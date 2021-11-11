<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HTML 5 Boilerplate</title>
    <?php include "components/header.php" ;?>

</head>
<body>

<div class="container">
    <?php myFramework::view($data['loginForm']); ?>
</div>

<div class="background">

</div>
<?php include "components/footer.php" ;?>

</body>
</html>