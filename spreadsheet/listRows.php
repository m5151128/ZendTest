<?php
  require_once __DIR__ . '/setup.php';

  // データ取得
  $query = new Zend_Gdata_Spreadsheets_ListQuery();
  $query->setSpreadsheetKey($spreadsheetKey);
  $query->setWorksheetId($worksheetId);
  $listFeed = $spreadsheetService->getListFeed($query);
  foreach($listFeed as $rowData) {
      $rowEntry = $rowData->getCustom();
      foreach($rowEntry as $cellData) {
          echo $cellData->getColumnName() . ' : ' . $cellData . PHP_EOL;
      }
      echo PHP_EOL;
  }
