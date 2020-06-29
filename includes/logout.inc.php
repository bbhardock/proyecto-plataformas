<?php
    require '../session_check.php';
    session_unset();
    session_destroy();
    header("Location: ../index.php");