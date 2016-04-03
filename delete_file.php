<?php
include("connect.php");

$conn->query("delete from files where file_name='".$_GET["name"]."' and uid='".$_SESSION["id"]."';");
header("Location: dashboard.php");
die();
?>