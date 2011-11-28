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
    
    protected static $_has_many = array(
        'tags' => array(
            'key_from' => 'id',
            'model_to' => 'Model_Tag',
            'key_to' => 'post_id',
            'cascade_save' => true,
            'cascade_delete' => true,
        )
    );
    
    protected static $_has_one = array(
        'author' => array(
            'key_from' => 'user_id',
            'model_to' => 'Model_User',
            'key_to' => 'id',
            'cascade_save' => false,
            'cascade_delete' => false,
        ),
    );

    public static function find_all()
    {
        return static::find()->order_by("id", "DESC")->get();
    }

    public function delete_tags()
    {
        foreach($this->tags as $tag)
        {
            if(!$tag->delete())
            {
                return false;
            }
        }
        
        return true;
    }
    
    public static function find_newest($start, $limit)
    {
        // @todo what to do with start?
        
        return static::find()->order_by("id", "DESC")->where(array("published" => true))->limit($limit)->get();
    }
    
    public function get_preview()
    {
        $preview = "";
        
        if(empty($this->preview))
        {
            $preview = substr($this->body, 0, 255);
        }
        else
        {
            $preview = $this->preview;
        }
        
        $preview = strip_tags($preview);
        
        return $preview;
    }
    
    public function get_formatted_creation_date()
    {
        return \Date::forge($this->created_at)->format();
    }
    
    public function get_formatted_update_date()
    {
        return \Date::forge($this->updated_at)->format();
    }
    
    public static function find_by_slug($slug)
    {
        return static::find()->where(array("slug" => $slug))->get_one();
    }
    
}