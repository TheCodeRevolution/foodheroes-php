<?php

require('../database.php');
require('../response.php');

$database_connection = db_connect([
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'foodheroes'
]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $deleted_id = $_POST['deleted_id'] ?? '';

    db_delete('receipes', $deleted_id);

    redirect('../../pages/user/dashboard.php');

}

?>