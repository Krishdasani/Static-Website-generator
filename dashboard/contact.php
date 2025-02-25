<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Messages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
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
        .table {
            margin: 20px auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        
        .table__body {
            padding: 20px;
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
        <a href="index.php">Portfolios</a>
        <a href="about.php">About</a>
        <a href="contact.php">Messages</a>
    </div>
    <div>
        <main class="table">
            
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $userid = $_COOKIE['user_id'];
                        include 'server.php';
                        $sql = "SELECT * FROM contacts WHERE userid = '$userid'";
                        $code = mysqli_query($conn, $sql);
                        $i = 1;
                        while($res = mysqli_fetch_array($code)){
                        
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            
                            <td><?php echo $res['name']; ?></td>
                            <td><?php echo $res['email']; ?></td>
                            <td><?php echo $res['message']; ?></td>
                            <td><?php echo $res['status']; ?></td>

                            <td>
                                <a href='reply.php?id=<?php echo $res['id']?>&email=<?php echo $res['email']?>'><button>Reply</button></a>
                                
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
