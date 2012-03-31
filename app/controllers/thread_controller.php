<?php
class ThreadController extends AppController
{
    public function create()
    {
        $page = Param::get('page_next', 'create');

        switch ($page) {
        case 'create':
            $thread = new Thread;
            $post = new Post;
            break;
        case 'create_end':
            try {
                $thread = new Thread;
                $post = new Post;

                $params = array(
                    'name' => Param::get('name'),
                    'comment' => Param::get('comment'),
                );
                $post->set($params);
                if (!$post->validate()) {
                    throw new ValidationException;
                }

                $thread->create(Param::get('title'));
                $thread->write($post);

            } catch (ValidationException $e) {
                $page = 'create';
            }
            break;
        default:
            throw new NotFoundException('invalid page');
            break;
        }

        $this->set(get_defined_vars());
        $this->render($page);
    }

    public function view()
    {
        $thread = Thread::get(Param::get('thread_id'));
        $posts = $thread->getPosts();
        $this->set(get_defined_vars());
    }

    public function write()
    {
        $thread = Thread::get(Param::get('thread_id'));
        $page = Param::get('page_next', 'write');

        switch ($page) {
        case 'write':
            $post = new Post($params);
            break;
        case 'write_end':
            try {
                $params = array(
                    'name' => Param::get('name'),
                    'comment' => Param::get('comment'),
                );
                $post = new Post($params);
                $thread->write($post);
            } catch (ValidationException $e) {
                $page = 'write';
            }
            break;
        }

        $this->set(get_defined_vars());
        $this->render($page);
    }
}
