<?php
include_once('databaseconnection.php');

if ($con->connect_error) die("Connection failed: ".$con->connect_error);
$sql="CREATE TABLE member(
        id int NOT NULL AUTO_INCREMENT,
        PRIMARY KEY(id),
        firstname varchar(15) NOT NULL,
        lastname varchar(30) NOT NULL,
        username varchar(15) NOT NULL,
        password varchar(15) NOT NULL,
        email varchar(30) NOT NULL,
        phonenumber int NOT NULL,
        birthday date NOT NULL,
        class varchar(2) NOT NULL,
        gender varchar(6) NOT NULL,
    )";
if ($con->query($sql)===TRUE) echo "Table Member created successfully";
else echo "error creating table: ".$con->error;
$con->close();
?>
