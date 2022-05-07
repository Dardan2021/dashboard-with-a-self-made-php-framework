<div class="contents my-5">
    <div class="content my-5">
        <h2 class="heading-thin">Change Password</h2>
        <?php echo formOpen("","POST", array( "class"=>"m-20",'id'=>'changePassword'))?>
            <div class="group">
                <?php echo formInput(['type' => 'password', 'name'=>'currentPassword', 'class'=>'control', 'id'=>'currentPassword','placeholder' => 'Current password'])?>
            </div>
            <div class="group">
                <?php echo formInput(['type' => 'password', 'name'=>'newPassword', 'class'=>'control', 'id'=>'newPassword','placeholder' => 'New name'])?>
            </div>
            <div class="group">
                <input type="submit" value="Update &rarr;" class="btn-default">
                <input type="reset" value="Reset &larr;" class="btn-reset">
            </div>
        </form>
    </div>
</div>