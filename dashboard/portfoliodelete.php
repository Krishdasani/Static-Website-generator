<?php 
$imageid = $_GET['id'];
$userid = $_COOKIE['user_id'];
include 'server.php';
 $imagedelete = mysqli_query($conn,"DELETE FROM `portfolio` WHERE portfolio_id = '$imageid' ");
if($imagedelete)
{
$dir = '../'.$userid.'/'.$imageid; 

$items = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::CHILD_FIRST
);

foreach ($items as $item) {
    if ($item->isDir()) {
        rmdir($item->getRealPath());
    } else {
        unlink($item->getRealPath());
    }
}

rmdir($dir);
header("location:index.php");

}

?>