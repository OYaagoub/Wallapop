<section id="temas">
<?php 
if (is_array($temas) || is_object($temas)) {
    // Iterate over $temas
    foreach ($temas as $value) {
        $models= new Models();
        $apuntes = $models->getApuntes($value['id']);
        
        echo '<fieldset>';
        echo "<legend>{$value['nombre']}</legend>";
        echo "<a href='#' class='NuevaApunte' data-name='{$value['nombre']}' data-url='{$value['id']}' > Nueva apunte </a>";
        
        include('apuntes.php');
        echo '</fieldset>';
    }
} else {
    // $temas is not an array or an object, so display an error message
    echo 'Error: $temas is not an array or an object.';
}

?>
</section>
