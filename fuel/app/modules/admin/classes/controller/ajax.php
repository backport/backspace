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
    
}