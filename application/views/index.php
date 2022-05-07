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
        <?php if(!empty(self::getSession('security')))
        {
        ?>
            <div class="flash " id="flashi">
                <h5><?php echo self::getSession('security');?></h5>
                <span class="remove"><i class="fa fa-close"></i> </span>
            </div>
        <?php
        }
        self::unsetSession('security');
        ?>
        <?php myFramework::view($data['signupForm']); ?>
    </div>
    <div class="background"></div>
    <?php include "components/footer.php" ;?>

</body>
</html>