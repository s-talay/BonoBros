<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../config.php";
session_start();

function check_session(): bool
{
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
        return true;
    } else {
        return false;
    }
}


if (!check_session()) {
    header('HTTP/1.0 403 Forbidden');
    die;
}


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header('Content-Type: application/json');
    #searches for lobbys with state and playerid
    if (isset($_GET['state']) && isset($_GET['playerid'])) {
        $state = $_GET['state'];
        $playerid = $_GET['playerid'];
        $stmt = $mysqli->prepare("SELECT l.lobbyid,l.state,g.gamename as 'Game',us1.Username as 'User 1' ,us2.Username as 'User 2'
                                FROM lobby as l
                                join users AS us1 ON us1.id = l.player1id 
                                left join users AS us2 ON us2.id = l.player2id
                                join game AS g ON g.gameid = l.gameid
                                WHERE state = ? 
                                AND (player1id=? OR player2id = ?)");
        $stmt->bind_param("sii", $state, $playerid, $playerid);
        $stmt->execute();
        $result = $stmt->get_result();
    } elseif (isset($_GET['state'])) {
        $state = $_GET['state'];
        $stmt = $mysqli->prepare("SELECT l.lobbyid,l.state,g.gamename as 'Game',us1.Username as 'User 1' ,us2.Username as 'User 2'
                            FROM lobby as l
                            join users AS us1 ON us1.id = l.player1id 
                            left join users AS us2 ON us2.id = l.player2id
                            join game AS g ON g.gameid = l.gameid
                            WHERE state = ?");
        $stmt->bind_param("s", $state);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $sql = "SELECT * FROM lobby";
        $result = $mysqli->query($sql);
    }


    if ($result->num_rows > 0) {
        // Output data of each row
        $data = [];
        while ($row = $result->fetch_assoc()) {
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
    if (isset($data['gameid'])) {
        $sql = "INSERT INTO lobby (state, gameid, player1id, player2id, winnerid) 
                    VALUES ('open', ?, ?, null, null)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ii", $data['gameid'], $_SESSION['id']);
        $stmt->execute();
        $stmt->close();

    }
    $stmt = $mysqli->prepare("SELECT * FROM lobby WHERE state = 'open' AND player1id = ? ORDER BY lobbyid desc LIMIT 1;");
    $stmt->bind_param("i", $_SESSION['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Output data of each row
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo "0 results";
    }

    $mysqli->close();

}
if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['lobbyid'])) {

        // Fetch the existing record
        $stmt = $mysqli->prepare("SELECT * FROM lobby WHERE lobbyid = ?");
        $stmt->bind_param("i", $data['lobbyid']);
        $stmt->execute();
        $result = $stmt->get_result();
        $existingData = $result->fetch_assoc();
        if ($existingData['player1id'] != $_SESSION['id'] && $existingData['state'] == "open") {
            // Use the existing values if the new ones are not provided
            $sql = "UPDATE lobby SET state='running',player2id=? WHERE lobbyid=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ii", $_SESSION['id'], $data['lobbyid']);
            $stmt->execute();
            $stmt->close();
            $mysqli->close();
        } else
            echo "Fehler";

    }
}

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['lobbyid'])) {

        // Fetch the existing record
        $stmt = $mysqli->prepare("SELECT * FROM lobby WHERE lobbyid = ?");
        $stmt->bind_param("i", $data['lobbyid']);
        $stmt->execute();
        $result = $stmt->get_result();
        $existingData = $result->fetch_assoc();
        if ($existingData['player1id'] == $_SESSION['id'] && $existingData['state'] == "open") {
            // Use the existing values if the new ones are not provided
            $sql = "DELETE FROM lobby WHERE lobbyid=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("i", $data['lobbyid']);
            $stmt->execute();
            $stmt->close();
            $mysqli->close();
        } else
            echo "Fehler";

    }
}
?>