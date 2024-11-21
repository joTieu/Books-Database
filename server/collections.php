<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <script src="../js/index.js"></script>
        <link href="../css/collections.css" rel="stylesheet"/>
        <title>Book Collections</title>
        <?php include_once ("database/database_creation.php"); ?>
    </head>
    <body>
        <header>
            <h1>Book Collections</h1>
            <?php require("../pages/header.html"); ?>
        </header>
        <main>
            <div id="collection-wrap">
                <form action="collections.php" method="POST">
                    <select name="userCollection" id="">
                        <option value="0" disable selected>View User Collection</option>
                        <?php
                        $search = $connection->query("SELECT customerID, customerName FROM Customers");
                        while ($getUsers = $search->fetch_assoc())
                            echo("<option value='".$getUsers["customerID"]."'>".$getUsers["customerName"]."</option>");
                        ?>
                    </select>
                    <input type="submit" value="Search"/>
                    <table>
                    <tr id="header">
                        <th>Customer Name</th>
                        <th>Book Title</th>
                        <th>Remove</th>
                    </tr>
                    <?php 
                        $collectionQuery = "SELECT Customers.customerID, customerName, bookTitle, Books.bookID FROM CustomerCollections 
                        INNER JOIN Customers ON Customers.customerID = CustomerCollections.customerID 
                        INNER JOIN Books ON Books.bookID = CustomerCollections.bookID";
                        $search = $_POST["userCollection"] ?? 0;
                        if ($search != 0) {
                            $collectionQuery .= " WHERE Customers.customerID = $search";
                        }
                        $tableResult = $connection->query($collectionQuery);
                        while ($tableList = $tableResult->fetch_assoc()) {
                            echo("<tr>");
                            echo("<td>".$tableList["customerName"]."</td>");
                            echo("<td><a href='item_details.php?id=".$tableList["bookID"]."'>".$tableList["bookTitle"]."</a></td>");
                            echo("<td><a href='collections-filter.php?bookID=".$tableList["bookID"]."&userID=".$tableList["customerID"]."'><img class='remove' src='../images/trashcan.png'></a></td>");
                        }
                    ?>
                </table>
                </form>
            </div>
        </main>
        <footer>
            <?php require("../pages/footer.html"); ?>
        </footer>
    </body>
</html>

<?php

?>