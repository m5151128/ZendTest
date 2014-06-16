<?php
  set_include_path('/home/nagayama/ZendTest/ZendGdata/library/');

  require_once 'Zend/Loader.php';
  Zend_Loader::loadClass('Zend_Gdata');
  Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
  Zend_Loader::loadClass('Zend_Gdata_Spreadsheets');

  // 認証準備
  $email    = "hogehoge@gmail.com"; // メールアドレス
  $password = "password"; // パスワード
  $service  = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;

  $client = Zend_Gdata_ClientLogin::getHttpClient($email, $password, $service);
  $spreadsheetService = new Zend_Gdata_Spreadsheets($client);

  $spreadsheetKey = "spreadsheetKey"; // スプレットシートのキー
  $worksheetId    = "od6"; // ワークシートのID

  // 書き込みたいデータ(１行ぶん。列名=>データ)
  $rowData = [
      'col1' => 1,
      'col2' => 'テスト',
      'col3' => date('Y/m/d'),
  ];

  // 1行分のデータを最後尾に追記する
  echo ($spreadsheetService->insertRow($rowData, $spreadsheetKey, $worksheetId)) ? "OK" : "NG";
  echo PHP_EOL;

  // データ取得
  $query = new Zend_Gdata_Spreadsheets_ListQuery();
  $query->setSpreadsheetKey($spreadsheetKey);
  $query->setWorksheetId($worksheetId);
  $listFeed = $spreadsheetService->getListFeed($query);
  foreach($listFeed as $rowData) {
      $rowEntry = $rowData->getCustom();
      foreach($rowEntry as $cellData) {
          echo $cellData->getColumnName() . ' : ' . $cellData->getText() . PHP_EOL;
      }
      echo PHP_EOL;
  }

  // 行の後のデータ
  $updateData = [
      'col1' => 1,
      'col2' => '',
      'col3' => date('Y-m-d H:i:s'),
      'col4' => '更新した',
      ];

  echo ($spreadsheetService->updateRow($rowData, $updateData)) ? '更新OK' : 'NG';
  echo PHP_EOL;
