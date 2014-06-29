<?php
  require_once __DIR__ . '/setup.php';

  // 更新用のデータ
  $updateData = [
      'col1' => 2,
      'col2' => '',
      'col3' => date('Y-m-d H:i:s'),
      '日本語' => '更新しますた',
  ];

  // データ更新
  $query = new Zend_Gdata_Spreadsheets_ListQuery();
  $query->setSpreadsheetKey($spreadsheetKey);
  $query->setWorksheetId($worksheetId);
  $listFeed = $spreadsheetService->getListFeed($query);
  foreach($listFeed as $rowData) {
      $rowEntry = $rowData->getCustom();
      foreach($rowEntry as $cellData) {
          if ($cellData->getColumnName() == 'col1' && $cellData->getText() == '1') {
            echo ($spreadsheetService->updateRow($rowData, $updateData)) ? 'OK' : 'NG';
            echo PHP_EOL;
          }
      }
  }
