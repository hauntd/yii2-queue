<?php

namespace zhuravljov\yii\queue;

use Yii;
use yii\base\Behavior;

/**
 * Class LogBehavior
 *
 * @author Roman Zhuravlev <zhuravljov@gmail.com>
 */
class LogBehavior extends Behavior
{
    /**
     * @var Queue
     */
    public $owner;

    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            Queue::EVENT_AFTER_PUSH => function (JobEvent $event) {
                Yii::info(get_class($event->job) . ' pushed.', Queue::class);
            },
            Queue::EVENT_BEFORE_WORK => function (JobEvent $event) {
                Yii::info(get_class($event->job) . ' started.', Queue::class);
            },
            Queue::EVENT_AFTER_WORK => function (JobEvent $event) {
                Yii::info(get_class($event->job) . ' finished.', Queue::class);
            },
            Queue::EVENT_AFTER_ERROR => function (ErrorEvent $event) {
                Yii::error(get_class($event->job) . ' error ' . $event->error, Queue::class);
            },
        ];
    }
}