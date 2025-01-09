<html>
    <head>
        <meta charset="utf-8">
        <!-- Link JS scripts via <script> -->
        <script src="../js/index.js"></script>
        <!-- Link CSS styles via <link> -->
        <link href="../css/collections.css" rel="stylesheet">
        <title>Book Catalogue Registration</title>
        <?php 
            include_once("./database/database_creation.php");
            include_once("./database/database_table_creation.php");
        ?>
    </head>
    <body>
        <header>
            <?php require("../pages/header.html"); ?>
        </header>
        <main id='registration'>
            <div>
                <?php
                    $user = $_POST["user"];
                    $email = $_POST["email"];
                    $pass = $_POST["password"];
                    $pass2 = $_POST["confirm_password"];

                    // Verify if account info exists in database
                    $getLoginQuery = $connection->query("SELECT customerName, customerPass, email FROM Customers");
                    if ($getLoginQuery->num_rows < 1) {
                        echo("<p id='success'>Successfully registered.<br> Click <a href='./index.php'>here</a> to return home</p>");
                    } else {
                        $getLoginTable = $getLoginQuery->fetch_assoc();    
                        if(($getLoginTable["customerName"] === $user) || ($getLoginTable["email"] === $email)) {
                            echo("<p id='success'>Username or email already exists.<br> Click <a href='./register.php'>here</a> to return to registration</p>");
                        } else {
                            echo("<p id='success'>Successfully registered.<br> Click <a href='./index.php'>here</a> to return home</p>");
                        }
                    }
                    // Add customer login to database
                    $addCustomer = "INSERT IGNORE INTO Customers(customerName, customerPass, email) VALUES ('".$user."', '".$pass."', '".$email."')";
                    $connection->query($addCustomer);
                ?>
            </div>
        </main>
        <footer>
            <?php require("../pages/footer.html"); ?>
        </footer>
    </body>
</html>