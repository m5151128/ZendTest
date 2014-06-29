<?php
  require_once __DIR__ . '/setup.php';

  // 書き込みたいデータ(１行ぶん。列名=>データ)
  $rowData = [
      'col1'   => 1,
      'col2'   => 'col2',
      'col3'   => date('Y-m-d'),
      //'3test'  => 'test', // 数値から始まるカラム名はダメらしい
      '日本語' => '書き込みしますた',
      '存在しないよ' => '絡むがないお',
  ];

  // 1行分のデータを最後尾に追記する
  echo ($spreadsheetService->insertRow($rowData, $spreadsheetKey, $worksheetId)) ? "OK" : "NG";
  echo PHP_EOL;
