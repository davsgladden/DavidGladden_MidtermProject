<?php
    $dsn = 'mysql:host=pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=fltp7dq2s3ninu3t';
    $username = 'b1yigybqycgbh56h';
    //$password = 'x98fnb2jyqm2y8la';

    try {
        $db = new PDO($dsn, $username);//, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('view/error.php');
        exit();
    }
?>
