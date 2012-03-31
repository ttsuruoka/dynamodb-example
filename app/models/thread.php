<?php
class Thread extends AppModel
{
    public $validation = array(
        'title' => array(
            'length' => array(
                'validate_between', 1, 32,
            ),
        ),
    );

    public $id;
    public $title;

    public static function get($id)
    {
        $db = Dynamo::conn();
        $r = $db->call('GetItem', array(
            'TableName' => 'thread',
            'Key' => array(
                'HashKeyElement' => array('N' => (string)$id),
            ),
        ));

        if (empty($r['Item'])) {
            throw new NotFoundException;
        }

        $v = $r['Item'];
        $params = array(
            'id' => current($v['id']),
            'title' => current($v['title']),
            'updated' => current($v['updated']),
            'created' => current($v['created']),
        );
        $thread = new self($params);

        return $thread;
    }

    public static function generateId()
    {
        return (int)round((microtime(true) - strtotime('20120325')) * 10);
    }

    public static function search()
    {
        $db = Dynamo::conn();
        $r = $db->call('Scan', array(
            'TableName' => 'thread',
        ));

        $threads = array();
        foreach ($r['Items'] as $v) {
            $params = array(
                'id' => current($v['id']),
                'title' => current($v['title']),
                'updated' => current($v['updated']),
                'created' => current($v['created']),
            );
            $threads[] = new self($params);
        }

        uasort($threads, function($a, $b) {
            if ($a->updated == $b->updated) return 0;
            return $a->updated > $b->updated ? -1 : 1;
        });

        return $threads;
    }

    public function create($title)
    {
        $params = array(
            'id' => self::generateId(),
            'title' => $title,
            'updated' => Time::unix(),
            'created' => Time::unix(),
        );
        $this->set($params);

        if (!$this->validate()) {
            throw new ValidationException;
        }

        $db = Dynamo::conn();
        $db->call('PutItem', array(
            'TableName' => 'thread',
            'Item' => array(
                'id'      => array('N' => (string)$this->id),
                'title'   => array('S' => $this->title),
                'updated' => array('N' => (string)$this->updated),
                'created' => array('N' => (string)$this->created),
            ),
        ));
    }

    public function write(Post $post)
    {
        if (!$post->validate()) {
            throw new ValidationException;
        }

        $db = Dynamo::conn();
        $db->call('PutItem', array(
            'TableName' => 'post',
            'Item' => array(
                'thread_id' => array('N' => (string)$this->id),
                'name'      => array('S' => $post->name),
                'comment'   => array('S' => $post->comment),
                'created'   => array('N' => (string)Post::generateTime()),
            ),
        ));

        $this->updated = Time::unix();
        $db->call('UpdateItem', array(
            'TableName' => 'thread',
            'Key' => array(
                'HashKeyElement' => array('N' => (string)$this->id),
            ),
            'AttributeUpdates' => array(
                'updated' => array(
                    'Value' => array('N' => (string)$this->updated),
                    'Action' => 'PUT',
                ),
            ),
        ));
    }

    public function getPosts()
    {
        $db = Dynamo::conn();
        $r = $db->call('Query', array(
            'TableName' => 'post',
            'HashKeyValue' => array('N' => (string)$this->id),
        ));

        $posts = array();

        foreach ($r['Items'] as $v) {
            $params = array(
                'thread_id' => current($v['thread_id']),
                'name' => current($v['name']),
                'comment' => current($v['comment']),
                'created' => current($v['created']),
            );
            $posts[] = new Post($params);
        }

        return $posts;
    }
}
