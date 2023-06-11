// DOM要素を参照
const elementButton = document.querySelector("#buttonExecute");

// イベントを登録
elementButton.addEventListener("click", update);

/** 計算し画面に結果を表示します。 */
function update() {
  // 要素を参照
  const elementNum1 = document.querySelector("#num1");
  const elementNum2 = document.querySelector("#num2");
  const elementResult = document.querySelector("#result");

  // フォーム値を取得
  const num1 = Number(elementNum1.value);
  const num2 = Number(elementNum2.value);

  // 足し算を行う
  const result = num1 + num2;

  // 画面に表示
  elementResult.innerHTML = result; // テキストを代入
}
