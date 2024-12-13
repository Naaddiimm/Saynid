<?php
include '../../controllers/PostC.php';
$x=new PostC();
$x->DeletePost($_GET['id']);
header('location:homeAdmin.php');
?>