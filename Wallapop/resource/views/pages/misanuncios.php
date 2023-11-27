<details>
    <summary style="cursor:pointer;background:gold;width:max-content;padding:10px;border-radius:10px">Nuevo Anoncio</summary>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="new">
        <input required type="text" name="title" placeholder="titolo" value="<?= $title?>">
        <textarea required name="description" placeholder="descripcion"><?= $description?></textarea>
        <div id="imageInputs" style="width:100%;">
            <input type="file" style="width:100%;" value="<?= $photoPran?>" required name="photoPran" accept="image/*">
        </div>
        <button type="button" onclick="addImageInput()">Añadir image</button>        
        <div style="display:flex">
        <select name="monida" style="width:20%;border:none;background:none" id="">
            <option value="$">$</option>
            <option value="€">€</option>
        </select>
        <input style="width:20%;border:none"  value="<?= $p1?>" type="number" min="1" required name="price1" placeholder="precio (e.g., $23.35)">
        <span style="width:5%;font-size:30px;text-align:center">.</span>
        <input style="width:20%;border:none" value="<?= $p2?>" type="number" min="00" max="99" required name="price2" placeholder="precio (e.g., $23.35)">
        </div>
        <input type="submit" value="Submit Post">
    </form>
    <script>
    function addImageInput() {
        const imageInputs = document.getElementById('imageInputs');
        const newInput = document.createElement('input');
        newInput.setAttribute('type', 'file');
        newInput.setAttribute('name', 'photos[]');
        newInput.setAttribute('accept', 'image/*');
        imageInputs.appendChild(newInput);
    }
</script>

</details>
<section id="cardAds">
    <?= $mis = (empty($misanuncios)) ? "no tienes anuncios hechos" : "" ;?>
    <?php foreach ($misanuncios as $anoncio_mi) :?>
        <?php  
            $g = $anoncio_mi->getPrice();
            $arrayprice = explode(".", $g);
            $images=$anu->getImagesAnu($anoncio_mi->getId());
        ?>
        <div class="card" data-url="#" 
            data-title="<?= $anoncio_mi->getTitle() ?>"
            data-description="<?= $anoncio_mi->getDescription() ?>"
            data-price1="<?= $arrayprice[0] ?>"
            data-price2="<?= $arrayprice[1] ?>"
            data-image="<?= $anoncio_mi->getImage() ?>"
            data-id="<?= $anoncio_mi->getId() ?>"
            data-images="
            <?php 
            foreach ($images as  $image) {
                echo $image->getImage().",".$image->getId().";";
            }
            ?>
            
            "
        >
            <img src="<?=$image=$anoncio_mi->getImage() ?>" alt="">
            <span><?= $arrayprice[0]?><sup>,<?= $arrayprice[1]?></sup></span>
            <p><?= $anoncio_mi->getTitle() ?></p>
            <div class="btn">
                <a href="/Wallapop/index.php?page=misanuncios&id_anuncion_del=<?=$id =$anoncio_mi->getId()?>">delete</a>
                <a href="/Wallapop/index.php?page=details&id_st=<?=$id =$anoncio_mi->getId()?>">View/Update</a>

            </div>
        </div>
    
    <?php endforeach ;?>
    <!-- <form action="" id="edit" style="display:flex;flex-direction:column;width:80vw;height:80vh;position:fixed;top:5vh;right:10v;overflow-y:auto" method="post">
        <input type="text" name="title" id="title" placeholder="titulo">
        <textarea name="description" id="description" cols="30" rows="10"></textarea>
        <div>
            <select name="monida" id="monida">
                <option value="$">$</option>
                <option value="€">€</option>
            </select>
            <input type="number" name="price1" id="price1" placeholder="precio">
            <span>.</span>
            <input type="number" name="price2" id="price2" placeholder="precio">
        </div>
        <input type="file" name="image" id="image" placeholder="imagen">
        <div id="inputphotos">
            <div>
                <img src="" alt="">
                <a href="">delete</a>
            </div>
        </div>
        <input type="submit" name="submit" id="submit" value="submit">

    </form> -->
</section>