<?php
  set_include_path(__DIR__ . '/../ZendGdata/library/');

  require_once 'Zend/Loader.php';
  Zend_Loader::loadClass('Zend_Gdata');
  Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
  Zend_Loader::loadClass('Zend_Gdata_Spreadsheets');

  // 認証準備
  $email    = "gehofugatest@gmail.com"; // メールアドレス
  $password = "gehofugatest1111"; // パスワード
  $service  = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;

  $client = Zend_Gdata_ClientLogin::getHttpClient($email, $password, $service);
  $spreadsheetService = new Zend_Gdata_Spreadsheets($client);

  $spreadsheetKey = "1XjNoUsquo8CkL8bzfMptj-S1Y8QqNtZM6z9qa2gRV30"; // スプレットシートのキー
  $worksheetId    = "od6"; // ワークシートのID

  // リストの取得
  $query = new Zend_Gdata_Spreadsheets_ListQuery();
  $query->setSpreadsheetKey($spreadsheetKey);
  $query->setWorksheetId($worksheetId);
  $listFeed = $spreadsheetService->getListFeed($query);
