// contact number validate input
function validateinput(input) {
  input.value = input.value.replace(/[^0-9]/g, "");
}

// show college and department fields
function showFields(val) {
  var college_field = document.getElementById("college_div");
  var department_field = document.getElementById("department_div");

  if (val == 1) {
    college_field.style.setProperty("display", "block", "important");
    department_field.style.setProperty("display", "block", "important");
    setTimeout(function () {
      college_field.classList.add("active");
    }, 0);
    setTimeout(function () {
      department_field.classList.add("active");
    }, 100);
  } else if (val == 2) {
    college_field.style.setProperty("display", "none", "important");
    department_field.style.setProperty("display", "none", "important");
    college_field.classList.remove("active");
    department_field.classList.remove("active");
  }
}
