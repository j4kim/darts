<?php

use J4kim\Darts\Auth;

$this->insert(Auth::check() ? "parts/logout-form" : "parts/login-form");
