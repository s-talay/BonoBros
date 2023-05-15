<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('log_errors', '0');
ini_set('error_log', './');
include "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header('Content-Type: application/json');
    $mysqli = openConnection();
    $sql = "SELECT * FROM lobby";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        $data = [];
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
    }
        echo json_encode($data);
    } else {
        echo "0 results";
    }
    $mysqli->close();

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    if(isset($data['state']) && 
        isset($data['gameid']) &&
        isset($data['player1id' ])){
            $mysqli = openConnection();
            $data['player2id'] = isset($data['player2id']) ? $data['player2id'] : null;
            $data['winnerid'] = isset($data['winnerid']) ? $data['winnerid'] : null;
            $sql = "INSERT INTO lobby (state, gameid, player1id, player2id, winnerid) 
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("siiii",$data['state'], $data['gameid'], $data['player1id'], $data['player2id'], $data['winnerid']);
            $stmt->execute();
            $stmt->close();
            $mysqli->close();
    }
    
}






?>
