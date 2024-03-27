<?php
require_once "includes/database.php";

// get movie id from url
$movieId = $_GET['id'] ?? '1';

// Fetch movie details
$query = "SELECT * FROM final_movie WHERE MovieId = '$movieId'";
$result = mysqli_query($db, $query) or die('Error loading movie.');

$movie = mysqli_fetch_assoc($result);

// if form was submitted
if(isset($_POST['add'])) {
    // get values from form
    $reviewTitle = $_POST['title'] ?? '';
    $review = $_POST['review'] ?? '';
    $rating = $_POST['rating'] ?? '';
    $firstName = $_POST['first'] ?? '';
    $lastName = $_POST['last'] ?? '';

    // TODO: validate inputs

    // query to add record
    $insertQuery = "INSERT INTO `final_review` 
                    (`MovieId`, `ReviewTitle`, `Review`, `Rating`, `FirstName`, `LastName`) 
                    VALUES 
                    ('$movieId', '$reviewTitle', '$review', '$rating', '$firstName', '$lastName')";

    // execute query
    $result = mysqli_query($db, $insertQuery);

    if($result) {
        // redirect to movie details page
        header('Location: movie-details.php?MovieId=' . $movieId);
        exit;
    } else {
        echo "Error adding review: " . mysqli_error($db);
    }
}

mysqli_close($db);
require_once "includes/header.php";
?>
<a href="movie-details.php?MovieId=<?= $movieId ?>" class="btn btn-outline-light">
    <i class="fas fa-arrow-left"></i> Back
</a>


<div class="container mt-5">
    <h1>Add Movie Review</h1>

    <form method="post">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="mb-3">
                    <label for="title" class="form-label">Review Title:</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="mb-3">
                    <label for="review" class="form-label">Review:</label>
                    <textarea type="text" class="form-control" id="review" name="review"></textarea>
                </div>
                <div class="mb-3">
                    <label for="movie" class="form-label">Movie:</label>
                    <input type="text" class="form-control" id="movie" value="<?= $movie['MovieTitle'] ?>" disabled>
                    <input type="hidden" name="movieId" value="<?= $movieId ?>">
                </div>
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating:</label>
                    <select class="form-select" id="rating" name="rating">
                        <option value="1">⭐️<i class="fas fa-star text-warning"></i></option>
                        <option value="2">⭐️⭐️<i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i></option>
                        <option value="3">⭐️⭐️⭐️<i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i></option>
                        <option value="4">⭐️⭐️⭐️⭐️ <i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i></option>
                        <option value="5">⭐️⭐️⭐️⭐️⭐️ <i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i></option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="first" class="form-label">First Name:</label>
                    <input type="text" class="form-control" id="first" name="first">
                </div>
                <div class="mb-3">
                    <label for="last" class="form-label">Last Name:</label>
                    <input type="text" class="form-control" id="last" name="last">
                </div>
                <button type="submit" name="add" class="btn btn-primary">Add Review</button>
            </div>
        </div>
    </form>
</div>

<?php require_once "includes/footer.php"; ?>

