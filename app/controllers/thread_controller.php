<?php
class ThreadController extends AppController
{
    public function create()
    {
        $page = Param::get('page_next', 'create');

        switch ($page) {
        case 'create':
            break;
        case 'create_end':
            break;
        default:
            throw new NotFoundException('invalid page');
            break;
        }

        $this->set(get_defined_vars());
    }
}
