<?php
define('ROOT_DIR', dirname(__DIR__).'/');
define('APP_DIR', ROOT_DIR.'app/');
require_once ROOT_DIR.'dietcake/dietcake.php';
require_once dirname(__DIR__).'/app/config/bootstrap.php';

require_once VENDOR_DIR.'SimpleAmazonDynamoDB/SimpleAmazonSTS.php';
require_once VENDOR_DIR.'SimpleAmazonDynamoDB/SimpleAmazonDynamoDB.php';
