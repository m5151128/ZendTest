<?php
require_once __DIR__ . '/setup.php';

// カレンダーサービスのマジックメソッドで、新規エントリを作成
$event = $service->newEventEntry();
 
// イベントの情報を設定
$event->title = $service->newTitle("予定を作ったお");
$event->where = array($service->newWhere("日本のどこかで"));
$event->content = $service->newContent("説明文が入るお");
 
// 日付指定
$startDate = "2014-07-07";
$startTime = "14:00:00";
$endDate = "2014-07-07";
$endTime = "16:00:00";
 
$when = $service->newWhen();
$when->startTime = "{$startDate}T{$startTime}";
$when->endTime = "{$endDate}T{$endTime}";
$event->when = array($when);
 
// イベントをカレンダーに追加
$newEvent = $service->insertEvent($event);
