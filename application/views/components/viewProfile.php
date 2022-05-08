<div class="contents my-5" >
    <div class="content " style="display:flex;justify-content: space-between; height:20%" id="content">
        <div style="display:flex">
            <div class="contactName" >
                <h1 class="heading-thin">Lets Chat</h1>
                <h2> <?php echo $data['name']?></h2>
            </div>
            <img class="profilePictureView" src="<?php echo $data['imgSrc'] ?>" alt="">
            <h1 id="idSend" style="display:none"> <?php echo $data['id']?></h1>
        </div>
        <?php
        if(self::getSession("id") != $data['id']):
        ?>
        <?php
            $status = self::getStatusFriendship(self::getSession("id"),$data['id']);

            if($status == "true")
            {
                echo '<button type="submit" id="removeFriend" style="height:27%; width:10%" class="btn btn-danger mx-3">Hiq nga Shoqeria <i class="fa fa-minus"></i> </button>';
            }
            else if($status == "false")
            {
                echo '<button type="submit" id="addFriend"  style="height:27%; width:10%" class="btn btn-primary">Shto si shok <i class="fa fa-plus"></i> </button>';
            }
        ?>
        <?php
        endif;
        ?>
    </div>
    <div class="status">
        <form id="messagecommentBox" class="messagecommentBox" action="">
            <div class="commentSection">
                <textarea id="commentBox" placeholder="make a status"></textarea>
            </div>
            <div style="display:flex">
                <h5> <?php echo $data['name']?></h5>
                <img class="profilePictureView" src="<?php echo $data['imgSrc'] ?>" alt="">
            </div>
            <p>une jam dakord</p>
        </form>
        <div id="commentStatusContainer">

        </div>
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