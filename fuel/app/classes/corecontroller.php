<?php

class CoreController extends Controller
{
    protected $_view;

    public function set_template($template)
    {
        $this->_view = \View::forge($template . ".html.twig");
    }

    public function set_page_title($page_title)
    {
        $this->_view->page_title = $page_title;
    }

    public function get_view()
    {
        return $this->_view;
    }

}