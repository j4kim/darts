<?php

include isset($_SESSION['username']) ?
    "logout-form.php":
    "login-form.php" ;