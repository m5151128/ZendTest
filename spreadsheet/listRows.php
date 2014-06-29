<?php
  require_once __DIR__ . '/setup.php';

  // データ取得
  foreach($listFeed as $rowData) {
      $rowEntry = $rowData->getCustom();
      foreach($rowEntry as $cellData) {
          echo $cellData->getColumnName() . ' : ' . $cellData . PHP_EOL;
      }
      echo PHP_EOL;
  }
