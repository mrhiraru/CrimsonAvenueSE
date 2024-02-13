// preloader js
const loader_container = document.querySelector(".loader-container");
window.addEventListener("load", () => {
  loader_container.classList.add("fade-out-animation");
  setTimeout(() => {
    loader_container.style.display = "none";
  }, 5000);
});

// contact number validate input
function validateinput(input) {
  input.value = input.value.replace(/[^0-9]/g, "");
}

function validateinputsem(input) {
  // Remove any non-digit characters
  input.value = input.value.replace(/[^1-3]/g, "");

  // Ensure only one digit is allowed
  if (input.value.length > 1) {
    input.value = input.value.slice(0, 1);
  }
}

// show college fields
function affiliation_effect() {
  var affiliation = document.querySelector(
    'input[name="affiliation"]:checked'
  ).value;
  var college_div = document.getElementById("college_div");

  if (affiliation === "Student" || affiliation === "Faculty") {
    college_div.style.setProperty("display", "block", "important");
  } else {
    college_div.style.setProperty("display", "none", "important");
  }
}
// Attach the function to the click event of the affiliation radio buttons
document
  .querySelectorAll('input[name="affiliation"]')
  .forEach(function (radio) {
    radio.addEventListener("click", affiliation_effect);
  });

window.onload = function () {
  affiliation_effect();
};

// // real time clock timer
// function updateClock() {
//   // Fetch the server time using AJAX
//   $.ajax({
//     url: "../includes/get_time.php", // Replace with the correct server-side script
//     type: "GET",
//     success: function (serverTime) {
//       // Update the clock element
//       document.getElementById("timer").innerText = serverTime;

//       // Set the function to be called again after 1 second
//       setTimeout(updateClock, 1000);
//     },
//     error: function (xhr, status, error) {
//       console.error("Error fetching server time:", error);
//     },
//   });
// }

// window.onload = function () {
//   updateClock();
// };
