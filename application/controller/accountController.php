<?php

class accountController extends myFramework
{
    public static function index()
    {
        echo "index method from controller";
        $data['signupForm'] = "components/signup";

        self::view("index",  $data);
    }

    public static function login()
    {
        echo "index method from controller";
        $data['loginForm'] = "components/login";

        self::view("login",  $data);
    }
}