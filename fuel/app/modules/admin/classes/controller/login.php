<?php

namespace Admin;

class Controller_Login extends AdminController
{

    protected function get_validator()
    {
        $val = \Validation::forge();

        $val->add("username", \Lang::line("username"))
                ->add_rule("required");

        $val->add("password", \Lang::line("password"))
                ->add_rule("required");

        return $val;
    }

    public function action_index()
    {
        if (\Auth::check())
        {
            \Response::redirect("admin/dashboard");
        }

        if (\Input::method() === "POST")
        {
            $val = $this->get_validator();

            if ($val->run())
            {
                $username = $val->validated("username");
                $password = $val->validated("password");

                if (\Auth::login($username, $password))
                {
                    \Response::redirect("admin/dashboard");
                }
                else
                {
                    // username or password invalid
                    echo "login error";
                }
            }
            else
            {
                // validation errors
                echo "validation error";
            }
        }

        $this->set_template("login");
        $this->set_page_title(\Lang::line("login"));
        
        return \Response::forge($this->get_view());
    }

}