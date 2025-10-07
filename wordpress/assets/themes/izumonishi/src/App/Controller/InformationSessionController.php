<?php declare(strict_types=1);
namespace App\Controller;

use Mvc4Wp\Core\Controller\PlainPhpController;
use Mvc4Wp\Core\Library\Castable;

class InformationSessionController extends PlainPhpController
{
    use Castable;

    public function init(array $args = []): void
    {
        // no-op
    }

    private function page(string $view, array $data): self
    {
        $this->view('components/header', $data);
        $this->view($view, $data)->view('components/footer', $data);
        return $this;
    }

    /**
     * Single-page version for admissions/events
     * - No slug checks, no headings
     * - Categories become audience badges
     */
    public function index(array $args = []): void
    {
        // Fetch all upcoming sessions (no parent slug filtering)
        $info_sessions = $this->getInfo();

        // 親ページ情報を取得
        $parent_info = $this->getParentPageInfo();

        // Normalize for view (flat list)
        $normalized = [];
        foreach ($info_sessions as $session) {
            // Date pieces
            $dateObj = null;
            $date = $session['date'];
            if ($date) {
                $dateObj = (strpos($date, '/') !== false)
                    ? \DateTime::createFromFormat('m/d/Y', $date)
                    : \DateTime::createFromFormat('Y-m-d', $date);
            }
            $weekdays = ['日', '月', '火', '水', '木', '金', '土'];
            $weekday = $dateObj ? $weekdays[(int) $dateObj->format('w')] : '';
            $date_disp = $dateObj ? $dateObj->format('Y年n月j日') . "（{$weekday}）" : '';
            $year = $dateObj ? $dateObj->format('Y年') : '';
            $month = $dateObj ? $dateObj->format('n') : '';
            $day = $dateObj ? $dateObj->format('j') : '';

            // Time display
            $start = $session['start_time'] ? substr($session['start_time'], 0, 5) : '';
            $end = $session['end_time'] ? substr($session['end_time'], 0, 5) : '';
            $time_disp = ($start && $end) ? "{$start}–{$end}" : $start;

            // Build flat item (audiences already derived from terms)
            $normalized[] = [
                'event_number' => $session['event_number'],
                'year' => $year,
                'month' => $month,
                'day' => $day,
                'weekday' => $weekday,
                'date_display' => $date_disp,
                'time_display' => $time_disp,
                'title' => $session['title'],
                'location' => $session['location'],
                'text' => $session['text'],
                'link' => $session['link'],
                'audiences' => $session['audiences'] ?? [], // ← categories as badges
            ];
        }

        $data = [
            'title' => get_the_title(),
            'en_title' => get_field('en'),
            'content' => get_the_content(),
            'parent_info' => $parent_info,
            'styles' => [
                'components/global',
                'components/block_editor_content',
                'singular',
                'info_session'
            ],
            'scripts' => [
                'typekit',
                'noie',
                'jquery',
                'lazysizes',
                'smooth-scroll.polyfills',
                'inview',
                'menu',
                'singular',
                'global',
            ],
            'sessions' => $normalized,         // ← flat list for the view
            'custom_related_posts' => '',                  // not used here
            'current_page_hierarchy' => get_current_page_hierarchy(),
        ];

        $this->ok()->page('information-session/index', $data)->done();
    }

    /**
     * Get all upcoming information_session posts (no taxonomy parent filter)
     * Hides events already started (<= now + 1h, JST).
     */
    public function getInfo(): array
    {
        $args = [
            'post_type' => 'information_session',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'meta_key' => 'date',
            'orderby' => 'meta_value',
            'order' => 'ASC',
        ];

        $query = new \WP_Query($args);
        $info_sessions = [];

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();

                $date = get_field('date');
                $start_time = get_field('start_time');

                // Hide already-started (<= now + 1h)
                if ($date && $start_time) {
                    $dateObj = (strpos($date, '/') !== false)
                        ? \DateTime::createFromFormat('m/d/Y', $date)
                        : \DateTime::createFromFormat('Y-m-d', $date);

                    if ($dateObj) {
                        $date_for_compare = $dateObj->format('Y-m-d');
                        $start_time_short = substr((string) $start_time, 0, 5);
                        $event_dt = new \DateTime($date_for_compare . ' ' . $start_time_short, new \DateTimeZone('Asia/Tokyo'));
                        $event_ts = $event_dt->getTimestamp();
                        $now_ts = (new \DateTime('now', new \DateTimeZone('Asia/Tokyo')))->getTimestamp();

                        if ($event_ts <= ($now_ts + 3600)) {
                            continue;
                        }
                    }
                }

                // Build audience badges from ALL category terms
                $terms = get_the_terms(get_the_ID(), 'information_session_category');
                $terms = (!is_wp_error($terms) && !empty($terms)) ? $terms : [];

                $audiences = [];
                foreach ($terms as $t) {
                    if (!($t instanceof \WP_Term))
                        continue;
                    $audiences[] = [
                        'name' => $t->name,
                        'slug' => sanitize_title($t->slug ?: $t->name),
                    ];
                }

                $info_sessions[] = [
                    'ID' => get_the_ID(),
                    'event_number' => get_field('event_number'),
                    'date' => $date,
                    'start_time' => $start_time,
                    'end_time' => get_field('end_time'),
                    'title' => get_field('title'),
                    'location' => get_field('location'),
                    'text' => get_field('text'),
                    'link' => get_field('link'),
                    'audiences' => $audiences,
                ];
            }
            wp_reset_postdata();
        }

        return $info_sessions;
    }

    private function getParentPageInfo(): ?array
    {
        $current_id = get_the_ID();

        // URLからページIDを直接取得を試行
        $url_parts = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $potential_page_id = null;
        foreach ($url_parts as $part) {
            if (is_numeric($part)) {
                $potential_page_id = (int) $part;
                break;
            }
        }

        // 実際のページIDを使用（URLから取得したIDまたは現在のID）
        $actual_page_id = $potential_page_id ?: $current_id;
        $ancestors = get_post_ancestors($actual_page_id);

        if (!empty($ancestors)) {
            $top_parent_id = end($ancestors);
            $parent_en = function_exists('get_field') ? get_field('en', $top_parent_id) : '';
            $parent_url = get_permalink($top_parent_id);
            $parent_text = $parent_en ? $parent_en : get_the_title($top_parent_id);

            return [
                'id' => $top_parent_id,
                'url' => $parent_url,
                'text' => $parent_text,
                'en' => $parent_en
            ];
        }

        return null;
    }

    public function redirect(array $args = []): void
    {
        $this->done();
    }
}
