<!--This page is exactly like display_answer.php but it is for the past exams so it does not submit the student's answers to the database-->
<?php
if(isset($_POST["submit"])){

session_start();
$uid = $_SESSION["uid"];
$ename = $_POST["ename"];
echo "

<head>
<style>
body{
background-color: grey;
}
p,h2,h4,strong {
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
";
try {
	 $dbh = new PDO('',"", "");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	  foreach($dbh->query("select score from takes where ename = '".$ename."' and id = '".$uid."'" )as $take) {
                   $score = $take[0] * 100;     
		   echo "<h2>Score: ".$score."%</h2>";
                }
	  foreach( $dbh->query("select points from exam where ename = '".$ename."'") as $pre){
         echo "<h1>".$ename."</h1>";
         echo "<h3> Total Points ".$pre[0]."</h3>";
        }
	#print out the questions and indicate if they are right or wrong
	     foreach( $dbh->query("select qnumber,qtext,correct,points from questions where ename = '".$ename."'") as $q){
               	foreach( $dbh->query("select answer from studentqa where ename = '".$ename."' and id = '".$uid."' and qnumber = ".$q[0]) as $sa) 
		{
		if($q[2] == $sa[0]){                
		echo "<img src ='image/correct.png' height = '24' wdith = '24' align = 'left'>";
		 echo "<p>Points ".$q[3]."/".$q[3]."</p>";
		echo "<h4> ".$q[0].".  ".$q[1]."</h4>";
		
		} else {
		echo "<img src ='image/red.png' height = '24' wdith = '24' align = 'left'>";
                 echo "<p>Points 0/".$q[3]."</p>";
		 echo "<h4>".$q[0].".  ".$q[1]."</h4>";
		 
		}
	
               foreach($dbh->query("select choice,ctext from choice where ename = '".$ename."' and qnumber = ".$q[0]) as $col) {
			if (($q[2] == $sa[0]) && ($col[0] == $sa[0])) {
				echo "<img src ='image/correct.png' height = '12' wdith = '12'><strong> ".$col[0].". ".$col[1]."</strong>";
			} else if (($q[2] != $sa[0])&&($col[0] == $sa[0])) {
				echo "<img src ='image/red.png' height = '12' wdith = '12'> <strong>".$col[0].". ".$col[1]."</strong>";
			
			} else if (($q[2] != $sa[0])&&($col[0] == $q[2])){
				echo "<img src ='image/correct.png' height = '12' wdith = '12'><strong>".$col[0].".  ".$col[1]."</strong>";
			}
			else {
				echo "<strong> ".$col[0].". ".$col[1]."</strong>";
			}
			echo"<br>";
              }
	}
	}


}
catch (PDOException $e) {

        printf( "Error!" . $e->getMessage()."<br/>");
        die();
}
}
?>
<a href="https://lukejohnson.media/code/classdatabase/user_homepage.php">Go Back To Your HomePage</a>
