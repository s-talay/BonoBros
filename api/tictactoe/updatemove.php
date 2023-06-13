<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../../config.php";
session_start();

function checkWin($moves)
{
    $winningCombinations = [
        ["00", "01", "02"],
        ["10", "11", "12"],
        ["20", "21", "22"],
        ["00", "10", "20"],
        ["01", "11", "21"],
        ["02", "12", "22"],
        ["00", "11", "22"],
        ["02", "11", "20"]
    ];

    $board = array_fill_keys(range(0, 2), array_fill_keys(range(0, 2), null));

    foreach ($moves as $move) {
        $board[$move['cell'][0]][$move['cell'][1]] = $move['player'];
    }

    foreach ($winningCombinations as $combo) {
        $first = $board[$combo[0][0]][$combo[0][1]];
        if ($first && $first == $board[$combo[1][0]][$combo[1][1]] && $first == $board[$combo[2][0]][$combo[2][1]]) {
            return $first; // Return the winning player's ID
        }
    }

    return false;
}

function checkTie($moves)
{
    $board = array_fill_keys(range(0, 2), array_fill_keys(range(0, 2), null));

    foreach ($moves as $move) {
        $board[$move['cell'][0]][$move['cell'][1]] = $move['player'];
    }

    foreach ($board as $row) {
        foreach ($row as $cell) {
            if (is_null($cell)) {
                return false;
            }
        }
    }

    return true;
}

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['lobbyid']) && isset($data['cell'])) {
        $pattern = "/[0-9][0-9]/";
        if (preg_match($pattern, $data['cell'])) {
            $sql = "SELECT * FROM moves_tictactoe WHERE lobbyid = ? AND movetype = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("is", $data['lobbyid'], $data['cell']);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows == 0) {
                $stmt->close();
                $sql = "INSERT INTO moves_tictactoe (lobbyid, playerid, movetype) 
                VALUES (?, ?, ?)";
                $stmt = $mysqli->prepare($sql);
                echo ($data['lobbyid'] & $data['cell']);
                $stmt->bind_param("iis", $data['lobbyid'], $_SESSION['id'], $data['cell']);
                $stmt->execute();
                $stmt->close();

                $stmt = $mysqli->prepare("SELECT m.movetype as cell,m.playerid as player
                                FROM moves_tictactoe as m
                                WHERE m.lobbyid = ?");
                $stmt->bind_param("i", $data['lobbyid']);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    // Output data of each row
                    $moves = [];
                    while ($row = $result->fetch_assoc()) {
                        $moves[] = $row;
                    }
                    echo json_encode($moves);
                } else {
                    echo json_encode(null);
                }
                $stmt->close();
                if (checkwin($moves)) {
                    $winner = checkwin($moves);
                    $stmt = $mysqli->prepare("UPDATE lobby SET state='closed', winnerid=? WHERE lobbyid=?");
                    $stmt->bind_param("ii", $winner, $data['lobbyid']);
                    $stmt->execute();
                    $stmt->close();
                } elseif (checkTie($moves)) {
                    $stmt = $mysqli->prepare("UPDATE lobby SET state='closed' WHERE lobbyid=?");
                    $stmt->bind_param("i", $data['lobbyid']);
                    $stmt->execute();
                    $stmt->close();
                }
                header('HTTP/1.0 200 OK');
                echo ('{"response":"ok"}');
            } else {
                header('HTTP/1.0 400 Error');
                echo ("Zug Existiert schon");
            }
        }
    }

    $mysqli->close();

}