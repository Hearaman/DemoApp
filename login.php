<?php
require_once './base.php';
$msg = '';
if(isset($_SESSION['userSes'])) 
{
    header('location:add-post.php');
}
if (isset($_POST['email']))
{    
    $email = $_POST['email'];
    $psw = $_POST['psw'];
    if ($app->login($email, $psw))
    {
        header('location:add-post.php');
    } else
    {
        unset($_SESSION['userSes']);
        $msg = "Opps...!, Wrong email or Password";
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Demo Cloud</title>
        <link href="css/main.css" rel="stylesheet" />
        <link href="css/font-awesome.min.css" rel="stylesheet" />
    </head>
    <body>        
        <div class="container">
            <br/><br/><br/>
            <div class="row-fluid">
                <div class="span4"></div>
                <div class="span4 text-center">
                    <div class="well">
                        <i class="fa fa-user fa-5x"></i>
                        <hr/>
                        <form name="login" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                            <p><input type="text" name="email" placeholder="Email" class="span12" required/></p>
                            <p><input type="password" name="psw" placeholder="Password" class="span12" required/></p>
                            <p><input type="submit" class="btn btn-primary span12" value="Login" /></p>
                            <p>To check this App</p>
                            <p>Email: demo@gmail.com / Psw: demo</p>
                        </form>
                    </div>
                    <?php
                    if (strlen($msg) > 0)
                    {
                        ?>
                        <div class="alert alert-danger"><?= $msg; ?></div>
                        <?php
                    }
                    ?>
                </div>
                <div class="span4"></div>
            </div>
        </div>
        
    </body>
</html>
