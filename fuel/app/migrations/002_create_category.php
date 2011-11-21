<?php

namespace Fuel\Migrations;

class Create_Category
{
    public function up()
    {
        \DBUtil::create_table("category", array(
            "id" => array("type" => "int", 'auto_increment' => true),
            "created_at" => array("type" => "varchar", "constraint" => 255),
            "updated_at" => array("type" => "varchar", "constraint" => 255),
            "title" => array("type" => "varchar", "constraint" => 255),
            "slug" => array("type" => "varchar", "constraint" => 255),
        ), array("id"));
        
        \DB::query("ALTER TABLE `category` ADD UNIQUE (`slug`)")->execute();
    }
    
    public function down()
    {
        \DBUtil::drop_table("category");
    }
}