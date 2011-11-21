<?php

namespace Fuel\Migrations;

class Create_Tag
{
    public function up()
    {
        \DBUtil::create_table("tag", array(
            "id" => array("type" => "int", 'auto_increment' => true),
            "post_id" => array("type" => "int"),
            "created_at" => array("type" => "varchar", "constraint" => 255),
            "updated_at" => array("type" => "varchar", "constraint" => 255),
            "title" => array("type" => "varchar", "constraint" => 255),
        ), array("id"));
    }
    
    public function down()
    {
        \DBUtil::drop_table("tag");
    }
}