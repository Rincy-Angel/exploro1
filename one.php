<?php

$updatedData = $_POST['newData'];
file_put_contents('articles.JSON', $updatedData);

?>
