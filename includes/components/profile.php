<?php 

$firstName = $_SESSION['fname'];
$lastName = $_SESSION['lname'];

?>

<div class="profile">
    <div class="profile__header">
        <span class="profile__welcome">Welcome, <?php echo $firstName?></span>
        <form action="./logout.php" method="POST">
            <button class="button-link profile__logout">Log out</button>
        </form>
    </div>
</div>