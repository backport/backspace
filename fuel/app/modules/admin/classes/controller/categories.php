<?php

namespace Admin;

class Controller_Categories extends AdminController
{

    protected function get_validator()
    {
        $val = \Validation::forge();

        $val->add("title", \Lang::line("title"))
                ->add_rule("required");

        $val->add("slug", \Lang::line("slug"))
                ->add_rule("required");

        return $val;
    }

    public function action_index()
    {
        $this->set_template("category_index");
        $this->set_page_title(\Lang::line("categories"));
        
        $cats = \Model_Category::find_all();
        $this->get_view()->cats = $cats;
        
        return \Response::forge($this->get_view());
    }
    
    public function action_delete()
    {
        $id = \Input::get("id");
        
        $cat = \Model_Category::find($id);
        
        if(!$cat instanceof \Model_Category)
        {
            throw new \Exception("Category {$id} not found!");
        }
        
        if($cat->delete())
        {
            \Response::redirect("admin/categories");
        }
        else
        {
            throw new \Exception("could not delete category!");
        }
    }
    
    public function action_edit()
    {
        $this->set_template("category_form");
        $this->set_page_title(\Lang::line("categories"));
        
        $id = \Input::get("id");
        
        $cat = \Model_Category::find($id);
        
        if(!$cat instanceof \Model_Category)
        {
            throw new \Exception("Category {$id} not found!");
        }
        
        $title_message = "";
        $slug_message = "";
        
        if (\Input::method() === "POST")
        {
            $val = $this->get_validator();

            if ($val->run())
            {
                $title = $val->validated("title");
                $slug = $val->validated("slug");

                $cat->title = $title;
                $cat->slug = $slug;
                
                if($cat->save())
                {
                    \Response::redirect("admin/categories");
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
            }
        }
        else
        {
            $title_value = $cat->title;
            $slug_value = $cat->slug;
        }

        $this->get_view()->title_message = $title_message;
        $this->get_view()->title_value = $title_value;
        
        $this->get_view()->slug_message = $slug_message;
        $this->get_view()->slug_value = $slug_value;
        
        $this->get_view()->id = $cat->id;
        
        return \Response::forge($this->get_view());
    }
    
    public function action_create()
    {
        $this->set_template("category_form");
        $this->set_page_title(\Lang::line("categories"));
        
        $title_message = "";
        $slug_message = "";
        
        if (\Input::method() === "POST")
        {
            $val = $this->get_validator();

            if ($val->run())
            {
                $title = $val->validated("title");
                $slug = $val->validated("slug");

                $cat = \Model_Category::forge();
                $cat->title = $title;
                $cat->slug = $slug;
                
                if($cat->save())
                {
                    \Response::redirect("admin/categories");
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
            }
        }

        $this->get_view()->title_message = $title_message;
        $this->get_view()->title_value = \Input::post("title");
        
        $this->get_view()->slug_message = $slug_message;
        $this->get_view()->slug_value = \Input::post("slug");
        
        return \Response::forge($this->get_view());
    }

}