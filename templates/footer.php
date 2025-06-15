
<footer class="page-footer grey darken-3">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">PHP Pizza Forum</h5>
                    <p class="grey-text text-lighten-4">The ultimate destination for pizza lovers to share and discover amazing recipes.</p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Quick Links</h5>
                    <ul>
                        <?php
                        // Check if we're in templates directory for correct paths
                        $current_path = $_SERVER['REQUEST_URI'];
                        $in_templates = strpos($current_path, '/templates/') !== false;
                        
                        $home_link = $in_templates ? '../index.php' : 'index.php';
                        $add_link = $in_templates ? 'add.php' : 'templates/add.php';
                        $search_link = $in_templates ? '../search.php' : 'search.php';
                        $about_link = $in_templates ? '../about.php' : 'about.php';
                        $contact_link = $in_templates ? '../index.php#contact' : 'index.php#contact';
                        ?>
                        <li><a class="grey-text text-lighten-3" href="<?php echo $home_link; ?>"><i class="material-icons tiny left">home</i>Home</a></li>
                        <li><a class="grey-text text-lighten-3" href="<?php echo $add_link; ?>"><i class="material-icons tiny left">add</i>Add Pizza</a></li>
                        <li><a class="grey-text text-lighten-3" href="<?php echo $search_link; ?>"><i class="material-icons tiny left">search</i>Search</a></li>
                        <li><a class="grey-text text-lighten-3" href="<?php echo $about_link; ?>"><i class="material-icons tiny left">info</i>About</a></li>
                        <li><a class="grey-text text-lighten-3" href="<?php echo $contact_link; ?>"><i class="material-icons tiny left">email</i>Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright brand">
            <div class="container center">
                © 2025 PHP Pizza Forum - Made with <span style="color: #ff4d4d;">❤️</span> for Pizza Lovers
                <div class="grey-text text-lighten-4" style="margin-top: 5px; font-size: 0.9rem;">
                    <a class="grey-text text-lighten-4" href="#!">Privacy Policy</a> | 
                    <a class="grey-text text-lighten-4" href="#!">Terms of Service</a> | 
                    <a class="grey-text text-lighten-4" href="#!">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        // Initialize all Materialize components
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize modals
            var modals = document.querySelectorAll('.modal');
            M.Modal.init(modals);
            
            // Initialize dropdowns
            var dropdowns = document.querySelectorAll('.dropdown-trigger');
            M.Dropdown.init(dropdowns);
            
            // Initialize tooltips
            var tooltips = document.querySelectorAll('.tooltipped');
            M.Tooltip.init(tooltips);
        });
    </script>
</body>
</html>
