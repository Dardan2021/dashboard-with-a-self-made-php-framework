<div class="contents my-5">
    <div class="content my-5">
        <h2 class="heading-thin">Change Name</h2>
        <?php echo formOpen("","POST", array( "class"=>"m-20"))?>
            <div class="group">
                <?php echo formInput(['type' => 'text', 'name'=>'newName', 'class'=>'control', 'id'=>'newName','placeholder' => 'New name'])?>
            </div>
            <div class="group">
                <input type="submit" value="Update &rarr;" class="btn-default">
            </div>
        </form>
    </div>
</div>