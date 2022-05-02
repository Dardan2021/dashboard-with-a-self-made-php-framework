<?php


class ajaxController  extends myFramework
{
    public function __construct()
    {
        parent::__construct();

        self::model("userModel");
    }
    public static function files()
    {
        if ( 0 < $_FILES['send_file']['error'] ) {
            echo 'Error: ' . $_FILES['send_file']['error'] . '<br>';
        }
        else
        {
            var_dump($_FILES['send_file']['name']);
            move_uploaded_file($_FILES['send_file']['tmp_name'], 'C:/xampp/htdocs/integrateChat/public/profile/uploadFile/' . $_FILES['send_file']['name']);
            echo 'success';
        }
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
            case 'sendMessage':

                $values['user_id'] = $post['userid'];
                $values['user_id_sent'] = $post['useridsend'];
                $values['message'] = $post['send_message'];
                $values['msg_type'] = 'text';

                if(userModel::insertData("messages", $values))
                {
                    echo json_encode(['status'=>'success']);
                }

                break;
            case 'showMessage':
                $values['user_id'] = $post['userid'];
                $values['user_id_sent'] = $post['useridsend'];
                $datas = userModel::fetchAllData('messages', array('IN'=>ARRAY('user_id'=>array($values['user_id'], $values['user_id_sent']),'user_id_sent'=>array($values['user_id'], $values['user_id_sent']))),
                    array("fetch"=>'array'));
                self::showMessages(1,1,1);

              foreach($datas as $data)
              {
                  if($data['user_id']==$values['user_id'])
                  {
                      echo self::showMessages($data['message'],$data['msg_type'],"leftMessageText");

                  }
                  else
                  {
                      echo self::showMessages($data['message'],$data['msg_type'],"rightMessageText");
                  }

              }
                break;
            case 'addFriendship':
                $values['status'] = "true";
                $firstid = $post['userid'];
                $secondid =  trim($post['useridsend']," ");
                $check = userModel::fetchAllData("friendship", array('friend_id'=>$firstid,'friend_with'=>$secondid), array("fetch"=>'value'));
                if(!empty($check))
                {
                    userModel::updateData("friendship", array('friend_id'=>$firstid,'friend_with'=>$secondid), $values);
                    echo json_encode(['status'=>'success']);
                }
                else
                {
                    userModel::updateData("friendship", array('friend_id'=>$secondid,'friend_with'=>$firstid), $values);
                    echo json_encode(['status'=>'success']);
                }

                break;
            case 'removeFriendship':
                $values['status'] = "false";
                $firstid = $post['userid'];
                $secondid =  trim($post['useridsend']," ");
                $check = userModel::fetchAllData("friendship", array('friend_id'=>$firstid,'friend_with'=>$secondid), array("fetch"=>'value'));

                if(!empty($check))
                {
                    userModel::updateData("friendship", array('friend_id'=>$firstid,'friend_with'=>$secondid), $values);
                    echo json_encode(['status'=>'success']);
                }
                else
                {
                    userModel::updateData("friendship", array('friend_id'=>$secondid,'friend_with'=>$firstid), $values);
                    echo json_encode(['status'=>'success']);
                }
                break;
            case 'sendfile':

                $values['user_id'] = $post['userid'];
                $values['user_id_sent'] = $post['useridsend'];
                $values['msg_type'] = $post['type'];
                $values['message'] = $post['fileName'];
                $extensions = array("jpg","JPG","jpeg","png","pdf","zip","xlsx","docx","csv");


                if(!in_array($values['msg_type'],$extensions))
                {
                    echo "error";
                }
                else
                {
                    if(userModel::insertData("messages", $values))
                    {
                        echo json_encode(['status'=>'success']);
                    }
                }
                break;
        }

    }
}