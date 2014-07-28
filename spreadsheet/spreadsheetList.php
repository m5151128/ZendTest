<?php
require_once __DIR__ . '/authentication.php';

class spreadsheetList extends authentication
{
    public function getList()
    {
        $this->printFeed($this->spreadsheetFeed, "Spreadsheet");
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
$obj->getList();
