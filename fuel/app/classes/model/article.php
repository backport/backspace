<?php

class Model_Article extends \Orm\Model
{

    protected static $_properties = array(
        "id",
        "created_at",
        "updated_at",
        "title",
        "slug",
        "preview",
        "body",
        "comments_allowed",
        "published",
        "category_id",
        "user_id",
    );
    
    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array('before_insert'),
        'Orm\Observer_UpdatedAt' => array('before_save'),
    );
    
    protected static $_table_name = "article";

}