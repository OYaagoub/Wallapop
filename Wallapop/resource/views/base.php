<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="./public/assets/css/style.css">
    <!-- <script>
        setInterval(() => {
            location.reload()
        }, 5000);
    </script> -->
</head>
<body>
    <header>
    <?php require_once("./resource/views/includes/header.php"); ?>
    <?php require_once("./resource/views/layouts/Lo_Si_Pr.php"); ?>
    </header>
    <div id="bad" style="width:100%;<?php echo isset($_SESSION['error']) ? 'padding:10px;':'' ?>display:block;background:red;color:white">
    <?php if (isset($_SESSION['error'])){
        $bad_news=$_SESSION['error'];
        echo $bad_news;
    }
    ?>
    </div>
    <div id="good" style="width:100%;<?php echo isset($_SESSION['access']) ? 'padding:10px;':'' ?>display:block;background:green;color:white">
    <?php if (isset($_SESSION['access'])){
        $good_news=$_SESSION['access'];
        echo $good_news;
    }
    ?>
    
    <?php 
    unset($_SESSION['error']);
    unset($_SESSION['access']);
    ?>
    
    </div>
    <?php echo $content ?>
    
    <?php require_once("./resource/views/includes/footer.php"); ?>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.card').click(function() {
            var url =$(this).data("url");
            location.href=url;
        });
        $('#homelink').click(()=>{
            location.href="/Wallapop/index.php"
        })
        
    });
    
    setTimeout(() => {
        document.getElementById("bad").style.display = "none";
        document.getElementById("good").style.display = "none";
    }, 1500);
    
</script>
</html>
