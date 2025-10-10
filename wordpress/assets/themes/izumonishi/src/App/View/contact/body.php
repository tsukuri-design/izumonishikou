<?php declare(strict_types=1); ?>
<main class="contact-content firstin show branch<?php echo $data['branch']; ?>" role="main">

    <div class="contact-contents contact_content">
        <?php if ($data['branch'] === 0): ?>
            <h1><span class="english">CONTACT</span><span class="japanese">お問い合わせ</span></h1>
            <div class="error">
                <?php foreach ($data['errors'] as $error): ?>
                    <p><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endforeach; ?>
            </div>

            <form action="" method="POST" class="form_block branch0">
                <div class="item name">
                    <label for="name">
                        <span class="char">お名前</span>
                    </label>
                    <input id="name" type="text" name="sender_name" value="<?php echo htmlspecialchars($data['formData']['sender_name'], ENT_QUOTES, 'UTF-8'); ?>" required placeholder="お名前をご入力ください">
                    <span class="error_label"></span>
                </div>

                <div class="item company">
                    <label for="company">
                        <span class="char">会社名 / 団体名</span>
                    </label>
                    <input id="company" type="text" name="company" value="<?php echo htmlspecialchars($data['formData']['company'], ENT_QUOTES, 'UTF-8'); ?>" required placeholder="所属企業/団体名をご入力ください">
                    <span class="error_label"></span>
                </div>

                <div class="item email">
                    <label for="email">
                        <span class="char">メールアドレス</span>
                    </label>
                    <input id="email" type="email" name="email" value="<?php echo htmlspecialchars($data['formData']['email'], ENT_QUOTES, 'UTF-8'); ?>" required placeholder="メールアドレスをご入力ください">
                    <span class="error_label"></span>
                </div>

                <div class="item tel">
                    <label for="tel">
                        <span class="char">電話番号</span>
                    </label>
                    <input id="tel" type="text" name="tel" value="<?php echo htmlspecialchars($data['formData']['tel'], ENT_QUOTES, 'UTF-8'); ?>" required placeholder="電話番号をご入力ください">
                    <span class="error_label"></span>
                </div>

                <div class="item content">
                    <label for="content">
                        <span class="char">お問い合わせ内容</span>
                    </label>
                    <textarea id="content" name="content" required placeholder="お問い合わせ内容をご入力ください"><?php echo htmlspecialchars(trim($data['formData']['content']), ENT_QUOTES, 'UTF-8'); ?></textarea>
                    </textarea>
                    <span class="error_label"></span>
                </div>

                <div class="item privacy_con">
                    <label class="container" for="privacy">
                        <input type="checkbox" id="privacy" name="privacy" value="プライバシーポリシーに同意する">
                        <label for="privacy" class="check_box checkmark"></label>
                    </label>
                    <div class="privacy"><a href="<?php echo esc_url(home_url()); ?>/privacy/" target="_blank">プライバシーポリシー</a>に同意する</div>
                    <span class="error_label"></span>
                </div>

                <div class="submit_cov">
                    <input type="submit" value="<?php echo htmlspecialchars($data['submitLabel'], ENT_QUOTES, 'UTF-8'); ?>">
                </div>

                <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                <input type="hidden" name="branch" value="1">
                <input type="hidden" name="nonce" value="<?php echo wp_create_nonce($data['nonceKey']); ?>">
            </form>

        <?php elseif ($data['branch'] === 1): ?>
            <h1><span class="english">CONFIRM</span><span class="japanese">お問い合わせ内容の確認</span></h1>
            <div class="confirm">

                <form action="" method="POST" class="form_block branch1">
                    <div class="item">
                        <label for="name">
                            <span class="char">お名前</span>
                        </label>
                        <input id="name" type="text" name="sender_name" value="<?php echo htmlspecialchars($data['formData']['sender_name'], ENT_QUOTES, 'UTF-8'); ?>" readonly>
                    </div>

                    <div class="item">
                        <label for="company">
                            <span class="char">会社名 / 団体名</span>
                        </label>
                        <input id="company" type="text" name="company" value="<?php echo htmlspecialchars($data['formData']['company'], ENT_QUOTES, 'UTF-8'); ?>" readonly>
                    </div>

                    <div class="item">
                        <label for="email">
                            <span class="char">メールアドレス</span>
                        </label>
                        <input id="email" type="email" name="email" value="<?php echo htmlspecialchars($data['formData']['email'], ENT_QUOTES, 'UTF-8'); ?>" readonly>
                    </div>

                    <div class="item">
                        <label for="tel">
                            <span class="char">電話番号</span>
                        </label>
                        <input id="tel" type="text" name="tel" value="<?php echo htmlspecialchars($data['formData']['tel'], ENT_QUOTES, 'UTF-8'); ?>" readonly>
                    </div>

                    <div class="item">
                        <label for="content">
                            <span class="char">お問い合わせ内容</span>
                        </label>
                        <textarea id="content" name="content" readonly><?php echo htmlspecialchars(trim($data['formData']['content']), ENT_QUOTES, 'UTF-8'); ?></textarea>
                        </textarea>
                    </div>

                    <div class="item privacy_con">
                        <label class="container" for="privacy">
                            <input type="checkbox" id="privacy" name="privacy" value="プライバシーポリシーに同意する" checked>
                            <label for="privacy" class="check_box checkmark"></label>
                        </label>
                        <div class="privacy"><a href="<?php echo esc_url(home_url()); ?>/privacy/" target="_blank">プライバシーポリシー</a>に同意する</div>
                        <span class="error_label"></span>
                    </div>

                    <div class="submit_cov">
                        <input type="submit" value="お問い合わせを送信">
                    </div>

                    <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                    <input type="hidden" name="branch" value="2">
                    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce($data['nonceKey']); ?>">
                </form>

                <form action="" method="POST" class="form_block branch1 return">
                    <div class="submit_cov return">
                        <input type="submit" value="戻って修正する">
                    </div>
                    <input type="hidden" name="branch" value="0">
                    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce($data['nonceKey']); ?>">
                    <input type="hidden" name="sender_name" value="<?php echo htmlspecialchars($data['formData']['sender_name'], ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="company" value="<?php echo htmlspecialchars($data['formData']['company'], ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($data['formData']['email'], ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="tel" value="<?php echo htmlspecialchars($data['formData']['tel'], ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="content" value="<?php echo htmlspecialchars($data['formData']['content'], ENT_QUOTES, 'UTF-8'); ?>">
                </form>
                <?php /*<p class="privacy">送信することで<a href="<?php echo get_home_url(); ?>/privacy/" target="_blank">利用規約</a>に同意したものとします。</p> */ ?>
            </div>

        <?php elseif ($data['branch'] === 2): ?>
            <div class="send_complete" id="thxMessage">
                <figure class="complete_ico"><?php svg('complete'); ?></figure>
                <h3 class="heading3">問い合わせを送信しました</h3>
                <p class="explain">お問い合せ内容を確認次第、<br class="md">ご連絡させていただきます。<br>今しばらくお待ちいただきますよう、<br class="md">よろしくお願いいたします。</p>
                <button class="back_to_top_button"><a href="<?php echo esc_url(home_url()); ?>">TOPに戻る</a></button>
            </div>
        <?php endif; ?>
    </div>
</main>
<script>
    const recaptchaSiteKey = '<?php echo htmlspecialchars($data['recaptcha'], ENT_QUOTES, 'UTF-8'); ?>';
    const template_uri = '<?php echo htmlspecialchars(get_theme_file_uri(), ENT_QUOTES, 'UTF-8'); ?>/';
</script>
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo htmlspecialchars($data['recaptcha'], ENT_QUOTES, 'UTF-8'); ?>"></script>