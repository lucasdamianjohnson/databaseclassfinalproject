<!--These are functions to send the user back to the login page or the user home page depending if they get the right username and password -->
<script>
function notRightLoginInfo()
{
alert("Your login creds are not right");
window.location = "https://lukejohnson.media/code/classdatabase/login.php";
}
function noPassword(){
alert("Please enter a password");
window.location = "https://lukejohnson.media/code/classdatabase/login.php";
}
function noUsername(){
alert("Please enter a username");
window.location = "https://lukejohnson.media/code/classdatabase/login.php";
}
function noCreds(){
alert("Please enter a username and password");
window.location = "https://lukejohnson.media/code/classdatabase/login.php";
}
function wrongCreds(){
alert("Either your password or username is wrong");
window.location = "https://lukejohnson.media/code/classdatabase/login.php";
}
function rightCreds(){
window.location = "https://lukejohnson.media/code/classdatabase/user_homepage.php";
}
</script>
<?php
#start a session incase the user is right
session_start();
#check to make sure that this page is being visited from the form on login.php
if(isset($_POST["login"])){

#check to seee if username and password are both empty
if(empty($_POST["username"]) && empty($_POST["password"])){
session_unset();  
session_destroy();
echo '<script type="text/javascript">',
     'noCreds();',
     '</script>';
}
#check to see if username is empty
if(empty($_POST["username"])){
session_unset();
session_destroy();
echo '<script type="text/javascript">',
     'noUsername();',
     '</script>';
}
#check to see if the password feild is empty
if(empty($_POST["password"])){
session_unset();
session_destroy();
echo '<script type="text/javascript">',
     'noPassword();',
     '</script>';
}

#if that all passes then do this 
try {
        $dbh = new PDO('',"", "");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	/*Since the login page is the only place that the user can enter in text this is the only place I use a prepared statment.
	I used MariaDB enocde function to encypt the password and I created a function getPass() in MariaDB to get the password 
	easily and not to show the string I am enocding the password with in the database. 
	*/
	$sth = $dbh->prepare('select id,name from student where id = ? and password = getPass(?) ');
	$sth->execute(array($_POST['username'], $_POST['password']));	
	$fetch = $sth->fetch();
	$id = trim($fetch["id"]);
	 if (strcmp($id, trim($_POST["username"]))==0){
	     /*This is the only way I was able to compare the username name from the database with the username from the form on login.php
	     It just trims the string and usses strcmp.
	     If it passes then it sets the session varibles and takes you to the user home page. 
	     If it does not pass it sends you back to the homepage with a javascript altert saying that you did not etner in the right info
	     */
        $_SESSION["uid"]=$id;
       $_SESSION["name"]=$fetch["name"];
       #just a quick message if your computer is slow enough to see it
		echo"<center><h1>Welcome!</h1></center>";
        echo '<script type="text/javascript">',
     'rightCreds();',
     '</script>';

                 }else {
      echo '<script type="text/javascript">',
     'wrongCreds();',
     '</script>';
}

		  

}
catch (PDOException $e) {

        printf( "Error!" . $e->getMessage()."<br/>");
        die();
}
}
?>
