<?php
    $host='localhost';
    $db_name='id20143841_codi_2023';
    $username='root';
    $passwd='';
    $conn = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8",$username,$passwd);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>