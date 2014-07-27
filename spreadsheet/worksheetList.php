<?php
set_include_path(__DIR__ . '/../ZendGdata/library/');

require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
Zend_Loader::loadClass('Zend_Gdata_Spreadsheets');

$email = getInput("E-Mail Address(example: hogehoge@gmail.com)");
$password = getInput("Password");

function getInput($text)
{
    echo $text . ': ';
    return trim(fgets(STDIN));
}

$sample = new worksheetList($email, $password);
$sample->run();

class worksheetList
{
    public function __construct($email, $password)
    {
        try {
          $client = Zend_Gdata_ClientLogin::getHttpClient($email, $password, Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME);
        } catch (Zend_Gdata_App_AuthException $ae) {
          exit("Error: メールアドレスまたはパスワードが正しくありません\n");
        }

        $this->spreadsheetService = new Zend_Gdata_Spreadsheets($client);
    }

    public function run()
    {
        $spreadsheetFeed = $this->spreadsheetList();
        $this->worksheetList($spreadsheetFeed);
    }

    public function spreadsheetList()
    {
        $spreadsheetFeed = $this->spreadsheetService->getSpreadsheetFeed();

        $this->printFeed($spreadsheetFeed, "Spreadsheet");
        return $spreadsheetFeed;
    }

    public function worksheetList($spreadsheetFeed)
    {
        echo PHP_EOL;
        $ssNo = getInput("Input SpreadSheet Number");
        $ssURL = explode('/', $spreadsheetFeed->entries[$ssNo]->id->text);
        // print_r($ssURL);
        // $ssURL{ [0] => "https", [1] => "", [2] => "spreadseets.google.com", [3] => "feeds", [4] => "spreadsehhts", [5] => "スプレットシートのキー"
        $ssKey = $ssURL[5];

        $query = new Zend_Gdata_Spreadsheets_DocumentQuery();
        $query->setSpreadsheetKey($ssKey);
        $worksheetFeed = $this->spreadsheetService->getWorksheetFeed($query);

        $this->printFeed($worksheetFeed, "Worksheet");
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
    }
}
