<?php
    include_once ("database/database_creation.php");
    // Book Rating
    $bookID = $_GET["id"];
    $userRating = (int)($_POST["rating"] ?? 0);
    if (($userRating > 0) && ($userRating <= 5)) {
        $connection->query("UPDATE Books SET countedRatings = countedRatings + 1 WHERE bookID = $bookID");
        $connection->query("UPDATE Books SET rating = rating + $userRating WHERE bookID = $bookID");
    }
    header("Location: item_details.php")
?>