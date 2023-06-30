const cells = document.querySelectorAll("td");
const restartBtn = document.querySelector("#restart");
let currentPlayer = "X";

function handleCellClick(e) {
  const cell = e.target;
  if (cell.textContent !== "") {
    return;
  }

  cell.textContent = currentPlayer;
  checkWin();
  togglePlayer();
}

function togglePlayer() {
  currentPlayer = currentPlayer === "X" ? "O" : "X";
}

function checkWin() {
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
      cells.forEach(cell => cell.removeEventListener("click", handleCellClick));
      fancyAlert(`${currentPlayer} wins!`);
      return;
    }
  }
  const isTie = [...cells].every(cell => cell.textContent !== "");
  if (isTie) {
    fancyAlert("It's a tie!");
  }
}

function restartGame() {
  cells.forEach(cell => {
    cell.textContent = "";
    cell.addEventListener("click", handleCellClick);
  });
  currentPlayer = "X";
}

function fancyAlert(msg) {
  if ($("#myDialog").length === 0) { // Check if dialog is already open
    $("<div id='myDialog'>" + msg + "</div>").dialog({
      title: "Alert",
      modal: true,
      buttons: {
        OK: function () {
          $(this).dialog("close");
          $(this).dialog("destroy");
          $("#myDialog").remove();
        }
      },
      close: function () {
        $(this).dialog("destroy");
        $("#myDialog").remove();
      }
    });
  }
}

restartBtn.addEventListener("click", restartGame);

cells.forEach(cell => {
  cell.addEventListener("click", handleCellClick);
});