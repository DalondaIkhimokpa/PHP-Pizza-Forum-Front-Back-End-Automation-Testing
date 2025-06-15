<?php
// Include database connection
include('../config/conn_db.php');
if (!$connection) {
    die('DB connection failed: ' . mysqli_connect_error());
}

$email = $title = $ingredients = '';
$errors = array('email' => '', 'title' => '', 'ingredients' => '');
    
if(isset($_POST['submit'])){
    
    // check email
    if(empty($_POST['email'])){
        $errors['email'] = 'An email is required';
    } else{
        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Email must be a valid email address';
        }
    }
    
    // check title
    if(empty($_POST['title'])){
        $errors['title'] = 'A title is required';
    } else{
        $title = $_POST['title'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
            $errors['title'] = 'Title must be letters and spaces only';
        }
    }
    
    // check ingredients
    if(empty($_POST['ingredients'])){
        $errors['ingredients'] = 'At least one ingredient is required';
    } else{
        $ingredients = $_POST['ingredients'];
        if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
            $errors['ingredients'] = 'Ingredients must be a comma separated list';
        }
    }
    
    // If no errors, save to database
    if(!array_filter($errors)){
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $title = mysqli_real_escape_string($connection, $_POST['title']);
        $ingredients = mysqli_real_escape_string($connection, $_POST['ingredients']);
        
        // create sql
        $sql = "INSERT INTO pizzas(title,email,ingredients) VALUES('$title','$email','$ingredients')";
        
        // save to db and check
        if(mysqli_query($connection, $sql)){
            // success
            header('Location: ../index.php');
            exit();
        } else{
            // error
            echo 'query error: ' . mysqli_error($connection);
        }
    }
}      
?>
<!DOCTYPE html>
<html lang="en">
<?php include('header.php'); ?>
<body class="grey lighten-4">
<div class="container">
    <!-- Hero Section -->
    <div class="section center">
        <h4 class="center">Add a Pizza</h4>
        <form class="white" action="add.php" method="POST">
            <label>Your Email</label> 
            <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <div class="red-text center-align"><?php echo $errors['email']; ?></div>
            
            <label>Pizza Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>">
            <div class="red-text center-align"><?php echo $errors['title']; ?></div>
            
            <label>Ingredients (comma separated)</label>
            <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients); ?>">
            <div class="red-text center-align"><?php echo $errors['ingredients']; ?></div>
            
            <div class="center">
                <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
            </div>
        </form>
    </div>
</div>
<?php include('footer.php'); ?>
</html>
