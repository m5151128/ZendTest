<?php
  require_once __DIR__ . '/setup.php';

  // データ削除
  $query = new Zend_Gdata_Spreadsheets_ListQuery();
  $query->setSpreadsheetKey($spreadsheetKey);
  $query->setWorksheetId($worksheetId);
  $listFeed = $spreadsheetService->getListFeed($query);
  foreach($listFeed as $rowData) {
      $rowEntry = $rowData->getCustom();
      foreach($rowEntry as $cellData) {
          if ($cellData->getColumnName() == 'col1' && $cellData == '1') {
              echo (!$spreadsheetService->deleteRow($rowData)) ? 'OK' : 'NG';
              echo PHP_EOL;
          }
      }
  }
