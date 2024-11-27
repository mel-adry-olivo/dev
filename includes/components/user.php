<?php 

if(isset($_SESSION['user_id'])) {
    $firstName = $_SESSION['fname'];
    $lastName = $_SESSION['lname'];
}


?>


<div class="action-menu__content-item user" data-state="login">
    <div class="user__content">
        <?php if (isset($_SESSION['user_id'])) :?> 
            <div class="profile">
                <div class="profile__header">
                    <span class="profile__welcome">Welcome, <?php echo $firstName?></span>
                </div>
                <div class="profile__body">
                    <form action="./reservations.php">
                        <button class="button-link profile-link profile__view-reservations">View Reservations</button>
                    </form>
                    <?php if($_SESSION['role'] == 'admin') : ?>
                        <form action="./manage.php">
                            <button class="button-link profile-link profile__manage">Manage Products</button>
                        </form>
                    <?php endif; ?>
                    <form action="./routes/auth/logout.php" method="POST">
                        <button class="button-link profile-link profile__logout">Log out</button>
                    </form>
                    
                </div>
            </div>
        <?php else : ?>
            <?php require './includes/components/auth.php'?>
        <?php endif; ?>
    </div>
</div>