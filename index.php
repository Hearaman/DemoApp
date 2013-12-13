<?php
require_once './base.php';
$page = 'home';
$users = $app->getUsers();
$posts=$app->getAllPosts(10);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Demo Cloud</title>
        <link href="css/main.css" rel="stylesheet" />
    </head>
    <body>
        <?php require_once './header.php'; ?>
        <div class="container">
            <div class="row-fluid">
                <div class="span4">
                    <div class="well well-small">
                        <h4>Users with their latest Posts</h4>
                        <hr/>
                        <?php
                        foreach ($users as $i => $user)
                        {
                            ?>
                            <div class="row-fluid">
                                <div class="span3">
                                    <img src="img/<?= ($user->id % 2) . ".png"; ?>" />
                                </div>
                                <div class="span9">
                                    <h4 class="text-info"><?= $user->name; ?></h4>
                                    <p><?= $user->email; ?></p>
                                </div>
                            </div>
                            <?php
                            if (count($users) != ($i + 1))
                                echo "<hr/>";
                        }
                        ?>
                    </div>
                </div>
                <div class="span8">
                    <h3>Latest Posts</h3>
                    <?php
                    if (count($posts) > 0)
                    {
                        foreach ($posts as $i => $post)
                        {
                            ?>
                            <div>
                                <label><b class="text-info"><?= $post->post; ?></b></label>
                                <p><?= $post->description; ?></p>    
                                <div class="row-fluid">
                                    <div class="span6"><span class="text-success">Added By: </span> <small class="text-warning"><?= $post->user; ?></small></div>
                                    <div class="span6"><span class="text-success">On: </span> <small class="text-warning"><?= date('l d M Y', strtotime($post->date)); ?></small></div>
                                </div>
                            </div>
                            <?php
                            if (count($posts) != ($i + 1))
                                echo "<hr/>";
                        }
                    } else
                    {
                        echo "<p>You dont have posts</p>";
                    }
                    ?>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <h1 class="text-error">Would like to Try this Demo Cloud App?</h1>
                <a href="login.php">Yes, I do..!</a>
            </div>            
        </div>
        <?php
        require_once './footer.php';
        ?>
    </body>
</html>
