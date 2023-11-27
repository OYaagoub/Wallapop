<?php
include_once('headWithHeader.php');

?>
<body>
    <nav>
        <a href="index.php?page=main">APUNTES</a>
        <form action="/index.php" method="get">
            <input type="hidden" name="page" value="searchS">
            <?php 
            if ($page !='main' & isset($ida)) {
                echo '<input type="hidden" name="id_asi" value="'.$ida.'">';
            }
            
            ?>
            <input type="text" id="search-input" name="search" placeholder="Search <?php echo ($page =='main') ? '': 'in '.$page ?>"/>
            <button >Search</button>
        </form>
        <ul>
            <li><a href="index.php?page=DAW">DAW</a></li>
            <li><a href="index.php?page=DIW">DIW</a></li>
            <li><a href="index.php?page=DWES">DWES</a></li>
            <li><a href="index.php?page=DWEC">DWEC</a></li>
            <li><a href="index.php?page=DWES_JAVA">DWES_JAVA</a></li>
            <li><a href="index.php?page=PROJECT_FINAL">PROJECT_FINAL</a></li>
        </ul>
        
    </nav>
    <?php
include_once('route.php');

?>

<div id="DivNuevaApunte">
    <form action="index.php?page=new"  method="post">
        <h2>Nueva apunte en el { <span id="titleTema">fe</span> } del <span> <?php echo $page ?></span></h2>
        <input  type='text' name='nombre' placeholder="Title">
        <textarea placeholder="Content" name="content" id="" cols="30" rows="10"></textarea>
        <input id="formato" type='hidden' name='id' value=''>
        <input type="submit" value="Añadir">
    </form>

</div>
<script>document.getElementById('DivNuevaApunte').style.display="none";</script>
<script src="jquery-3.6.0.min.js"></script>

<script src="search.js"></script>
<script>
    
    $(document).ready(function(){
      $('.NuevaApunte').click(function(){
        $("#DivNuevaApunte").toggle();
        let url = $(this).data('url');
        let name = $(this).data('name');

        // Set the form action based on the extracted URL
        document.getElementById('formato').value = url;
        document.getElementById('titleTema').innerHTML = name;
      });
    });
</script>
</body>
</html>
