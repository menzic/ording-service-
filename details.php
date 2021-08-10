<?php

include('config/db_connect.php');

if(isset($_POST['delete'])){

    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sql = "DELETE FROM food WHERE id = $id_to_delete";

    if(mysqli_query($conn, $sql)){
        //success
        Header('Location: index.php');
    } {
        //failure
        echo 'query error: ' . mysqli_error($conn);
    }
}

// check GET request id param
if(isset($_GET['id'])){

    $id = mysqli_real_escape_string($conn, $_GET['id']);

    //make sql
    $sql = "SELECT * FROM food WHERE id = $id";

    // get the query result
    $result = mysqli_query($conn, $sql);

    // fetch result in array format
    $meal = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);
  
}

?>
<!DOCTYPE html>
<htm>

<?php include('template/header.php'); ?>

<div class="container center">
    <?php if($meal): ?>
    <h4><?php echo htmlspecialchars($meal['title']); ?></h4>
    <p>Created by: <?php echo htmlspecialchars($meal['email']) ?></p>
    <p><?php echo date($meal['created_at']); ?> </p>
    <h5>Ingredients:</h5>
    <p><?php echo htmlspecialchars($meal['ingredients']); ?></p>
   

    <!--DELETE FORM-->
    <form action="details.php" method="POST">
    <input type="hidden" name="id_to_delete" value="<?php echo $meal['id'] ?>">
    <input type="submit" name="delete" value="Delete" class="btn addbtn z-depth-0">
    </form>
    <?php else: ?>

    <h5>No such meals exits</h5>
     
    <?php endif; ?>
    </div> 

<?php include('template/footer.php'); ?>



</htm>