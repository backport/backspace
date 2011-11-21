<?php

namespace Admin;

class AdminController extends \CoreController
{
    public function before()
    {
        parent::before();
        
        \Lang::load("admin");
        
        if (\Uri::segment(2) !== "login" && !\Auth::instance()->check())
        {
            \Response::redirect("admin/login");
        }
    }
}