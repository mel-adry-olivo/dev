<?php

session_start();

require './includes/templates.php';
require './includes/icons.php';
require './includes/config.php';
require './includes/db-utils.php';

if (!isset($_SESSION['referer']) ) {
    $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
}

$reserved = getReservedProducts($_SESSION['user_id']);
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
    <?php require './includes/style-loader.php'?>
</head>
<body>
    <div class="wrapper">
        <div class="bag__summary">
            <header class="bag__summary-header">
                <a href="<?php echo $_SESSION['referer'] ?? './index.php'; ?>" class="bag__summary-back">
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
    <div id="snackbar"></div>
    <div class="page-overlay confirm__overlay"></div>
    <div class="confirm__dialog">
        <h6>Confirm</h6>
        <p class="confirm__message">Message</p>
        <div class="confirm__button-wrapper">
            <button class="confirm__cancel">Cancel</button>
            <button class="button button--filled-dark confirm__ok">Yes</button>
        </div>
    </div>
</body>
</html>