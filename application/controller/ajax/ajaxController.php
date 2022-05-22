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
                $datas = userModel::fetchAllData('users', array('like' => array('full_name'=>$values['full_name'])), array("fetch"=>'array'));

                foreach($datas as $data)
                {
                    $imgSrc[] =  userModel::fetchAllData('profilePicture', array('id'=>$data['id']), array("fetch"=>'value'),'profile_picture_filename');
                }

                echo json_encode(['datas' =>$datas, 'imgSrc'=>$imgSrc]);
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
                $datas = userModel::fetchAllData('messages', array('IN'=>ARRAY('user_id'=>array($values['user_id'], $values['user_id_sent']),'user_id_sent'=>array($values['user_id'], $values['user_id_sent']))), array("fetch"=>'array'));

                if(!empty($datas))
                {
                    foreach($datas as $data)
                    {
                        if($data['user_id'] == $values['user_id'])
                        {
                            echo self::showMessages($data['message'],$data['msg_type'],"leftMessageText");
                        }
                        else
                        {
                            echo self::showMessages($data['message'],$data['msg_type'],"rightMessageText");
                        }
                    }
                }

                break;

            case 'addFriendship':

                $values['status'] = "true";
                $values['friend_id']= $post['userid'];
                $values['friend_with']= $post['useridsend'];
                $firstid = $values['friend_id'];
                $secondid =  trim($values['friend_with']," ");

                $checkFirstSide = userModel::fetchAllData("friendship", array('friend_id'=>$firstid,'friend_with'=>$secondid), array("fetch"=>'value'));
                $checkSecondSide = userModel::fetchAllData("friendship", array('friend_id'=>$secondid,'friend_with'=>$firstid), array("fetch"=>'value'));
                if(empty($checkFirstSide) && empty($checkSecondSide))
                {
                    userModel::insertData("friendship", $values);
                    echo json_encode(['status'=>'success']);
                }
                else
                {
                    if(!empty($checkFirstSide))
                    {
                        userModel::updateData("friendship", array('friend_id'=>$firstid,'friend_with'=>$secondid), $values);
                        echo json_encode(['status'=>'success']);

                    }
                    else if(!empty($checkSecondSide))
                    {
                        userModel::updateData("friendship", array('friend_id'=>$secondid,'friend_with'=>$firstid), $values);
                        echo json_encode(['status'=>'success']);

                    }
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

            case 'sendPicture':

                $values['id'] = $post['userid'];
                $values['profile_picture_filename'] = $post['fileName'];
                $check = userModel::fetchAllData("profilepicture", array('id'=>$values['id']), array("fetch"=>'value'));

                if(!empty($check))
                {
                    userModel::updateData("profilepicture", array('id'=>$values['id']), $values);
                    echo 'success';
                }
                else
                {
                    if(userModel::insertData("profilepicture", $values))
                    {
                        echo 'success';
                    }
                }

                break;

            case 'changePassword':

                $values['id'] = $post['userid'];
                $currentPassword = $post['currentPassword'];
                $values['password'] = $post['newPassword'];

                $check = userModel::fetchAllData("users", array('id'=>$values['id']), array("fetch"=>'value'));

                if($check['password'] == $currentPassword)
                {
                    if(userModel::updateData("users",  array('id'=>$values['id']), $values))
                    {
                        echo 'success';
                    }
                }
                else
                {
                    echo 'error';
                }

                break;

            case 'changeName':

                $id = $post['userid'];
                $values['full_name'] = $post['newName'];

                if(userModel::updateData("users",  array('id'=>$id), $values))
                {
                    echo json_encode(['status'=>'success','name'=> $values['full_name']]);
                }

                break;

            case 'sendCommentStatus':
                $values['id_creator'] = $post['userid'];
                $values['id_commentor'] = $post['useridsend'];
                $values['text_comment'] = $post['comment'];
                $values['created_date'] = date('Y/m/d H:i:s');
                $values['type'] = 'status';
                if(userModel::insertData("comments", $values))
                {
                   echo json_encode(['status'=>'success']);
                }

                break;

            case 'showCommentStatus':

                $values['user_id'] = $post['userid'];
                $values['user_id_sent'] = $post['useridsend'];

                $datas = userModel::fetchAllData('comments', array('id_commentor'=>$values['user_id_sent']),array('orderBy'=>'ORDER BY id_comment DESC'));

                if(!empty($datas))
                {
                    foreach($datas as $data)
                    {
                        if($values['user_id_sent']==$data['id_commentor'])
                        {
                            echo self::showCommentStatus($data['text_comment'],$data['type'],$data['id_creator'],$data['id_comment']);
                        }
                    }
                }

                break;

            case "sendComment":

                $values['id_creator'] = $post['userid'];
                $values['id_commentor'] = $post['useridsend'];
                $values['id_comment'] = $post['commentId'];
                $values['comment_text'] = $post['comment'];
                $values['created_date'] = date('Y/m/d H:i:s');

                $datas = userModel::fetchAllData('comment_status', array('id_commentor'=>$values['id_commentor'],'id_creator'=> $values['id_commentor'],'created_date'=> $values['created_date']),array('fetch'=>'array'));

                if($datas != null)
                {
                    $countDatas = count($datas);
                }


                if(userModel::insertData("comment_status", $values))
                {
                    echo json_encode(['status'=>'success']);
                }


                break;

            case "showComment";

                $values['user_id'] = $post['userid'];
                $values['user_id_sent'] = $post['useridsend'];
                $commentDisplayId = $post['commentDisplayId'];

                $datas = userModel::fetchAllData('comment_status', array('id_commentor'=>$values['user_id_sent']),array('fetch'=>'array'));
                if(!empty($datas))
                {
                    foreach($datas as $data)
                    {
                        if($commentDisplayId == $data['id_comment'])
                        {
                            echo self::showComment($data['comment_text'],$data['id_creator'],$data['id_comment']);
                        }
                    }
                }

                break;

            case "countNotifications";

                $id = $post['userid'];
                $lastid = $post['lastid'];

                $lastid= trim($lastid," ");

                if($lastid==0)
                {
                    $datas = userModel::countData('comments', array('id_commentor'=>'='.$id),array('fetch'=>'array'));

                }
                else
                {
                    $datas = userModel::countData('comments', array('id_commentor'=>'='.$id, 'id_comment'=>'>'.$lastid),array('fetch'=>'array'));
                }
                echo json_encode(['status' => 'success', 'number' => $datas]);

                break;

            case "addLastNumber";

                $values['id'] = $post['userid'];
                $lastid = userModel::fetchAllData('comments', array('id_commentor'=>$values['id']),array('fetch'=>'value', 'orderBy'=>'ORDER BY id_comment DESC LIMIT 1'));
                $values['id_comment'] = $lastid['id_comment'];
                $check = userModel::countData('notifications', array('id'=>'='.$values['id']),array('fetch'=>'array'));

                if($check==0)
                {
                    if(userModel::insertData("notifications", $values))
                    {
                        echo json_encode(['status' => 'success', 'number' => " ",'lastid' => $lastid['id_comment']]);
                    }
                }
                else
                {
                    if(userModel::updateData("notifications",  array('id'=>'='.$values['id']), $values))
                    {
                        echo json_encode(['status' => 'success', 'number' => " ",'lastid' => $lastid['id_comment']]);
                    }
                }

                break;
        }

        }
}