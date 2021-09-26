<?php

class profile extends myFramework
{
    public static function index()
    {
        $data['layout'] = "components/changeName";
        $data['title'] = "Change Name";

        self::view("dashboard",  $data);
    }
}