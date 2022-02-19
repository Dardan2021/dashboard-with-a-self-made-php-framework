<?php

class profile extends myFramework
{
    public static function index()
    {
        $data['layout'] = "components/changeName";
        $data['title'] = "Change Name";
        self::view("dashboard",  $data);
    }

    public static function changePictureView()
    {
        $data['layout'] = "components/changePicture";
        $data['title'] = "Change Picture";

        self::view("dashboard",  $data);
    }

    public static function changePasswordView()
    {
        $data['layout'] = "components/changePassword";
        $data['title'] = "Change Password";

        self::view("dashboard",  $data);
    }

    public static function searchView()
    {
        $data['layout'] = "components/searchView";
        $data['title'] = "Search Friend";

        self::view("dashboard",  $data);
    }

    public static function table()
    {
        $data['layout'] = "components/table";
        $data['title'] = "Table";

        self::view("dashboard",  $data);
    }
}