<?php
require_once "includes/header.php";
require_once "includes/database.php";

// Get the MovieId from the URL
$movieId = $_GET['MovieId'] ?? '';

// Check if MovieId is provided
if (!empty($movieId)) {
    // Query to fetch details of the specific movie using MovieId
    $movieQuery = "SELECT * FROM final_movie WHERE MovieId = '$movieId'";
    $movieResult = mysqli_query($db, $movieQuery);

    if (!$movieResult) {
        die('Error in movie query: ' . mysqli_error($db));
    }

    // Fetch the movie details
    $movieRow = mysqli_fetch_assoc($movieResult);

    // Display the movie details section
    ?>
    <a href="index.php" class="btn btn-outline-light">
        <i class="fas fa-arrow-left"></i> Back
    </a>

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-4">
                <div class="movie-details">
                    <div class="movie-image">
                        <?php if (!empty($movieRow['imageURL'])): ?>
                            <img src="<?= $movieRow['imageURL'] ?>" class="img-fluid" alt="<?= $movieRow['MovieTitle'] ?>">
                        <?php else: ?>
                            <img src="images/stone.jpg" class="img-fluid" alt="<?= $movieRow['MovieTitle'] ?>">
                        <?php endif; ?>
                    </div>
                    <div class="movie-info">
                        <h2><?= $movieRow['MovieTitle'] ?></h2>
                        <p><?= $movieRow['MovieDescription'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php

    // Query to fetch reviews for the specific movie
    $sort = $_GET['sort'] ?? 'MovieTitle';
    $reviewsQuery = "SELECT 
                        final_review.ReviewId,
                        final_review.Rating AS Rating,
                        final_review.ReviewTitle AS Title,
                        final_review.Review AS Review,
                        final_review.FirstName AS FirstName,
                        final_review.LastName AS LastName,
                        final_movie.imageURL AS ImageURL
                    FROM 
                        final_review
                    JOIN 
                        final_movie ON final_movie.MovieId = final_review.MovieId
                    WHERE 
                        final_movie.MovieId = '$movieId'
                    ORDER BY 
                        $sort";

    // Run the reviews query
    $reviewsResult = mysqli_query($db, $reviewsQuery);

    if (!$reviewsResult) {
        die('Error in reviews query: ' . mysqli_error($db));
    }

    // Display the reviews section
    ?>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-4">



                <?php
                // Add the "Add Review" button once at the top
                if (mysqli_num_rows($reviewsResult) > 0) {
                    $row = mysqli_fetch_array($reviewsResult, MYSQLI_ASSOC);
                    ?>
                    <div class="review-section-title d-flex justify-content-between align-items-center">
                        <h3>Reviews</h3>
                        <a href="add-review.php?id=<?= $movieId ?>" class="">Add</a>
                    </div>
                    <hr>
                    <?php
                    mysqli_data_seek($reviewsResult, 0); // Reset pointer to the beginning
                }

                while ($row = mysqli_fetch_array($reviewsResult, MYSQLI_ASSOC)) {
                    ?>

                    <?php
                    while ($row = mysqli_fetch_array($reviewsResult, MYSQLI_ASSOC)) {
                        ?>
                        <div class="movie-details">
                            <div class="review-image">
                                <?php if (!empty($row['ImageURL'])): ?>
                                    <img src="<?= $row['ImageURL'] ?>" class="img-fluid" alt="<?= $movieRow['MovieTitle'] ?>">
                                <?php else: ?>
                                    <img src="images/stone.jpg" class="img-fluid" alt="<?= $movieRow['MovieTitle'] ?>">
                                <?php endif; ?>
                            </div>
                            <div class="movie-info">
                                <h4><?= $row['Title'] ?></h4>
                                <p>
                                    <?= $row['FirstName'] ?>
                                    <?= $row['LastName'] ?>
                                    <?php
                                    // Display rating as stars
                                    $rating = $row['Rating'];
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $rating) {
                                            echo '<i class="fas fa-star text-warning"></i>';
                                        } else {
                                            echo '<i class="far fa-star text-warning"></i>';
                                        }
                                    }
                                    ?>
                                </p>
                                <p><?= $row['Review'] ?></p>
                            </div>
                            <a href="edit-review.php?id=<?= $row['ReviewId']?> " class=''>Edit</a>
                            <a href="delete-review.php?id=<?= $row['ReviewId']?> " class=''>Delete</a>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php
} else {

    echo "Movie not found!";
}

mysqli_close($db);
require_once "includes/footer.php";
?>

