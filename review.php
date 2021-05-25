<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Review Page</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="reviewPage.css">
</head>

<body>
    <?php
    // Get all reviews using PHP
    require_once 'dbconnection.php';
    $queryItemID = $_GET["itemID"];
    $sql = "SELECT productID, text, rating, Fname, Lname FROM reviews as R INNER JOIN users as U ON R.userID = U.userId WHERE productID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $queryItemID);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($productID, $reviewText, $rating, $Fname, $Lname);
    $productIDArray = array();
    $ratingArray = array();
    $reviewTextArray = array();
    $FnameArray = array();
    $LnameArray = array();
    $defaultImage = "https://res.cloudinary.com/cmpe272img/image/upload/v1621803021/default-image-620x600_rgcqhi.jpg";
    while ($stmt->fetch()) {
        array_push($productIDArray, $productID);
        array_push($ratingArray, $rating);
        array_push($reviewTextArray, $reviewText);
        array_push($FnameArray, $Fname);
        array_push($LnameArray, $Lname);
    }
    $len = count($reviewTextArray);
    ?>
    <div class="container">
        <h1 id='title'>Review Page</h1>
        <link rel="stylesheet" href="https://allyoucan.cloud/cdn/icofont/1.0.1/icofont.css" integrity="sha384-jbCTJB16Q17718YM9U22iJkhuGbS0Gd2LjaWb4YJEZToOPmnKDjySVa323U+W7Fv" crossorigin="anonymous">
        <div class="container">
            <div class="col-md-12">
                <div class="offer-dedicated-body-left">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="bg-white rounded shadow-sm p-4 mb-5 rating-review-select-page">
                            <form>
                                <div class="form-group">
                                    <div class="dropdown">
                                        <select class="form-select" aria-label="Default select example" id="rating" style="max-width: 20%;">
                                            <option selected value="0" disabled>Rating</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select><br>
                                        <label>Your Review</label>
                                        <textarea class="form-control" id="reviewBox"></textarea>
                                    </div><br>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm" type="button" id="submit"> Submit Review </button>
                                    </div>
                            </form>
                        </div>
                        <hr />
                        <div class="bg-white rounded shadow-sm p-4 mb-4 restaurant-detailed-ratings-and-reviews">
                            <h5 class="mb-1">All Ratings and Reviews</h5>
                            <!-- Check if reviews exist. if yes then render. -->
                            <?php if ($len == 0) {
                                echo "No reviews Found";
                            } else {
                                for ($i = 0; $i < $len; $i++) { ?>
                                    <div class="reviews-members pt-4 pb-4">
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="reviews-members-header">
                                                    <h6 class="mb-1"><i class="text-black" href="#"><?php echo $FnameArray[$i]; ?></i></h6>
                                                    <span style="color:grey">Rating: <?php echo $ratingArray[$i]; ?>/5</span>
                                                </div>
                                                <div class="reviews-members-body">
                                                    <p><?php echo $reviewTextArray[$i]; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                            <?php }
                            } ?>
                            <!-- <a class="text-center w-100 d-block mt-4 font-weight-bold" href="#">See All Reviews</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        //code to create an entry into the DB.
        // Values to insert into the DB are:
        // productID, userID, Review, Rating
        $('#submit').on('click', function(event) {
            const review_text = $('#reviewBox').val()
            const rating = $('#rating').val()
            // const userID = localStorage.getItem('userID');
            $.ajax({
                type: "POST",
                url: "./insertReview.php",
                data: {
                    name: "John",
                    review_text: review_text,
                    rating: rating
                }
            }).done(function(msg) {
                console.log("Data Saved: " + msg);
            });
        })
    </script>
</body>

</html>