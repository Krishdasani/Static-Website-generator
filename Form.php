<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload ZIP File</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            max-width: 600px;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input[type="text"],
        .form-group input[type="file"],
        .form-group input[type="textarea"],
        .form-group select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group input[type="submit"] {
            width: 100%;
            padding: 10px;
            background: #007BFF;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 16px;
            border-radius: 4px;
        }
        .form-group input[type="submit"]:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Upload ZIP File</h1>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Project Name</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="file">Choose ZIP file:</label>
                <input type="file" name="file" id="file" accept=".zip" required>
            </div>
            <div class="form-group">
                <label for="cover">Upload Cover Photo:</label>
                <input type="file" name="cover" id="cover" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="textarea" name="Description" id="description" required>
            </div>
            <div class="form-group">
                <label for="layout">Choose Layout:</label>
                <select name="layout" id="layout" required>
                    <option value="grid">Grid Layout</option>
                    <option value="masonry">Masonry Layout</option>
                    <option value="single">Single Image Focus Layout</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Upload">
            </div>
        </form>
    </div>
</body>
</html>
