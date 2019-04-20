<?php
// Initialize the session
session_start();
require 'config.php';
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

html('header', array(
    'title'=>array('Welcome','Szia <b>'.htmlspecialchars($_SESSION["username"]).'</b>!'), 
    'style'=>'body{ font: 14px sans-serif; text-align: center; }'
));

?>

    <div class="page-header">
        <!--<h1>Szia <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>!</h1>-->
    </div>

    <!-- Fő oldalak -->
    <p>
    <?php
        if (user() >= 1) {
            echo '<a href="course.php" class="btn btn-primary">Kurzusok</a> ';
            echo '<a href="test.php" class="btn btn-primary">Tesztek</a> ';
        } else {
            echo "Jelenleg csak sima felhasználó vagy, nem érhetők el számodra a szolgáltatások.<br>";
            echo "Kérj meg egy tanárt vagy admint, hogy adják meg neked a megfelelő jogosultságot!";
        }
    ?>
    </p>

     <!-- Jogosultság -->
    <p> Jogosultság:
    <?php
        switch (user()) {
            case 1: echo 'diák'; break;
            case 5: echo 'tanár'; break;
            case 9: echo 'admin'; break;
            case 0: echo 'felhasználó'; break;
        }
    ?>

    <!-- Szerkesztés -->
    <p>
    <?php
        if (user() >= 5) {
            echo '<br><br>';
            echo '<a href="admin_user.php" class="btn btn-info">Felhaszálók kezelése</a> ';
            echo '<a href="admin_userclass.php" class="btn btn-info">Osztályok kezelése</a> ';
            echo '<a href="admin_coursecat.php" class="btn btn-info">Kurzus kategóriák kezelése</a> ';
        }
    ?>
    </p>

    <p>
        <hr>
        <a href="reset-password.php" class="btn btn-warning">Új jelszó</a>
        <a href="logout.php" class="btn btn-danger">Kijelentkezés</a>
    </p>

<?php
    html('footer');
?>