<?php

class Model_Tag extends \Orm\Model
{

    protected static $_properties = array(
        "id",
        "post_id",
        "created_at",
        "updated_at",
        "title",
    );
    
    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array('before_insert'),
        'Orm\Observer_UpdatedAt' => array('before_save'),
    );
    
    protected static $_table_name = "tag";

}