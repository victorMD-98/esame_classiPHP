<?php

    $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'esame_class',
        'port' => '3306',
        'user' => 'root',
        'password' => ''
    ];


    $mysqli = new mysqli(
        $config['host'],
        $config['user'],
        $config['password']
    );
    if($mysqli->connect_error){die(''. $mysqli->connect_error); };
    
    $sql = 'CREATE DATABASE IF NOT EXISTS esame_class';
    if(!$mysqli->query($sql)){die(''. $mysqli->connect_error);};
    
    $sql='USE esame_class';
    $mysqli->query($sql);
    
    $sql = 'CREATE TABLE IF NOT EXISTS users (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(16) NOT NULL,
        surname VARCHAR(16) NOT NULL,
        tel VARCHAR(20) UNIQUE NOT NULL,
        city VARCHAR(16) NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        image VARCHAR(100) NOT NULL
     )';
    if(!$mysqli->query($sql)) {die(''. $mysqli->connect_error);};
    
   