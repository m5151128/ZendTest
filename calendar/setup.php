<?php
set_include_path(__DIR__ . '/../ZendGdata/library/');

require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
Zend_Loader::loadClass('Zend_Gdata_Calendar');

// 認証準備
$email    = "gehofugatest@gmail.com"; // メールアドレス
$password = "gehofugatest1111"; // パスワード
$service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;

$client = Zend_Gdata_ClientLogin::getHttpClient($email, $password, $service);
$service = new Zend_Gdata_Calendar($client);
