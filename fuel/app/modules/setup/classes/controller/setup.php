<?php

namespace Setup;

class Controller_Setup extends \Controller
{

    protected function random_string()
    {
        $length = 32;
        $aZ09 = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
        $out = '';
        for ($c = 0; $c < $length; $c++)
        {
            $out .= $aZ09[mt_rand(0, count($aZ09) - 1)];
        }
        return $out;
    }

    public function action_index()
    {
        $migrate = \Fuel\Core\Migrate::current();

        $admin_pass = $this->random_string();
        
        $admin = \Auth::instance()->create_user("admin", $admin_pass, "admin@backport.net", 100);

        $view = \View::forge('welcome.html.twig');
        $view->admin_pass = $admin_pass;
        
        return \Response::forge($view);
    }

}