<?php
// Include database connection
include('config/conn_db.php');

// Initialize variables
$name = $email = $message = '';
$errors = array('name' => '', 'email' => '', 'message' => '');
$success = false;

// Process form submission
if(isset($_POST['contact_submit'])) {
    // Validate name
    if(empty($_POST['name'])) {
        $errors['name'] = 'Name is required';
    } else {
        $name = mysqli_real_escape_string($connection, $_POST['name']);
    }
    
    // Validate email
    if(empty($_POST['email'])) {
        $errors['email'] = 'Email is required';
    } else {
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email must be a valid email address';
        }
    }
    
    // Validate message
    if(empty($_POST['message'])) {
        $errors['message'] = 'Message is required';
    } else {
        $message = mysqli_real_escape_string($connection, $_POST['message']);
    }
    
    // If no errors, save to database
    if(!array_filter($errors)) {
        $sql = "INSERT INTO contacts(name, email, message) 
                VALUES('$name', '$email', '$message')";
        
        if(mysqli_query($connection, $sql)) {
            // Success
            $success = true;
            $name = $email = $message = ''; // Clear form
        } else {
            echo 'Query error: ' . mysqli_error($connection);
        }
    }
}

// Redirect to home page if form was successfully submitted
if($success) {
    header('Location: index.php?contact=success#contact');
    exit();
}

include('templates/header.php');
?>

<div class="container">
    <div class="section center">
        <h4>Contact Us</h4>
        
        <div class="row">
            <div class="col s12 m8 offset-m2">
                <div class="card z-depth-0">
                    <div class="card-content">
                        <form action="contact.php" method="POST">
                            <div class="row">
                                <div class="input-field col s12 m6">
                                    <input id="name" type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
                                    <label for="name">Your Name</label>
                                    <div class="red-text"><?php echo $errors['name']; ?></div>
                                </div>
                                <div class="input-field col s12 m6">
                                    <input id="email" type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                                    <label for="email">Your Email</label>
                                    <div class="red-text"><?php echo $errors['email']; ?></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea id="message" class="materialize-textarea" name="message"><?php echo htmlspecialchars($message); ?></textarea>
                                    <label for="message">Your Message</label>
                                    <div class="red-text"><?php echo $errors['message']; ?></div>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" name="contact_submit" class="btn brand z-depth-0">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <a href="index.php" class="btn brand z-depth-0">Back to Home</a>
    </div>
</div>

<?php include('templates/footer.php'); ?>
