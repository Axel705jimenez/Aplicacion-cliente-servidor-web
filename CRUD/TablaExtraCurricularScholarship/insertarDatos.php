<?php

$scholarshipAmount = $_POST["scholarshipAmount"];
$eligibilityRequirements = $_POST["eligibilityRequirements"];
$scholarshipDuration = $_POST["scholarshipDuration"];
$description = $_POST["description"];

require_once('../config.inc.php');


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO extracurricularscholarship (scholarshipAmount, eligibilityRequirements, scholarshipDuration, `description`)
VALUES ('".$scholarshipAmount."', '".$eligibilityRequirements."', '".$scholarshipDuration."' , '".$description."')";

if ($conn->query($sql) === TRUE)
{
  $conn->close();
  header("location:TablaExtraCurricularScholarship.php");

} else 
{
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


//Ctrl+D Selecciona las siguientes palabras

//Shift+Alt Selecion de los caracteres

?>