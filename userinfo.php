<?php
session_start();
?>
<head>
<base target="_parent">
<style>
 body{
 text-align: center;
 background-color: black;
}
h2 {
color: yellow;
}
</style>
</head>
<?php
/*
This page is used as an ifram on the main page. It just prints out the users name. 
It also gives them a link to log out. 
*/
echo "<h2>Hello  ".$_SESSION["name"]."!</h2>";
echo "<a href='https://lukejohnson.media/code/classdatabase/login.php'>Log Out</a>";
?>
