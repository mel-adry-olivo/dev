<?php

session_start();

require './includes/templates.php';
require './includes/icons.php';
require './includes/db-utils.php';

$conn = require './includes/db-conn.php';

if (!isset($_SESSION['referer']) ) {
    $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
}

$userId = $_SESSION['user_id'] ?? null;
$reserved = getReservedProducts($conn, $userId);
$count = count($reserved);
$title = 'Reservations | INSPEC®';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="./assets/images/icons/favicon.ico" type="image/x-icon">
    <script type="module" src="./assets/js/pages/reservation.js" defer></script>
    <link href="https://fonts.cdnfonts.com/css/satoshi" rel="stylesheet"/>
    <link href="https://fonts.cdnfonts.com/css/source-serif-pro" rel="stylesheet"/>
    <link href="./assets/styles/global/global.css" rel="stylesheet"/>
    <link href="./assets/styles/global/components.css" rel="stylesheet"/>
    <link href="./assets/styles/pages/summary.css" rel="stylesheet"/>
</head>
<body>
    <div class="wrapper">
        <div class="bag__summary">
            <header class="bag__summary-header">
                <a href="<?php echo $_SESSION['referer'] ?? './'; ?>" class="bag__summary-back">
                    <span class="icon-container bag__summary-back-icon"><?php echo getIcon("arrow-left"); ?></span>
                    <span class="bag__summary-back-text">Back</span>
                </a>
                <div class="header__logo">
                    <a href="./index.php">
                        <img src="./assets/images/icons/logo-xsmall.png" alt="Inspec Logo" width="66" height="16">
                    </a>
                </div>  
            </header>
            <main class="bag__summary-content">
                <div class="bag__summary-products">
                    <div class="bag__summary-content-header">
                        <h6 class="bag__summary-title">Your Reservations</h6>
                        <span class="bag__summary-count">

                        </span>
                    </div>
                    <?php if (empty($reserved)) : ?>
                        <span class="bag__empty-text">You have no reservations</span>
                    <?php else : ?> 
                        <?php foreach($reserved as $reservedproduct) : ?>
                            <?php createReservationCard($reservedproduct); ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </main>
            <footer>

            </footer>
        </div>
    </div>
    <?php include './includes/components/confirm-dialog.php';?>
    <div class="snackbar"></div>    
</body>
</html>