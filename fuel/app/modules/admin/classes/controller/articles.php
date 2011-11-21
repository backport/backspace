<?php

namespace Admin;

class Controller_Articles extends AdminController
{

    protected function get_validator()
    {
        $val = \Validation::forge();

        $val->add("title", \Lang::line("title"))
                ->add_rule("required");

        $val->add("slug", \Lang::line("slug"))
                ->add_rule("required");
        
        $val->add("category", \Lang::line("category"))
                ->add_rule("required");
        
        $val->add("body", \Lang::line("body"))
                ->add_rule("required");

        return $val;
    }

    public function action_index()
    {
        $this->set_template("article_index");
        $this->set_page_title(\Lang::line("articles"));
        
        $articles = \Model_Article::find_all();
        $this->get_view()->articles = $articles;
        
        return \Response::forge($this->get_view());
    }
    
    public function action_delete()
    {
        $id = \Input::get("id");
        
        $article = \Model_Article::find($id);
        
        if(!$article instanceof \Model_Article)
        {
            throw new \Exception("Article {$id} not found!");
        }
        
        if($article->delete())
        {
            \Response::redirect("admin/articles");
        }
        else
        {
            throw new \Exception("could not delete article!");
        }
    }
    
    public function action_edit()
    {
        $this->set_template("article_form");
        $this->set_page_title(\Lang::line("categories"));
        
        $id = \Input::get("id");
        
        $article = \Model_Article::find($id);
        
        if(!$article instanceof \Model_Article)
        {
            throw new \Exception("Article {$id} not found!");
        }
        
        $title_message = "";
        $slug_message = "";
        $category_message = "";
        $body_message = "";
        $comments_allowed = false;
        $published = false;
        
        if (\Input::method() === "POST")
        {
            $val = $this->get_validator();

            if ($val->run())
            {
                $title = $val->validated("title");
                $slug = $val->validated("slug");
                $category = $val->validated("category");
                $preview = \Input::post("preview");
                $body = $val->validated("body");
                $comments_allowed = (bool) \Input::post("comments_allowed");
                $published = (bool) \Input::post("published");

                $article->user_id = $user[1];
                $article->title = $title;
                $article->slug = $slug;
                $article->category_id = $category;
                $article->preview = $preview;
                $article->body = $body;
                $article->comments_allowed = $comments_allowed;
                $article->published = $published;
                
                if($article->save())
                {
                    \Response::redirect("admin/articles");
                }
                else
                {
                    throw new \Exception("error occured while saving");
                }
            }
            else
            {
                if(is_object($val->errors("title")))
                {
                    $title_message = $val->errors("title")->get_message();
                }
                 
                if(is_object($val->errors("slug")))
                {
                    $slug_message = $val->errors("slug")->get_message();
                }
                
                if(is_object($val->errors("category")))
                {
                    $category_message = $val->errors("category")->get_message();
                }
                
                if(is_object($val->errors("body")))
                {
                    $body_message = $val->errors("body")->get_message();
                }
            }
        }
        else
        {
            $title_value = $article->title;
            $slug_value = $article->slug;
            $category_value = $article->category_id;
            $preview_value = $article->preview;
            $body_value = $article->body;
            $comments_allowed = $article->comments_allowed;
            $published = $article->published;
        }

        $this->get_view()->title_message = $title_message;
        $this->get_view()->title_value = $title_value;
        
        $this->get_view()->slug_message = $slug_message;
        $this->get_view()->slug_value = $slug_value;
        
        $this->get_view()->category_message = $category_message;
        $this->get_view()->category_value = $category_value;
        
        $this->get_view()->preview_value = $preview_value;
        
        $this->get_view()->body_message = $body_message;
        $this->get_view()->body_value = $body_value;
        
        $this->get_view()->comments_allowed = $comments_allowed;
        $this->get_view()->published = $published;
        
        $this->get_view()->id = $article->id;
        
        $cats = \Model_Category::find_all();
        $this->get_view()->cats = $cats;
        
        return \Response::forge($this->get_view());
    }
    
    public function action_create()
    {
        $this->set_template("article_form");
        $this->set_page_title(\Lang::line("write_article"));
        
        $title_message = "";
        $slug_message = "";
        $category_message = "";
        $body_message = "";
        $comments_allowed = true;
        $published = false;
        
        if (\Input::method() === "POST")
        {
            $val = $this->get_validator();

            if ($val->run())
            {
                $title = $val->validated("title");
                $slug = $val->validated("slug");
                $category = $val->validated("category");
                $preview = \Input::post("preview");
                $body = $val->validated("body");
                $comments_allowed = (bool) \Input::post("comments_allowed");
                $published = (bool) \Input::post("published");

                $user = \Auth::instance()->get_user_id();
                
                if(!isset($user[1]))
                {
                    throw new \Exception("Could not get userId");
                }
                    
                $article = \Model_Article::forge();
                $article->user_id = $user[1];
                $article->title = $title;
                $article->slug = $slug;
                $article->category_id = $category;
                $article->preview = $preview;
                $article->body = $body;
                $article->comments_allowed = $comments_allowed;
                $article->published = $published;
                
                if($article->save())
                {
                    \Response::redirect("admin/articles");
                }
                else
                {
                    throw new \Exception("error occured while saving");
                }
            }
            else
            {
                if(is_object($val->errors("title")))
                {
                    $title_message = $val->errors("title")->get_message();
                }
                 
                if(is_object($val->errors("slug")))
                {
                    $slug_message = $val->errors("slug")->get_message();
                }
                
                if(is_object($val->errors("category")))
                {
                    $category_message = $val->errors("category")->get_message();
                }
                
                if(is_object($val->errors("body")))
                {
                    $body_message = $val->errors("body")->get_message();
                }
            }
        }

        $this->get_view()->title_message = $title_message;
        $this->get_view()->title_value = \Input::post("title");
        
        $this->get_view()->slug_message = $slug_message;
        $this->get_view()->slug_value = \Input::post("slug");
        
        $this->get_view()->category_message = $category_message;
        $this->get_view()->category_value = \Input::post("category");
        
        $this->get_view()->preview_value = \Input::post("preview");
        
        $this->get_view()->body_message = $body_message;
        $this->get_view()->body_value = \Input::post("body");
        
        $this->get_view()->comments_allowed = $comments_allowed;
        $this->get_view()->published = $published;
        
        $cats = \Model_Category::find_all();
        $this->get_view()->cats = $cats;
        
        return \Response::forge($this->get_view());
    }

}