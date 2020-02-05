<?php
//This page displays the answers for the test and what the user got wrong and right. Also, their score for the test/
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

p,h4,strong,h5{
color: yellow;

}
</style>
</head>
";
try {

        $dbh = new PDO('',"", "");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    /*
    So the lines below start a transaction then input the users answers into the studentqa table for automatic grading. 
    */
	$dbh->beginTransaction();
             for($i = 1; $i <= $_POST["totalq"]; $i++){
    
                $dbh->query("insert studentqa values('".$uid."','".$ename."',".$i.",0,'".$_POST["choice".$i]."')");
         }
	$dbh->commit();
	#print info about the test
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
		    #if the got it right put a green check mark next to it, else put a red X next to it. 
		if($q[2] == $sa[0]){                
		echo "<img src ='image/correct.png' height = '24' wdith = '24' align = 'left'>";
		echo "<p>Points ".$q[3]."/".$q[3]."</p>";
		echo "<h4> ".$q[0].".  ".$q[1]."</h4>";
		;
		} else {
		echo "<img src ='image/red.png' height = '24' wdith = '24' align = 'left'>";
                 echo "<p>Points 0/".$q[3]."</p>";
		 echo "<h4>".$q[0].".  ".$q[1]."</h4>";
		}
	
               foreach($dbh->query("select choice,ctext from choice where ename = '".$ename."' and qnumber = ".$q[0]) as $col) {
		    #if they got the choice right put a green check next to it else put a red X and a green check next to the correct answer
		if (($q[2] == $sa[0]) && ($col[0] == $sa[0])) {
				echo "<img src ='image/correct.png' height = '12' wdith = '12'><strong> ".$col[0].". ".$col[1]."</strong>";
			} else if (($q[2] != $sa[0])&&($col[0] == $sa[0])) {
				echo "<img src ='image/red.png' height = '12' wdith = '12'> <strong>".$col[0].". ".$col[1]."</strong>";
			
			} else if (($q[2] != $sa[0])&&($col[0] == $q[2])){
				echo "<img src ='image/correct.png' height = '12' wdith = '12'><strong>".$col[0].".  ".$col[1]."</strong>";
			}
			else {
			        #if the answer is not the one the user chose or the right answer jsut pirnt it out as normal
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
<!--Take the user back to the homepage -->
<a href="http://classdb.it.mtu.edu/~ldjohnso/user_homepage.php">Go Back To Your HomePage</a>
