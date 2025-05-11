<?php
        session_start();
        // delete the session of the user
        $_SESSION = array();
        session_destroy();
        header("Location: ../page.php?mod=home");
?>
