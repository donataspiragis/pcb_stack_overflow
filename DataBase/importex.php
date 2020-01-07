<?php
ini_set('memory_limit','900M');
//IMPORT EXAMPLE
function importexample($filename,$conn){
$query = '';
//Read the JSON file and stored in a variable
$data = file_get_contents($filename.'.json'); 
//Convert JSON string into PHP array format
$data_array = json_decode($data, true); 
$nar = 0;

    // begin the transaction
    $conn->beginTransaction();

foreach($data_array as $row) {
	$insr = $conn->quote($row['BodyHtml']);
	$insrt = $conn->quote($row['BodyMarkdown']);


preg_match('/(\d{10})(\d{3})([\+\-]\d{4})/', $row['CreationDate'], $matches);
$dt = DateTime::createFromFormat("U.u.O",vsprintf('%2$s.%3$s.%4$s', $matches));
$dt= $dt->format('Y-m-d H:i:s');
if(array_key_exists('LastEditDate',$row)){

preg_match('/(\d{10})(\d{3})([\+\-]\d{4})/', $row['LastEditDate'], $matches);
$dtl = DateTime::createFromFormat("U.u.O",vsprintf('%2$s.%3$s.%4$s', $matches));
$dtl= $dtl->format('Y-m-d H:i:s');

	$conn->exec("INSERT INTO examples (`Title`, `BodyHtml`,`BodyMarkdown`,`LastEditDate`,`CreationDate`,`Score`,`DocTopicId`) VALUES (".$conn->quote($row['Title']).", ".$insr.",".$insrt.",'".$dtl."','".$dt."',".$row['Score'].",'".$row['DocTopicId']."')");	
}else{
	$conn->exec("INSERT INTO examples (`Title`, `BodyHtml`,`BodyMarkdown`,`CreationDate`,`Score`,`DocTopicId`) VALUES (".$conn->quote($row['Title']).", ".$insr.",".$insrt.",'".$dt."',".$row['Score'].",'".$row['DocTopicId']."')");	
}


    
}
$conn->commit();
}


