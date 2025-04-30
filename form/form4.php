<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $_SESSION['first_name'] = $_POST['first_name'];
  $_SESSION['last_name'] = $_POST['last_name'];
  $_SESSION['birthdate'] = $_POST['birthdate'];
  $_SESSION['address'] = $_POST['address'];
  $_SESSION['unit'] = $_POST['unit'];
  $_SESSION['city'] = $_POST['city'];
  $_SESSION['state'] = $_POST['state'];
  $_SESSION['zip'] = $_POST['zip'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Step 4: Discounts & Education</title>
  <link rel="stylesheet" href="styles.css" />
</head>
<body>
  <div class="form-page">
    <h1>Step 4: Discounts</h1>
    <form action="form5.php" method="POST">
      <label for="credit_score">Your Credit Score</label>
      <select name="credit_score" id="credit_score" required>
        <option value="">Select</option>
        <option value="excellent">Excellent (720+)</option>
        <option value="good">Good (680-719)</option>
        <option value="average">Average (580-679)</option>
        <option value="poor">Poor (below 580)</option>
        <option value="not_sure">Not Sure</option>
      </select>

      <label for="student">Are you a current college student?</label>
      <select name="student" id="student" required>
        <option value="">Select</option>
        <option value="yes">Yes</option>
        <option value="no">No</option>
      </select>

      <label for="education">Highest Level of Education</label>
      <select name="education" id="education" required>
        <option value="">Select</option>
        <option value="none">No Diploma</option>
        <option value="highschool">High School / GED</option>
        <option value="associate">Associate's Degree</option>
        <option value="bachelor">Bachelor's Degree</option>
        <option value="master">Master's Degree</option>
        <option value="doctorate">Doctoral Degree</option>
      </select>

      <label for="license_age">What age did you get your first license?</label>
      <input type="number" name="license_age" id="license_age" min="16" max="80" required>

      <div class="form-buttons">
        <a href="../index.html" class="home-link">← Back to Home</a>
        <a href="form3.php" class="btn">Back</a>
        <button type="submit">Next</button>
      </div>
    </form>
  </div>
</body>
</html>