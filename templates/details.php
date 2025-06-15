<?php
// Connect to database
include('../config/conn_db.php');

// Process delete request
if(isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($connection, $_POST['pizza_id']);
    $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";
    
    if(mysqli_query($connection, $sql)) {
        header('Location: ../index.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($connection);
    }
}

// check Get request id parameter
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connection, $_GET['id']);
    // write query for one pizza
    $sql = "SELECT * FROM pizzas WHERE id = $id";
    // get the query results
    $result = mysqli_query($connection, $sql);
    // fetch the resulting row as an array
    $pizza = mysqli_fetch_assoc($result);
    // free the result set
    mysqli_free_result($result);
    // close the database connection
    mysqli_close($connection);
} else {
    // Redirect to home page if no ID provided
    header('Location: ../index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('header.php'); ?>
<body class="grey lighten-4">
<div class="container center">
    <?php if($pizza): ?>
        <div class="card z-depth-0">
            <div class="card-image">
                <img src="../images/heather-barnes-X1I9UPcE7nQ-unsplash.jpg" alt="Pizza Image" style="height: 250px; object-fit: cover; padding: 0;">
            </div>
            <div class="card-content">
                <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
                <p><i class="material-icons tiny">email</i> Created by: <?php echo htmlspecialchars($pizza['email']); ?></p>
                <p><i class="material-icons tiny">access_time</i> <?php echo date('F j, Y, g:i a', strtotime($pizza['created_at'])); ?></p>
                <h5><i class="material-icons small">restaurant</i> Ingredients:</h5>
                <ul class="collection">
                    <?php foreach(explode(',', $pizza['ingredients']) as $ing): ?>
                        <li class="collection-item"><?php echo htmlspecialchars($ing); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        
        <!-- Delete button and modal -->
        <div class="row">
            <div class="col s12 center">
                <a href="#" class="btn red modal-trigger waves-effect" data-target="delete-modal">
                    <i class="material-icons left">delete</i>Delete
                </a>
                <a href="../index.php" class="btn brand z-depth-0 waves-effect">
                    <i class="material-icons left">home</i>Back to Home
                </a>
            </div>
        </div>
        
        <!-- Delete modal structure -->
        <div id="delete-modal" class="modal">
            <div class="modal-content center-align">
                <h4>Confirm Delete</h4>
                <p>Are you sure you want to delete this pizza?</p>
            </div>
            <div class="modal-footer center-align">
                <form action="details.php?id=<?php echo $pizza['id']; ?>" method="POST" class="center-align">
                    <input type="hidden" name="pizza_id" value="<?php echo $pizza['id']; ?>">
                    <button type="submit" name="delete" class="btn red waves-effect">
                        <i class="material-icons left">check</i>Yes, Delete
                    </button>
                    <a href="#!" class="modal-close btn brand waves-effect">
                        <i class="material-icons left">close</i>Cancel
                    </a>
                </form>
            </div>
        </div>
    <?php else: ?>
        <h4>No such pizza exists.</h4>
        <a href="../index.php" class="btn brand z-depth-0">Back to Home</a>
    <?php endif; ?>
</div>

<?php include('footer.php'); ?>

<!-- Initialize modal -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems);
});
</script>
</body>
</html>
