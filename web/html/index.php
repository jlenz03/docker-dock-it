<?php
require_once "includes/header.php";
require_once "includes/database.php";

?>


<div class="row d-flex justify-content-center">

    <div class="col-4">
        <h1>Welcome to Reel Reviews</h1>
    </div>
</div>



<?php
// query to run on the database
// use title, artist, and price as your 3 columns
$sort= $_GET['sort'] ?? 'MovieTitle';

$query= "SELECT final_movie.MovieTitle AS MovieTitle, final_movie.MovieId, final_movie.MovieDescription AS MovieDescription, final_movie.imageURL AS ImageURL
        FROM final_movie
        ORDER BY $sort";

// run the query
$result = @mysqli_query($db, $query) or die('Error in query: ' . mysqli_error($db));
?>
<div class="container mt-3">
    <div class="row justify-content-center">
        <?php
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            // Limit the movie description to 100 characters
            $shortDescription = (strlen($row['MovieDescription']) > 100) ? substr($row['MovieDescription'], 0, 100) . "..." : $row['MovieDescription'];
            ?>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <?php if (!empty($row['ImageURL'])): ?>
                        <img src="<?= $row['ImageURL'] ?>" class="img-fluid" alt="<?= $row['MovieTitle'] ?>">
                    <?php else: ?>
                        <img src="images/stone.jpg" class="img-fluid" alt="<?= $row['MovieTitle'] ?>">
                    <?php endif; ?>

                    <div class="card-img-overlay d-flex flex-column justify-content-end">
                        <h5 class="card-title"><?= $row['MovieTitle'] ?></h5>
                        <!-- Display the shorter movie description -->
                        <p class="card-text"><?= $shortDescription ?></p>
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
