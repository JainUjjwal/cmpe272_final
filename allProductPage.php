<!DOCTYPE html>

<head>
    <title>Products Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" integrity="sha384-wESLQ85D6gbsF459vf1CiZ2+rr+CsxRY0RpiF1tLlQpDnAgg6rwdsUF1+Ics2bni" crossorigin="anonymous">
</head>

<body>
    <div id="data"></div>
    
    <?php
    require_once 'dbconnection.php';
    $queryWebsiteName = $_GET["products"];
    $sql = "SELECT productID, productName, websiteName, cost, productData FROM products WHERE websiteName = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $queryWebsiteName);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($productID, $productName, $websiteName, $cost, $productData);
    $productIDArray = array();
    $websiteNameArray = array();
    $productNameArray = array();
    $costArray = array();
    $productDataArray = array();
    while ($stmt->fetch()) {
        array_push($productIDArray, $productID);
        array_push($productNameArray, $productName);
        array_push($websiteNameArray, $websiteName);
        array_push($costArray, $cost);
        array_push($productDataArray, $productData);
    }
    $len = count($productIDArray);
    if($len == 0){
        echo "No Products Found";
    }
    for ($i = 0; $i < $len; $i=$i+4) {
    ?>
    <div class="row">
        <?php for($j = 0; $j<4; $j++){ 
            if($i+$j<$len){?>
                <div class="col-sm">
                    <div class="card" style="width: 18rem; margin-top:20px">
                        <!-- <img src="..." class="card-img-top" alt="..."> -->
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $productNameArray[$i+$j] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">$<?php echo $costArray[$i+$j] ?></h6>
                            <p class="card-text"><?php echo $productDataArray[$i+$j] ?></p>
                            <a href="/item/?itemID=<?php echo $productIDArray[$i+$j]?>" class="btn btn-primary" >Review product</a>
                        </div>
                    </div>
                </div>
        <?php
        }
     }?>
    </div>
    
    <?php
    }
    ?>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        let userIds = <?php echo json_encode($userIdArray); ?>;
        let emails = <?php echo json_encode($emailArray); ?>;
        console.log(emails)
        $('#data').html(emails + ' ')
    </script> -->
</body>