<ul>
    <?php echo anchor("accountController/logout", "logouot", array("class"=>"btn-outline"));?>
    <?php echo anchor("#", '<span class="hember" id="hember">&#9776;</span>');?>
    <li>
        <button id="notification"></button>
        <div id="remainingComment" style="display:none">
           <?php echo self::getLastCommentId(self::getSession("id"))?>
        </div>
    </li>
</ul>
