<?php

class Model_Category extends \Orm\Model
{
    protected static $_properties = array(
        "id",
        "created_at",
        "updated_at",
        "title",
        "slug"
    );
    
    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array('before_insert'),
        'Orm\Observer_UpdatedAt' => array('before_save'),
    );
    
    protected static $_table_name = "category";

    
    public static function find_all()
    {
        return static::find()->order_by("title", "ASC")->get();
    }
}