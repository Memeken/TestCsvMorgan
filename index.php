<?php
$uploadError = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$target_dir = "reception/";
	$target_file = $target_dir . basename($_FILES["csv"]["name"]);
	$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      //Check if file is a csv file
	if ($fileType != "csv") {
		$uploadError = "Le fichier sélectionné n'est pas un fichier .CSV.";
	}
	// Check if file already exists
	if (file_exists($target_file)) {
		$uploadError = "Sorry, file already exists.";
	}

	if (!empty($uploadError)){
		echo "Sorry, your file was not uploaded.";
	}
	else {
		if(move_uploaded_file($_FILES["csv"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["csv"]["name"]). " has been uploaded.";

		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
}
// $row = 1;
// if (($handle = fopen("uploads/users.csv", "r")) !== FALSE) {
//     while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
//         $num = count($data);
//         echo "<p> $num champs à la ligne $row: <br /></p>\n";
//         $row++;
//         for ($c=0; $c < $num; $c++) {
//             echo $data[$c] . "<br />\n";
//         }
//     }
//     fclose($handle);
// }	
// $data = fgetcsv(fopen("uploads/users.csv", "r"), 1000, ",");
// echo $data[0];
?>



<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>CSV</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<h1>CSV</h1>
	<div>
		<form action="index.php" method="post" enctype="multipart/form-data">
			<label for="csv">Choisissez le fichier CSV à upload:</label>

			<p><input type="file" id="csv" name="csv" accept=".csv">
				<input type="submit" value="Upload CSV" name="upload"></p>
				<span><?php echo $uploadError; ?></span>
			</form>
		</div>
	</body>
	</html>