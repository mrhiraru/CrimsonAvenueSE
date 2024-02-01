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

// settings.college js

// Variable to store the previously clicked item's ID
var previousItemId = null;

document
  .querySelectorAll('[id^="college-edit"][data-id]')
  .forEach(function (element) {
    element.onclick = function () {
      // Get the data-id attribute value
      var itemId = this.getAttribute("data-id");

      // Revert changes from the previously clicked item
      if (previousItemId !== null) {
        revertChanges(previousItemId);
      }

      // Apply changes for the current clicked item
      applyChanges(itemId);

      // Update the URL with the current itemId
      updateUrl(itemId);

      // Update the previousItemId to the current one
      previousItemId = itemId;
    };
  });

document
  .querySelectorAll('[id^="college-cancel"][data-id]')
  .forEach(function (element) {
    element.onclick = function () {
      // Get the data-id attribute value
      var itemId = this.getAttribute("data-id");

      // Revert changes from the previously clicked item
      if (previousItemId !== null) {
        revertChanges(previousItemId);

        // Update the URL to remove the 'id' parameter
        updateUrl(null);

        // Reset the previousItemId since it's a cancel action
        previousItemId = null;
      }
    };
  });

// Function to apply changes for the clicked item
function applyChanges(itemId) {
  var collegeItem = document.getElementById("college-item" + itemId);
  var mainButtons = document.getElementById("main-buttons" + itemId);
  var editButtons = document.getElementById("edit-buttons" + itemId);

  collegeItem.disabled = false;
  collegeItem.style.cssText =
    "border-bottom: solid 1px var(--primary) !important;";
  editButtons.style.setProperty("display", "block", "important");
  mainButtons.style.setProperty("display", "none", "important");
}

// Function to revert changes from the previously clicked item
function revertChanges(itemId) {
  var collegeItem = document.getElementById("college-item" + itemId);
  var mainButtons = document.getElementById("main-buttons" + itemId);
  var editButtons = document.getElementById("edit-buttons" + itemId);

  collegeItem.disabled = true;
  collegeItem.style.cssText = "border-bottom: none";
  editButtons.style.setProperty("display", "none", "important");
  mainButtons.style.setProperty("display", "block", "important");
}

// Function to update the URL with the 'id' parameter
function updateUrl(itemId) {
  var currentUrl = window.location.href;

  if (itemId !== null) {
    // Add or update the 'id' parameter based on the itemId
    var newUrl = currentUrl.includes("?id=")
      ? currentUrl.replace(/(\?id=)[^&]+/, "?id=" + itemId)
      : currentUrl + (currentUrl.indexOf("?") !== -1 ? "&id=" + itemId : "?id=" + itemId);
  } else {
    // Remove the 'id' parameter
    var newUrl = currentUrl.replace(/(\?id=)[^&]+/, "");
    newUrl = newUrl.endsWith("&") ? newUrl.slice(0, -1) : newUrl; // Remove trailing "&" if needed
  }

  // Use replaceState to update the URL without reloading the page
  window.history.replaceState({ path: newUrl }, "", newUrl);
}
