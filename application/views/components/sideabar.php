<div class="sidebar">
    <ul>
        <li>
            <?php $filename = self::getpictureFileName(self::getSession("id")) ?>
            <?php echo anchor("#", '<span class="profileFirst"><img src="'.$filename.'" alt="" class="imgProfile"></span>');?>
        </li>
        <li>
            <?php echo "<a   href=''><span class='icon .icon-users'>&#128100</span><span id='profileName'>".self::getName(self::getSession("id"))."</span> </a>"?>
            <div id="id" style="display:none"><?php echo self::getSession("id")?> </div>
        </li>
        <li>
            <?php echo anchor("profile/searchView", '<span class="icon">&#9851</span>Search Friend');?>
        </li>
        <li>
            <?php echo anchor("profile/changePictureView", '<span class="icon">&#9851</span>Change Picture');?>
        </li>
        <li>
            <?php echo anchor("profile/changePasswordView", '<span class="icon">&#9852</span>Change Password');?>
        </li>
        <li>
            <?php echo anchor("profile", '<span class="icon">&#9852</span>Change Name');?>
        </li>
    </ul>
</div>
