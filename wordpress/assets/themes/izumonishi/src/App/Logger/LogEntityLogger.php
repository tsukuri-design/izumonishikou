<?php declare(strict_types=1);
namespace App\Logger;

use App\Model\LogEntity;
use App\Model\LogLevelTagEntity;
use Mvc4Wp\Core\Library\DateTimeUtils;
use Psr\Log\AbstractLogger;

class LogEntityLogger extends AbstractLogger
{
    protected static $thresholds = [
        'emergency' => 1,
        'alert' => 2,
        'critical' => 3,
        'error' => 4,
        'warning' => 5,
        'notice' => 6,
        'info' => 7,
        'debug' => 8,
    ];

    protected int $threshold;

    public function __construct(
        string $log_level,
    ) {
        if (array_key_exists($log_level, self::$thresholds)) {
            $this->threshold = self::$thresholds[$log_level];
        } else {
            $this->threshold = self::$thresholds['debug'];
        }
    }

    public function log($level, string|\Stringable $message, array $context = []): void
    {
        $threshold = $this->threshold;
        if (!array_key_exists($level, self::$thresholds)) {
            $threshold = self::$thresholds['debug'];
        }

        if (self::$thresholds[$level] <= $threshold) {
            $entry = new LogEntity();
            $date = DateTimeUtils::datetime();
            $entry->post_title = $date . ' - ' . strtoupper($level) . ' --> ' . $message;
            $entry->post_content = var_export($context, true);
            $entry->register(true);
            $tag = LogLevelTagEntity::findBySlug($level);
            if (is_null($tag)) {
                $tag = new LogLevelTagEntity();
                $tag->name = strtoupper($level);
                $tag->slug = $level;
                $tag->description = '';
                $tag->register();
            }
            $entry->addTag($tag);
        }
    }
}