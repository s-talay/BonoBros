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
          alert(`${currentPlayer} wins!`);
          return;
        }
      }
      const isTie = [...cells].every(cell => cell.textContent !== "");
      if (isTie) {
        alert("It's a tie!");
      }
    }

    function restartGame() {
      cells.forEach(cell => {
        cell.textContent = "";
        cell.addEventListener("click", handleCellClick);
      });
      currentPlayer = "X";
    }

    restartBtn.addEventListener("click", restartGame);

    cells.forEach(cell => {
      cell.addEventListener("click", handleCellClick);
    });