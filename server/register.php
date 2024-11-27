<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <!-- Link JS scripts via <script> -->
        <script src="../js/index.js"></script>
        <!-- Link CSS styles via <link> -->
        <link href="../css/register.css" rel="stylesheet">
        <title>Account Registration</title>
        <script src="../js/create.js" defer></script>
    </head>
    <body>
        <header>
            <h1>Account Registration</h1>
            <?php require("../pages/header.html"); ?>
        </header>
        <main>
            
            <div class="container">
            <h1>Welcome</h1>
            <hr>
                <div class="form-container">
                    <form action="registerSuccess.php" method="POST" onsubmit="return validateUser()">
                        <label for="user"><strong>Enter Username</strong></label>
                        <input type="text" id="user" name="user" required/><br>

                        <label for="email"><strong>Email:</strong></label>
                        <input type="email" id="email" name="email" required/><br>
                    
                        <label for="password"><strong>Password:</strong></label>
                        <input type="password" id="password" name="password" required/><br>
                    
                        <label for="confirm_password"><strong>Confirm Password:</strong></label>
                        <input type="password" id="confirm_password" name="confirm_password" required/><br>
                    
                        <button type="submit">Register</button>
                    </form>
                </div>


            </div>
        </main>
        <footer>
            <?php require("../pages/footer.html"); ?>
        </footer>
    </body>
</html>