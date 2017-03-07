# ISMS-PHP
iSMS PHP Client

Please check isms site for the list of response error codes and description.
https://www.isms.com.my/response_result.php

### Setup
```
$ composer.phar install
```

### Example Usage
```
require './vendor/autoload.php';

use ISMS\Recipient;
use ISMS\Message;
use ISMS\SMS;

$recipient = new Recipient('9999999');
$message = new Message($recipient, 'message to send');
$sms = new SMS('username', 'password', $message);

try
{
    $sms->send();
}
catch (\Exception $e)
{
    var_dump($e->getMessage(), $e->getCode());
}
```