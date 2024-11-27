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
    bookDesc varchar(255),
    authorID int NOT NULL,
    genreID int NOT NULL,
    rating int NOT NULL,
    countedRatings int NOT NULL,
    bookImagePath varchar(255),
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

    // Add Books: bookID, bookTitle, bookDesc, authorID, genreID, rating, reviews, image
    $addBook = "INSERT IGNORE INTO Books VALUES
    (1, 'Harry Potter Part 1', 'The beginnings of Harry Potter in the high-action magical world', 1, 4, 0, 0, '../images/1-Harry Potter Part 1.jpg'),
    (2, 'Lifetime of Us', 'The following of couple whose lives have taken a turn', 2, 3, 0, 0, '../images/lifetime of us.jpg'),
    (3, 'Goosebumps', 'The mysterious horror leaving you a sense of GOOSEBUMPS!', 3, 1, 0, 0, '../images/3-Goosebumps.jpg'),
    (4, 'Detective Smith on the Case', 'Join detective Smith as he takes on the the unsolved mysteries', 4, 5, 0, 0, '../images/4-Detective Smith on the Case.jpg'),
    (5, 'Harry Potter Part 2', 'Harry Potter\'s journeys continues in an mysterious turn!', 1, 5, 0, 0, '../images/5-Harry Potter Part 2.jpg'),
    (6, 'Love in a Hometown World', 'The loving feeling in an high-action world', 2, 4, 0, 0, '../images/bookpreview.jpg')";
    $connection->query($addBook);
?>