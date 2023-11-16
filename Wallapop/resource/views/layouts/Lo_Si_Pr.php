<ul>
    <?php 
        if (!isset($_SESSION['logcode'])) {?>
            <li><a href="/Wallapop/index.php?page=login">Login</a></li>
            
            
        <?php }else{ 
            $user=$log->getBylogCode($_SESSION['logcode']);
            $_SESSION['name']=$user->getFullname();
            $_SESSION['id_user']=$user->getId();
            $_SESSION['photo']=$user->getPhoto();
            ?>
            <li><a href="/Wallapop/index.php?page=misanuncios">Mis Anoncios</a></li>
            <li><a href="/Wallapop/index.php?page=logout">
                <span><?php echo $_SESSION['name'] ?></span>
                <img src="<?php echo $_SESSION['photo'] ?>" alt="img">
            </a></li>

        <?php }
    ?>

</ul>