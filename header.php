<div class="navbar">
    <div class="navbar-inner">
        <a class="brand" href="index.php">Demo Cloud</a>
        <ul class="nav">
            <li class="<?=($page=='home')?'active':'';?>"><a href="index.php">Home</a></li>
            <li class="<?=($page=='post')?'active':'';?>"><a href="add-post.php">Add  Post</a></li>
        </ul>
        <ul class="nav pull-right">      
            <?php
                if (isset($_SESSION['userSes']))
                    echo "<li><a href='#'><span class='text-info'>Welcome <b>".$_SESSION['userSes']->name."</b></span></a></li>";
                ?>
            <li>                
                
                    <?php
                    if (isset($_SESSION['userSes']))
                        echo "<a href='logout.php'>Logout</a>";
                    else
                        echo "<a href='login.php'>Login</a>";
                    ?>
            </li>                   
        </ul>
    </div>            
</div>