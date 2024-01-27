<?php

use J4kim\Darts\Auth;

include Auth::check() ?
    "logout-form.php":
    "login-form.php" ;