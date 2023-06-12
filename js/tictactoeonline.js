let currentPlayer = null;
let intervalID = null;
const cells = document.querySelectorAll("td");
let meData=null;

async function startGame() {
  const me = await fetch("/api/userid.php");
  console.log(me)
  meData = await me.json();
  cells.forEach(cell => {
    cell.textContent = "";
    cell.addEventListener("click", handleCellClick);
  });

  const lobbyResponse = await fetch("/api/tictactoe/checkLobby.php?lobbyid="+lobbyId);
  const lobbyData = await lobbyResponse.json();
  console.log(lobbyData);
  if (!lobbyData.active) {
    alert('The lobby is not active.');
    return;
  }

  fetchGameState(); // fetch initial game state
  intervalID = setInterval(fetchGameState, 5000); // fetch game state every 5 seconds
}
async function checkWin() {
  const winningCombinations = [
    ["00", "01", "02"],
    ["10", "11", "12"],
    ["20", "21", "22"],
    ["00", "10", "20"],
    ["01", "11", "21"],
    ["02", "12", "22"],
    ["00", "11", "22"],
    ["02", "11", "20"]
  ];

  const stateResponse = await fetch('/api/tictactoe/tictactoestate.php?lobbyid='+lobbyId);
  const stateData = await stateResponse.json();

  for (let i = 0; i < winningCombinations.length; i++) {
    const [a, b, c] = winningCombinations[i];
    const cellA = document.querySelector(`#cell${a}`);
    const cellB = document.querySelector(`#cell${b}`);
    const cellC = document.querySelector(`#cell${c}`);
    if (
      cellA.textContent !== "" &&
      cellA.textContent === cellB.textContent &&
      cellB.textContent === cellC.textContent
    ) {
      alert(`${cellA.textContent} wins!`);
      return;
    }
  }
  const isTie = stateData.gameOver && !stateData.winner;
  if (isTie) {
    alert("It's a tie!");
  }
}


async function fetchGameState() {
  const stateResponse = await fetch('/api/tictactoe/tictactoestate.php?lobbyid='+lobbyId);
  console.log(stateResponse)
  const stateData = await stateResponse.json();

  const historyResponse = await fetch('/api/tictactoe/tictactoehistory.php?lobbyid='+lobbyId);
  const historyData = await historyResponse.json();

  currentPlayer = stateData.currentPlayer;
  if(historyData){
    historyData.forEach(move => {
      console.log(move);
      const cell = document.querySelector(`#cell${move.cell}`);
      cell.textContent = move.player;
    });
  }
  // update all cells based on history data


  checkWin();
}

function handleCellClick(e) {
  const cell = e.target;
  if (cell.textContent !== "" || currentPlayer !== meData.id) { // only the current player can make a move
    console.log(currentPlayer)
    return;
  }
  
  cell.textContent = currentPlayer;
  updateMove(cell.id); // send your move to the server
  checkWin();
  fetchGameState();
}

async function updateMove(cellId) {
  cellId = cellId.substring(4);
  const response = await fetch('/api/tictactoe/updatemove.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({cell: cellId, lobbyid: lobbyId}),
  });
  console.log(response);
  //const data = await response.json();
  return response;
}

startGame();
