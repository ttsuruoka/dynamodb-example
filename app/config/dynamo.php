<?php
class Dynamo
{
    public static function conn()
    {
        static $db = null;
        if (!$db) {
            $db = new SimpleAmazonDynamoDB(AWS_STS_ACCESS_KEY_ID, AWS_STS_SECRET_ACCESS_KEY, AWS_STS_SESSION_TOKEN);
        }
        return $db;
    }
}
