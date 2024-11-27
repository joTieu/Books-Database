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
                    <?php
                        $bookID = (int)$_GET["id"];
                        $detailQuery = "SELECT bookTitle, bookDesc, rating, authorName, bookImagePath
                        FROM Books 
                        INNER JOIN Authors ON Books.authorID = Authors.authorID
                        WHERE bookID = $bookID";
                        $bookInfo = $connection->query($detailQuery)->fetch_assoc();
                        $bookImagePath = $bookInfo["bookImagePath"];
                        echo "<img src='$bookImagePath' alt='Image of ".$bookInfo["bookTitle"]."' class='book-image'/>";
                    ?>
                    <!-- <img src="../images/bookpreview.jpg" alt="image of an open book"/> -->
                </div>
                <div class="details">
                    <?php
                        $tempTable = $connection->query("SELECT bookID from Books");
                        // Check if bad ID injection via URL
                        if(($bookID < 1) || ($bookID > $tempTable->num_rows)) {
                            header("Location: catalog.php");
                        }
                        
                        // Book Title
                        echo("<h1 id='detail_title'>".$bookInfo["bookTitle"]."</h1><br>");
                        
                        // Book Author
                        echo("<h2>".$bookInfo["authorName"]."</h2>");

                        // Book Rating
                        $getRate = $connection->query("SELECT countedRatings, rating FROM Books WHERE BookID = $bookID");
                        $rateTable = $getRate->fetch_assoc();
                        $ratingTotal = $rateTable["rating"];
                        $ratingCounts = $rateTable["countedRatings"];
                        if ($ratingCounts > 0) {
                            $rateAverage = round((double)($ratingTotal / $ratingCounts), 2);
                            echo("<h3>Rating: <span class='rating-display'>$rateAverage / 5</span></h3>");
                        } else {
                            echo("<h3>Rating: <span class='rating-display'>No reviews</span></h3>");
                        }
                    ?>
                    <!-- Book Description -->
                    <div id="desc">
                        <?php
                            echo("<p id='detail_desc'>".$bookInfo["bookDesc"]."</p>");
                        ?>
                    </div>
                    <?php echo("<form action='ratings.php?id=".$bookID."' method='POST' id='ratings'>");?>
                        <table>
                            <tr>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                            </tr>
                            <tr>
                                <?php
                                    for ($i = 1; $i <= 5; $i++) {
                                        echo("<td><input value=$i name='rating' type='radio'/></td>");
                                    }
                                ?>
                            </tr>
                        </table>
                        <input type="submit" value="Add Rating"/>
                    </form>
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