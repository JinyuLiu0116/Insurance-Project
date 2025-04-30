<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['coverage'])) {
  $_SESSION['coverage'] = $_POST['coverage'];
}

$data = $_SESSION;

$host = 'localhost';
$user = 'root';
$password = '8551649';
$db = 'autoquote';

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$birthdate = (!empty($data['birthdate']) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $data['birthdate']))
  ? $data['birthdate']
  : null;

$miles = isset($data['miles']) ? (int)$data['miles'] : 0;
$license_age = isset($data['license_age']) ? (int)$data['license_age'] : 0;
$years_insured = isset($data['years_insured']) ? (int)$data['years_insured'] : 0;
$monthly_payment = isset($data['monthly_payment']) ? (float)$data['monthly_payment'] : 0.00;

$sql = "INSERT INTO quotes (
  year, make, model, ownership, `usage`, miles,
  first_name, last_name, birthdate,
  address, unit, city, state, zip,
  credit_score, student, education, license_age,
  accident, dui, reckless, insured,
  current_provider, years_insured, monthly_payment, coverage
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
  "sssssisssssssisssisssssiis",
  $data['year'], $data['make'], $data['model'], $data['ownership'], $data['usage'], $miles,
  $data['first_name'], $data['last_name'], $birthdate,
  $data['address'], $data['unit'], $data['city'], $data['state'], $data['zip'],
  $data['credit_score'], $data['student'], $data['education'], $license_age,
  $data['accident'], $data['dui'], $data['reckless'], $data['insured'],
  $data['current_provider'], $years_insured, $monthly_payment, $data['coverage']
);

if ($stmt->execute()) {
  
  header("Location: results.php");
  exit;
} else {
  echo "<h2>Error: " . $stmt->error . "</h2>";
}

$stmt->close();
$conn->close();
session_destroy(); 
?>