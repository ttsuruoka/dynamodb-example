<?php
class Post extends AppModel
{
    public $validation = array(
        'name' => array(
            'length' => array(
                'validate_between', 1, 16,
            ),
        ),
        'comment' => array(
            'length' => array(
                'validate_between', 1, 200,
            ),
        ),
    );

    public static function generateTime()
    {
        return (int)round(microtime(true) * 1000);
    }

    public function getCreatedTime()
    {
        return (int)round($this->created / 1000);
    }
}
