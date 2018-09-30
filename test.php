<?php

require './vendor/autoload.php';

use ISMS\Balance;

$isms = new Balance('dewaayam', 'sm558cf88');

echo $isms->get();