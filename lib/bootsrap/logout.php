<?php

require('../authentication.php');
require('../response.php');

session_start();

logout();

redirect('../../pages/user/signin.php');

?>