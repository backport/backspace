<?php

class Controller_Article extends \FrontendController
{
    public function action_index($slug)
    {
        $this->set_template("article/index");
        
        $article = \Model_Article::find_by_slug($slug);
     
        if(!$article instanceof \Model_Article)
        {
            throw new \Exception("article could not be found");
        }
        
        $this->get_view()->article = $article;
        
        return \Response::forge($this->get_view());
    }
}