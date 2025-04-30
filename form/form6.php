<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $_SESSION['accident'] = $_POST['accident'];
  $_SESSION['dui'] = $_POST['dui'];
  $_SESSION['reckless'] = $_POST['reckless'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Step 6: Insurance Status</title>
  <link rel="stylesheet" href="styles.css" />
  <script>
    function toggleDetails() {
      const insured = document.getElementById("insured").value;
      const section = document.getElementById("insurance-details");
      section.style.display = insured === "yes" ? "block" : "none";
    }
  </script>
</head>
<body>
  <div class="form-page">
    <h1>Step 6: Current Auto Insurance</h1>
    <form action="form7.php" method="POST">
      <label for="insured">Are you currently insured?</label>
      <select name="insured" id="insured" onchange="toggleDetails()" required>
        <option value="">Select</option>
        <option value="yes">Yes</option>
        <option value="no">No</option>
      </select>

      <div id="insurance-details" style="display:none;">
        <label for="current_provider">Current Insurance Provider</label>
        <select name="current_provider" id="current_provider">
          <option value="">Select</option>
          <option value="GEICO">GEICO</option>
          <option value="Progressive">Progressive</option>
          <option value="State Farm">State Farm</option>
          <option value="Allstate">Allstate</option>
          <option value="Other">Other</option>
        </select>

        <label for="years_insured">How many years have you been insured with them?</label>
        <input type="number" name="years_insured" id="years_insured" min="0" max="99">

        <label for="monthly_payment">Monthly Premium ($)</label>
        <input type="number" name="monthly_payment" id="monthly_payment" step="0.01">
      </div>

      <div class="form-buttons">
        <a href="../index.html" class="home-link">← Back to Home</a>
        <a href="form5.php" class="btn">Back</a>
        <button type="submit">Next</button>
      </div>
    </form>
  </div>
</body>
</html>