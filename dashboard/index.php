<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Portfolios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #007BFF;
            overflow: hidden;
        }
        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #0056b3;
            color: white;
        }
        .container {
            padding: 20px;
        }
        .add-portfolio {
            display: inline-block;
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #0056b3;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            float: right;
        }
        .add-portfolio:hover {
            background-color: #003f7f;
        }
        .table__body {
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            clear: both;
        }
        table {
            width: 100%;
            border-spacing: 0;
        }
        thead {
            background-color: #007BFF;
            color: white;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            transition: transform 0.2s ease-in-out;
        }
        .image:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="about.php">About</a>
        <a href="index.php">Portfolios</a>
        <a href="contact.php">Messages</a>
    </div>
    <div class="container">
        <a href="../Form.php" class="add-portfolio">Add New Portfolio</a>
        <main class="table">
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Cover Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $userid = $_COOKIE['user_id'];
                        include 'server.php';
                        $sql = "SELECT * FROM portfolio WHERE userid = '$userid'";
                        $code = mysqli_query($conn, $sql);
                        $i = 1;
                        while($res = mysqli_fetch_array($code)){
                            $portfolio = $res['portfolio_id'];
                            $imagepath = $userid . '/' . $portfolio . '/' . $portfolio . '/cover.jpg';
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><img src="../<?php echo $imagepath; ?>" class="image"></td>
                            <td><?php echo $res['name']; ?></td>
                            <td><?php echo $res['description']; ?></td>
                            <td>
                                <a href='portfolioupdate.php?id=<?php echo $portfolio?>'><button>Update</button></a>
                                <a href='portfolio.php?id=<?php echo $portfolio?>'><button>View</button></a>
                                <a href='portfoliodelete.php?id=<?php echo $portfolio?>'><button>Delete</button></a>
                            </td>
                        </tr>
                        <?php
                            $i = $i + 1;
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>
