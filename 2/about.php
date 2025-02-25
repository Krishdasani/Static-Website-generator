<?php
        $conn = new mysqli('devweb2023.cis.strath.ac.uk', 'tmb23194', 'Eihu5na6ongo', 'tmb23194');
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }
    
        $aboutQuery = "SELECT about FROM users WHERE id = '2'";
        $aboutResult = mysqli_query($conn, $aboutQuery);
        $aboutData = mysqli_fetch_assoc($aboutResult);
        $aboutText = $aboutData['about'];
        ?>
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <title>About Us</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    
                }
                .navbar {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    background-color: #007BFF;
                    padding: 10px 20px;
                }
                .navbar .logo {
                    font-size: 24px;
                    color: white;
                }
                .navbar .nav-links {
                    display: flex;
                    gap: 20px;
                }
                .navbar .nav-links a {
                    color: white;
                    text-decoration: none;
                }
                .content {
                    max-width: 800px;
                    margin: 20px auto;
                    background: #fff;
                    padding: 20px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    border-radius: 8px;
                }
                .content h1 {
                    text-align: center;
                }
            </style>
        </head>
        <body>
            <div class='navbar'>
                <div class='logo'>Logo</div>
                <div class='nav-links'>
                    <a href='home.php'>Home</a>
                    <a href='index.php'>Portfolio</a>
                    <a href='about.php'>About Us</a>
                    <a href='contact.php'>Contact</a>
                </div>
            </div>
            <div class='content'>
                <h1>About Us</h1>
                <p><?php echo nl2br($aboutText); ?></p>
            </div>
        </body>
        </html>