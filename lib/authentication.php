<?php

require_once 'session.php';

/**
 * Meldet einen Benutzer am System an.
 *
 * Anwendungsbeispiel:
 *   login(['id' => 1, 'email'=> 'a@moo.de', ...]);
 *
 * @param  array  $user
 * @return void
 */
function login(array $user) : void
{
    if (!array_key_exists('id', $user)) {
        throw new Exception (
            'The provided array does not have a key "id". You must provide this key for the authentication system to work properly.'
        );
    }

    session('_user', $user);
}


/**
 * Meldet den angemeldeten Benutzer ab.
 *
 * Anwendungsbeispiel:
 *   logout();
 *
 * @return void
 */
function logout() : void
{
    session('_user', null);
}


/*
    3. auth_user
    ------------

    auth_user([string $key]) : mixed

    Kann mit und ohne $key aufgerufen werden.

    Ohne $key:

    auth_user() : mixed

    Gibt die gespeicherten Daten des eingeloggten Benutzers zurück.
    Man erhält also wieder das Array bzw die Daten, die man mit login()
    gespeichert hat.
    Gibt es keinen eingeloggten Benutzer, soll die Funktion
    null zurückgeben.

    Mit $key:

    auth_user('email') : mixed

    Gibt den Wert zurück, der unter dem übergebenen
    Key gespeichert ist.

    Wenn der Key nicht existiert, soll null TODO zurückgegeben werden.
*/
function auth_user($key = null)
{
    if ($key === null) {
        return session('_user');
    }

    return session('_user')[$key] ?? null;
}


/*
    4. auth_id
    ----------
    
    auth_id()

    Gibt die id des angemeldeten Benutzers zurück. Wir gehen in dieser
    Funktion davon aus, dass das Array, das mit login() gespeichert wurde,
    einen Key namens id enthält. Wenn nicht, soll die Funktion null zurückgeben.
*/
function auth_id()
{
    return auth_user('id');
}

// logout();

// echo '<hr>Before Login<hr>';

// var_dump( auth_user() );
// var_dump( auth_user('email') );
// var_dump( auth_user('id') );
// var_dump( auth_id() );

// echo '<hr>After Login<hr>';

// login([
//     'id' => 12,
//     'email' => 'bla@bla.de',
// ]);

// var_dump( auth_user() );
// var_dump( auth_user('email') );
// var_dump( auth_user('id') );
// var_dump( auth_id() );
