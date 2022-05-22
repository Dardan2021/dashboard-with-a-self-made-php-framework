<?php


class fileAjaxController  extends myFramework
{
    public function __construct()
    {
        parent::__construct();

        self::model("userModel");
    }
    public static function files()
    {
        if ( 0 < $_FILES['send_file']['error'] )
        {
            echo 'Error: ' . $_FILES['send_file']['error'] . '<br>';
        }
        else
        {
            move_uploaded_file($_FILES['send_file']['tmp_name'], 'C:/xampp/htdocs/integrateChat/public/uploadFile/' . $_FILES['send_file']['name']);
            echo 'success';
        }
    }

    public static function filesProfile()
    {
        if ( 0 < $_FILES['uploadPicture']['error'] )
        {
            echo 'Error: ' . $_FILES['uploadPicture']['error'] . '<br>';
        }
        else
        {
            move_uploaded_file($_FILES['uploadPicture']['tmp_name'], 'C:/xampp/htdocs/integrateChat/public/uploadFile/' . $_FILES['uploadPicture']['name']);
            echo 'success';
        }
    }
}