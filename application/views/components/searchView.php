<div class="contents my-5">
    <div class="content my-5">
        <h2 class="heading-thin">Find Friend</h2>
        <form  class=" m-20"  id="searchForm" method="POST">
        <div class="group">
            <?php echo formInput(['type' => 'text', 'name'=>'full_name', 'class'=>'control', 'id'=>'full_name','placeholder' => 'Find friend'])?>
        </div>
        <div class="group">
            <input type="submit" value="Search" class="btn-default">
        </div>
        </form>
    </div>
    <div class="content my-5">
        <h2 class="heading-thin">Results</h2>
        <div class="main">
            <div id="name"></div>
            <div id="email">
                <p class='results'>Results : </p>
            </div>
        </div>
    </div>
</div>



