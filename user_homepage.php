<!--This page is the users homepage. This is where they can take test and view previous test.-->
<?php
session_start();
$uid = $_SESSION["uid"];
?>
<head>
<!--Just soemthing I was trying out to make the page more mobile friendly-->
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<style>
   html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        body {
            display: table;


      } 
.myBlock {
background-image: url("./image/loginbg.png");
      background-repeat: no-repeat;
 background-size: 100% 100%;
	text-align: center;
            display: table-cell;
            vertical-align: middle;
	float: center;
           background-color: black;
        }


   .scrollable {
    height: 100px; /* or any value */
    overflow-y: auto;
}

   .box{
   
 
}
/*
h1 has some special stuff done to it so it is readable against the background. Basically this adds a black outline. 
*/
h1 {
color: yellow;
 text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
}
.boxBottom {
	float:bottom;
}
.clear{
    clear:both;
}
</style>
</head>
<?php
	    /*
	    Truth be told I don't know this in php. Anyway this is the meat of the page. I use iframes so the user can scroll through list of
	    test they have to take and previous test. 
	    */
        echo "<div class = 'myBlock'><h1>Test Taking Home Page</h1>";    
	   echo"<iframe src='https://lukejohnson.media/code/classdatabase/pastexams.php' frameborder='0'></iframe>";
       	 echo"<iframe src='https://lukejohnson.media/code/classdatabase/testdisplay.php' frameborder='0'></iframe>";
        echo"<iframe src='https://lukejohnson.media/code/classdatabase/userinfo.php' frameborder='0'></iframe>";
         echo"<div><iframe src='https://lukejohnson.media/code/classdatabase/links.php' scrolling = 'no' frameborder  = '0'></iframe></div>";
?>
