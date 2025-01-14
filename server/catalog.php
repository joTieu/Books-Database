<html>
    <head>
        <meta charset="utf-8">
        <!-- Link JS scripts via <script> -->
        <script src="../js/index.js"></script>
        <!-- Link CSS styles via <link> -->
        <link href="../css/catalog.css" rel="stylesheet">
        <title>Book Catalog</title>
        <?php 
            include_once("./database/database_creation.php");
            include_once("./database/database_table_creation.php");
        ?>
    </head>
    <body>
        <header>
            <h1>Book Lookup</h1>
            <?php require("../pages/header.html"); ?>
        </header>
        <main>
            <div class = "filter-nav">
                <h2>Book Lookup</h2><hr>
                <form action="catalog_filter.php" onsubmit="return filter()" method="POST">
                    <label for="authors"><strong>Authors</strong></label>
                    <select name="authors">
                        <option value="0" disable selected>Select Author</option>
                        <?php
                        $authorSearch = $connection->query("SELECT * FROM Authors ORDER BY authorName");
                            while ($authorList = $authorSearch->fetch_assoc()) {
                                echo("<option value='".$authorList["authorID"]."'>".$authorList["authorName"]."</option>");
                            }
                        ?>
                    </select><br>
                    <label for="genres"><strong>Genres</strong></label>
                    <select name="genres">
                        <option value="0" disable selected>Select Genre</option>
                            <?php
                            $genreSearch = $connection->query("SELECT * FROM Genres ORDER BY genreName");
                                while ($genreList = $genreSearch->fetch_assoc()) {
                                    echo("<option value='".$genreList["genreID"]."'>".$genreList["genreName"]."</option>");
                                }
                            ?>
                    </select><br>
                    <label for="title"><strong>Book Title</strong></label>
                    <input type="text" placeholder="Enter Book Title" name="title"><br>
                    <input type="submit" value="Search Books"/>
                </form>
            </div>
        </main>
        <footer>
            <?php require("../pages/footer.html"); ?>
        </footer>
    </body>
</html>