<?php
require_once __DIR__ . '/spreadsheetList.php';

class worksheetList extends spreadsheetList
{
    public function getList()
    {
        $ssNo = getInput("Input SpreadSheet Number");
        $ssURL = explode('/', $this->spreadsheetFeed->entries[$ssNo]->id->text);
        // print_r($ssURL);
        // $ssURL{ [0] => "https", [1] => "", [2] => "spreadseets.google.com", [3] => "feeds", [4] => "spreadsehhts", [5] => "スプレットシートのキー"
        $ssKey = $ssURL[5];

        $query = new Zend_Gdata_Spreadsheets_DocumentQuery();
        $query->setSpreadsheetKey($ssKey);
        $worksheetFeed = $this->spreadsheetService->getWorksheetFeed($query);

        $this->printFeed($worksheetFeed, "Worksheet");
    }
}

$obj = new worksheetList($email, $password);
$obj->getList();
