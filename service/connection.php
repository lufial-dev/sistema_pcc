<?php
    $HOST = "localhost";
    $USER = "root";
    $PASS = "";
    $DB = "simetric_calc";
    $conn = new MySQLi("$HOST", "$USER", "$PASS", "$DB");
    if($conn->connect_error){
        //echo "Desconectado! Erro: " . $conn->connect_error;
    }else{
        //echo "Conectado!";
    }
?>