<div class="contents my-5">
    <div class="content my-5">
        <h2 class="heading-thin">Lets Chat</h2>
        <h1> <?php echo $data['name']?></h1>
        <h1> <?php echo $data['id']?></h1>

        <div class="chatContainer" style="display:flex">
            <div class="right-message" id="right-message"></div>
            <div class="left-message" id="left-message"></div>
        </div>

        <form id="messageChat" action="">
            <textarea id="textMessage" name="textMessage" rows="4" cols="50"></textarea>
        </form>
    </div>
</div>
