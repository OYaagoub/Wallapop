<?php
$title = "Product titulo";
ob_start();
?>
<?php
$pricea=$anun_details->getPrice();
$pricearray=explode(".",$pricea );
?>
<section id="details">
    <div class="img" style="position:relative" id="ed_img">
        <img src="<?= $anun_details->getImage()?>" alt="">
        <?php if ($edit=="true"): ?>
        <form id="ptp" action="" method="post" enctype="multipart/form-data"
            style="position: absolute;top: 0%;z-index: 2">
            <input type="hidden" name="action" value="imgp">
            <input type="hidden" name="id_st" value="<?= $anun_details->getId()?>">
            <input type="hidden" name="imgpA" value="<?= $anun_details->getImage()?>">
            <input type="file" name="imgpN" accept="image/*">
            <input type="submit" value="Update photo">
        </form>
        <?php endif; ?>

    </div>

    <div id="user">
        <img src="<?= $user_details->getPhoto()?>" alt="">
        <span>
            <?= $user_details->getFullname()?>
        </span>
    </div>
    <span id="prc">
        <?=$pricearray[0]?><sup>
            <?=$pricearray[1]?> 
            <?php if ($edit=="true"): ?>
            <span style="font-size: 13px;background: burlywood;padding: 5px 10px;cursor: pointer;">edit price</span>
            <?php endif; ?>
        </sup><a href=""> Chat</a>
        <?php if ($edit=="true"): ?>
        <form action="" id="for_prc" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="price">
            <input type="hidden" name="id_st" value="<?= $anun_details->getId()?>">
            <div style="display:flex">
                <select name="monida" style="width:20%;border:none;background:none" id="">
                    <option value="$">$</option>
                    <option value="€">€</option>
                </select>
                <input style="width:20%;border:none" value="<?= $p1?>" type="number" min="1" required name="price1"
                    placeholder="precio (e.g., $23.35)">
                <span style="width:5%;font-size:30px;text-align:center">.</span>
                <input style="width:20%;border:none" value="<?= $p2?>" type="number" min="00" max="99" required
                    name="price2" placeholder="precio (e.g., $23.35)">
            </div>
            <input type="submit" value="Update Price">
        </form>
        <?php endif; ?>
    </span>

    <h1 >
        <?= $anun_details->getTitle()?>
        <?php if ($edit=="true"): ?>
        <span id="tit" style="font-size: 13px;background: burlywood;padding: 5px 10px;cursor: pointer;">edit title</span>
        <?php endif; ?>
    </h1>
    <?php if ($edit=="true"): ?>
    <form id="for_tit" action="" method="post" >
        <input type="hidden" name="action" value="title">
        <input type="hidden" name="id_st" value="<?= $anun_details->getId()?>">
        <input type="text" name="title" value="<?= $anun_details->getTitle()?>">
        <input type="submit" value="Update title">
    </form>
    <?php endif; ?>
    <p id="ed_description">

        <?= $anun_details->getDescription()?>
    </p>
    <?php if ($edit=="true"): ?>
    <span id="dis" style="font-size: 13px;background: burlywood;padding: 5px 10px;cursor: pointer;">edit Description</span>
    <form style="width: 95%;" id="for_dis" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_st" value="<?= $anun_details->getId()?>">
        <input type="hidden" name="action" value="description">
        <textarea name="description" id="" cols="30" rows="10"><?= $anun_details->getDescription()?></textarea>
        <input type="submit" value="Update description">
    </form>
    <?php endif; ?>
    
    <div class="listfoto">
        <?php foreach ($images_details as $image) :?>
        <div class="foto" style="width: 50%;display: flex;flex-direction: column;justify-content: center;align-items: center;position: relative;">
            <img class="imgs" src="<?=$image->getImage()?>" style="width: 70%;height: 300px;align-self: center;" alt="<?=$image->getImage()?>">
            <?php if ($edit=="true"): ?>
            <form action="" class="for_imgs" style="position: absolute;z-index: 3;" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_img" value="<?= $image->getId()?>">
                <input type="hidden" name="imgA" value="<?=$image->getImage()?>">
                <input type="hidden" name="id_st" value="<?= $anun_details->getId()?>">
                <input type="hidden" name="action" value="imgs">
                <input type="file" name="imgN" accept="image/*">
                <input type="submit" value="Update photo">
            </form>
            <?php endif; ?>
        </div>
        <?php endforeach ?>
    </div>
</section>


<?php
$content = ob_get_clean();


include './resource/views/base.php';
?>