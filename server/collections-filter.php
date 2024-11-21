<?php
    include_once ("database/database_creation.php");
    $bookID = (int)($_GET["bookID"] ?? 0);
    $customerID = (int)($_GET["userID"] ?? 0);
    $tempBook = $connection->query("SELECT bookID from Books");
    $tempUser = $connection->query("SELECT customerID from Customers");
    // Check if bad ID injection via URL
    if ($bookID == 0 && $customerID == 0) {
        header("Location:collections.php");
    }
    if(($bookID < 0) || ($bookID > $tempBook->num_rows) || ($customerID < 0) || ($customerID > $tempUser->num_rows)) {
        header("Location: catalog.php");
    }
    echo("Book: $bookID and Customer: $customerID");
    $deletionQuery = "DELETE FROM CustomerCollections WHERE CustomerCollections.bookID = $bookID AND CustomerCollections.customerID = $customerID";
    $connection->query($deletionQuery);
    header("Location: collections.php");
?>