<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/item_details.css">
        <title>Book Details</title>
        <?php 
            include_once ("database/database_creation.php");
            // include_once("./database/database_table_creation.php");
        ?>
    </head>
    <body>
        <!-- Header section with page title and navigation -->
        <header>
            <h1>Book Details</h1>
            <?php require("../pages/header.html"); ?>
        </header>
        <!-- Main content area -->
        <main>
            <!-- Populate content about item details -->
            <?php
                $bookID = $_GET["id"];
                $bookInfo = $connection->query("SELECT bookTitle FROM Books WHERE bookID = $bookID")->fetch_assoc();
                echo("<h1 id='detail_title'>".$bookInfo["bookTitle"]."</h1>");
            ?>
        </main>
        <!-- Footer with copyright information -->
        <footer>
            <?php require("../pages/footer.html"); ?>
        </footer>
    </body>
</html>