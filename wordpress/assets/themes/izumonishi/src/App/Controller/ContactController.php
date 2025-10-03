<?php declare(strict_types=1);
namespace App\Controller;

use Mvc4Wp\Core\Controller\PlainPhpController;
use Mvc4Wp\Core\Library\Castable;

class ContactController extends PlainPhpController
{
    use Castable;

    private string $name;
    const INITIAL_SCREEN = 0;
    const CONFIRMATION_SCREEN = 1;
    const COMPLETION_SCREEN = 2;

    private string $nonceKey = 'XXX';
    public string $recaptcha_site_key;
    private string $recaptcha_secret_key;

    public int $branch = self::INITIAL_SCREEN;
    public array $errors = [];
    public string $submitLabel = '入力内容を確認';
    public string $readonly = '';

    public function init(array $args = []): void
    {
        $this->name = 'XXX';
        $this->setRecaptchaKeys();

    }

    private function page(string $view, array $data): self
    {
        $this->view('components/header', $data);
        // $this->view('navigation', $data);
        $this->view($view, $data)->view('components/footer', $data);
        return $this;
    }
    private function setRecaptchaKeys(): void
    {
        $contact_page = get_page_by_path('contact');
        if (!$contact_page) {
            // error_log('Contact page not found.');
            return;
        }
        $page_id = $contact_page->ID;

        $this->recaptcha_site_key = get_field('recaptcha_site_key', $page_id) ?? '';
        $this->recaptcha_secret_key = get_field('recaptcha_secret_key', $page_id) ?? '';

        if (!$this->recaptcha_site_key || !$this->recaptcha_secret_key) {
            // error_log('reCAPTCHA keys are missing.');
        }
    }

    private function validateReCAPTCHA(): bool
    {
        if (empty($this->recaptcha_secret_key)) {
            // error_log('reCAPTCHA secret key is missing.');
            return false;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['recaptcha_response'])) {
            // error_log('reCAPTCHA response is missing.');
            return false;
        }

        $response = $_POST['recaptcha_response'];
        $verifyResponse = @file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$this->recaptcha_secret_key}&response={$response}");
        if ($verifyResponse === false) {
            // error_log('reCAPTCHA API request failed.');
            return false;
        }

        $response_data = json_decode($verifyResponse, true);
        if (!$response_data['success'] || $response_data['score'] < 0.5) {
            // error_log('reCAPTCHA verification failed.');
            return false;
        }

        return true;
    }

    public function index(array $args = []): void
    {
        try {
            $this->branch = $this->determineBranch();
            $formData = $this->getFormData();

            $data = [
                'title' => 'Contact｜' . get_bloginfo('name'),
                'styles' => ['contact'],
                'scripts' => [
                    'typekit',
                    'noie',
                    'jquery',
                    'check_analytics',
                    'lazysizes',
                    'smooth-scroll.polyfills',
                    'inview',
                    'form',
                ],
                'branch' => $this->branch,
                'formData' => $formData,
                'errors' => $this->errors,
                'submitLabel' => $this->submitLabel,
                'readonly' => $this->readonly,
                'nonceKey' => $this->nonceKey,
                'recaptcha' => $this->recaptcha_site_key,
            ];

            if ($this->branch === self::COMPLETION_SCREEN) {
                $this->sendEmail($formData);
            }

            $this
                ->ok()
                ->page('contact/body', $data)
                ->done(); // Ensure this method and view exist
        } catch (\Throwable $e) {
            // error_log('Error in ContactController: ' . $e->getMessage());
            wp_die('An unexpected error occurred. Please try again later.');
        }
    }
    public function post(array $args = []): void
    {
        try {
            // error_log('POST method started.');
            $this->branch = $this->determineBranch();
            // error_log('Branch determined: ' . $this->branch);
            $formData = $this->getFormData();
            // error_log('Form data: ' . print_r($formData, true));

            $data = [
                'title' => 'Contact｜' . get_bloginfo('name'),
                'styles' => ['contact'],
                'scripts' => [
                    'typekit',
                    'noie',
                    'jquery',
                    'check_analytics',
                    'lazysizes',
                    'smooth-scroll.polyfills',
                    'inview',
                    'form',
                    'recaptcha',
                ],
                'branch' => $this->branch,
                'formData' => $formData,
                'errors' => $this->errors,
                'submitLabel' => $this->submitLabel,
                'readonly' => $this->readonly,
                'nonceKey' => $this->nonceKey,
                'recaptcha' => $this->recaptcha_site_key,
            ];
            if (!$this->validateReCAPTCHA()) {
                $this->errors['recaptcha'] = 'reCAPTCHA認証に失敗しました。';
            }

            if ($this->branch === self::COMPLETION_SCREEN) {
                $this->sendEmail($formData);
                // error_log('Email sent successfully.');
            }

            $this
                ->ok()
                ->page('contact/body', $data)
                ->done();
            // error_log('Page rendered successfully.');
        } catch (\Throwable $e) {
            // error_log('Error in ContactController POST: ' . $e->getMessage());
            wp_die('An unexpected error occurred during form submission. Please try again later.');
        }
    }



    private function determineBranch(): int
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return self::INITIAL_SCREEN;
        }

        if (empty($_POST['nonce']) || !$this->isValidNonce($_POST['nonce'])) {
            wp_die('Invalid nonce.');
        }

        // If returning to branch 0, keep data intact
        if (isset($_POST['branch']) && $_POST['branch'] === '0') {
            return self::INITIAL_SCREEN;
        }

        $this->validateForm();

        if (empty($this->errors)) {
            return isset($_POST['branch']) && $_POST['branch'] === '2'
                ? self::COMPLETION_SCREEN
                : self::CONFIRMATION_SCREEN;
        }

        return self::INITIAL_SCREEN;
    }

    /**
     * reCAPTCHA検証
     */
    public function reCAPTCHA()
    {
        // ページIDを安全に取得
        $contact_page = get_page_by_path('contact');
        if (!$contact_page) {
            // error_log('Contact page not found.');
            return; // ページが見つからない場合、処理を中断
        }
        $page_id = $contact_page->ID;

        // ACFからreCAPTCHAのサイトキーを安全に取得
        $recaptcha_site_key = get_field('recaptcha_site_key', $page_id);

        if (!$recaptcha_site_key) {
            // error_log('reCAPTCHA secret key not found.');
            return; // シークレットキーが見つからない場合、処理を中断
        } else {
            $this->recaptcha_site_key = $recaptcha_site_key;
        }

        // ACFからreCAPTCHAのシークレットキーを安全に取得
        $recaptcha_secret_key = get_field('recaptcha_secret_key', $page_id);
        if (!$recaptcha_secret_key) {
            // error_log('reCAPTCHA secret key not found.');
            return; // シークレットキーが見つからない場合、処理を中断
        }

        // POSTリクエストの確認
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['recaptcha_response'])) {
            return; // POSTリクエストでない、またはreCAPTCHAのレスポンスがない場合、処理を中断
        }

        // reCAPTCHAの検証リクエスト
        $response = $_POST['recaptcha_response'];
        $verifyResponse = @file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptcha_secret_key}&response={$response}");
        if ($verifyResponse === FALSE) {
            // error_log('reCAPTCHA API request failed.');
            wp_die('reCAPTCHA API request failed.'); // APIリクエスト失敗時の処理
        }

        $response_data = json_decode($verifyResponse);

        // スコアをログに記録
        error_log('reCAPTCHAスコア: ' . $response_data->score);

        if (!$response_data->success || $response_data->score < 0.5) {
            // error_log('reCAPTCHAの検証に失敗しました。最初からやり直してください。');
            wp_die('reCAPTCHAの検証に失敗しました。最初からやり直してください。'); // 検証失敗時の処理
        }
    }

    private function isValidNonce(string $nonce): bool
    {
        return (bool) wp_verify_nonce($nonce, $this->nonceKey);
    }


    private function getFormData(): array
    {
        $defaultData = [
            'sender_name' => '',
            'company' => '',
            'tel' => '',
            'email' => '',
            'content' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach ($defaultData as $key => $value) {
                $defaultData[$key] = htmlspecialchars($_POST[$key] ?? '', ENT_QUOTES, 'UTF-8');
            }
        }

        return $defaultData;
    }


    private function validateForm(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['sender_name'])) {
                $this->errors['sender_name'] = 'お名前は必須です。';
            }
            if (empty($_POST['company'])) {
                $this->errors['company'] = '会社名は必須です。';
            }
            if (empty($_POST['tel'])) {
                $this->errors['tel'] = '有効な電話番号は必須です。';
            }
            if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $this->errors['email'] = '有効なメールアドレスは必須です。';
            }
            // if ($_POST['email'] !== ($_POST['email_confirm'] ?? '')) {
            //     $this->errors['email_confirm'] = 'メールアドレスが一致しません。';
            // }
            if (empty($_POST['content'])) {
                $this->errors['content'] = 'お問い合わせ内容は必須です。';
            }
            if (empty($_POST['privacy'])) {
                $this->errors['privacy'] = 'プライバシーポリシーへの同意が必要です。';
            }
        }
    }
    private function logMailSend(array $formData, string $to, string $subject, string $status): void
    {
        $logDir = dirname(__DIR__, 3) . '/logs'; // Adjust based on your folder structure
        $logFile = $logDir . '/contact_email.log';

        if (!file_exists($logDir)) {
            mkdir($logDir, 0750, true); // create logs directory securely
        }

        $logEntry = sprintf(
            "[%s] To: %s | Name: %s | Subject: %s | Status: %s\n",
            date('Y-m-d H:i:s'),
            $to,
            $formData['sender_name'] ?? 'N/A',
            $subject,
            $status
        );

        file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
    }
    private function sendEmail(array $formData): void
    {
        mb_language('ja');
        mb_internal_encoding('UTF-8');

        $to = $formData['email'];
        $subject = 'お問い合わせありがとうございます';
        $from = 'info@XXX.jp';
        $bcc = 'info@XXX.jp';
        $message =
            "{$formData['sender_name']} 様 \n\n" .
            "この度はお問い合せいただき誠にありがとうございます。" . "\r\n" .
            "お問い合せ内容を確認次第、弊社担当者よりご返答いたしますので、" . "\r\n" .
            "今しばらくお待ちくださいますよう、よろしくお願い申し上げます。" . "\r\n" .
            "\r\n" .
            "登録された内容は下記のとおりです。" . "\r\n" .
            "------------------------------------------------- \n\n" .
            "【お名前】\n {$formData['sender_name']}\n\n" .
            "【会社名】\n {$formData['company']}\n\n" .
            "【メール】\n {$formData['email']}\n\n" .
            "【電話番号】\n {$formData['tel']}\n\n" .
            "【内容】\n {$formData['content']}\n\n" .
            '-------------------------------------------------' . "\r\n" .
            "\r\n" .
            'よろしくお願い申し上げます。' . " \r\n" .
            "\r\n" .
            'XXX株式会社' . " \r\n"
        ;

        $headers = ['From' => "XXX <{$from}>"];
        if (!empty($bcc)) {
            $headers['Bcc'] = $bcc;
        }
        $isSent = mb_send_mail($to, $subject, $message, $headers);

        $this->logMailSend($formData, $to, $subject, $isSent ? 'Success' : 'Failed');
    }
}
