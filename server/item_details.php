<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <script src="../js/index.js"></script>
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
            <div class="flexwrap">
                <!-- Populate content about item details -->
                <div class="image_section">
                    <img src="../images/bookpreview.jpg" alt="image of an open book"/>
                </div>
                <div class="details">
                    <?php
                        $bookID = (int)$_GET["id"];
                        $tempTable = $connection->query("SELECT bookID from Books");
                        // Check if bad ID injection via URL
                        if(($bookID < 1) || ($bookID > $tempTable->num_rows)) {
                            header("Location: catalog.php");
                        }
                        $detailQuery = "SELECT bookTitle, bookDesc, authorName
                        FROM Books 
                        INNER JOIN Authors ON Books.authorID = Authors.authorID
                        WHERE bookID = $bookID";
                        $bookInfo = $connection->query($detailQuery)->fetch_assoc();
                        echo("<h1 id='detail_title'>".$bookInfo["bookTitle"]."</h1><br>");
                        echo("<h2>".$bookInfo["authorName"]."</h2>");
                    ?>
                    <div id="desc">
                        <?php
                            echo("<p id='detail_desc'>".$bookInfo["bookDesc"]."</p>");
                        ?>
                    </div>
                    <form action="added_collection.php" onsubmit="return filter_details()" method="POST">
                        <select name="accUser">
                            <option value="0" disable selected>Select User Collection</option>
                            <?php
                            $search = $connection->query("SELECT customerID, customerName FROM Customers");
                            while ($getUsers = $search->fetch_assoc())
                                echo("<option value='".$getUsers["customerID"]."'>".$getUsers["customerName"]."</option>");
                            ?>
                        </select><br><br>
                        <?php echo("<input type='hidden' value='".$bookID."' name='bookID'/>");?>
                        <input type="submit" value="Add to Collection"/>
                    </form>
                </div>
            </div>
        </main>
        <!-- Footer with copyright information -->
        <footer>
            <?php require("../pages/footer.html"); ?>
        </footer>
    </body>
</html>