<?php
    
    // Create Authors Table
    $authorsTable = "CREATE TABLE IF NOT EXISTS Authors (
    authorID int NOT NULL,
    authorName varchar(100) NOT NULL UNIQUE,
    PRIMARY KEY (authorID)
    )";

    // Create Genres table
    $genresTable = "CREATE TABLE IF NOT EXISTS Genres (
    genreID int NOT NULL,
    genreName varchar(25) NOT NULL UNIQUE,
    PRIMARY KEY (genreID)
    )";

    $customerTable = "CREATE TABLE IF NOT EXISTS Customers (
    customerID int NOT NULL AUTO_INCREMENT,
    customerName varchar(100) NOT NULL UNIQUE,
    customerPass varchar(255) NOT NULL,
    email varchar(100) NOT NULL,
    PRIMARY KEY (customerID)
    )";

    // Create books table
    $booksTable = "CREATE TABLE IF NOT EXISTS Books (
    bookID int NOT NULL,
    bookTitle varchar(255) NOT NULL UNIQUE,
    authorID int NOT NULL,
    genreID int NOT NULL,
    PRIMARY KEY (bookID),
    FOREIGN KEY (authorID) REFERENCES Authors(authorID),
    FOREIGN KEY (genreID) REFERENCES Genres(genreID)
    )";
    
    $customerCollections = "CREATE TABLE IF NOT EXISTS CustomerCollections (
    customerID int NOT NULL,
    bookID int NOT NULL,
    PRIMARY KEY (customerID, bookID),
    FOREIGN KEY (customerID) REFERENCES Customers(customerID),
    FOREIGN KEY (bookID) REFERENCES Books(bookID)
    )";
    // Create all tables
    $connection->query($authorsTable);
    $connection->query($genresTable);
    $connection->query($booksTable);
    $connection->query($customerTable);
    $connection->query($customerCollections);

    // Insert data
    $addAuthor = "INSERT IGNORE INTO Authors VALUES 
    (1, 'Susan Makes'), 
    (2, 'Mark Maior'), 
    (3, 'Bobby Tails'), 
    (4, 'Samuel Smith')";
    $connection->query($addAuthor);

    $addGenre = "INSERT IGNORE INTO Genres VALUES
    (1, 'Horror'), 
    (2, 'Sci-Fi'), 
    (3, 'Romance'), 
    (4, 'Action'), 
    (5, 'Mystery'),
    (6, 'Non-Fictional'),
    (7, 'Fictional')";
    $connection->query($addGenre);

    // Add Books: bookID, bookTitle, authorID, genreID
    $addBook = "INSERT IGNORE INTO Books VALUES
    (1, 'Harry Potter Part 1', 1, 4),
    (2, 'Lifetime of Us', 2, 3),
    (3, 'Goosebumps', 3, 1),
    (4, 'Detective Smith on the Case', 4, 5),
    (5, 'Harry Potter Part 2', 1, 5),
    (6, 'Love in a Hometown World', 2, 4)";
    $connection->query($addBook);

// $filter = "SELECT Books.bookID, Books.bookTitle, Authors.authorName, Genres.genreName 
// from Books 
// inner join Authors on Books.authorID = Authors.authorID
// inner join Genres on Books.genreID = Genres.genreID
// where Authors.authorName = {$author} 
// AND Genres.genreName = {$genre} 
// AND Books.bookTitle = {$title}";

// if ($connection->query($filter) === false) {
//     echo("Filter failed");
// }
?>