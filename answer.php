<?php
	include 'database.php';
	if(!empty($_POST))
	{
		$yourans=$_POST["yourans"];
		$qid=$_POST["qid"];
		$sql= "INSERT INTO answers (qid, acont) VALUES ('$qid', '$yourans')";
		$qstat =mysqli_query($connection, $sql);
		if(!$qstat)
		{
						die(" nhi chali" . mysqli_error($connection));

		}
		else
		{
			$sql2= "UPDATE questions SET noans = noans + 1 WHERE questions.qid = '$qid' ";
		$qstat2 =mysqli_query($connection, $sql2);
		if(!$qstat2)
		{
						die(" nhi chali" . mysqli_error($connection));

		}
		else
		{
			header("Location: welcome.php");
			exit();
		}
	}
			
	
	}
?>