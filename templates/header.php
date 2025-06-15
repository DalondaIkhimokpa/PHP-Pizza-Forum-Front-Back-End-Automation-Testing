<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP Pizza Forum</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo $in_templates ? '../favicon.ico' : 'favicon.ico'; ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $in_templates ? '../favicon-32x32.png' : 'favicon-32x32.png'; ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $in_templates ? '../favicon-16x16.png' : 'favicon-16x16.png'; ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $in_templates ? '../apple-touch-icon.png' : 'apple-touch-icon.png'; ?>">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&family=Pacifico&display=swap" rel="stylesheet">
    <style type="text/css">
        .brand-logo {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            text-decoration: none;
        }
        .pizza-icon {
            width: 40px;
            height: 40px;
            background: rgb(215, 75, 32);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        .brand-logo:hover .pizza-icon {
            background: rgb(180, 60, 20);
        }
        .brand-logo:hover {
            color: rgb(180, 60, 20) !important;
        }
        .brand {
            background: rgb(215, 75, 32) !important;
        }
        nav {
            background: white !important;
        }
        nav .nav-wrapper {
            padding: 0 80px 0 20px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            position: relative;
        }
        nav ul {
            margin-right: 20px;
            display: flex;
            flex-wrap: wrap;
        }
        nav ul li {
            margin-left: 5px;
        }
        .btn {
            font-size: 0.9rem;
            padding: 0 10px;
        }
        form {
            max-width: 460px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }
        form input, form label, form button {
            font-size: 18px;
            font-family: 'Courier New', Courier, monospace;
            margin: 10px;
            border-radius: 5px;
            border: none;
            outline: none;
        }
        .hero-image {
            max-width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin: 10px 0;
        }
        .contact-form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
        }
        .banner {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('<?php echo $in_templates ? "../images/tamas-pap-XLmhRnV8yuc-unsplash.jpg" : "images/tamas-pap-XLmhRnV8yuc-unsplash.jpg"; ?>');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 20px 0;
            margin-bottom: 20px;
            text-align: center;
        }
        .banner h2 {
            font-family: 'Roboto', sans-serif;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
        }
        .card-small {
            height: 450px;
            display: flex;
            flex-direction: column;
        }
        .card-small .card-content {
            flex-grow: 1;
            overflow: auto;
        }
        .btn-floating {
            position: fixed;
            bottom: 30px;
            right: 30px;
        }
        
        /* Fix for mobile title overlap */
        @media only screen and (max-width: 992px) {
            .brand-logo {
                font-size: 0.8rem;
                left: 10px !important;
            }
            nav ul {
                margin-top: 50px;
            }
        }
    </style>
</head>
<body class="grey lighten-4">
    <nav class="white z-depth-0">
        <div class="container">
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
            <div class="nav-wrapper">
                <a href="<?php echo $home_link; ?>" class="brand-logo">
                    <div class="pizza-icon">🍕</div>
                </a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="<?php echo $add_link; ?>" class="btn brand z-depth-0"><i class="material-icons left">add</i>Add Pizza</a></li>
                    <li><a href="<?php echo $search_link; ?>" class="btn brand z-depth-0"><i class="material-icons left">search</i>Search</a></li>
                    <li><a href="<?php echo $home_link; ?>" class="btn brand z-depth-0"><i class="material-icons left">home</i>Home</a></li>
                    <li><a href="<?php echo $about_link; ?>" class="btn brand z-depth-0"><i class="material-icons left">info</i>About</a></li>
                    <li><a href="<?php echo $contact_link; ?>" class="btn brand z-depth-0"><i class="material-icons left">email</i>Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Banner (only on home page) -->
    <?php if(strpos($current_path, 'index.php') !== false || $current_path == '/' || $current_path == '/pizza-forum/'): ?>
    <div class="banner">
        <div class="container">
            <h2>PHP Pizza Forum</h2>
            <p class="flow-text">The ultimate destination for pizza lovers!</p>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Demo content removed -->
</body>
</html>

