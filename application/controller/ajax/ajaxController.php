<?php


class ajaxController  extends myFramework
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

              $values = json_decode($post['formData'], true);

              $errorName = utf8_encode(self::validation($values["full_name"], "Full Name", "required|not_int"));
              $errorEmail =  utf8_encode(self::validation($values["email"], "Email", "required|unique|userstable"));
              $errorPassword = utf8_encode(self::validation($values["password"], "Password", "required|min|5"));

              $errors = array("errorName" => $errorName, "errorEmail" => $errorEmail, "errorPassword" => $errorPassword);

              if (self::run())
              {
                  userModel::insertData("userstable", $values);
                  self::setFlashMessage('signupSuccess', "Your account is succesfully created");
                  echo json_encode(['status'=>'none']);
              }
              else
              {
                  echo json_encode($errors);
              }

              break;

            case 'loginUser':

                $values = json_decode($post['formData'], true);

                $emailPassword= array("email"=>$values["email"],"password"=>$values["password"]);
                $errorEmailFind =  self::validation($emailPassword, "Email", "authentication|userstable");
                if (self::run())
                {

                    $datas = userModel::fetchAllData('userstable', array('email' => $values['email'],"password"=> $values['password']), array("fetch"=>'value'));


                    var_dump($datas);

                    echo json_encode(['status'=>'success']);

                }
                else
                {
                    echo json_encode($errorEmailFind);


                }

                break;

        }


    }
}