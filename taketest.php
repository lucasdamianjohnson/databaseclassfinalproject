<?php
/*
This page is the where the user sees the test and can take it. 
*/
session_start();
$uid = $_SESSION["uid"];
$ename = $_POST["ename"];
$qn = 0; //the total number of questions 
echo "

<head>
<style>
body{
background-color: grey;
float center;
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
p,h4,strong,h5{
color: yellow;

}
</style>
</head>
";
try {
      
        
        
	    $dbh = new PDO('',"", "");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo"<div class='my-block'><form method = 'post' action='display_answer.php'>";
       #load info about the test from the database
        foreach( $dbh->query("select points from exam where ename = '".$ename."'") as $pre){
	 echo "<h1>".$ename."</h1>";
	 echo "<h3> Total Points ".$pre[0]."</h3>";
	}
	#create a form for the test. 
	 foreach( $dbh->query("select qnumber,qtext,points from questions where ename = '".$ename."'") as $q){
        	echo "<h5> Points ".$q[2]."</h5>";
                echo "<h4>".$q[0].".  ".$q[1]."</h4>";
               foreach($dbh->query("select choice,ctext from choice where ename = '".$ename."' and qnumber = ".$q[0]) as $col) {
			#this line makes it really easy to get input for each question. 
			echo"<input type='radio' value =".$col[0]." name = 'choice".$q[0]."' required>";
			echo"<label><strong>".$col[0].".".$col[1]."</strong></label>";
			echo"<br>";
              }
       
		$qn++;
}
echo"<input type='hidden', name='totalq' value=".$qn.">";
echo"<input type='hidden', name='ename' value=".$ename.">";
echo"<br><input type='submit' class='myButton' name='submit' value='Submit Answers'>";
        echo"</form></div>";

}
catch (PDOException $e) {

        printf( "Error!" . $e->getMessage()."<br/>");
        die();
}


?>

