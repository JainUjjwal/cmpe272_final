<!DOCTYPE html>
<head>
    <title>Products Page</title>
</head>
<body>
    <div id="data"></div>
    <?php
        require_once 'dbconnection.php';
        echo "We did it";
        $sql = "SELECT userId, email FROM users";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($userId, $email);
        $emailArray = array();
        $userIdArray = array();
        while ($stmt->fetch()) {
            array_push($userIdArray, $userId);
            array_push($emailArray, $email);
        }
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        let userIds = <?php echo json_encode($userIdArray); ?>;
        let emails = <?php echo json_encode($emailArray); ?>;
        console.log(emails)
        $('#data').html(emails + ' ')
    </script>
</body>