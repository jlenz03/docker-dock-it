<?php

require_once "includes/database.php";

// get review id from URL
$reviewId = $_GET['id'] ?? '';

// build query
$query = "SELECT final_review.*, final_movie.MovieTitle AS MovieTitle
                FROM final_review 
                JOIN final_movie ON final_review.MovieId = final_movie.MovieId
                WHERE final_review.ReviewId = '$reviewId'";

// execute query
$result = mysqli_query($db, $query) or die('Error loading review.');

// get review details from the database
$review = mysqli_fetch_array($result, MYSQLI_ASSOC);

// Check if the form is submitted for deletion
if(isset($_POST['delete'])) {
    // get review id to delete
    $reviewId = $_POST['reviewId'] ?? '';

    // query to delete review
    $deleteQuery = "DELETE FROM `final_review` 
                WHERE `final_review`.`ReviewId` = $reviewId
                LIMIT 1;";

    // execute deletion query
    $deleteResult = mysqli_query($db, $deleteQuery) or die("Error deleting review.");

    // check if review was deleted
    if($deleteResult) {
        // redirect to reviews page for the movie
        header('Location: movie-details.php?MovieId=' . $review['MovieId']);
        exit; // stop further execution
    } else {
        echo "Failed to delete review.";
    }
}

// close database connection
mysqli_close($db);
require_once "includes/header.php";
?>

<a href="movie-details.php?MovieId=<?= $review['MovieId'] ?>" class="btn btn-outline-light">
    <i class="fas fa-arrow-left"></i> Back
</a>
<div class=" mt-5 d-flex align-items-center justify-content-center">
    <div class="col text-center">
        <h1 class="mb-4">Delete Review</h1>
        <p>Are you sure you want to delete the review "<strong><?= $review['ReviewTitle'] ?></strong>" for the movie "<strong><?= $review['MovieTitle'] ?></strong>"?</p>
        <form method="post">
            <input type="hidden" name="reviewId" value="<?= $review['ReviewId'] ?>">
            <button type="submit" name="delete" class="btn btn-danger mt-3">Delete Review</button>
        </form>
    </div>
</div>

<?php require_once "includes/footer.php";
?>

