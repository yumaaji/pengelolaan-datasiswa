var greetingElement = document.getElementById("greeting");
var time = new Date().getHours();

if (time >= 5 && time < 12) {
  greetingElement.textContent = "Selamat Pagi";
} else if (time >= 12 && time < 18) {
  greetingElement.textContent = "Selamat Siang";
} else {
  greetingElement.textContent = "Selamat Malam";
}
