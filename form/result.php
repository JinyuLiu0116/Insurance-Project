<?php
session_start();
if (!isset($_SESSION['coverage'])) {
  header("Location: form7.php");
  exit;
}

// Base rate based on selected coverage
$base = match ($_SESSION['coverage']) {
  'liability_only' => 90,
  'balanced'       => 120,
  'full_coverage'  => 160,
  default          => 100
};

$birth_year = !empty($_SESSION['birthdate']) ? (int)date('Y', strtotime($_SESSION['birthdate'])) : null;
$current_year = (int)date('Y');
$current_age = $birth_year ? ($current_year - $birth_year) : 0;

$license_age = isset($_SESSION['license_age']) ? (int)$_SESSION['license_age'] : 0;
$years_with_license = $current_age - $license_age;
if (isset($_SESSION['student']) && $_SESSION['student'] === 'yes') {
  $base -= 10; 
}


$educated = ['associate', 'bachelor', 'master', 'doctorate'];
if (isset($_SESSION['education']) && in_array($_SESSION['education'], $educated)) {
  $base -= 10;
}

if ($years_with_license < 2) {
  $base += 25;
} elseif ($years_with_license < 4) {
  $base += 15;
} elseif ($years_with_license >= 4) {
  $base -= 15;
}
if ($_SESSION['miles'] > 15000)           $base += 10;
elseif ($_SESSION['miles'] < 6000)        $base -= 5;

if ($_SESSION['accident'] === 'yes')      $base += 20;
if ($_SESSION['dui'] === 'yes')           $base += 35;
if ($_SESSION['reckless'] === 'yes')      $base += 25;

if ($_SESSION['credit_score'] === 'excellent') $base -= 10;
elseif ($_SESSION['credit_score'] === 'poor')  $base += 20;

// Fake quote companies                              90 + number = 123 
$quotes = [
  ['company' => 'Falcon Auto',     'logo' => 'assets/falcon.png',     'price' => $base + rand(-5, 10)],
  ['company' => 'Zenith Insurance','logo' => 'assets/zenith.png',     'price' => $base + rand(0, 15)],
  ['company' => 'SafeShield',      'logo' => 'assets/safeshield.png', 'price' => $base + rand(-2, 20)],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Quotes</title>
  <link rel="stylesheet" href="styles.css" />
  <style>
    .quote-card {
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 1.5rem;
      margin-bottom: 1.5rem;
      background-color: #fff;
      text-align: center;
    }
    .quote-card img {
      max-width: 120px;
      margin-bottom: 0.5rem;
    }
    .price {
      font-size: 1.25rem;
      font-weight: bold;
      margin: 0.5rem 0;
    }
    button {
      background-color: #28a745;
      color: white;
      border: none;
      padding: 0.6rem 1.2rem;
      font-weight: bold;
      border-radius: 4px;
      cursor: pointer;
    }
    button:hover {
      background-color: #218838;
    }
  </style>
</head>
<body>
  <div class="form-page">
    <h1>Here Are Your Quotes</h1>
    <?php foreach ($quotes as $quote): ?>
      <div class="quote-card">
        <img src="<?= htmlspecialchars($quote['logo']) ?>" alt="<?= htmlspecialchars($quote['company']) ?> logo" />
        <h2><?= htmlspecialchars($quote['company']) ?></h2>
        <p class="price">$<?= $quote['price'] ?> / month</p>
        <form action="thank-you.html" method="post">
          <button type="submit">Select This Quote</button>
        </form>
      </div>
    <?php endforeach; ?>
  </div>
</body>
</html>