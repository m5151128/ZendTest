<?php
require_once __DIR__ . '/setup.php';

// イベントの取得
$query = $service->newEventQuery();
$query->setUser('default');
$query->setVisibility('private');
$query->setProjection('full');
$query->setOrderby('starttime');
//$query->setFutureevents('true');

// 期間の指定
$query->setStartMin('2013-04-01');
$query->setStartMax('2020-03-31');

// カレンダーサーバからイベントの一覧を取得します
try {
    $eventFeed = $service->getCalendarEventFeed($query);
} catch (Zend_Gdata_App_Exception $e) {
    echo "エラー: " . $e->getMessage();
}

echo "イベント一覧:" . PHP_EOL;
foreach ($eventFeed as $event) {
    echo $event->title . PHP_EOL;
}
