<?php

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

}