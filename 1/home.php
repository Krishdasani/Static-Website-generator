<?php
        $conn = new mysqli('devweb2023.cis.strath.ac.uk', 'tmb23194', 'Eihu5na6ongo', 'tmb23194');
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }
    
        // Fetch latest 3 portfolios for slideshow
        $latestPortfoliosQuery = "SELECT * FROM portfolio WHERE userid = '1' ORDER BY portfolio_id DESC LIMIT 3";
        $latestPortfoliosResult = mysqli_query($conn, $latestPortfoliosQuery);
    
        // Fetch first 3 portfolios for cards
        $firstPortfoliosQuery = "SELECT * FROM portfolio WHERE userid = '1' ORDER BY portfolio_id DESC LIMIT 3";
        $firstPortfoliosResult = mysqli_query($conn, $firstPortfoliosQuery);
        ?>
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
                    overflow: hidden;
                }
                .slides {
                    display: flex;
                    transition: transform 0.5s ease-in-out;
                }
                .slide {
                    min-width: 100%;
                    box-sizing: border-box;
                }
                .slideshow-container img {
                    width: 100%;
                    height: auto;
                }
                .prev, .next {
                    cursor: pointer;
                    background-color:black;
                    position: absolute;
                    top: 50%;
                    width: auto;
                    margin-top: -22px;
                    padding: 16px;
                    color: white;
                    font-weight: bold;
                    font-size: 18px;
                    transition: 0.6s ease;
                    border-radius: 0 3px 3px 0;
                    user-select: none;
                }
                .next {
                    right: 0;
                    border-radius: 3px 0 0 3px;
                }
                .prev:hover, .next:hover {
                    background-color: rgba(0,0,0,0.8);
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
                .card a,.button{
                    display: inline-block;
                    margin: 10px;
                    padding: 10px 20px;
                    background: #007BFF;
                    color: white;
                    text-decoration: none;
                    border-radius: 4px;
                }
                .card a:hover,button:hover {
                    background: #0056b3;
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
    
            <div class='slideshow-container'>
                <div class='slides'>
                    <?php
                    while ($portfolio = mysqli_fetch_assoc($latestPortfoliosResult)) {
                        echo "<div class='slide'><img src='$portfolio[image_path]' alt='$portfolio[name]'></div>";
                    }
                    ?>
                </div>
                <a class='prev' onclick='plusSlides(-1)'>&#10094;</a>
                <a class='next' onclick='plusSlides(1)'>&#10095;</a>
            </div>
            <div class='cards'>
                <?php
                while ($portfolio = mysqli_fetch_assoc($firstPortfoliosResult)) {
                    echo "<div class='card'>
                        <img src='$portfolio[image_path]' alt='$portfolio[name]'>
                        <h2>$portfolio[name]</h2>
                        <p>$portfolio[description]</p>
                        <a href='$portfolio[portfolio_id]/$portfolio[portfolio_id]/index.php'>View Portfolio</a>
                    </div>";
                }
                ?>
                <a class='button' href='index.php'>View All Portfolios</a>
            </div>
            <script>
            let slideIndex = 0;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function showSlides(n) {
            let slides = document.getElementsByClassName('slide');
            if (n >= slides.length) { slideIndex = 0 }
            if (n < 0) { slideIndex = slides.length - 1 }
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = 'none';
            }
            slides[slideIndex].style.display = 'block';
        }

            </script>
        </body>
        </html>