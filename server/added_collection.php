<?php
require_once("database/database_creation.php");
$userID = $_POST["accUser"];
$bookID = $_POST["bookID"];
$collectionQuery = "INSERT IGNORE INTO CustomerCollections VALUES ($userID, $bookID)";
$connection->query($collectionQuery);
header("Location: catalog.php");
?>