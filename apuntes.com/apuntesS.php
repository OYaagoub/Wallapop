<?php 
echo '<div id="apuntes">';
//if (is_array($apuntes) || is_object($apuntes)) {
    $x=count($search);
    foreach ($search as $valuea) {
        echo '<div class="apunte">';
        echo "
        <details>
        <summary>{$x} {$valuea['nombre']};  
        
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
