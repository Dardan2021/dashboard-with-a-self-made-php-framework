<div class="contents my-5" >
    <div class="content my-5" style="display:flex;align-items: center;" id="content">
        <div>
            <h2 class="heading-thin">Lets Chat</h2>
            <h1> <?php echo $data['name']?></h1>
            <h1 id="idSend"> <?php echo $data['id']?></h1>
        </div>
        <?php
        if(self::getSession("id") != $data['id']):
        ?>
        <?php
            $status = self::getStatusFriendship(self::getSession("id"),$data['id']);

            if($status == "true")
            {
                echo '<button type="submit" id="removeFriend" class="btn btn-danger mx-3">Hiq nga Shoqeria <i class="fa fa-minus"></i> </button>';
            }
            else if($status == "false")
            {
                echo '<button type="submit" id="addFriend" class="btn btn-primary">Shto si shok <i class="fa fa-plus"></i> </button>';
            }
        ?>
        <?php
        endif;
        ?>
    </div>
</div>
<?php
    if(self::getSession("id") != $data['id']):
?>
<div id="chatContent" class="chatContent">
    <div class="chatContainer"  id="chatContainer"></div>
    <div></div>
    <form id="messageChat" class="textMessage" action="">
        <textarea class="form-control textMessage" id="textMessage"  name="textMessage" rows="2"></textarea>
        <input type="file" class="form-control textMessage files-upload" id="upload-files" name="send_file">
        <input type="hidden" value="<?php echo $data['id']?>" name="userid">
    </form>
<?php
endif;
?>
</div>