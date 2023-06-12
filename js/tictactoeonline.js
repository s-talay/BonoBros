let currentPlayer = null;
let intervalID = null;

async function startGame() {
  const lobbyResponse = await fetch('/api/tictactoe/checkLobby.php');
  const lobbyData = await lobbyResponse.json();

  if (!lobbyData.active) {
    alert('The lobby is not active.');
    return;
  }

  fetchGameState(); // fetch initial game state
  intervalID = setInterval(fetchGameState, 5000); // fetch game state every 5 seconds
}

async function fetchGameState() {
  const stateResponse = await fetch('tictactoestate.php');
  const stateData = await stateResponse.json();

  const historyResponse = await fetch('tictactoehistory.php');
  const historyData = await historyResponse.json();

  currentPlayer = stateData.currentPlayer;

  // update all cells based on history data
  historyData.moves.forEach(move => {
    const cell = document.querySelector(`#cell${move.cell}`);
    cell.textContent = move.player;
  });

  checkWin();
}

function handleCellClick(e) {
  const cell = e.target;
  if (cell.textContent !== "" || currentPlayer !== "X") { // only the current player can make a move
    return;
  }
  cell.textContent = currentPlayer;
  updateMove(cell.id, currentPlayer); // send your move to the server
  checkWin();
  togglePlayer();
}

async function updateMove(cellId, player) {
  const response = await fetch('updatemove.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({cell: cellId, player: player}),
  });
  const data = await response.json();
  return data;
}

startGame();
