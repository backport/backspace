<?php

namespace Admin;

class Controller_Logout extends AdminController
{

    public function action_index()
    {
        if (\Auth::instance()->logout())
        {
            \Response::redirect("admin/login");
        }
        else
        {
            throw new \Exception("could not log out");
        }
    }

}