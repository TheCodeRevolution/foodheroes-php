<?php

/*
    Response helpers
    ================

    1. redirect
    -----------
    Schreibe eine Funktion, die einen Redirect ausführt.
    Die Funktion muss also einen Location header setzen.

    Anwendungsbeispiel:

    redirect('login.php');
*/

function redirect(string $url) : void
{
    header('Location: ' . $url);
    exit();
}


/**
 * !!! Diese Funktion wird nur im "Mini-Framework" verwendet !!!
 *
 * Erzeugt eine JSON-Response.
 *
 * Anwendungsbeispiel:
 *   echo json_response(['status' => 'success']);
 *
 * @param  array  $data
 * @param  int    $status_code = 200
 * @return string
 */
function json_response(array $data, int $status_code = 200) : string
{
    http_response_code($status_code);

    header('Content-Type: application/json');
    return json_encode($data);
}
