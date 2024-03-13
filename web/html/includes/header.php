<?php ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/gif" href="images/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Raleway:wght@300&display=swap" rel="stylesheet">
    <title><?=$pageTitle ?? 'Reel Reviews'?> </title>
</head>

<header>
    <div class="logo">
        <a class="navbar-brand rounded-circle d-flex justify-content-center align-items-center bg-white" href="#">
            <img src="images/reel-review-logo.png" alt="reel logo" class="img-fluid">
        </a>
    </div>

<ul class="nav justify-content-end">
  <li class="nav-item">
    <a  class="nav-link"href="home.php">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="movies.php">Movies</a>
  </li>


</ul>

</header>