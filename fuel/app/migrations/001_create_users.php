<?php

namespace Fuel\Migrations;

class Create_Users
{
    public function up()
    {
        \DBUtil::create_table("user", array(
            "id" => array("type" => "int", 'auto_increment' => true),
            "username" => array("type" => "varchar", "constraint" => 50),
            "password" => array("type" => "varchar", "constraint" => 255),
            "group" => array("type" => "int"),
            "email" => array("type" => "varchar", "constraint" => 255),
            "last_login" => array("type" => "varchar", "constraint" => 25),
            "login_hash" => array("type" => "varchar", "constraint" => 255),
            "profile_fields" => array("type" => "text"),
            "created_at" => array("type" => "int"),
        ), array("id"));
    }
    
    public function down()
    {
        \DBUtil::drop_table("user");
    }
}