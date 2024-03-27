<?php
require_once "includes/database.php";



// get review id from URL
$reviewId = $_GET['id'] ?? '';

// build query
$query = "SELECT final_review.*, final_movie.MovieTitle AS MovieTitle, final_movie.MovieId AS MovieId
          FROM final_review 
          JOIN final_movie ON final_review.MovieId = final_movie.MovieId
          WHERE final_review.ReviewId = '$reviewId'";

// execute query
$result = mysqli_query($db, $query) or die('Error loading review.');

// get review details from the database
if ($result && mysqli_num_rows($result) > 0) {
    $review = mysqli_fetch_assoc($result);
    $movieId = $review['MovieId'];
} else {
    $error = "Review not found.";
}



// if form was submitted
if(isset($_POST['update'])) {
    // get values from form
    $reviewId = $_POST['reviewId'] ?? '';
    $title = $_POST['title'] ?? '';
    $reviewContent = $_POST['review'] ?? '';
    $rating = $_POST['rating'] ?? '';
    $movieId = $_POST['movieId'] ?? '';

    // TODO: validate inputs

    // escape values to prevent SQL injection
    $title = mysqli_real_escape_string($db, $title);
    $reviewContent = mysqli_real_escape_string($db, $reviewContent);
    $rating = mysqli_real_escape_string($db, $rating);

    // query to update record
    $updateQuery = "UPDATE `final_review` SET 
                    `ReviewTitle` = '$title', 
                    `Review` = '$reviewContent', 
                    `Rating` = '$rating' 
                    WHERE `ReviewId` = '$reviewId'";

    // execute query
    $updateResult = mysqli_query($db, $updateQuery);

    // check if record was edited
    if($updateResult) {
        // redirect to the movie details page with MovieId
        if (!empty($movieId)) {
            header('Location: movie-details.php?MovieId=' . $review['MovieId']);
            exit;
        } else {
            $error = "MovieId is empty.";
        }
    } else {
        $error = "Failed to update review.";
    }
}

mysqli_close($db);
require_once "includes/header.php";
?>
<a href="movie-details.php?MovieId=<?= $movieId ?>" class="btn btn-outline-light">
    <i class="fas fa-arrow-left"></i> Back
</a>
<div class="row">
    <div class="col-md-6 mx-auto">
    <h1 class="mb-4">Edit Review</h1>
    <form method="post">
        <div class="form-group">
            <label for="title">Review Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $review['ReviewTitle'] ?? '' ?>">
        </div>
        <div class="form-group">
            <label for="review">Review:</label>
            <textarea class="form-control" id="review" name="review" rows="5"><?= $review['Review'] ?? '' ?></textarea>
        </div>
        <div class="form-group">
            <label for="movie">Movie:</label>
            <input type="text" class="form-control" id="movie" value="<?= $review['MovieTitle'] ?? '' ?>" disabled>
        </div>
        <div class="form-group">
            <label for="rating">Rating:</label>
            <select class="form-control" id="rating" name="rating">
                <option value="1" <?= $review['Rating'] == 1 ? 'selected' : '' ?>>⭐️</option>
                <option value="2" <?= $review['Rating'] == 2 ? 'selected' : '' ?>>⭐⭐️</option>
                <option value="3" <?= $review['Rating'] == 3 ? 'selected' : '' ?>>⭐⭐⭐️</option>
                <option value="4" <?= $review['Rating'] == 4 ? 'selected' : '' ?>>⭐⭐⭐⭐️</option>
                <option value="5" <?= $review['Rating'] == 5 ? 'selected' : '' ?>>⭐⭐⭐⭐⭐️</option>
            </select>
        </div>
        <input type="hidden" name="reviewId" value="<?= $reviewId ?>">
        <input type="hidden" name="movieId" value="<?= $review['MovieId'] ?? '' ?>">
        <button type="submit" name="update" class="btn btn-secondary">Update Review</button>
    </form>
</div>
</div>

<?php require_once "includes/footer.php"; ?>






