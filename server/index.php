<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <script src="../js/index.js"></script>
        <link href="../css/index.css" rel="stylesheet">
        <title>Book Catalogue</title>
    </head>
    <body>
        <header>
            <h1>Welcome to the Book Catalog</h1>
            <?php require("../pages/header.html"); ?>
        </header>
        <!-- Main content area -->
        <main>
            <section class="container">
                <div class="text-section">
                    <h2>Discover Your Next Favorite Book</h2>
                    
                    <p>Dive into a world of stories, knowledge, and imagination. 
                    <p>Explore our extensive catalog of books across genres, discover your next favorite read, and connect with a community of book enthusiasts.</p>
                    <p>Whether you're looking for timeless classics, modern thrillers, or insightful non-fiction, Book Haven has something for everyone.</p>
                    <p>Start your reading journey today!</p>
                </div>

                <div class="image-container">
                    <img src="../images/homepage.jpg" alt="Book catalog" id="home-image">
                </div>
            </section>
        </main>
        <footer>
            <?php require("../pages/footer.html"); ?>
        </footer>
    </body>
</html>