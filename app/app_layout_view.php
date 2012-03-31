<?php
class AppLayoutView extends View
{
    public $layout = 'default';
    public $page_title = '';

    public function render($action = null)
    {
        // render content
        $action = is_null($action) ? $this->controller->action : $action;
        if (strpos($action, '/') === false) {
            $view_filename = VIEWS_DIR . $this->controller->name . '/' . $action . self::$ext;
        } else {
            $view_filename = VIEWS_DIR . $action . self::$ext;
        }
        $content = self::extract($view_filename, $this->vars);

        // render layout
        $layout_filename = VIEWS_DIR . 'layouts/' . $this->layout . self::$ext;
        $vars = array(
            'page_title' => $this->page_title,
            'content' => $content,
        );
        $this->controller->output .= self::extract($layout_filename, array_merge($this->vars, $vars));
    }
}
