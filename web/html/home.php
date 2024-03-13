<?php
require_once "includes/header.php";
require_once "includes/database.php";

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="row justify-content-start">
    <div class="col-4">
        <h1>Home </h1>
        <h2> Welcome to Reel Reviews!</h2>

        <div class="container mt-5">
            <div class="card" style="width: 18rem;">
                <img src="images/hp.jpeg" class="card-img" alt="...">
                <div class="card-img-overlay d-flex flex-column justify-content-end">
                    <h5 class="card-title">Card Title</h5>
                    <p class="card-text">Some quick example text to show more content when hovered over the card image.</p>
                    <a href="movies.php"> <button type="button" class="btn btn-primary btn-lg" >Browse Movies</button></a>

                </div>
            </div>
        </div>


</div>
</div>
</body>
<?php
require_once "includes/footer.php"; ?>
</html>