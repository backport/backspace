<?php

namespace Admin;

/**
 * AdminControllerRest (security)
 */
class Controller_Ajax extends \Fuel\Core\Controller_Rest
{

    public function get_slug()
    {
        $title = \Input::get("title");

        $this->response(\Inflector::friendly_title($title, '-', true));
    }

    public function get_tagsuggest()
    {
        $title = (null != \Input::get("title")) ? \Input::get("title") : "yyyzzzzz";

        $tags = \Model_Tag::find()->where("title", "LIKE", $title . "%")->get();

        if (is_array($tags))
        {
            $res = array();

            foreach ($tags as $tag)
            {
                if (!in_array($tag->title, $res))
                {
                    $res[] = $tag->title;
                }
            }
            
            $this->response($res);
        }
    }

}