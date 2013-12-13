<?php
require_once './base.php';
$page = "post";
$uid = $_SESSION['userSes']->id;
$posts = $app->getAllPostByUserId($uid);
if (isset($_POST['name']))
{
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $dateTime = date('Y-m-d H:i:s');
    if ($app->createPost($uid, $name, $desc, $dateTime))
    {
        $_SESSION['suc'] = "Your Post hast been added";
        header('location:add-post.php');
        exit;
    }
}
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
            <h2>Add new Post</h2>
            <div class="well well-small">
                <form name="post" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="text" name="name" placeholder="Enter Your Post Name" class="span11" required="required"/>
                    <textarea   name="desc" placeholder="Enter Post Description" style="min-height: 120px; width: 100%;" required="required"></textarea>
                    <p><input type="submit" value="Add" class="btn btn-primary btn-large span2"/></p>
                </form>
            </div>
            <?php
            if (isset($_SESSION['suc']))
            {
                ?>
                <div class="alert alert-success"><?= $_SESSION['suc']; ?></div>
                <?php
                unset($_SESSION['suc']);
            }
            ?>
            <h2>List of your posts <small>(<?= count($posts); ?> posts)</small></h2>
            <?php
            if (count($posts) > 0)
            {
                foreach ($posts as $i=>$post)
                {
                    ?>
                    <div>
                        <label><b class="text-info"><?= $post->name; ?></b></label>
                        <p><?= $post->description; ?></p>    
                        <span class="text-success">Added on: </span> <small class="text-warning"><?=date('l d M Y',strtotime($post->date));?></small>
                    </div>
                    <?php
                    if(count($posts)!=($i+1)) echo "<hr/>";
                }
            } else
            {
                echo "<p>You dont have posts</p>";
            }
            ?>
        </div>
        <?php
        require_once './footer.php';
        ?>
    </body>
</html>
