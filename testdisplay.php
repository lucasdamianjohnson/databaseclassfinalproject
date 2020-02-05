<!-- this page is uses as an iframe in the user_homepage.php file. It shows the users what test they have to take-->
<?php
session_start();
$uid = $_SESSION["uid"];
?>
<head>
<base target="_parent">
<style>
 body{
	text-align:center;
 background-color: grey;
}
p,h2 {
color: yellow;
}
.myButton{
    background:url(./image/grey.png) no-repeat;
    cursor:pointer;
    border:none;
    width:150;
    height:35px;
   color: yellow;
    background-size: 150px 35px;
}
        .myButton:hover{
         -webkit-filter: grayscale(100%);
         filter: grayscale(100%);
        }


</style>

</head>
<?php
try{

   $dbh = new PDO('',"", "");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$find =  $dbh->prepare("select ename from takes where score is NULL and id = '".$uid."'");
	$find->execute();
	$count = $find->rowCount();
	if ($count == 0 ){
    #if there is not test to take display nothing
	echo"<h2>No Test to take</h2>";
	}else{
	echo"<h2>Test to take</h2>";
	}
	#prints out the name of the best and a button that will take the user to the test
        foreach($dbh->query("select ename from takes where score is NULL and id = '".$uid."'" ) as $take) {
            echo"<form method = 'post' action='taketest.php'>";
                     echo "<p>".$take[0]."</p>";
                    echo "<input type='hidden' name='ename' value= ".$take[0].">";
                    echo"<input type='submit' name='submit' class='myButton' value='Take Test'></input>";
                         echo"</form>";
              
              }
           
}
catch (PDOException $e) {

        printf( "Error!" . $e->getMessage()."<br/>");
        die();
}


?>

