<?php
require_once "includes/header.php";
require_once "includes/database.php";

// Get the MovieId from the URL
$movieId = $_GET['MovieId'] ?? '';

// Query to fetch details of the specific movie using MovieId
$query = "SELECT * FROM final_movie WHERE MovieId = $movieId";

$result = mysqli_query($db, $query);

if (!$result) {
    die('Error in query: ' . mysqli_error($db));
}

// Fetch the movie details
$row = mysqli_fetch_assoc($result);

// Display the movie details
?>
<body>

    <div class="row  d-flex justify-content-center">
        <div class="col-md-8 mb-4">
            <div class="movie-details">
                <div class="movie-image">
<!--                    <img src="images/--><?//= $row['MovieImage'] ?><!--" class="img-fluid" alt="--><?//= $row['MovieTitle'] ?><!--">-->
                    <img src="images/stone.jpg" class="img-fluid" alt="<?= $row['MovieTitle'] ?>">
                </div>
                <div class="movie-info">
                    <h2><?= $row['MovieTitle'] ?></h2>
                    <p>
                        The story follows a young boy named Harry Potter, who discovers on his eleventh birthday that he is a wizard. He receives an invitation to attend Hogwarts School of Witchcraft and Wizardry. Along with his newfound friends Ron Weasley and Hermione Granger, Harry embarks on a journey of magical discovery.

                        At Hogwarts, Harry learns about his past, his famous status as "The Boy Who Lived," and the dark wizard Voldemort who killed his parents. The trio investigates a mystery surrounding the Sorcerer's Stone, an object with the power to grant immortality.

                    </p>
<!--                    <p>--><?//= $row['MovieDescription'] ?><!--</p>-->
                    <!-- You can display more details as needed -->
                    <a href="reviews.php?MovieId=<?= $row['MovieId'] ?>" class="btn btn-primary">View Reviews</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

<?php
mysqli_close($db);
require_once "includes/footer.php";
?>

