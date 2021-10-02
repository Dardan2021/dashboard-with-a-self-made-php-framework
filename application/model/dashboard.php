<?php

class Dashboard extends myFramework
{
    public function __construct()
    {
        parent::__construct();
        self::model("userModel");
    }
    public static function createUser($values = array())
    {
        return userModel::insertData("userstable", $values);
    }
}