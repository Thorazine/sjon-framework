<?php
    include '../core/config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include '../core/head.php'; ?>
    </head>
    <body>

        <?php include '../core/header.php'; ?>

        <?php include "../pages/" . $page . ".php"; ?>

        <div class='errorcontainer'>
            <?php echo App::displayErrors(); ?>
        </div>

        <?php include '../core/footer.php'; ?>

    </body>
</html>
<?php
    DB::close();
?>
