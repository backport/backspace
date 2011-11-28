<?php

class Controller_Blog extends \FrontendController
{
    public function action_index()
    {
        $this->set_template("blog/index");
        $this->set_page_title(\Lang::line("blog_home"));
        
        $articles = \Model_Article::find_newest(0, 10);
        $this->get_view()->articles = $articles;
        
        return \Response::forge($this->get_view());
    }
}