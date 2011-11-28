<?php

/**
 * This Model is for use in reading context only!!
 * Do not create users with it
 */
class Model_User extends \Orm\Model
{

    protected static $_properties = array(
        "id",
        "username",
        "password",
        "group",
        "email",
        "last_login",
        "login_hash",
        "profile_fields",
        "created_at",
    );
    protected static $_table_name = "user";

    public static function save()
    {
        throw new \Exception("This Model is for use in reading context only!!");
    }

    public static function update()
    {
        throw new \Exception("This Model is for use in reading context only!!");
    }

    public static function delete()
    {
        throw new \Exception("This Model is for use in reading context only!!");
    }

}