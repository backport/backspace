<?php

namespace Fuel\Migrations;

class Create_Article
{
    public function up()
    {
        \DBUtil::create_table("article", array(
            "id" => array("type" => "int", 'auto_increment' => true),
            "category_id" => array("type" => "int"),
            "user_id" => array("type" => "int"),
            "created_at" => array("type" => "varchar", "constraint" => 255),
            "updated_at" => array("type" => "varchar", "constraint" => 255),
            "title" => array("type" => "varchar", "constraint" => 255),
            "slug" => array("type" => "varchar", "constraint" => 255),
            "preview" => array("type" => "text"),
            "body" => array("type" => "text"),
            "comments_allowed" => array("type" => "int", "constraint" => 1),
            "published" => array("type" => "int", "constraint" => 1),
        ), array("id"));
        
        \DB::query("ALTER TABLE `article` ADD UNIQUE (`slug`)")->execute();
    }
    
    public function down()
    {
        \DBUtil::drop_table("article");
    }
}