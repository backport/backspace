<?php

namespace Admin;

class Controller_Account extends AdminController
{

    protected function get_validator()
    {
        $val = \Validation::forge();

        $val->add("email", \Lang::line("email"))
                ->add_rule("valid_email")
                ->add_rule("required");

        $val->add("old_password", \Lang::line("old_password"))
                ->add_rule("required");

        $val->add("password", \Lang::line("password"))
                ->add_rule('min_length', 8)
                ->add_rule("required");

        return $val;
    }

    public function action_index()
    {
        $user = \Auth::instance()->get_user_array();

        $email = $user["email"];
        $password = "";
        $old_password = "";

        $email_message = "";
        $password_message = "";
        $old_password_message = "";

        if (\Input::method() === "POST")
        {
            $val = $this->get_validator();

            if ($val->run())
            {
                $email = $val->validated("email");
                $old_password = $val->validated("old_password");
                $password = $val->validated("password");

                $user_data = array(
                    "old_password" => $old_password,
                    "password" => $password,
                    "email" => $email,
                );

                if (\Auth::instance()->update_user($user_data, $user["screen_name"]))
                {
// does not work currently due to a fuel email package issue
//                    try
//                    {
//                        $email = \Email::forge();
//                        $email->from("backspace blogging platform", "backspace blogging platform");
//                        $email->to($email, $user["screen_name"]);
//                        $email->subject(\Lang::line("email_changed_email_subject"));
//                        $email->body(\Lang::line("email_changed_email_body"));
//                        
//                        $email->send();
//                    }
//                    catch (\EmailValidationFailedException $e)
//                    {
//                        // todo
//                    }
//                    catch (\EmailSendingFailedException $e)
//                    {
//                        // todo
//                    }



                    \Auth::instance()->logout();
                    \Response::redirect("admin/login");
                }
                else
                {
                    throw new \Exception("error occured");
                }
            }
            else
            {
                if (is_object($val->errors("email")))
                {
                    $email_message = $val->errors("email")->get_message();
                    $email = \Input::post("email");
                }

                if (is_object($val->errors("old_password")))
                {
                    $old_password_message = $val->errors("old_password")->get_message();
                }

                if (is_object($val->errors("password")))
                {
                    $password_message = $val->errors("password")->get_message();
                }
            }
        }

        $this->set_template("myaccount");
        $this->set_page_title(\Lang::line("my_account"));

        $this->get_view()->username = $user["screen_name"];
        $this->get_view()->email_value = $email;

        $this->get_view()->email_message = $email_message;
        $this->get_view()->old_password_message = $old_password_message;
        $this->get_view()->password_message = $password_message;

        return \Response::forge($this->get_view());
    }

}