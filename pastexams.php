<?php
//This page is used as an iframe in the userhompage. It just prints out the test the user has taken. 
session_start();
$uid = $_SESSION["uid"];
?>
<head>
<base target="_parent">
<style>
 body{
 text-align: center;
 background-color: black;
}
p,h2{
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
try {
        echo"<h2>Previous Test</h2>";
        $dbh = new PDO('',"", "");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  
         /*Print out past test, the score, and a button so the user can re-visit the results of the test 
         */
             foreach($dbh->query("select ename,score from takes where score is not NULL and id = '".$uid."'" ) as $prev) {
                     echo "<form method = 'POST' action = 'display_test.php'>";
		     $score = $prev[1]*100;
                     echo "<p>".$prev[0].": Score: ".$score."%</p>";
		     echo "<input type='hidden' name='ename' value =".$prev[0].">";
		     echo "<input type='submit' class='myButton' name='submit' value='More Info'>";
		     echo "</form>";
              }



}
catch (PDOException $e) {

        printf( "Error!" . $e->getMessage()."<br/>");
        die();
}

?>



