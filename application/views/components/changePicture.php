<div class="contents my-5">
    <div class="content my-5">
        <h2 class="heading-thin">Change Picture</h2>
        <?php echo formOpen("","POST", array( "class"=>"m-20","id"=>"formChangePhoto"))?>
            <div class="group">
                <label for="myImage" id="imageLabel"></label>
                <?php echo formInput(['type' => 'file', 'name'=>'uploadPicture', 'class'=>'control', 'id'=>'myImage'])?>
            </div>
            <div class="group">
                <input type="submit" value="Update Picture &rarr;" class="btn-default">
            </div>
        </form>
    </div>
</div>
