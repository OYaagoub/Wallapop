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
    <div class="card" data-url="/Wallapop/index.php?page=details">
        <img src="./public/assets/uploads/i3601458768.webp" alt="">
        <span><sup>$</sup>345<sup>99</sup></span>
        <p>carpeta de mac v42.32</p>
        <div class="btn">
            <a href="">delete</a>
            <a href="">view</a>
            <a href="">edit</a>
        </div>
    </div>
    <div class="card" data-url="/Wallapop/index.php?page=details">
        <img src="./public/assets/uploads/i3601458768.webp" alt="">
        <span><sup>$</sup>345<sup>99</sup></span>
        <p>carpeta de mac v42.32</p>
        <div class="btn">
            <a href="">delete</a>
            <a href="">view</a>
            <a href="">edit</a>
        </div>
    </div>
    <div class="card" data-url="/Wallapop/index.php?page=details">
        <img src="./public/assets/uploads/i3601458768.webp" alt="">
        <span><sup>$</sup>345<sup>99</sup></span>
        <p>carpeta de mac v42.32</p>
        <div class="btn">
            <a href="">delete</a>
            <a href="">view</a>
            <a href="">edit</a>
        </div>
    </div>
    <div class="card" data-url="/Wallapop/index.php?page=details">
        <img src="./public/assets/uploads/i3601458768.webp" alt="">
        <span><sup>$</sup>345<sup>99</sup></span>
        <p>carpeta de mac v42.32</p>
        <div class="btn">
            <a href="">delete</a>
            <a href="">view</a>
            <a href="">edit</a>
        </div>
    </div>
    <div class="card" data-url="/Wallapop/index.php?page=details">
        <img src="./public/assets/uploads/i3601458768.webp" alt="">
        <span><sup>$</sup>345<sup>99</sup></span>
        <p>carpeta de mac v42.32</p>
        <div class="btn">
            <a href="">delete</a>
            <a href="">view</a>
            <a href="">edit</a>
        </div>
    </div>
</section>