<?php
require_once "includes/database.php";

// get movie id from url
$movieId = $_GET['id'] ?? '1';

// Fetch movie details
$query = "SELECT * FROM final_movie WHERE MovieId = ?";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, "s", $movieId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$movie = mysqli_fetch_assoc($result);

// if form was submitted
if(isset($_POST['add'])) {
    // get values from form
    $reviewTitle = $_POST['title'] ?? '';
    $review = $_POST['review'] ?? '';
    $rating = $_POST['rating'] ?? '';
    $firstName = $_POST['first'] ?? '';
    $lastName = $_POST['last'] ?? '';

    // Prepare insert statement
    $insertQuery = "INSERT INTO `final_review` 
                    (`MovieId`, `ReviewTitle`, `Review`, `Rating`, `FirstName`, `LastName`) 
                    VALUES 
                    (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $insertQuery);
    mysqli_stmt_bind_param($stmt, "isssss", $movieId, $reviewTitle, $review, $rating, $firstName, $lastName);

    // execute query
    $result = mysqli_stmt_execute($stmt);

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

    <form method="post" accept-charset="UTF-8">
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
                        <option value="1">⭐️</option>
                        <option value="2">⭐️⭐️</option>
                        <option value="3">⭐️⭐️⭐</option>
                        <option value="4">⭐️⭐️⭐️⭐️ </option>
                        <option value="5">⭐️⭐️⭐️⭐️⭐️</option>
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

