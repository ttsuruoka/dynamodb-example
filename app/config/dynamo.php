<?php
class Dynamo
{
    protected $db;
    public $operations = array();

    public function __construct()
    {
        $this->db = new SimpleAmazonDynamoDB(AWS_STS_ACCESS_KEY_ID, AWS_STS_SECRET_ACCESS_KEY, AWS_STS_SESSION_TOKEN);
    }

    public static function conn()
    {
        static $dynamo;
        if (!$dynamo) {
            $dynamo = new self;
        }
        return $dynamo;
    }

    public function call($operation, $params = array())
    {
        $r = $this->db->call($operation, $params);

        $this->operations[] = array(
            'operation' => $operation,
            'params' => json_encode($params),
            'time' => $this->db->total_time,
            'response' => $this->db->raw_body,
        );

        if ($this->db->status_code != 200) {
            if (isset($r['message'])) {
                throw new DynamoException("{$r['__type']}: {$r['message']}", $this->db->status_code);
            } else {
                throw new DynamoException('Unknown error occurred', $this->db->status_code);
            }
        }

        return $r;
    }
}

class DynamoException extends Exception
{
}
