<?php   
    session_start();
    class sessionmanager {
        public function __construct() {
            if (!isset($_SESSION["visit"])) {
                $_SESSION["visit"] = 0;
            }
        }
        public function incrementvisit() {
            $_SESSION["visit"]++;
        }
        public function getcount() {
            return $_SESSION["visit"];
        }
        public function resetSession() {
            session_destroy();
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
        public function getmessage() {
            if ($this->getcount() === 1) {
                return "Bienvenue à notre plateforme.";
            } else {
                return "Merci pour votre fidélité, c'est votre " . $this->getcount() . "ème visite.";
            }
        }
    }

    $session = new sessionmanager();
    $session->incrementvisit();
    if (isset($_POST["reset"])) {
        $session->resetSession();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php echo $session->getmessage(); ?>
    <form method="POST">
        <button type="submit" name="reset">reset visits</button>
    </form>
</body>
</html>