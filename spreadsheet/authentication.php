<?php
set_include_path(__DIR__ . '/../ZendGdata/library/');

require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
Zend_Loader::loadClass('Zend_Gdata_Spreadsheets');

class authentication
{
    public function __construct($email, $password)
    {
        try {
          $client = Zend_Gdata_ClientLogin::getHttpClient($email, $password, Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME);
        } catch (Zend_Gdata_App_AuthException $ae) {
          exit("Error: メールアドレスまたはパスワードが正しくありません\n");
        }

        $this->spreadsheetService = new Zend_Gdata_Spreadsheets($client);
        $this->spreadsheetFeed = $this->spreadsheetService->getSpreadsheetFeed();
    }
}

$email = getInput("E-Mail Address(example: hogehoge@gmail.com)");
$password = getInput("Password");

function getInput($text)
{
    echo $text . ': ';
    return trim(fgets(STDIN));
}
