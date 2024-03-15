<?php
require_once "includes/header.php";
require_once "includes/database.php";

$code = $_GET['MovieId'] ?? '';

$query = "SELECT *FROM final_movie WHERE MovieId = 'MovieId'";
$result =mysqli_query($db,$query) or die ('Error in Query');
$customer = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>
<body>

</body>
</html>
<?php
// query to rn on the database
$sort= $_GET['sort'] ?? 'MovieTitle';
$query= "SELECT final_movie.MovieTitle AS Movie, final_review.ReviewId,  final_review.Rating AS Rating, final_review.ReviewTitle AS Title, final_review.Review AS Review, final_review.FirstName AS FirstName, final_review.LastName AS LastName
        FROM final_review
        JOIN final_movie ON final_movie.MovieId = final_review.MovieId
        WHERE final_movie.MovieId = '$code'
        ORDER BY $sort";


// run the query
//$result = @mysqli_query($db, $query) or die('Error in query');
//in development
$result = @mysqli_query($db, $query) or die('Error in query'.mysqli_error($db));
?>
<?php
//loop through results
//EACH  time mysqli_fetch_array is called, it retrieves the next record
while($row= mysqli_fetch_array($result,MYSQLI_ASSOC)){
//$row represents a record in database
//echo $row['Name'] . '<br>';
?>
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-4">
            <div class="movie-details">
                <div class="review-image">
                    <!--                 <img src="images/--><?//= $row['MovieImage'] ?><!--" class="img-fluid" alt="--><?//= $row['MovieTitle'] ?><!--">-->
                    <img src="images/stone.jpg" class="img-fluid" alt="<?= $row['Movie'] ?>">
                </div>
                <div class="movie-info">
                    <h2><?=$row['Title'] ?></h2>

                    <p>
                        <?=$row['FirstName'] ?>
                        <?=$row['LastName'] ?>
                        <?=$row['Rating'] ?>
                    </p>
                    <p><?=$row['Movie'] ?></p>
                    <p><?=$row['Review'] ?></p>
                    <!-- You can display more details as needed -->

                </div>
            </div>
        </div>
    </div>
</div>



<!--<table class="table table-striped table-hover">-->
<!--    <thead>-->
<!--    <tr>-->
<!--        <th> <a href="?sort=MovieTitle"> Movie Title</a></th>-->
<!--        <th> <a href="?sort=Rating">Rating</a></th>-->
<!--        <th> <a href="?sort=ReviewTitle">Title</a></th>-->
<!--        <th> <a href="?sort=Review">Review</a></th>-->
<!--        <th> <a href="?sort=FirstName">First Name</a></th>-->
<!--        <th><a href="?sort=LastName"> Last Name</a></th>-->
<!---->
<!--    </tr>-->
<!--    </thead>-->
<!--    <tbody>-->
<!---->
<!--    <tr>-->
<!---->
<!---->
<!--        <td>--><?//=$row['Movie'] ?><!-- </td>-->
<!--        <td>--><?//=$row['Rating'] ?><!-- </td>-->
<!--        <td>--><?//=$row['Title'] ?><!-- </td>-->
<!--        <td>--><?//=$row['Review'] ?><!-- </td>-->
<!--        <td>--><?//=$row['FirstName'] ?><!-- </td>-->
<!--        <td>--><?//=$row['LastName'] ?><!-- </td>-->
<!--        <td>-->
<!--            <a href="edit-review.php?id=--><?//= $row['ReviewId']?><!-- " class='btn btn-sm btn-secondary'>Edit</a>-->
<!--        </td>-->
<!--        <td>-->
<!--            <a href="add-review.php?id=--><?//= $row['ReviewId']?><!-- " class='btn btn-sm btn-secondary'>Add</a>-->
<!--        </td>-->
<!--        <td>-->
<!--            <a href="delete-review.php?id=--><?//= $row['ReviewId']?><!-- " class='btn btn-sm btn-secondary'>Delete</a>-->
<!--        </td>-->
<!---->
<!---->
<!--    </tr>-->
<!--    </tbody>-->
<!--    --><?php
    }
//
//    //close database connection
//    //usually done in footer of page
//    mysqli_close($db);
//    ?>
<!---->
<!---->
<!---->
<!---->
<!---->
<!---->
<!--</table>-->
<?php
require_once "includes/footer.php";
?>

