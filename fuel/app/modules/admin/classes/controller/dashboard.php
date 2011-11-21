<?php

namespace Admin;

class Controller_Dashboard extends AdminController
{
    public function action_index()
    {
        $this->set_template("dashboard");
        $this->set_page_title(\Lang::line("dashboard"));
        
        return \Response::forge($this->get_view());
    }
}