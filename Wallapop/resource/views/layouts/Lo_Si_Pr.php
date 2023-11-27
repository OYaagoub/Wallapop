<ul>
    <?php 
        if (!isset($_SESSION['logcode'])) {?>
            <li>
            <form id="top" action="/Wallapop/index.php?page=login" method="post">
                <input type="hidden" name="action" value="login">
                <input type="email" name="email" placeholder="Correo" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <input type="submit" value="Iniciar Session">
                <a href="/Wallapop/index.php?page=signUp">Sign Up</a>
            </form>
            </li>
            <!-- <li><a href="/Wallapop/index.php?page=login">Login</a></li> -->
            
            
        <?php }else{ 
            $user=$log->getBylogCode($_SESSION['logcode']);
            if ($user!=null) {
                
                $_SESSION['name']=$user->getFullname();
                $_SESSION['id_user']=$user->getId();
                $_SESSION['photo']=$user->getPhoto();
                ?>
                <li><a href="/Wallapop/index.php">Home</a></li>
                <li><a href="/Wallapop/index.php?page=misanuncios">Mis Anoncios</a></li>
                <li><a href="/Wallapop/index.php?page=logout">
                    <span><?php echo $_SESSION['name'] ?></span>
                    <img src="<?php echo $_SESSION['photo'] ?>" alt="img">
                </a></li>
            <?php }else{
                unset($_SESSION['logcode']);
            }
            ?>

        <?php }
    ?>

</ul>