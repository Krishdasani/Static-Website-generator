<?php
            $conn = new mysqli('devweb2023.cis.strath.ac.uk', 'tmb23194', 'Eihu5na6ongo', 'tmb23194');
            if ($conn->connect_error) {
                die('Connection failed: ' . $conn->connect_error);
            }

            $fetchMedia = "SELECT * FROM images WHERE id = '62'";
            $result = mysqli_query($conn, $fetchMedia);
            $mediaData = mysqli_fetch_assoc($result);

            if ($mediaData) {
                $mediaPath = $mediaData['path'];
                $mediaType = mime_content_type($mediaPath);
                $mediaName = $mediaData['name'];
                $mediaElement = '';
                if (strpos($mediaType, 'video') !== false) {
                    $mediaElement = "<video src='$mediaName' alt='$mediaName' controls></video>";
                } else {
                    $mediaElement = "<img src='$mediaName' alt='$mediaName'>";
                }

                echo "<!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <title>$mediaName</title>
                </head>
                <body>
                    <h1>$mediaName</h1>
                    $mediaElement
                    <p>Description: {$mediaData['description']}</p>
                    <p><a href='index.php'>Back to Gallery</a></p>
                </body>
                </html>";
            } else {
                echo "Media not found.";
            }
        ?>