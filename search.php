<?php
// Include database connection
include('config/conn_db.php');

// Initialize variables
$search = '';
$pizzas = [];

// Process search
if(isset($_GET['search'])) {
    $search = mysqli_real_escape_string($connection, $_GET['search']);
    
    // Search query
    $sql = "SELECT id, title, email, ingredients FROM pizzas 
            WHERE title LIKE '%$search%' 
            OR ingredients LIKE '%$search%' 
            ORDER BY created_at DESC";
    
    // Execute query
    $result = mysqli_query($connection, $sql);
    
    // Fetch results
    $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    // Free result
    mysqli_free_result($result);
}

// Close connection
mysqli_close($connection);

include('templates/header.php');
?>

<div class="container">
    <div class="section center">
        <h4>Search Pizzas</h4>
        
        <!-- Search Form -->
        <div class="row">
            <form class="col s12" action="search.php" method="GET">
                <div class="row">
                    <div class="input-field col s12 m8 offset-m2">
                        <i class="material-icons prefix">search</i>
                        <input id="search" type="text" name="search" value="<?php echo htmlspecialchars($search); ?>">
                        <label for="search">Search by pizza name or ingredients</label>
                    </div>
                </div>
                <button type="submit" class="btn brand z-depth-0 waves-effect">
                    <i class="material-icons left">search</i>Search
                </button>
                <a href="templates/add.php" class="btn brand z-depth-0 waves-effect">
                    <i class="material-icons left">add</i>Add New Pizza
                </a>
            </form>
        </div>
        
        <!-- Search Image -->
        <?php if(!$search): ?>
        <div class="row">
            <div class="col s12 m8 offset-m2">
                <div class="card center">
                    <div class="card-image">
                        <img src="images/heather-barnes-X1I9UPcE7nQ-unsplash.jpg" alt="Search Pizza" style="height: 300px; object-fit: cover; padding: 0;">
                    </div>
                    <div class="card-content">
                        <p>Enter a pizza name or ingredient to search our collection.</p>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Search Results -->
        <?php if($search): ?>
            <h5 class="center">Search Results for "<?php echo htmlspecialchars($search); ?>"</h5>
            
            <?php if(count($pizzas) > 0): ?>
                <div class="row">
                    <?php foreach($pizzas as $pizza): ?>
                        <div class="col s12 m6 l4">
                            <div class="card z-depth-0 card-small">
                                <div class="card-image">
                                    <img src="images/pizza-svgrepo-com.svg" alt="Pizza Image" class="hero-image" style="padding: 20px; height: 180px; object-fit: contain;">
                                </div>
                                <div class="card-content center">
                                    <h5><?php echo htmlspecialchars($pizza['title']); ?></h5>
                                    <p class="grey-text">By: <?php echo htmlspecialchars($pizza['email']); ?></p>
                                    <div style="max-height: 100px; overflow-y: auto;">
                                        <ul>
                                            <?php foreach(explode(',', $pizza['ingredients']) as $ing): ?>
                                                <li><?php echo htmlspecialchars($ing); ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-action center">
                                    <a href="templates/details.php?id=<?php echo $pizza['id']; ?>" class="btn-small brand z-depth-0">
                                        <i class="material-icons left">visibility</i>View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="card">
                    <div class="card-content">
                        <p>No pizzas found matching your search.</p>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<?php include('templates/footer.php'); ?>
</html>

<!-- Floating action button -->
<div class="fixed-action-btn">
    <a href="templates/add.php" class="btn-floating btn-large brand">
        <i class="large material-icons">add</i>
    </a>
</div>

