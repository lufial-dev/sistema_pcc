<?php
    require("connection.php");
    require("model/face.php");
    
    $face = new Face();
    $face->save($conn);
    
    echo($face->id);
?>

