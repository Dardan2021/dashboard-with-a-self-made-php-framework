<div class="accountMessage">

    <?php
/*    echo session::flash("signupSuccess", " alert alertError")."<br>";*/
    if(isset($_SESSION['signupSuccess']))
    {
        echo session::flash("signupSuccess", " alert alertSuccess")."<br>";
    }
    else
    {
        echo " ";
    }
    ?>
</div>

<form  class="form-container" onsubmit="return false"  id="signupForm" method="POST">

    <h2 class="heading">Create user account</h2>

    <div class="group">
        <?php echo formInput(['type' => 'text', 'name'=>'full_name', 'class'=>'control', 'placeholder' => 'Enter name', 'value'=>myFramework::setValue('full_name')])?>
        <div class="error text-danger" id="errorName">
        </div>
    </div>
    <div class="group">
        <?php echo formInput(['type' => 'email', 'name'=>'email', 'class'=>'control', 'placeholder' => 'Enter email', 'value'=>myFramework::setValue('email')])?>
        <div class="error text-danger"  id="errorEmail">
        </div>
    </div>
    <div class="group">
        <?php echo formInput(['type' => 'password', 'name'=>'password', 'class'=>'control', 'placeholder' => 'Enter password', 'value'=>myFramework::setValue('password')])?>
        <div class="error text-danger" id="errorPassword">
        </div>
    </div>
    <div class="group">
        <button type="submit" class="buton" id="btn-create"> Create Account</button>
    </div>
    <div class="group">
        <?php echo anchor("accountController/login", "Already have an account?" ,array("class"=>"links", "id"=>"links"))?>
    </div>
</form>