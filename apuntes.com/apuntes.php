<?php 
echo '<div id="apuntes">';
//if (is_array($apuntes) || is_object($apuntes)) {
    $x=count($apuntes);
    foreach ($apuntes as  $valuea) {
        echo '<div class="apunte">';
        echo "
        <details>
        <summary><span style='border-radius:5px;width:max-content;padding:5px;background:rgba(245, 210, 10,0.3);margin:0 5px' >{$x}</span> <div style='min-width:75%'> {$valuea['nombre']}</div> 
        <div id='btn' style='float:right;width:max-content;'> 
        <a href='index.php?page=delete&id={$valuea['id']}' style='position: relative;right: -10px;'>Delete</a>
        </div>
        </summary>
        <p><pre><code>".htmlspecialchars($valuea['apunte'])."</code></pre></p>
        </details>
        ";
        echo '</div>';
        $x--;
    }
//} else {
    // $temas is not an array or an object, so display an error message
//    echo 'Error: $apuntes is not an array or an object.';
//}


echo '</div>';


?>
