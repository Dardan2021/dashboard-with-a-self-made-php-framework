<?php


class ajaxCondasdastroller  extends myFramework
{
    public function __construct()
    {
        parent::__construct();

        self::model("userModel");
    }

    public static function ajax()
    {
        $post = $_POST;

        switch ($post['ajaxCall']) {

            case 'createUser':

                /* $errorName = self::validation("fullName", "Full Name", "required|not_int");
                 $errorEmail = self::validation("email", "Email", "required|userstsable");
                 $errorPassword = self::validation("password", "Password", "required|min|5");

                 $values=array("errorName"=>$errorName,"errorEmail"=>$errorEmail, "errorPassword"=>$errorPassword, "errorConfirmPassword"=>$errorConfirmPassword);

                 if(empty($errorName) ||empty($errorEmail) ||empty($errorPassword) ||empty($errorConfirmPassword))
                 {

                     if(userModel::insertData("userstable", $values))
                     {*/
                $values = json_decode($post['formData'], true);
                userModel::insertData("userstable", $values);
                self::setFlashMessage('signupSuccess', "Your account is succesfully created");
                echo json_encode($values);
                /*   self::setFlashMessage('signupSuccess', "Your account is succesfully created");

               }
           }
           else
           {
               echo json_encode($values);
           }*/



                break;
        }
    }
}