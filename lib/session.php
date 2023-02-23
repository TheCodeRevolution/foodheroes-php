<?php

function session(string $key = null, $value = null)
{
    // Die Funktion erwartet, dass die Session bereits gestartet wurde.
    if (session_status() === PHP_SESSION_NONE) {
        throw new Exception(
            'You have to manually call session_start() before using this function.'
        );
    }

    // a) session()
    // Gibt die gesamte Session zurück
    if ($key === null) {
        return $_SESSION;
    }

    // d) session($key, null)
    // Löscht den Eintrag mit den Schlüssel $key aus der Session.
    if ($value === null && func_num_args() === 2) {
        unset($_SESSION[$key]);
        return;
    }

    // c) session($key, $value)
    // Speichert $value unter dem Schlüssel $key in der Session.
    if ($value !== null) {
        return $_SESSION[$key] = $value;
    }

    // b) session($key)
    // Gibt den Wert zurück, der in der Session unter $key gespeichert ist.
    // Wird $key nicht gefunden, soll null zurückgegeben werden.
    return $_SESSION[$key] ?? null;
}

// session_start();
// session_unset();

// // a)
// var_dump( session() );

// // c)
// session('pizza', 'lecker');
// session('rand', [1, 2, 3, 4]);
// var_dump( session() );

// // b)
// var_dump( session('pizza') );
// var_dump( session('nicht-da') );

// // d)
// session('rand', null);
// var_dump( session() );
