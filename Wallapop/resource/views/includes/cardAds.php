<section id="cardAds">
    
    
    
    <?= $retVal = (empty($anuncios)) ? "no tienes anuncios hechos" : "" ;?>
    <?php foreach ($anuncios as $anoncio) :?>
        
        <a class="card" href="/Wallapop/index.php?page=details&id_st=<?= $anoncio->getId()?>">
            <img src="<?=$image=$anoncio->getImage() ?>" alt="">
            <?php  
            $g = $anoncio->getPrice();
            $arrayprice = explode(".", $g);
            ?>
            <span><?= $arrayprice[0]?><sup><?= $a=$arrayprice[1]?></sup></span>
            <p><?= $anoncio->getTitle() ?></p>
        </a>
    <?php endforeach ;?>
</section>