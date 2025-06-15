<!-- Connect to database -->
<?php
// Include database connection file
include('config/conn_db.php');

// write query for all pizzas
$sql = "SELECT id, title, email, ingredients FROM pizzas order by created_at";
// get the query results
$result = mysqli_query($connection, $sql);
// fetch the resulting rows as an array
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);
// free the result set
mysqli_free_result($result);
// close the database connection
mysqli_close($connection);
?>

<?php include('templates/header.php'); ?>

<div class="container">
    <!-- Hero Section -->
    <div class="section center">
        <h4>Welcome to PHP Pizza Forum</h4>
        <p class="flow-text">Share your favorite pizza recipes with the world!</p>
        
        <!-- Improved hero image container -->
        <div class="card">
            <div class="card-image">
                <img src="images/alan-hardman-SU1LFoeEUkk-unsplash.jpg" alt="Pizza Hero Image" 
                     style="max-height: 400px; width: 100%; object-fit: cover;">
            </div>
        </div>
        
        <div class="row">
            <div class="col s12 m6 offset-m3">
                <a href="templates/add.php" class="btn-large brand z-depth-0 waves-effect">Add Your Pizza Recipe</a>
            </div>
        </div>
    </div>

    <div class="container" style="max-width: 900px; margin: 0 auto;">
   <h4 class="center">Our Pizza Collection</h4> 
   <div class="row">
      <!-- Loop through the pizzas and display them -->
      <?php foreach ($pizzas as $pizza): ?>
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
                        <?php foreach(explode(', ', $pizza['ingredients'] ) as $ing): ?>
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
      <?php if (count($pizzas) >= 3): ?>
         <div class="center">
            <p class="grey-text">There are 3 or more pizzas in our collection</p>
         </div>
      <?php endif; ?>
   </div>
</div>

    <!-- Features Section -->
    <div class="section">
        <div class="row">
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-content center">
                        <h5>Share Recipes</h5>
                        <p>Upload your favorite pizza recipes and share them with fellow pizza lovers.</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-content center">
                        <h5>Discover New Flavors</h5>
                        <p>Browse through hundreds of unique pizza combinations from around the world.</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-content center">
                        <h5>Join Community</h5>
                        <p>Connect with other pizza enthusiasts and exchange cooking tips and tricks.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="section" id="contact">
        <div class="row">
            <div class="col s12">
                <h4 class="center">Contact Us</h4>
                <div class="contact-form">
                    <form action="contact.php" method="POST">
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <input id="contact_name" type="text" name="name" required>
                                <label for="contact_name">Your Name</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input id="contact_email" type="email" name="email" required>
                                <label for="contact_email">Your Email</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="contact_message" class="materialize-textarea" name="message" required></textarea>
                                <label for="contact_message">Your Message</label>
                            </div>
                        </div>
                        <div class="center">
                            <button type="submit" name="contact_submit" class="btn brand z-depth-0 waves-effect">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('templates/footer.php'); ?>
