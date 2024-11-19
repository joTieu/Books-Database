<?php
    function filterTable($authorInput, $genreInput, $titleInput) {
        $modified = false;
        $displayColumns = "Books.bookID, Books.bookTitle, authorName, Genres.genreName";
        $filter = "SELECT $displayColumns FROM Authors 
        INNER JOIN Books on Books.authorID = Authors.authorID
        INNER JOIN Genres on Genres.genreID = Books.genreID";
        if ($authorInput != 0) {
            $filter .= " WHERE Authors.authorID = $authorInput";
            $modified = true;
        }
        if ($genreInput != 0) {
            if (!$modified) {
                $filter .= " WHERE Genres.genreID = $genreInput";
            } else {
                $filter .= " AND Genres.genreID = $genreInput";
            }
            $modified = true;
        }
        if ($titleInput != NULL) {
            if (!$modified) {
                $filter .= " WHERE Books.bookTitle LIKE '%".$titleInput."%'";
            } else {
                $filter .= " AND Books.bookTitle LIKE '%".$titleInput."%'";
            }
            $modified = true;
        }
        return $filter;
    }
    require_once("database/database_creation.php");
    // User Filter Inputs
    // Title
    $title = $_POST["title"];
    // Author
    $author = $_POST["authors"];
    // Genre
    $genre = $_POST["genres"];
    
    // Filter by user inputs
    $connection->query(filterTable($author, $genre, $title));
?>

<html>
    <head>
        <meta charset="utf-8">
        <!-- Link JS scripts via <script> -->
        <script src="../js/index.js"></script>
        <!-- Link CSS styles via <link> -->
        <link href="../css/filter.css" rel="stylesheet">
        <title>Book Catalogue</title>
    </head>
    <body>
        <header>
            <h1>Book Lookup: Results</h1>
            <?php require("../pages/header.html"); ?>
        </header>
        <main>
            <table>
                <tr>
                    <th>Book ID</th>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Favorite</th>
                </tr>
                <?php 
                $tableResult = $connection->query(filterTable($author, $genre, $title));
                while ($tableList = $tableResult->fetch_assoc()) {
                    echo("<tr>");
                    // TODO: Make a dynamic product/item detail page
                    echo("<td>".$tableList["bookID"]."</td><td><a href='item_details.php?id=".$tableList["bookID"]."'>".$tableList["bookTitle"]."</a></td><td>".$tableList["authorName"]."</td><td>".$tableList["genreName"]);
                    echo("<td><img src='../images/star.png' class='favorite' alt = 'favorite star'/></td>");
                }
                ?>
            </table>
        </main>
        <footer>
            <?php require("../pages/footer.html"); ?>
        </footer>
    </body>
</html>