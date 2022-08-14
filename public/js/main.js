const game = document.getElementById("game");
const btnReset = document.getElementById("btnReset");
const gameBoard = [
  [null, null, null],
  [null, null, null],
  [null, null, null],
];

let l, c;
let player = "X";
let ocupate = 0;

btnReset.addEventListener("click", resetGame);
game.addEventListener("click", (e) => {
  const tg = e.target;
  l = parseInt(tg.getAttribute("l"));
  c = parseInt(tg.getAttribute("c"));
  if (gameBoard[l][c]) return;
  gameBoard[l][c] = player;
  tg.innerHTML = player;
  ocupate++;
  if (gameOver(l, c, player)) {
    alert(`Felicitari ${player}! Ai castigat.`);
    btnReset.disabled = false;
  } else if (ocupate == 9) {
    alert("gameul este remiza!");
    btnReset.disabled = false;
  } else {
    schimbaplayer();
  }
});

genereazagameBoard();

function gameOver(l, c, player) {
  let cnt = 0;
  for (let i = 0; i < 3; i++) {
    if (gameBoard[l][i] == player) cnt++;
  }
  if (cnt == 3) return true;
  cnt = 0;
  for (let i = 0; i < 3; i++) {
    if (gameBoard[i][c] == player) cnt++;
  }
  if (cnt == 3) return true;
  if (l == c) {
    cnt = 0;
    for (let i = 0; i < 3; i++) {
      if (gameBoard[i][i] == player) cnt++;
    }
  } else if (l + c == 2) {
    cnt = 0;
    for (let i = 0; i < 3; i++) {
      if (gameBoard[i][3 - i - 1] == player) cnt++;
    }
  }
  if (cnt == 3) return true;
  return false;
}
function resetGame() {
  for (let i = 0; i < 3; i++) {
    for (let j = 0; j < 3; j++) {
      gameBoard[i][j] = null;
    }
  }
  Array.from(document.querySelectorAll("div[l]")).forEach((x) => {
    x.textContent = null;
  });
  document.getElementById("player").textContent = player;
  ocupate = 0;
  btnReset.disabled = true;
}
function genereazagameBoard() {
  let l, c;
  for (let i = 0; i < 9; i++) {
    let e = document.createElement("div");
    l = Math.round((i + 2) / 3) - 1;
    c = Math.round(i % 3);
    e.setAttribute("l", l);
    e.setAttribute("c", c);
    game.appendChild(e);
  }
}
function schimbaplayer() {
  player = player == "X" ? "0" : "X";
  document.getElementById("player").textContent = player;
}
