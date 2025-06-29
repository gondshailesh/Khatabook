//logout function
function logout() {
  fetch("logout.php")
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        window.location.href = data.redirect;
      }
    })
    .catch((err) => console.error("Logout failed:", err));
}

document.getElementById("status").addEventListener("change", function () {
  const status = this.value;
  const dateGivenGroup = document.getElementById("dateGivenGroup");
  const dateTakenGroup = document.getElementById("dateTakenGroup");

  if (status === "giver") {
    dateGivenGroup.style.display = "block";
    dateTakenGroup.style.display = "none";
  } else if (status === "taker") {
    dateGivenGroup.style.display = "none";
    dateTakenGroup.style.display = "block";
  }
});

// Initialize the display on page load
window.onload = function () {
  document.getElementById("status").dispatchEvent(new Event("change"));
};
document
  .getElementById("incomeForm")
  .addEventListener("submit", function (event) {
    // Get values
    let incomeSource = document.getElementById("incomeSource").value.trim();
    let totalAmount = document.getElementById("totalAmount").value.trim();

    // Validate if income source is not empty
    if (incomeSource === "") {
      alert("Please enter the income source");
      event.preventDefault(); // Stop form submission
      return false;
    }

    // Validate if total amount is a valid positive number
    if (totalAmount <= 0) {
      alert("Please enter a valid amount greater than zero");
      event.preventDefault(); // Stop form submission
      return false;
    }

    return true;
  });

// Function to toggle visibility of date input fields based on the status
function toggleDateFields() {
  var status = document.getElementById("status").value;
  var dateGivenGroup = document.getElementById("dateGivenGroup");
  var dateTakenGroup = document.getElementById("dateTakenGroup");

  if (status === "giver") {
    dateGivenGroup.style.display = "block"; // Show date of giving
    dateTakenGroup.style.display = "none"; // Hide date of taking
  } else if (status === "taker") {
    dateGivenGroup.style.display = "none"; // Hide date of giving
    dateTakenGroup.style.display = "block"; // Show date of taking
  }
}

// Initialize on page load to show the correct date field
document.addEventListener("DOMContentLoaded", function () {
  toggleDateFields();
});
