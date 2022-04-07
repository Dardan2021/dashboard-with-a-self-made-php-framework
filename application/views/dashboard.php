<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HTML 5 Boilerplate</title>
    <?php include "components/header.php" ;?>
<body>
<nav>
    <?php include "components/nav.php" ;?>
</nav>
<div class="layout">
    <?php include "components/sideabar.php";?>
    <?php

    myFramework::view($data['layout'],$data); ?>
</div>
<?php include "components/footer.php" ;?>
</body>
</html>