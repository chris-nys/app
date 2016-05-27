<!DOCTYPE html>
<html>
<head>
<title>Chris' App</title>
<style>
#header {
	border-bottom: solid gray 2px;
	padding-bottom: 6px;
	margin-bottom: 24px;
}
h1 {
	margin: 0;
}
#head-img {
	margin: 0;
	
}
.left {
    float: left;
    margin-left: 30px;
    border: solid gray 2px;
    padding: 8px;
    clear: right;
    font-size: x-large;
    color: white;
}
.right {
	float: right;
	margin-right: 30px;
	border: solid gray 2px;
    padding: 8px;
    margin-bottom: 12px;
    font-size: x-large;
    color: white;
}
.container {
	border-style: groove;
	overflow: auto;
	padding: 24px;
}
</style>
</head>
<body background="http://0.media.dorkly.cvcdn.com/30/92/91df1f660211028cb2283d7f3ddf07e3.jpg">
	<div id="header">
		<h1 align="left">Chris' App</h1>
	</div>
<?php
//include db creds
include 'db_conn.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// update database for last login time
$sql = "SELECT address, date FROM user_data ORDER BY id DESC LIMIT 0, 1";
$result = $conn->query($sql);

$current_ip = $_SERVER['REMOTE_ADDR'];
$current_date = date('l F jS Y h:i:s A');

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$last_login = $row['date'];
    	$last_address = $row['address'];
    	$sql = "INSERT INTO user_data (address, date) VALUES ('$current_ip', '$current_date')";
    }
} else {
    //update the login time
    	$last_login = "never";
    	$last_address = "nowhere";
    	$sql = "INSERT INTO user_data (address, date)
VALUES ('$current_ip', '$current_date')";
    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// now query for words
$sql = "SELECT id, word, last_word FROM app_data";
$result = $conn->query($sql);

//open the container div
echo "<div class='container'>";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //add an exclamation point if it's the last word
        if ($row['last_word']) {
	        $word = $row['word'] . "!";
        } else {
	        $word = $row['word'];
        }
        //decide whether to shift the div left or right
        if ($row['id'] % 2 == 0){
        echo "<div class='right'> $word</div>";
        } else {
		echo "<div class='left'>$word</div>";
		}
    }
} else {
    echo "No words :(";
}
//close db connection
$conn->close();

//close the container div
echo "</div>";
?>
</body>
<footer>
  <p>Last login was: <?php echo $last_login . " from " . $last_address; ?></p>
</footer>
</html>
