<?php
trait additionalFunction
{
    public static function getStatusFriendship($firstid, $secondid)
    {
        $datasFirst = userModel::fetchAllData('friendship', array('friend_id' => $firstid,'friend_with'=>$secondid),array("fetch"=>'value'));
        $datasSecond = userModel::fetchAllData('friendship', array('friend_id' => $secondid,'friend_with'=>$firstid),array("fetch"=>'value'));

        if(empty($datasFirst) && empty($datasSecond))
        {
            return 'false';
        }
        else if(!empty($datasFirst))
        {
            return $datasFirst['status'];
        }
        else if(!empty($datasSecond))
        {
            return $datasSecond['status'];
        }
    }

    public static function  showMessages($message, $type ,$position)
    {
        if($type=='text')
        {
            return '<div class="textDiv"><p  class="'.$position.'"><span>'.$message.'</span></p></div><br>';
        }

        else if($type == 'jpg' || $type =='png' || $type =='png' || $type =='JPEG' || $type =='JPG')
        {

            return '<div><img class="file '.$position.'"style="width:250px;height:200px" src="https://localhost/integrateChat/public/uploadFile/'.$message.'" class="sender-img" alt=""> </div><br>';
        }
        else
        {
            return '<div class=""><a  class="file '.$position.' " href="https://localhost/integrateChat/public/uploadFile/'.$message.'">'.$message.'</a></div><br>';
        }
    }
    public static function getpictureFileName($id)
    {
        $datas = userModel::fetchAllData('profilepicture', array('id' => $id),array("fetch"=>'value'));
        if(!empty($datas))
        {
            $fullPath = "https://localhost/integrateChat/public/uploadFile/".$datas['profile_picture_filename'];
            return $fullPath;
        }
        else
        {
            $fullPath = "https://localhost/integrateChat/public/uploadFile/Unknown_person.jpg";
            return $fullPath;
        }

    }
    public static function getName($id)
    {
        $datas = userModel::fetchAllData('users', array('id' => $id),array("fetch"=>'value'));

        if(!empty($datas))
        {
            return $datas['full_name'];
        }
        else
        {
            return 0;
        }
    }

    public static function showCommentStatus($commentStatusText, $type, $id, $commentId)
    {
        $fullCommentID = "sectionComment".$commentId;
        $fullTextID  = "sectionText".$commentId;
        $fullFormID = "sectionForm".$commentId;

        return '<div style="height:15vh;background-color:yellow">
                    <div style="display:flex">
                       <img  width="20px" height="20px" src="'.self::getpictureFileName($id).'" alt="">
                       <h3> '.self::getName($id).'</h3></div>
                       <p style="font-size:12px;">'.$commentStatusText.'</p>
                       <form  id="'.$fullFormID.'" class="sectionForm" style="background-color:blue;overflow: auto;">
                          <textarea name="" id="'.$fullTextID.'" class="commentStatus" style="font-size:12px;" placeholder="writeComment" cols="24" rows="1"></textarea>
                       </form>
                       <div id="'.$fullCommentID.'" class="sectionComment" style="overflow:auto;"">
                       </div>
                    </div>';
    }

    public static function showComment($commentStatusText,  $id, $commentId)
    {
        return '<div style="background-color:red;">
                    <div style="display:flex">
                       <img  width="10px" height="10px" src="'.self::getpictureFileName($id).'" alt="">
                       <h3> '.self::getName($id).'</h3></div>
                       <p style="font-size:9px;">'.$commentStatusText.'</p>
                    </div>
                 </div>';
    }

    public static function getLastCommentId($id)
    {
        $datas = userModel::fetchAllData('notifications', array('id' => $id),array("fetch"=>'value'));

        if($datas != null )
        {
            return $datas['id_comment'];
        }
        else
        {
            return 0;
        }
    }
}