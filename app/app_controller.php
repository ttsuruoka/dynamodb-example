<?php
class AppController extends Controller
{
    public $default_view_class = 'AppLayoutView';

    public function dispatchAction()
    {
        try {
            parent::dispatchAction();
        } catch (DynamoException $e) {
            $this->set('e', $e);
            $this->render('errors/dynamo');
        }
    }
}
