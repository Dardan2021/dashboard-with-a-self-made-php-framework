<form action="" class="form-container">
    <div class="header-img">
        <img src="<?php echo BASE_URL;?>assets/images/im1.png" class="profile-img"alt="">
    </div>

    <h2 class="heading">Login in your Account</h2>

    <div class="group">
        <?php echo formInput(['type' => 'email', 'name'=>'email', 'class'=>'control', 'placeholder' => 'Enter email'])?>
    </div>
    <div class="group">
        <?php echo formInput(['type' => 'password', 'name'=>'password', 'class'=>'control', 'placeholder' => 'Enter password'])?>
    </div>
    <div class="group">
        <input type="submit" class="buton" id="btn-create" value="Login">
    </div>
    <div class="group">
        <?php echo anchor("accountController/index", "Create new account..." ,array("class"=>"links", "id"=>"links"))?>
    </div>
</form>