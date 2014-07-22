<?php
set_include_path(__DIR__ . '/../ZendGdata/library/');

require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
Zend_Loader::loadClass('Zend_Gdata_Spreadsheets');

$email = getInput("メールアドレス(example: hogehoge@gmail.com)");
$password = getInput("パスワード");

function getInput($text)
{
    echo $text . ': ';
    return trim(fgets(STDIN));
}

$sample = new getFileList($email, $password);
$sample->run();

class getFileList
{
    public function __construct($email, $password)
    {
        try {
          $client = Zend_Gdata_ClientLogin::getHttpClient($email, $password, Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME);
        } catch (Exception $e) {
          exit("Error: メールアドレスまたはパスワードが正しくありません\n");
        }

        $this->spreadsheetService = new Zend_Gdata_Spreadsheets($client);
    }

    public function run()
    {
        $feed = $this->spreadsheetService->getSpreadsheetFeed();

        $i = 0;
        foreach($feed->entries as $entry) {
            echo $i . ': ' .  $entry->title . "\n";
            $i++;
        }
    }
}
