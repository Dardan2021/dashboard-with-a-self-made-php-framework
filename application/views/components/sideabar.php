<div class="sidebar">
    <ul>
        <li>
            <?php echo anchor("#", '<span class="profileFirst"><img src="'.BASE_URL.'assets/images/background.jpg" alt="" class="imgProfile"></span>');?>
        </li>
        <li>
            <?php echo "<a href=''><span class='icon .icon-users'>&#128100</span>".self::getSession("name")."</a>"?>
            <div id="id" style="display:none"><?php echo self::getSession("id")?></div>
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
        <li>
            <?php echo anchor("profile/chat", '<span class="icon">&#9852</span>Lets chat');?>
        </li>
        <li>
            <?php echo anchor("profile/table", '<span class="icon">&#9852</span>Table');?>
        </li>
    </ul>
</div>
