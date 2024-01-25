// contact number validate input
function validateinput(input) {
  input.value = input.value.replace(/[^0-9]/g, "");
}

// show college and department fields
function affiliation_effect() {
  var affiliation = document.querySelector(
    'input[name="affiliation"]:checked'
  ).value;
  var college_div = document.getElementById("college_div");
  var department_div = document.getElementById("department_div");

  if (affiliation === "Student" || affiliation === "Faculty") {
    college_div.style.setProperty("display", "block", "important");
    department_div.style.setProperty("display", "block", "important");
  } else {
    college_div.style.setProperty("display", "none", "important");
    department_div.style.setProperty("display", "none", "important");
  }
}

// Attach the function to the click event of the affiliation radio buttons
document
  .querySelectorAll('input[name="affiliation"]')
  .forEach(function (radio) {
    radio.addEventListener("click", affiliation_effect);
  });

// resend timer
function resend_timer() {
  var input_resend = document.getElementById("input_resend");
  var counter = 15;
  // add disabled attribute
  for (let i = counter; i > 0; i--) {
    // change value of resend to counter then wait 1 sec to change again
  }
  // remove disabled attribute
}
