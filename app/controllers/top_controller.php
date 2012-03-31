<?php
class TopController extends AppController
{
    public function index()
    {
        $threads = Thread::search();

        $this->set(get_defined_vars());
    }
}
