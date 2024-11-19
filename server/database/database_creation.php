<?php
    // Database & Table creation scripts
    // Written by John Tieu
    // Project: CST8285 Assignment 2
    
    // Server Connection Information
    $server = "localhost";
    $user = "root";
    $pass = "";
    $name = "booksDB";

    $connection = new mysqli($server, $user, $pass);
    // Check if user successfully connected to server
    // if ($connection->connect_errno) {
    //     die("Connection failed: {$connection->connect_error}");
    // }

    // Setting up database

    // Debug database refresh (not to be kept in final version)
    // $connection->query("DROP DATABASE $name");

    $connection->query("CREATE DATABASE IF NOT EXISTS $name");
    $connection->query("USE $name");

    // require_once("database_table_creation.php");


    // Close connection when user logs out (to be inmplemented)
    // $connection->close();
?>