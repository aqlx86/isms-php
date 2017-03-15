# ISMS-PHP
iSMS PHP Client

Please check isms site for the list of response error codes and description.
https://www.isms.com.my/response_result.php

### Current features
* Send SMS
* Get Remaining balance

### Setup
```
$ composer.phar install
```

### Sending of SMS example usage
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


### Get remaining SMS balance
```
require './vendor/autoload.php';

use ISMS\Balance;

$balance = new Balance('username', 'password');

try
{
    echo $balance->get();
}
catch (\Exception $e)
{
    var_dump($e->getMessage(), $e->getCode());
}
```