<?php
trait additionalFunction
{
    public static function getStatusFriendship($firstid, $secondid)
    {
        $datas = userModel::fetchAllData('friendship', array('friend_id' => $firstid,'friend_with'=>$secondid),array("fetch"=>'value'));
        if(empty($datas))
        {
            $datas = userModel::fetchAllData('friendship', array('friend_id' => $secondid,'friend_with'=>$firstid),array("fetch"=>'value'));
        }
        return $datas['status'];
    }

    public static function  showMessages($message, $type ,$position)
    {
        if($type=='text')
        {
            return '<div class="textDiv"><p  class="'.$position.'"><span>'.$message.'</span></p></div><br>';
        }

        else if($type == 'jpg' || $type =='png' || $type =='png' || $type =='JPEG' || $type =='JPG')
        {

            return '<div><img class="file '.$position.'"style="width:300px;height:200px" src="uploadFile/'.$message.'" class="sender-img" alt=""> </div><br>';
        }
        else
        {
            return '<div class=""><a  class="file '.$position.' " href="uploadFile/'.$message.'">'.$message.'</a></div><br>';
        }
    }
}