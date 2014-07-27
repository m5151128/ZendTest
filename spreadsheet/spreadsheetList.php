<?php
require_once __DIR__ . '/authentication.php';

class spreadsheetList extends authentication
{
    public function __construct($email, $password)
    {
        parent::__construct($email, $password);
        $this->getList();
    }

    public function getList()
    {
        $spreadsheetFeed = $this->spreadsheetService->getSpreadsheetFeed();

        $this->printFeed($spreadsheetFeed, "Spreadsheet");
        return $spreadsheetFeed;
    }

    public function printFeed($feed, $listName)
    {
        echo PHP_EOL;
        echo "---List Of " . $listName . "---" . PHP_EOL;
        echo "(Number: " . $listName. " Name)" . PHP_EOL;

        $i = 0;
        foreach($feed->entries as $entry) {
            echo $i . ': ' .  $entry->title . "\n";
            $i++;
        }

        echo PHP_EOL;
    }
}

$obj = new spreadsheetList($email, $password);
