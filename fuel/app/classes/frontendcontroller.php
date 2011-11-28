<?php

class FrontendController extends \CoreController
{
    const TITLE_SEPERATOR = " :: ";

    public function before()
    {
        parent::before();

        \Lang::load("general");
    }

    public function set_page_title($page_title)
    {
        parent::set_page_title($page_title);
    }

    public function set_template($template)
    {
        // @todo
        $template = "default/" . $template;

        parent::set_template($template);

        // @todo
        $this->_view->style_template = "default/_styles/night.html.twig";
        
        $project_title = "@TODO PAGE TITLE";
        $this->_view->project_title = $project_title;
    }

}