<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <title>Home</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
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
                .slideshow-container {
                    position: relative;
                    max-width: 100%;
                    margin: auto;
                }
                .slideshow-container img {
                    width: 100%;
                    height: auto;
                }
                .cards {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 20px;
                    justify-content: center;
                    padding: 20px;
                }
                .card {
                    background: #fff;
                    border-radius: 8px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    overflow: hidden;
                    width: calc(33% - 20px); /* Three cards in a row */
                    text-align: center;
                    transition: transform 0.2s;
                }
                .card:hover {
                    transform: scale(1.05);
                }
                .card img {
                    width: 100%;
                    height: 200px;
                    object-fit: cover;
                }
                .card h2 {
                    margin: 10px 0;
                    font-size: 1.5em;
                }
                .card p {
                    margin: 0 10px 10px;
                    color: #666;
                }
                .card a {
                    display: inline-block;
                    margin: 10px;
                    padding: 10px 20px;
                    background: #007BFF;
                    color: white;
                    text-decoration: none;
                    border-radius: 4px;
                }
                .card a:hover {
                    background: #0056b3;
                }
            </style>
        </head>
        <body>
            <div class='navbar'>
                <div class='logo'>Logo</div>
                <div class='nav-links'>
                    <a href='home.php'>Home</a>
                    <a href='portfolio.php'>Portfolio</a>
                    <a href='about.php'>About Us</a>
                    <a href='contact.php'>Contact</a>
                </div>
            </div>

            <div class='slideshow-container'></div>
            <div class='cards'></div>
        </body>
        </html>