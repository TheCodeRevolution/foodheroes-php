<?php

/**
 * Stellt eine Datenbankverbdinung her und gibt diese zurück.
 *
 * Anwendungsbeispiel:
 *   $database_connection = db_connect([
 *     'host' => 'localhost',
 *     'username' => 'root',
 *     'password' => '',
 *     'database' => 'todolist'
 *   ]);
 *
 * @param  array  $config
 * @return PDO
 */
function db_connect(array $config) : PDO
{
    $host = $config['host'];
    $port = $config['port'] ?? 3306;
    $charset = $config['charset'] ?? 'utf8mb4';
    $user = $config['username'];
    $pass = $config['password'];
    $database = $config['database'];

    $dsn = "mysql:host=$host;dbname=$database;charset=$charset;port=$port";

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    return new PDO($dsn, $user, $pass, $options);
}


/**
 * Holt einen einzelnen Datensatz aus der Datenbank.
 *
 * Den Funktionen db_get und db_all kann eine SQL-Query
 * mit Platzhaltern übergeben werden, die dann als
 * Prepared Statement ausgeführt wird.
 *
 * Dazu muss für jeden Platzhalter ein gleichnamiger
 * Key im übergebenen $data-Array existieren.
 * Der dazugehörige Wert wird beim Ausführen der Query
 * die Stelle des Platzhalters einnehmen.
 *
 * Anwendungsbeispiel:
 *   $todos = db_get('SELECT * FROM users WHERE id = :id', [
 *     'id' => 3
 *   ]);
 *
 * @param  string   $query
 * @param  array    $data
 * @param  bool     $all
 * @return array
 */
function db_get(string $query, array $data = [], bool $all = false)
{
    $statement = db_statement($query, $data);

    if ($all) {
        $result = $statement->fetchAll();
    } else {
        $result = $statement->fetch();
    }

    $statement->closeCursor();

    return $result;
}


/**
 * Holt mehrere Datensätze aus der Datenbank.
 *
 * Anwendungsbeispiel:
 *   $todos = db_all('SELECT * FROM todos');
 *   $todos = db_all('SELECT * FROM todos WHERE user_id = :user_id', [
 *     'user_id' => auth_id()
 *   ]);
 *
 * @param  string   $query
 * @param  array    $data
 * @return array
 */
function db_all(string $query, array $data = [])
{
    return db_get($query, $data, true);
}


/**
 * Fügt einen Datensatz in eine Tabelle ein.
 *
 * Die Keys des übergebenen $data-Arrays entsprechen
 * den Namen der Tabellenspalten in der Datenbank.
 *
 * Anwendungsbeispiel:
 *   db_insert('todos', [
 *     'text' => 'Ich bin ein neues Todo',
 *     'user_id' => auth_id(),
 *   ]);
 *
 * @param  string   $table
 * @param  array    $data
 * @return PDOStatement
 */
function db_insert(string $table, array $data) : PDOStatement
{
    $column_list = [];
    $placeholders = [];

    foreach (array_keys($data) as $column) {
        $column_list[] = '`' . $column . '`';
        $placeholders[] = ':' . $column;
    }

    $column_list = implode(', ', $column_list);
    $placeholders = implode(', ', $placeholders);

    $query = "INSERT INTO `$table` ($column_list) VALUES ($placeholders)";

    return db_statement($query, $data);
}


/**
 * Aktualisiert einen bestehenden Datensatz.
 * Der Datensatz wird anhand über seine Id bestimmt.
 *
 * Die Keys des übergebenen $data-Arrays entsprechen
 * den Namen der Tabellenspalten in der Datenbank.
 *
 * Anwendungsbeispiel:
 *   db_update('todos', 3, [
 *     'text' => 'Geänderter Text',
 *   ]);
 *
 * @param  string   $table
 * @param  int      $id
 * @param  array    $data
 * @return PDOStatement
 */
function db_update(string $table, int $id, array $data) : PDOStatement
{
    $key_value_pairs = [];

    foreach (array_keys($data) as $column) {
        $key_value_pairs[] = "`$column` = :$column";
    }

    $key_value_pairs = implode(', ', $key_value_pairs);

    $query = "UPDATE `$table` SET $key_value_pairs WHERE id = :id";

    $data['id'] = $id;

    return db_statement($query, $data);
}


/**
 * Löscht einen bestehenden Datensatz anhand seiner
 * Id aus einer Tabelle.
 *
 * Anwendungsbeispiel:
 *   db_delete('todos', 12);
 *
 * @param  string    $table
 * @param  int       $id
 * @return PDOStatement
 */
function db_delete(string $table, int $id) : PDOStatement
{
    return db_statement(
        "DELETE FROM $table WHERE id = :id",
        ['id' => $id]
    );
}


/**
 * Feuert eine Query an die Datenbank.
 *
 * Übergibt man der Funktion ein leeres $bindings-Array,
 * wird die Query direkt an die Datenbank gefeuert.
 *
 * Wenn man ein befülltes $bindings-Array, so erzeugt die
 * Funktion ein Prepared Statement, knüpft mit bindValue()
 * alle Werte an die Platzhalter in der Query und führt
 * die Query dann aus.
 *
 * Anwendungsbeispiel:
 *   db_statement(
 *     "UPDATE users SET email = :email WHERE id = :id",
 *     ['email' => 'new@mail.de']
 *   );
 *
 * @param  string   $query
 * @param  array    $bindings
 * @return PDOStatement
 */
function db_statement(string $query, array $bindings = []) : PDOStatement
{
    global $database_connection;

    if (!isset($database_connection) || !$database_connection instanceof PDO) {
        throw new Exception(
            'You must create a database connection and store it in a '
                . 'global variable called $database_connection. You can use '
                . 'the db_connect() function to create the connection.'
        );
    }

    // Fire query without bound values
    if ($bindings === []) {
        return $database_connection->query($query);
    }

    // Fire prepared query
    $statement = $database_connection->prepare($query);

    db_bind_values($statement, db_prepare_bindings($bindings));

    $statement->execute();

    return $statement;
}


/**
 * Bindet Werte an ein Statement.
 *
 * @param  PDOStatement $statement
 * @param  array        $bindings
 * @return void
 */
function db_bind_values(PDOStatement $statement, array $bindings) : void
{
    foreach ($bindings as $key => $value) {
        $statement->bindValue(
            ':' . $key,
            $value,
            is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR
        );
    }
}


/**
 * Bereitet Werte so auf, dass sie in einem Prepared Statement
 * benutzt werden können.
 *
 * @param  array  $bindings
 * @return array
 */
function db_prepare_bindings(array $bindings) : array
{
    foreach ($bindings as $key => $value) {
        if (is_bool($value)) {
            $bindings[$key] = (int) $value;
        }
    }

    return $bindings;
}
