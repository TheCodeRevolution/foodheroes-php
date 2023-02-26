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

    $update__title = $_POST['update__title'] ?? '';
    $update__description = $_POST['update__description'] ?? '';
    $updated_id = $_POST['updated_id'] ?? '';

    db_update('receipes', $updated_id, [
        'title' => $update__title,
        'description' => $update__description,
    ]);

    redirect('../../pages/user/dashboard.php');

}

?>