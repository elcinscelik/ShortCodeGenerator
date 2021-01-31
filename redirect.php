<?php

 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "esctest";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);



	if(isset($_GET['code']))
	{
		$code= $_GET['code'];
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
		
		$sql4 = "UPDATE tableone SET counter=(counter+1) WHERE code = '$code'";
		if (mysqli_query($conn, $sql4)) {
                echo "5 saniye içinde yönlendiriliyorsun";
				 
				$sqltest = "SELECT url FROM tableone WHERE code = '$code'";
				$result = mysqli_query($conn, $sqltest) or die("Error in Selecting " . mysqli_error($conn));
				$row = $result->fetch_assoc();
				$veri = $row['url'];
				
				header("Location: $veri", true, 303);
				exit;
            } else {
                  echo "Error: " . $sql4 . "<br>" . mysqli_error($conn);
            }
	}
 ?>