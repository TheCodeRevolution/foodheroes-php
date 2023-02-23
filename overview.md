```php
// authentication.php
/////////////////////
login($user) : void
logout() : void
auth_user(string $key = null)
auth_id()

// database.php
///////////////
db_get(string $query, array $data = [], bool $all = false)
db_all(string $query, array $data = [])
db_insert(string $table, array $data)
db_update(string $table, int $id, array $data)
db_delete(string $table, int $id)
db_statement($query, $bindings = []) : PDOStatement

// request.php
//////////////
request_method() : string
request_is(string $method) : bool
query($key = null)
request($key = null)

// Nur im Mini-Framework:
request_wants_json() : bool
base_url() : string
url(string $path) : string

// response.php
///////////////
redirect(string $url, int $response_code = 302) : void

// Nur im Mini-Framework:
json_response(array $data, int $status_code = 200) : void

// router.php
/////////////
// Nur im Mini-Framework:
router(array $routes) : string

// session.php
//////////////
session(string $key = null, $value = null)

// view.php
///////////
html_escape(string $string, string $encoding = 'UTF-8') : string
e(string $string) : string
error_for(string $fieldname, array $errors, string $format) : string

// Nur im Mini-Framework:
view(string $template, array $data = []) : string
