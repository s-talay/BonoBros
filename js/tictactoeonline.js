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
  intervalID = setInterval(fetchGameState, 500); // fetch game state every 5 seconds
}


async function fetchGameState() {
  const stateResponse = await fetch('/api/tictactoe/tictactoestate.php?lobbyid='+lobbyId);
  
  const stateData = await stateResponse.json();
  console.log(stateData);
  if(stateData.username == null && stateData.state == "closed"){
    alert("Es ist ein Unentschieden");
    clearInterval(intervalID);
  }else if(stateData.username != null && stateData.state == "closed"){
    alert("Der Sieger ist "+stateData.username);
    clearInterval(intervalID);
  }
  changeTurnTitle();


  const historyResponse = await fetch('/api/tictactoe/tictactoehistory.php?lobbyid='+lobbyId);
  const historyData = await historyResponse.json();

  currentPlayer = stateData.currentPlayer;
  // update all cells based on history data
  if(historyData){
    historyData.forEach(move => {
      console.log(move);
      const cell = document.querySelector(`#cell${move.cell}`);
      cell.textContent = (meData.id == move.player)?"X":"O";
    });
  }
  
}

function handleCellClick(e) {
  const cell = e.target;
  if (cell.textContent !== "" || currentPlayer !== meData.id) { // only the current player can make a move
    console.log(currentPlayer)
    return;
  }
  
  // cell.textContent = currentPlayer; // nicht nötig passiert eh später
  updateMove(cell.id); // send your move to the server
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
   console.log(await response);
  //const data = await response.json();
}

async function changeTurnTitle(){
  const res = await fetch('/api/tictactoe/turntitle.php?lobbyid='+lobbyId);
  const data = await res.json();
  console.log(meData.id +" : "+currentPlayer);
  if(currentPlayer == null){
    $("#itsTurn span").text(data.User1+"´s");
    return;
  }
  if(meData.id === currentPlayer){
    if(meData.username == data.User1){
      $("#itsTurn span").text(data.User1+"´s");
    }else{
      $("#itsTurn span").text(data.User2+"´s");  
    }
  }else{
    if(meData.username == data.User1){
      $("#itsTurn span").text(data.User2+"´s");
    }else{
      $("#itsTurn span").text(data.User1+"´s");
    }
  }

}
startGame();
