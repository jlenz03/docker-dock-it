

<?php
require_once "includes/header.php";
require_once "includes/database.php";

?>
<body>

<div class="row d-flex justify-content-center">

    <div class="col-4">
        <h1>Movie Database</h1>
    </div>
</div>


</body>
</html>
<?php
// query to rn on the database
//use  title artist and price as ur 3 columns
$sort= $_GET['sort'] ?? 'MovieTitle';

$query= "SELECT final_movie.MovieTitle AS MovieTitle, final_movie.MovieId
        FROM final_movie
        ORDER BY $sort";

// run the query
//$result = @mysqli_query($db, $query) or die('Error in query');
//in development
$result = @mysqli_query($db, $query) or die('Error in query'.mysqli_error($db));
?>
<div class="container mt-3">
    <div class="row justify-content-center">
        <?php
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="images/stone.jpg" class="card-img" alt="...">
                    <div class="card-img-overlay d-flex flex-column justify-content-end">
                        <h5 class="card-title"><?= $row['MovieTitle'] ?></h5>
                        <p class="card-text">Some quick example text to show more content when hovered over the card image.</p>
                        <a href="movie-details.php?MovieId=<?= $row['MovieId'] ?>" class="btn btn-primary btn-lg">Details</a>
                    </div>
                </div>
            </div>
            <?php
        }
        mysqli_close($db);
        ?>
    </div>
</div>


<?php
require_once "includes/footer.php";
?>
