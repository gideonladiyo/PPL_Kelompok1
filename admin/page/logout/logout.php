<?php
        // delete the session of the user
        $_SESSION = array();
        session_destroy();
        // return a little feeedback message
        header("Location: ../");
?>