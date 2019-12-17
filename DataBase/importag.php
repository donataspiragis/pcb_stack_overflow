<?php
//IMPORT TAGS
function importag($filename,$conn){

$query = '';
//Read the JSON file and stored in a variable
$data = file_get_contents($filename.'.json'); 
//Convert JSON string into PHP array format
$data_array = json_decode($data, true); 
$nar = 0;

    // begin the transaction
    $conn->beginTransaction();
foreach($data_array as $row) {
	$insr = $conn->quote($row['Tag']);
    

preg_match('/(\d{10})(\d{3})([\+\-]\d{4})/', $row['CreationDate'], $matches);
$dt = DateTime::createFromFormat("U.u.O",vsprintf('%2$s.%3$s.%4$s', $matches));
$dt=$dt->format('Y-m-d H:i:s');

$conn->exec("INSERT INTO languages (`id`, `Title`,`CreationDate`, `Tag`) VALUES (".$conn->quote($row['Id']).",".$conn->quote($row['Title']).",'".$dt."',".$insr.")");	    
}
$conn->commit();
}

