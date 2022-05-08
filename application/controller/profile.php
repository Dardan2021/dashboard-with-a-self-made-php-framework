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

    public static function viewProfile()
    {
        $data['layout'] = "components/viewProfile";
        $data['title'] = "ViewProfile";
        $data['name'] = $_GET["name"];
        $data['id'] = $_GET["id"];
        $data['imgSrc'] = self::getpictureFileName($data['id']);

        self::view("dashboard",  $data);
    }

    public static function chat()
    {
        $data['layout'] = "components/chat";
        $data['title'] = "ViewProfile";
        $data['name'] = $_GET["name"];
        self::view("dashboard",  $data);
    }
}