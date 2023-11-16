<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);
$title = "Wallapop";
ob_start();
?>

<?php 
require_once("./routes/web.php");

?>
<?php
$content = ob_get_clean();

// Include the layout and inject the content
include ('./resource/views/base.php');

?>
