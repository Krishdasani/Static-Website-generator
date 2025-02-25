<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Portfolios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .table {
            margin: 20px auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        .table__header {
            background-color: #007BFF;
            color: white;
            padding: 20px;
            text-align: center;
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
    <div>
        <main class="table">
            <section class="table__header">
                <h1>Portfolio Details</h1>
            </section>
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th> Id </th>
                            <th> Cover Image </th>
                            <th> Name </th>
                            <th> Description </th>
                            <th>Tags</th>
                            <th>Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $userid = $_COOKIE['user_id'];
                        $id = $_GET['id'];
                        include 'server.php';
                        $sql = "SELECT * FROM images WHERE userid = '$userid' AND portfolio_id='$id'";
                        $code = mysqli_query($conn, $sql);
                        $i = 1;
                        while($res = mysqli_fetch_assoc($code)){
                            $portfolio = $res['id'];
                            $name = $res['name'];
                            $imagepath = $userid . '/' . $id . '/' . $id . '/' . $name;
                            $tagResult = mysqli_query($conn, "SELECT * FROM Tags WHERE image_id = $portfolio");
                            $tags = [];
                            while($tagRow = mysqli_fetch_assoc($tagResult)) {
                                $tags[] = $tagRow['Tag'];
                            }
                            $tagList = !empty($tags) ? implode(', ', $tags) : '';
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><img src="../<?php echo $imagepath; ?>" class="image"></td>
                            <td><?php echo $res['name']; ?></td>
                            <td><?php echo $res['description']; ?></td>
                            <td><?php echo $tagList; ?></td>
                            <td>
                                <a href='imageupdate.php?id=<?php echo $portfolio?>'><button>Update</button></a>
                                <a href='imagedelete.php?id=<?php echo $portfolio?>'><button>Delete</button></a>
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
