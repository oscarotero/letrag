<?php
header("HTTP/1.1 301 Moved Permanently");
header('location: tag.php?id='.$_GET['IDE']);
exit();
?>