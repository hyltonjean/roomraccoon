// Step 1 - Get the item from input field
const form = document.getElementById("itemform");
form.addEventListener("submit", e => {
  let value = document.getElementById("item").value;
  if (value.length == 0) {
    alert("Please enter a shopping item");
    e.preventDefault();
  }
});

// Hide alerts
var close = document.getElementsByClassName("close");

function hide() {
  this.parentElement.remove();
  return false;
}

for (var i = 0; i < close.length; i++) {
  close[i].addEventListener("click", hide, false);
}
