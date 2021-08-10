<?php
include('config/db_connect.php');

    // WRITE QUERY FOR ALL MEALS
    $sql = 'SELECT title, ingredients, id FROM food ORDER BY CREATED_at';

        // make query and get result
        $result = mysqli_query($conn, $sql);

    //fetch the resulting rows as an array
    $meal= mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    //free up space form memory
    mysqli_free_result($result);
    
    // close connection
    mysqli_close($conn);



       
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<?php include('template/header.php'); ?>



    

 


 

<h4 class="center grey-text">your orders of food displayed !</h4>

<div class="container">
    <div class="row">

    <?php foreach($meal as $meals): ?>
        
        <div class="col s6 md3">
            <div class="card z-depth-0">
         
                <div class="card-content center">
                    <h6><?php echo htmlspecialchars($meals['title']); ?></h6>
                    <ul>
                    <?php foreach(explode(' , ' , $meals['ingredients']) as $ing) :?>
                    
                    <li><?php echo htmlspecialchars($ing);?></li>
                   <?php endforeach; ?>
                    </ul>
            </div>
        </div>
                <div class="card-action right-align">
                  <a class="brand-text" href="details.php?id=<?php echo
                   $meals['id']?>">more info</a>  
                </div>
    </div>
    <?php endforeach; ?>

    <?php if(count($meal)>=3): ?>
        <p>there are 2 or more meals</p>
        <?php  else:  ?>
        <p>there are less then 2 meal </p>

        <?php endif; ?>

    
</div>
</div>

<?php include('template/footer.php'); ?>



</html>