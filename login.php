<?php
error_reporting(E_ERROR | E_PARSE);
session_unset();
session_destroy();
#when you log out this will deystroy you session on this computer
?>
 <head>
     <!-- Some very simple CSS to give the page an Okay look -->
        <title>Log In</title>
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
    .my-block {
      
        text-align: center;
        display: table-cell;
        vertical-align: middle;
        background-color: black;
        }
	strong{

	color: yellow;
	}	
	h1{

	color: yellow;
	}
	p{
	background-color: white;
	}
	input[type=text] {
	    padding:5px; 
            border:2px solid #ccc; 
            -webkit-border-radius: 5px;
           border-radius: 5px;
	}

	input[type=text]:focus {
   	 border-color:666;
	}
    input[type=password] {
            padding:5px;
            border:2px solid #ccc;
            -webkit-border-radius: 5px;
           border-radius: 5px;
        }

        input[type=password]:focus {
         border-color:666;
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
<body>
<div class="my-block">
<?php
/*
This creates a very simple form for the user to login. I use the password datatype to make it more secure. Also, html 5 has some awesome 
features and one of them is that you can add the keyword required to a feild and it will not let you leave that feild blank. On the checklogin.php I did 
make same fail safe javascript functions if the user somehow gets past the HTML5 required tag
*/
echo"<br><h1>Michigan Tech Online Testing Hub</h1>";
echo"<form method='post' action='checklogin.php'>";
echo"<strong>Username</strong><br>";
echo"<input type='text' name='username' required><br>";
echo"<strong>Password</strong><br>";
echo"<input type='password' name='password' required><br>";
echo"<br>";
echo"<strong><input type='submit'class='myButton' name='login' value='Log In'></strong>";


?>
</div>
</body>
