<?php
require_once __DIR__ . '/setup.php';

try {
    $listFeed= $service->getCalendarListFeed();
} catch (Zend_Gdata_App_Exception $e) {
    echo "エラー: " . $e->getMessage();
}

echo "カレンダーリスト:" . PHP_EOL;
foreach ($listFeed as $calendar) {
    echo $calendar->title . PHP_EOL;
}
