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
              $errorEmail =  utf8_encode(self::validation($values["email"], "Email", "required|unique|users"));
              $errorPassword = utf8_encode(self::validation($values["password"], "Password", "required|min|5"));

              $errors = array("errorName" => $errorName, "errorEmail" => $errorEmail, "errorPassword" => $errorPassword);

              if (self::run())
              {
                  userModel::insertData("users", $values);
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
                $errorEmailFind =  self::validation($emailPassword, "Email", "authentication|users");
                if (self::run())
                {
                    $datas = userModel::fetchAllData('users', array('email' => $values['email'],"password"=> $values['password']), array("fetch"=>'value'));

                    self::setSession("id",$datas['id']);

                    $sessionData = [
                        'id'=>$datas['id'],
                        'name'=>$datas['full_name']
                    ];
                    self::setSession($sessionData,"");
                    echo json_encode(['status'=>'success']);
                }
                else
                {
                    echo json_encode($errorEmailFind);
                }

                break;
            case 'searchUser':
                $values = json_decode($post['formData'], true);

                $datas = userModel::fetchAllData('users', array('full_name' => $values['full_name']), array("fetch"=>'array'));

                echo json_encode($datas);
                break;

        }


    }
}