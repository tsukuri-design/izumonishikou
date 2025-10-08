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
                'global',
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

        // 運動部データの配列
        $club_activities_sports = [
            [
                'bracket' => '目指せ甲子園出場！',
                'club_name' => '野球部',
                'captain_name' => '主将 白根 千尋 さん',
                'image' => 'school-life/club-activities/sports1',
                'comment' => '「甲子園出場」という大きな目標に向けて、日々練習に取り組んでいます。応援されるチームを目指し、挨拶や礼儀といった基本的な姿勢も大切にしています。支えてくださる多くの方々への感謝の気持ちを忘れず、これからも努力を重ねていきます。',
            ],
            [
                'bracket' => '目指せ中国総体出場！',
                'club_name' => '陸上部',
                'captain_name' => '部長 矢野 唯斗 さん',
                'image' => 'school-life/club-activities/sports2',
                'comment' => '陸上部では、部員それぞれが明確な目標を持ち、その達成に向けて日々努力を重ねています。記録の向上だけでなく、仲間と楽しみながら活動できるのが魅力の部活動です。興味のある方は、ぜひ私たちと一緒に活動しませんか？',
            ],
            [
                'bracket' => '目指せ県大会ベスト４！',
                'club_name' => 'サッカー部',
                'captain_name' => '部長 須山 俊輔 さん',
                'image' => 'school-life/club-activities/sports3',
                'comment' => 'サッカー部は、県大会ベスト4を目標に掲げ、限られた練習時間の中でも一人ひとりが高い集中力を持って日々の活動に取り組んでいます。学年の垣根を越えて仲が良く、チーム全体に明るく前向きな雰囲気が広がっている楽しい部活動です。',
            ],
            [
                'bracket' => '目指せ中国総体出場！',
                'club_name' => '女子テニス部',
                'captain_name' => '部長 稲田 悠希 さん',
                'image' => 'school-life/club-activities/sports4',
                'comment' => '女子テニス部は学年を問わず仲が良く、オンとオフの切り替えを大切にしながら、和やかな雰囲気で楽しく活動しています。部員それぞれが個人戦や団体戦で目標を立て、その目標達成に向けて日々練習に励んでいます。',
            ],
            [
                'bracket' => '目指せ中国総体出場！',
                'club_name' => '男子テニス部',
                'captain_name' => '部長 河口 純誠 さん',
                'image' => 'school-life/club-activities/sports5',
                'comment' => '男子テニス部は、学年に関わらず部員同士が良い関係を築いている部活です。大会では一回でも多く勝ち上がるために、日々練習を頑張っています。中国総体団体出場という目標に向かって、一緒に心身を鍛えましょう。',
            ],
            [
                'bracket' => '目指せインハイ出場！',
                'club_name' => 'ボクシング部',
                'captain_name' => '部長 河瀬 柊磨 さん',
                'image' => 'school-life/club-activities/sports6',
                'comment' => '私たちボクシング部は、大池ボクシングジムに通いながら日々練習に取り組んでいます。ジムでは社会人の方々とも一緒に汗を流し、インターハイ出場という目標に向かって、実戦的な環境の中でトレーニングに励んでいます。',
            ],
            [
                'bracket' => '目指せ初戦突破！',
                'club_name' => '女子バレー部',
                'captain_name' => '部長 竹内 綾菜 さん',
                'image' => 'school-life/club-activities/sports7',
                'comment' => '私たち女子バレーボール部は、「明るく、元気で、笑顔に」をモットーに、日々の練習に取り組んでいます。少しでも興味のある方は、ぜひ気軽に見学に来てください。お待ちしています！',
            ],
            [
                'bracket' => '目指せ県大会ベスト16！',
                'club_name' => '男子バスケ部',
                'captain_name' => '部長 井之上 陸翔 さん',
                'image' => 'school-life/club-activities/sports8',
                'comment' => '男子バスケットボール部です。私たちは、チームの目標達成に向けて日々練習に励んでいます。経験者はもちろん、初心者でも楽しめる環境ですので、興味のある方はぜひ一緒にバスケを楽しみましょう！',
            ],
            [
                'bracket' => '体力強化・スキルアップ！',
                'club_name' => '女子バスケ部',
                'captain_name' => '部長 山本 悠真 さん',
                'image' => 'school-life/club-activities/sports9',
                'comment' => '私たち女子バスケットボール部は、現在１年生２名で活動しています。経験者はもちろん、初心者の方も大歓迎です。少人数だからこそ１人ひとりが活躍できる部活ですので、高校から新しい挑戦をしたいという方は、ぜひ一緒に楽しく頑張りましょう！',
            ],
            [
                'bracket' => '目指せ全国上位入賞！',
                'club_name' => 'ゲートボール部',
                'captain_name' => '部長 山本 悠真 さん',
                'image' => 'school-life/club-activities/sports10',
                'comment' => 'ゲートボールは、幅広い年代の方々と交流しながら楽しめるスポーツです。ルールや技術は丁寧に教えていますので、初心者の方も安心して始められます。出雲西高校ゲートボール部で全国大会出場を目指して一緒に頑張りましょう！',
            ]
        ];

        // 文化部データの配列
        $club_activities_culture = [
            [
                'bracket' => '目指せ全国大会出場！',
                'club_name' => '写真部',
                'captain_name' => '部長 鎌田 一輝 さん',
                'image' => 'school-life/club-activities/culture1',
                'comment' => '私たち写真部は、限られた時間の中でも一日一日を大切にし、日々活動に励んでいます。撮影日にはさまざまな場所へ出かけ、ミーティング日には撮影した写真の鑑賞会を行なっています。初心者の方も大歓迎です。一緒に頑張りましょう！',
            ],
            [
                'bracket' => '学校を盛り上げる！',
                'club_name' => '放送部',
                'captain_name' => '部長 須山 萌咲 さん',
                'image' => 'school-life/club-activities/culture2',
                'comment' => '私たち放送部は、朝や昼の校内放送を担当するほか、学校行事では司会進行や音響などの裏方としても活動しています。初心者の方でも大歓迎ですので、ぜひ一緒に放送部で学校を盛り上げていきましょう！',
            ],
            [
                'bracket' => '部員同士の交流を深める！',
                'club_name' => '図書部',
                'captain_name' => '部長 森 智恵美 さん',
                'image' => 'school-life/club-activities/culture3',
                'comment' => '図書部は遅くても17時には活動が終了し、休日の活動もないため、自分のペースで無理なく続けられる部活です。活動内容は、本の紹介や新聞記事の切り抜き、図書室の飾りつけなどです。のんびりと楽しく活動できますので、ぜひ入部してください！',
            ],
            [
                'bracket' => 'メリハリある楽しい部活に！',
                'club_name' => '茶道部',
                'captain_name' => '部長 矢田 陽菜乃 さん',
                'image' => 'school-life/club-activities/culture4',
                'comment' => '一人ひとりが礼儀と作法を身につけることを目標に、外部講師の先生にご指導いただいています。部員は明るく、男女の仲が良く、お点前をする時は真剣に集中してやる、メリハリのあるメンバーです。一緒に活動できることを楽しみにしています！',
            ],
            [
                'bracket' => '楽しく好きな絵を描く！',
                'club_name' => '美術部',
                'captain_name' => '部長 中山 陽菜 さん',
                'image' => 'school-life/club-activities/culture5',
                'comment' => '美術部は週２回の活動で、勉強との両立もしやすく、自分のペースで取り組める部活動です。絵を描くことが好きな方はもちろん、これから始めてみたいという方も大歓迎です。興味のある方は、ぜひ一緒に楽しく制作活動をしましょう！',
            ],
            [
                'bracket' => '目指せインハイ出場！',
                'club_name' => '水泳同好会',
                'captain_name' => '部長 小村 ほのか さん',
                'image' => 'school-life/club-activities/culture6',
                'comment' => '私たち水泳同好会は、現在部員２名という少人数で活動していますが、インターハイ出場を目標に掲げ、日々の練習に取り組んでいます。夢のインターハイ出場に向けてこれからも全力で頑張っていきます。',
            ],
            [
                'bracket' => '笑顔で楽しむ！',
                'club_name' => 'ダンス同好会',
                'captain_name' => '部長 持田 綺菜 さん',
                'image' => 'school-life/club-activities/culture7',
                'comment' => '私たちダンス部は、「みんなで楽しく笑顔で踊る」をモットーに日々活動しています。ダンス経験の有無に関係なく、初心者の方も大歓迎です。ダンスに興味のある方は、ぜひ一緒に踊ってみませんか？',
            ]
        ];

        $data = [
            'title' => wp_strip_all_tags(html_entity_decode(get_the_title())) . '｜' . get_bloginfo('name'),
            'content' => get_the_content(),
            'club_activities_pickup' => $club_activities_pickup,
            'club_activities_sports' => $club_activities_sports,
            'club_activities_culture' => $club_activities_culture,
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
                'global',
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
