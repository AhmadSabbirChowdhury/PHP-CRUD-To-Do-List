<?php
session_start();

$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

$id=0;
$update= false;
$topic= "";
$date= "";
$description= "";

if(isset($_POST['save'])){
    $topic = $_POST['topic'];
    $date = $_POST['date'];
    $description = $_POST['description'];

    $mysqli-> query("INSERT INTO data(topic, date, description) VALUES('$topic','$date', '$description') ") or
                    die($mysqli->error);

    $_SESSION['message'] = 'Records have been saved';
    $_SESSION['msg_type'] = 'success';

    header("Location: index.php");
}

if(isset($_GET['delete'])){
    $id= $_GET['delete']; //The value the need to be deleted
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = 'Records have been deleted';
    $_SESSION['msg_type'] = 'danger';

    header("Location: index.php");
}

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data where id=$id") or die ($mysqli->error());
    if(count($result) == 1){  //checkig if the record exists in the DB
        $row = $result->fetch_array();  //returns the data from DB
        $topic = $row['topic']; 
        $date = $row['date'];
        $description = $row['description'];
    }
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $topic = $_POST['topic'];
    $date = $_POST['date'];
    $description = $_POST['description'];

    $mysqli->query("UPDATE data SET topic='$topic', date='$date', description='$description' WHERE id=$id ")
    or die($mysqli->error);

    $_SESSION['message'] = 'Records have been updated';
    $_SESSION['msg_type'] = 'warning';

    header("Location: index.php");

}