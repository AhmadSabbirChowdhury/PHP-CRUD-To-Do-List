<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP CRUD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>
</head>
<body>
    <?php require_once 'process.php'; ?>

    <?php
        if(isset($_SESSION['message'])): ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">  
    <!-- it will print out the insert/delete/update alerts -->
        <div class="container">
            <?php
                echo $_SESSION['message'];
                unset ($_SESSION['message']);
            ?>
        </div>

    </div>
    <?php endif ?>
    

    <div class="container">

    <?php 
        //$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
    ?>

    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>Topic</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>

        <?php while($row = $result->fetch_assoc()): ?> 
        <!-- pulling data from DB and storing it in $row -->

        <tr>
            <td><?php echo $row['topic']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td>
                <a href="index.php?edit=<?php echo $row['id'];?>"
                class="btn btn-info">Edit</a>
                <a href="process.php?delete=<?php echo $row['id'];?>"
                class="btn btn-danger">Delete</a>
            </td>
        </tr>

        <?php endwhile ;?>
        </table>
    
    </div>

    <?php
        function pre_r( $array ){
            echo '<pre>';
            print_r( $array );
            echo '</pre>';
        }

    ?>
    <div class="row justify-content-center">
        <form action="process.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id;?>">
        
        <!-- Here 'value' is added so that whenever 'edit' button is clicked,
        the values will be fetched & displayed in the form-->
            <div class="form-group row">
                <label><b>Topic</b></label>
                <input type="text" name="topic" value="<?php echo $topic; ?>"
                class="form-control " placeholder="Topic Name..">
            </div>
            <div class="form-group row ">
                <label><b>Date</b></label>
                <input type="timestamp" name="date" value="<?php echo $date; ?>"
                class="form-control" placeholder="(D/M/Y)">
            </div>
            <div class="form-group row">
                <label><b>Description</b></label>
                <input type="message" name="description" value="<?php echo $description; ?>"
                class="form-control form-control-lg" placeholder="Details..">
            </div>
            <div class="form-group row">

            <?php if($update == true): ?>
                <button type="submit" class="btn btn-warning" name="update">Update</button>

            <?php else: ?>
               <button type="submit" class="btn btn-primary" name="save">Save</button>
            
            <?php endif;?>

            </div>
        </form>
    
    </div>
    </div>
    
</body>
</html>