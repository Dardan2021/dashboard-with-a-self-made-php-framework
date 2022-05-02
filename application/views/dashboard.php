<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <title>HTML 5 Boilerplate</title>

    <?php include "components/header.php" ;?>
<body>
    <nav style="height:10%;width:100%;">
       <?php include "components/nav.php" ;?>
    </nav>
    <section class="layout" style="height:90%;width:100%;" >
   <?php include "components/sideabar.php";?>
    <?php

        myFramework::view($data['layout'],$data); ?>
    </section>
    <?php include "components/footer.php" ;?>
</body>
</html>