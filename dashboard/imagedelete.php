<?php 
$imageid = $_GET['id'];
$userid = $_COOKIE['user_id'];
include 'server.php';
$portfolioget = mysqli_query($conn,"select * from images where id ='$imageid'");
$ds = mysqli_fetch_array($portfolioget);
$portfolioid = $ds['portfolio_id'];
$phpfile = $userid .'/'.$portfolioid .'/'.$portfolioid .'/'.$ds['name'].'.php'; 
$jpgfile = $userid .'/'.$portfolioid .'/'.$portfolioid .'/'.$ds['name'].'.php'; 
$imagedelete = mysqli_query($conn,"DELETE FROM `images` WHERE id = '$imageid' ");
if($imagedelete)
{
    
if (file_exists($jpgfile)) {
    if (unlink($file)) {
        echo "The file was successfully deleted.";
    } else {
        echo "There was an error deleting the file.";
    }
} else {
    echo "The file does not exist.";
}
if (file_exists($phpfile)) {
    if (unlink($file)) {
        echo "The file was successfully deleted.";
    } else {
        echo "There was an error deleting the file.";
    }
} else {
    echo "The file does not exist.";
}

header("location:portfolio.php?id=$portfolioid");
}

?>