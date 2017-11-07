
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<table class="redTable">
<tr>

<?php


if($_FILES['file']['type']!=(
  'text/csv'
|| 'application/vnd.ms-excel'
|| 'text/comma-separated-values'
|| 'application/csv'
|| 'text/x-comma-separated-values'
|| 'application/x-csv'
|| 'text/plain'
 )){
	
	header('Location: index.php?wrong_file_error=true');
	
	die;
	}
	
	$dir = './uploads/';
	
	if(move_uploaded_file($_FILES['file']['tmp_name'],$dir.$_FILES['file']['name']))
	{
		$dir = './uploads/'; 		
	//	move_uploaded_file($_FILES['file']['tmp_name'], $dir);		
		$filename = $dir.$_FILES['file']['name'];		
	}
	else{
		
		header('Location: index.php?file_open_error=true');		
		
		die;
	}


$file = fopen($filename,"r"); //get the csv file

//print_r(fgetcsv($file));
$data = fgetcsv($file);





?>
<td><h3> <?php 
echo "MIME TYPE DETECTED: ".mime_content_type($filename). " " ;
echo "<br><br> You are Uploading the Following File:    <b>".$filename."</b> To the following directory <b>".$dir."</b> </h3> </td></tr>"; ?>
<tr><td><h3><a href="index.php"> Upload Another File </h3></a></td></tr>
</table>



<table class="redTable">


<?php


//print headers
 $numcols = count($data) - 1;

 
 echo "<thead><tr>";
 
 $i = 0;
 
 while ($i<=$numcols){
	 
			echo "<th>".$data[$i]."</th>";
			$i++;
 }
	echo "</tr></thead>";
	$i = 0;
			
			
 

 while (($data = fgetcsv($file)) !== FALSE) { //first while - while not end of file

 //$data = rtrim($data);
 echo "<tr>";
 while ($i <= $numcols && $data[$i] !== NULL) 
				{
					echo "<td>".$data[$i]."</td>";
				$i ++;
				}
			    $i = 0;
		echo "</tr>";

			
}

 


	echo "</table></html>";

	fclose($file);
	
?>