<?php
require "/classes/db.php";
// step 1: define roles and permissions
$roles = array(
    'Admin' => array('create', 'read', 'update', 'delete'),
    'Moderator' => array('create', 'read', 'update'),
    'User' => array('read')
);

// step 2: create database tables
// roles table: id, name
// role_permissions table: id, role_id, permission
// user_roles table: id, user_id, role_id

// step 3: create user authentication system
session_start();
if (isset($_POST['email']) && isset($_POST['password'])) {
    $username = $_POST['email'];
    $password = $_POST['password'];

    $connectionDB = new database("localhost", "cms", "root", "");
    $connectionDB->connect();
    $userData = $connectionDB->login($_POST["email"], $_POST["password"]);

    $sql = "SELECT * FROM users WHERE `email`='$email'"; // $email of $users$
    // check if the user's credentials are valid
    // if valid, set a session variable with the user's role
    $_SESSION['role'] = '1';
}

// step 4: check user's role on protected pages
if (!isset($_SESSION['role']))
{   // redirect to login page
    header("Location:/components/cms.php");
    exit;
}
else {
    $role = $_SESSION['role'];
    if (!in_array($role, array_keys($roles))) {
        // redirect to login page
    } else {
        // display content based on user's role
    }
}

// step 5: handle different roles and permissions
if ($role == '1') {                 
    // display 1= Admin options
    header("Location/components/cms.php");
    exit(); //Exit
} elseif ($role == '3') {
    // display 3= Moderator options
    header("Location/components/login.php");
    exit(); //Exit
} elseif ($role == '2') {
    // display 2= User options
    header("Location/components/login.php");
    exit();//Exit
} else {
    // redirect to login page
    header("Location/components/login.php");
exit(); //Exit
}

// step 6: create an interface for adding, editing, and deleting roles and permissions
// step 7: create an interface for assigning roles to users
// step 8: use appropriate security measures
// step 9: test your code

//ROLLEN:
// 1 = Admin
// 2 = User
// 3 = Moderator

//RECHTEN:
//create = Maak 
//update = Edit
//read = lezen