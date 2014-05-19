<?php
set_include_path('/home/nagayama/ZendTest/ZendGdata/library/');

require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
Zend_Loader::loadClass('Zend_Gdata_Calendar');

// 認証準備
$email    = "hogehoge@gmail.com"; // メールアドレス
$password = "password"; // パスワード
$service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;

$client = Zend_Gdata_ClientLogin::getHttpClient($email, $password, $service);
$service = new Zend_Gdata_Calendar($client);

// カレンダーリストの取得
try {
    $listFeed= $service->getCalendarListFeed();
} catch (Zend_Gdata_App_Exception $e) {
    echo "エラー: " . $e->getMessage();
}

echo "カレンダーリスト:" . PHP_EOL;
foreach ($listFeed as $calendar) {
    //echo $calendar->title . PHP_EOL;
}

// イベントの取得
$query = $service->newEventQuery();
$query->setUser('default');
$query->setVisibility('private');
$query->setProjection('full');
$query->setOrderby('starttime');
//$query->setFutureevents('true');

// 期間の指定
$query->setStartMin('2013-04-01');
$query->setStartMax('2014-05-30');

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
