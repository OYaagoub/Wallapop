<?php
$title = "Product titulo";
ob_start();
?>

<section id="details">
    <div class="img">

        <img src="public/assets/uploads/i3601458768.webp" alt="">
    </div>
    <div id="user">
        <img src="public/assets/uploads/i3601458768.webp" alt="">
        <span>oussama</span>
    </div>
    <span><sup>$</sup>65<sup>99</sup><a href=""> Chat</a></span>
    <h1>Carpeta de MAc v4.4</h1>
    <p> 
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
        Expedita officia ullam quos, corrupti doloremque voluptatibus illum libero.
        Debitis quos blanditiis molestiae nostrum eligendi!</p>
    <div class="listfoto">
        <img src="public/assets/uploads/i3601458768.webp" alt="">
        <img src="public/assets/uploads/i3601458768.webp" alt="">
        <img src="public/assets/uploads/i3601458768.webp" alt="">
        <img src="public/assets/uploads/i3601458768.webp" alt="">

    </div>
</section>

<?php
$content = ob_get_clean();


include './resource/views/base.php';
?>
