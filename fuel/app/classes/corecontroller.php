<?php

class CoreController extends Controller
{
    protected $_view;

    public function set_template($template)
    {
        $this->_view = \View::forge($template . ".html.twig");
        
        $this->_view->base_uri = Uri::base(true);
        $this->_view->root_uri = Uri::base(false);
        
        
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