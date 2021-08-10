<?php
include('config/db_connect.php');

$title = $email = $ingredients ='';
$errors = array('email'=>'','title'=>'','ingredients'=>'');
if(isset($_POST['submit'])){
  

    // check email
    if(empty($_POST['email'])){
        $errors['email'] = 'An email is required<br />';
    }else {
        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors['email'] ='email must be a valid address';
        }
    }

      // check title
      if(empty($_POST['title'])){
        $errors['title'] = 'A title is required <br';
      }else{
          $title = $_POST['title'];
          if(!preg_match('/^[a-z-Z\s]+$/', $title)){
     $errors['title'] = 'title must be letter and spaces only';
          }
      }
    

       // check ingedient
    if(empty($_POST['ingredients'])){
        $errors['ingredients'] = 'At least one ingredient is required <br />';
    } else{
        $ingredients = $_POST['ingredients'];
    if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
        $errors['ingredients'] = 'ingredients must be letters and spaces only';
    }
        }

        if(array_filter($errors)){

        } else {

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
     

            // create sql
        $sql = "INSERT INTO food(title,email,ingredients) VALUE('$title', '$email',
        '$ingredients')";

        //save to db and check
        if(mysqli_query($conn, $sql)){
            //success
            header('Location: index.php');
        } else {
            // error
            echo 'query error: ' . mysqli_error($conn);
        }
            
        }

    }

?>

<!DOCTYPE html>
<html>
<?php include('template/header.php'); ?>

<section class="container white-text">
<h4 class="center">Select Your Meals</h4>
<form class="white" action="add.php" method="POST">
<label>Your Email:</label>
<input type="text" name="email" value="<?php echo $email ?>">
<div class="red-text"><?php echo  $errors['email'];?></div>
<label>Your Title:</label>
<input type="text" name="title" value="<?php echo $title ?>">
<div class="red-text"><?php echo $errors['title'];?></div>
<label>Ingredients (comma separated):</label>
<input type="text" name="ingredients" value="<?php echo   $ingredients ?>">
<div class="red-text"><?php echo $errors['ingredients'];?></div>
<div class="center">
    <input type="submit" name="submit" value="submit" class="btn addbtn">
</div>
<form>
</section>

<?php include('template/footer.php'); ?>

</html>