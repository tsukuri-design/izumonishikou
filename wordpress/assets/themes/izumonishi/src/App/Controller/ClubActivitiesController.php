<?php declare(strict_types=1);
namespace App\Controller;

use Mvc4Wp\Core\Controller\PlainPhpController;
use Mvc4Wp\Core\Library\Castable;
use Mvc4Wp\Core\Model\UserEntity;

class ClubActivitiesController extends PlainPhpController
{
    use Castable;

    private string $name;

    public function init(array $args = []): void
    {
        $this->name = '';
    }

    private function page(string $view, array $data): self
    {
        $this->view('components/header', $data);
        $this->view($view, $data)->view('components/footer', $data);
        return $this;
    }

    public function index(array $args = []): void
    {
        // error_log("CONTROLLER DEBUG: SingularController::index() called with args: " . json_encode($args));

        $slug = $args['slug'] ?? null;
        $post_id = $args['id'] ?? null;
        $post_type = $args['post_type'] ?? 'post'; //  Default to 'post' if not set

        if (!$slug && !$post_id) {
            // error_log("CONTROLLER ERROR: No slug or post ID provided!");
            $this->notFound()->done();
            return;
        }

        $query_args = [
            'post_type' => $post_type,
            'posts_per_page' => 1,
        ];

        //  If post ID is provided (for previews), use it instead of slug
        if ($post_id) {
            // error_log("CONTROLLER DEBUG: Loading post by ID {$post_id} (Post Type: {$post_type})");
            $query_args['p'] = (int) $post_id;
        } else {
            // error_log("CONTROLLER DEBUG: Loading post by slug {$slug} (Post Type: {$post_type})");
            $query_args['name'] = $slug;
        }

        $query = new \WP_Query($query_args);

        if (!$query->have_posts()) {
            // error_log("CONTROLLER ERROR: No post found!");
            $this->notFound()->done();
            return;
        }

        $query->the_post();
        // error_log("CONTROLLER DEBUG: Successfully loaded post: " . get_the_title());

        $data = [
            'title' => get_the_title() . '',
            'styles' => ['singular'],
            'scripts' => [
                'typekit',
                'noie',
                'jquery',
                'check_analytics',
                'lazysizes',
                'smooth-scroll.polyfills',
                'inview',
            ],
        ];

        wp_reset_postdata();

        $this
            ->ok()
            ->page('school-life/body', $data)
            ->done();
    }

    public function club_activities(array $args): void
    {
        // 部活動データの配列
        $club_activities_pickup = [
            [
                'badge' => 'かみあり国スポ強化指定校',
                'bracket' => '目指せ全国大会出場',
                'club_name' => '女子柔道部',
                'captain_name' => '主将 國谷 菜々心 さん',
                'image' => 'school-life/club-activities/pickup1',
                'comment' => '３年生４人、２年生２人、１年生７人の計13人で活動しています。みんなで声をかけ、助け合いながら心身ともに成長できるよう日々練習をしています。県大会で優勝する感動など、充実した学校生活を一緒に体験しましょう。',
                'achievements' => [
                    '令和４年度 インターハイ57kg級第３位',
                    '令和５年度 インターハイ48kg,52kg,70kg,78kg,78kg超級出場',
                    '令和６年度 全国高校選手権個人52kg,57kg,無差別級・団体出場'
                ],
                'coach_title' => '指導者の横顔',
                'coach_name' => '監督　青木 聡美',
                'coach_description' => '出雲西高校在学中は、インターハイ出場、中国大会団体・個人優勝、金鷲旗（全国大会） ３位などの実績を持つ。あさひ銀行（現・りそな銀行）・日水製薬など実業団でも全国大会で入賞。本校の指導者としても多くの選手をインターハイや国体などに出場させている。',
                'coach_image' => 'school-life/club-activities/pickup1_add',
                'reverse' => false
            ],
            [
                'badge' => null, // 表示しない
                'bracket' => '目指せ全国大会出場',
                'club_name' => '男子柔道部',
                'captain_name' => '主将 坂田 秀太 さん',
                'image' => 'school-life/club-activities/pickup2',
                'comment' => '私たち柔道部は、県総体優勝を目標に、日々真剣に練習に取り組んでいます。部員一人ひとりが個性豊かで、明るく前向きな雰囲気の中で活動しています。稽古を通して技術だけでなく、心身ともにたくましく成長できる部活動です。',
                'achievements' => [
                    '令和４年度 県高校総体団体準優勝',
                    '令和６年度 県高校総体団体３位',
                    '令和７年度 中国大会予選団体準優勝'
                ],
                'coach_title' => '指導者の横顔',
                'coach_name' => '監督　石飛 凜太郎',
                'coach_description' => '中学校時代に全国大会出場。高校でもインターハイ出場、中国大会３位の実績を持つ。岡山商大在籍時も中四国大会優勝やインカレ出場など、島根県を代表する競技者としての実力と実績を有している。',
                'coach_image' => 'school-life/club-activities/pickup2_add',
                'reverse' => true
            ],
            [
                'badge' => 'NEW',
                'bracket' => '目指せ中国大会出場！',
                'club_name' => '男子ソフトテニス部',
                'captain_name' => '顧問 比護 洋介 先生',
                'image' => 'school-life/club-activities/pickup3',
                'comment' => '中学校から引き続き活動したい人、高校から始めたい人も大歓迎です。私と一緒に楽しみながら、強くなっていきましょう。そして生涯にわたってソフトテニスを楽しみましょう。',
                'achievements' => null,
                'coach_title' => '指導者の横顔',
                'coach_name' => null,
                'coach_description' => '競技者数が多い東京都で、中学生時代には強化指定選手に選ばれ、専修大学附属高校在学時は全国私立大会出場。学習院大学在学中も競技者として活躍。今後、出雲西高校での指導者としての活躍もご期待ください。',
                'coach_image' => 'school-life/club-activities/pickup3_add',
                'reverse' => false
            ],
            [
                'badge' => null, // 表示しない
                'bracket' => '心響麗音！',
                'club_name' => '吹奏楽部',
                'captain_name' => '部長 竹下 奈那 さん',
                'image' => 'school-life/club-activities/pickup4',
                'comment' => '中国大会金賞を目標に練習に励んでいます。コンクールの他にも、文化祭や野球応援、演奏会や依頼演奏などがあります。学年関係なく仲が良く、貴重な経験ができ、大きく成長できる部活動です。私たちと一緒に楽しみながら吹奏楽をしませんか？',
                'achievements' => [
                    '第65回全日本吹奏楽コンクール島根県大会 高等学校小編成の部金賞',
                    '2024(第30回)日本管楽合奏コンテスト全国大会 高校生S部門優秀賞'
                ],
                'coach_title' => '指導者の横顔',
                'coach_name' => '顧問　千葉 一樹',
                'coach_description' => '国立音楽大学でチューバを専攻し、佐藤和彦氏らに師事。シカゴのミッドウエストバンドクリニックに参加するなど、奏者として高い技能と実績を有している。また、吹奏楽指導法・指揮法を大澤健一氏に師事し、指導技術を磨いている。',
                'coach_image' => 'school-life/club-activities/pickup4_add',
                'reverse' => true
            ],
            [
                'badge' => null,
                'bracket' => '目指せ中国大会出場！',
                'club_name' => '剣道部',
                'captain_name' => '主将 長岡 亮樹 さん',
                'image' => 'school-life/club-activities/pickup5',
                'comment' => '学年を超えて仲が良く、稽古と普段の生活にメリハリがあり、人間的に大きく成長できます。遠征の機会も多く、幅広い剣友と交流することで交友の輪を広げることができます。経験者の方はもちろん、剣道に興味のある方は大歓迎です！',
                'achievements' => [
                    '個人インターハイ　・全国選抜大会団体',
                    '中国大会団体個人出場'
                ],
                'coach_title' => '指導者の横顔',
                'coach_name' => '監督 高瀬 遼太',
                'coach_description' => '高校時代には滋賀県代表としてインターハイ出場。大阪体育大学在学中も全国レベルの大会で活躍。島根県に居を移してからも、全日本選手権、全国教職員大会に島根県代表として出場している。剣道の理念である「人間形成」をモットーに指導にあたっている。',
                'coach_image' => 'school-life/club-activities/pickup5_add',
                'reverse' => false
            ],
            [
                'badge' => null, // 表示しない
                'bracket' => '新しい活動に挑戦！',
                'club_name' => 'インターアクトクラブ',
                'captain_name' => '部長 今若 雅・柘植 心 さん',
                'image' => 'school-life/club-activities/pickup6',
                'comment' => '私たちインターアクトクラブでは、環境保全活動を中心とした地域奉仕活動を行っています。また、活動を通じて地域の方々とたくさんふれあい、幅広い分野の知識を学んでいきます。ぜひ私たちと一緒に活動しましょう！',
                'achievements' => [
                    '令和４年度 ボランティア・スピリットアワード高校生部門',
                    '令和３年度 全国ユース環境活動発表大会全国大会優秀賞',
                    '令和３年度 脱炭素チャレンジカップ2022 全国大会いのちをつなぐSARAYA賞'
                ],
                'coach_title' => '指導者の横顔',
                'coach_name' => '顧問　原 弥生',
                'coach_description' => 'インターアクトクラブとは、ロータリークラブの支援を受け1966年に結成された、歴史のあるクラブです。様々な奉仕活動を通して、様々な人々と交流し、多くの気づきや学びを得ています。',
                'coach_image' => 'school-life/club-activities/pickup6_add',
                'reverse' => true
            ],

        ];

        // 部活動データの配列
        $club_activities_sports = [
            [
                'badge' => 'かみあり国スポ強化指定校',
                'bracket' => '目指せ全国大会出場',
                'club_name' => '女子柔道部',
                'captain_name' => '主将 國谷 菜々心 さん',
                'image' => 'school-life/club-activities/pickup1',
                'comment' => '３年生４人、２年生２人、１年生７人の計13人で活動しています。みんなで声をかけ、助け合いながら心身ともに成長できるよう日々練習をしています。県大会で優勝する感動など、充実した学校生活を一緒に体験しましょう。',
                'achievements' => [
                    '令和４年度 インターハイ57kg級第３位',
                    '令和５年度 インターハイ48kg,52kg,70kg,78kg,78kg超級出場',
                    '令和６年度 全国高校選手権個人52kg,57kg,無差別級・団体出場'
                ],
                'coach_title' => '指導者の横顔',
                'coach_name' => '監督　青木 聡美',
                'coach_description' => '出雲西高校在学中は、インターハイ出場、中国大会団体・個人優勝、金鷲旗（全国大会） ３位などの実績を持つ。あさひ銀行（現・りそな銀行）・日水製薬など実業団でも全国大会で入賞。本校の指導者としても多くの選手をインターハイや国体などに出場させている。',
                'coach_image' => 'school-life/club-activities/pickup1_add',
                'reverse' => false
            ]

        ];

        $data = [
            'title' => wp_strip_all_tags(html_entity_decode(get_the_title())) . '｜' . get_bloginfo('name'),
            'content' => get_the_content(),
            'club_activities_pickup' => $club_activities_pickup,
            'club_activities_sports' => $club_activities_sports,
            'styles' => [
                'components/global',
                'components/block_editor_content',
                'singular',
                'school-life/club-activities',
            ],
            'scripts' => [
                'typekit',
                'noie',
                'jquery',
                'check_analytics',
                'lazysizes',
                'smooth-scroll.polyfills',
            ],
        ];

        $this
            ->ok()
            ->page('school-life/club-activities', $data)
            ->done();
    }

    public function other(array $args): void
    {

        $data = [
            'title' => wp_strip_all_tags(html_entity_decode(get_the_title())) . '｜' . get_bloginfo('name'),
            'content' => get_the_content(),
            'styles' => ['singular'],
            'scripts' => [
                'typekit',
                'noie',
                'jquery',
                'check_analytics',
                'lazysizes',
                'smooth-scroll.polyfills',
            ],
        ];

        $this
            ->ok()
            ->page('singular/other', $data)
            ->done();
    }

    public function redirect(array $args = []): void
    {
        $this
            ->done();
    }
}
