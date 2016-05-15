<?php
header("HTTP/1.1 301 Moved Permanently");
header('location: desenador.php?id='.$_GET['IDE']);
exit();
?>