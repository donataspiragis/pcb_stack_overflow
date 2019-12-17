    <?php
    include_once 'dbconnect.php';
    try
    {
         $database = new Connection();
         $db = $database->openConnection();
         // sql to create table

	 $sql = "CREATE TABLE `languages` (
      `id` int(11) NOT NULL,
      `Tag` varchar(255) NOT NULL,
      `Title` varchar(255) NOT NULL,
      `CreationDate` DATETIME,
      `Archived` BOOLEAN,
      PRIMARY KEY(`id`)
    )";
$db->exec($sql);
	$sql = "CREATE TABLE `topics` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `Title` varchar(255) NOT NULL,
      `RemarksHtml` longtext NOT NULL,
      `RemarksMarkdown` longtext NOT NULL,
      `CreationDate` DATETIME,
      `LastEditDate` DATETIME,
      `DocTagId` int,
      `ViewCount` int,
      `Archived` BOOLEAN,
      PRIMARY KEY(`id`),
      FOREIGN KEY(`DocTagId`) REFERENCES languages (`id`)
    )";
$db->exec($sql);
         $sql = "CREATE TABLE `examples` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `Title` varchar(255) NOT NULL,
      `BodyHtml` longtext NOT NULL,
      `BodyMarkdown` longtext NOT NULL,
      `CreationDate` DATETIME,
      `LastEditDate` DATETIME,
      `DocTopicId` int,
      `Score` int,
      `Archived` BOOLEAN,
      PRIMARY KEY(`id`),
      FOREIGN KEY(`DocTopicId`) REFERENCES topics (`id`)
    )";
$db->exec($sql);
         // use exec() because no results are returned
        
         echo "Tables created successfully";
         $database->closeConnection();
    }
    catch (PDOException $e)
    {
        echo "There is some problem in connection: " . $e->getMessage();
    }
    ?>
