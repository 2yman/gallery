<?php
include("includes/init.php");
if (!$session->is_SignedIn()) {redirect("login.php");}


if (empty($_GET['id'])) {
    redirect('photos.php');
}


$photo = Photo::findById($_GET['id']);
if ($photo) {
    $photo->deletePhoto();
    redirect('photos.php');
}else {
    redirect('photos.php');
}