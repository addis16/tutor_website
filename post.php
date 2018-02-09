<?php
session_start();
$text = $_POST['text'];

$open = fopen("log.html", 'a');
fwrite($open, "<div id='newLine'>".stripslashes(htmlspecialchars($text))."</div>\n");
fclose($open);
?>
