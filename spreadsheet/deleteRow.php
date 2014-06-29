<?php
  require_once __DIR__ . '/setup.php';

  // データ削除
  foreach($listFeed as $rowData) {
      $rowEntry = $rowData->getCustom();
      foreach($rowEntry as $cellData) {
          if ($cellData->getColumnName() == 'col1' && $cellData == '1') {
              echo (!$spreadsheetService->deleteRow($rowData)) ? 'OK' : 'NG';
              echo PHP_EOL;
          }
      }
  }
