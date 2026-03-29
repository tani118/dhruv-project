<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$usersFile = __DIR__ . '/../data/users.json';

function read_users($usersFile)
{
    if (!file_exists($usersFile)) {
        file_put_contents($usersFile, json_encode([]));
    }

    $raw = file_get_contents($usersFile);
    $users = json_decode($raw, true);

    if (!is_array($users)) {
        $users = [];
    }

    return $users;
}

function save_users($usersFile, $users)
{
    $result = file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
    if ($result === false) {
        error_log("Failed to write to users.json at: " . $usersFile);
    }
}

function find_user_by_email($users, $email)
{
    foreach ($users as $user) {
        if (strtolower($user['email']) === strtolower($email)) {
            return $user;
        }
    }

    return null;
}

function register_user($name, $email, $password)
{
    global $usersFile;
    $users = read_users($usersFile);

    if (find_user_by_email($users, $email)) {
        return 'Email is already registered.';
    }

    $users[] = [
        'name' => trim($name),
        'email' => trim($email),
        'password' => $password
    ];

    save_users($usersFile, $users);
    return '';
}

function login_user($email, $password)
{
    global $usersFile;
    $users = read_users($usersFile);
    $found = find_user_by_email($users, $email);

    if (!$found || $found['password'] !== $password) {
        return 'Invalid email or password.';
    }

    $_SESSION['user'] = [
        'name' => $found['name'],
        'email' => $found['email']
    ];

    return '';
}

function current_user()
{
    return $_SESSION['user'];
}

function logout_user()
{
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }

    session_destroy();
}
