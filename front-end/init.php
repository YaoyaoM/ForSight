<?php
// vvv DO NOT MODIFY/REMOVE vvv

// check current php version to ensure it meets 2300's requirements
function check_php_version()
{
  if (version_compare(phpversion(), '7.0', '<')) {
    define(VERSION_MESSAGE, "PHP version 7.0 or higher is required for 2300. Make sure you have installed PHP 7 on your computer and have set the correct PHP path in VS Code.");
    echo VERSION_MESSAGE;
    throw VERSION_MESSAGE;
  }
}
check_php_version();

function config_php_errors()
{
  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 0);
  error_reporting(E_ALL);
}
config_php_errors();

// open connection to database
function open_or_init_sqlite_db($db_filename, $init_sql_filename)
{
  if (!file_exists($db_filename)) {
    $db = new PDO('sqlite:' . $db_filename);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (file_exists($init_sql_filename)) {
      $db_init_sql = file_get_contents($init_sql_filename);
      try {
        $result = $db->exec($db_init_sql);
        if ($result) {
          return $db;
        }
      } catch (PDOException $exception) {
        // If we had an error, then the DB did not initialize properly,
        // so let's delete it!
        unlink($db_filename);
        throw $exception;
      }
    } else {
      unlink($db_filename);
    }
  } else {
    $db = new PDO('sqlite:' . $db_filename);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
  }
  return null;
}

function exec_sql_query($db, $sql, $params = array())
{
  $query = $db->prepare($sql);
  if ($query and $query->execute($params)) {
    return $query;
  }
  return null;
}

//Code above provided by Kyle Harms, INFO 2300 for this project
// You may place any of your code here.

// Source for the following login implementation and user-defined functions adapted from Kyle Harms, Lab 08 as a reference

//messages to post on the login page, displays errors
$error_messages = array();
$db = open_or_init_sqlite_db('secure/profile.sqlite', 'secure/init.sql');

function log_in($username, $password) {
  global $db;
  global $error_messages;
  global $current_user;
  global $username;
  if ($username && $password) {
    $sql = "SELECT * FROM users WHERE username = :username;";
    $params = array(
      ':username' => $username
    );
    $records = exec_sql_query($db, $sql, $params)->fetchAll();
    if ($records) {
      $account = $records[0];
      if ( password_verify($password, $account['password']) ) {

        $session = session_create_id('0');
        $params = array(
          ':user_id' => $account['id'],
          ':session' => $session
        );
        $sql = "INSERT INTO sessions (session, user_id) VALUES (:session ,:user_id);";
        $result = exec_sql_query($db, $sql, $params);
        if ($result) {
          setcookie("session", $session, time()+3600);  /* expire in 1 hour */
          $current_user = find_session($session);
          return $current_user;
        } else {
          array_push($error_messages, "Log in failed.");
        }
      } else {
        array_push($error_messages, "Invalid username or password.");
      }
    } else {
      array_push($error_messages, "Invalid username or password.");
    }
  } else {
    array_push($error_messages, "No username or password given.");
  }
  return NULL;

}

//log current user out
function log_out() {
  global $current_user;
  global $db;
  if ($current_user) {
    setcookie("session", "", time()-3600);
    $current_user = NULL;
    array_push($error_messages, "Successfully logged-out.");
  }
}

//find current session using sessions table
function find_session($session) {
  global $db;
  if (isset($session)) {
    $sql = "SELECT * FROM sessions WHERE session = :session;";
    $params = array(
      ':session' => $session
    );
    $records = exec_sql_query($db, $sql, $params)->fetchAll();
    if ($records) {
      // Username is UNIQUE, so there should only be 1 record.

      return $records[0];
    }
  }
  return NULL;
}

//set session when logged in
function session_login() {
  global $db;
  global $current_user;
  global $username;
  if (isset($_COOKIE["session"])) {
    $session = $_COOKIE["session"];
    $current_user = find_session($session);
    // Renew the cookie for 1 more hour
    if ( isset($current_user) ) {
      setcookie("session", $session, time()+3600);  /* expire in 1 hour */
    }
    // $current_user_array=[$current_user,$username];
    return $current_user;
  }
  $current_user = NULL;
  return NULL;
}

//check if current user is logged in
function check_if_logged_in() {
  global $db;
  global $current_user;
  if ($current_user) {
    $current_id=$current_user[1];
    $params = array(
      ':current_id' => $current_id,
    );
    $sql = "SELECT username from users WHERE users.id=:current_id;";
    $result = exec_sql_query($db, $sql, $params)->fetchAll();
    return $result[0][0];
  } else {
    return NULL;
  }
}

//clean email string so email can be sent to form submitter
function clean_string($string) {
  $bad = array("content-type","bcc:","to:","cc:","href");
  return str_replace($bad,"",$string);
}

//check if we need to log in
if ( isset($_POST['login']) && isset($_POST['username']) && isset($_POST['password']) ) {
  $username = trim( $_POST['username'] );
  $password = trim( $_POST['password'] );
  log_in($username, $password);
} else {
  // check if logged in already thru cookie
  session_login();
}
// Check if we should logout the user
if ((isset($_POST['logout']) ) ) {
  log_out();

}

//check whether a user is an admin
function is_user_admin($current_user) {
  global $db;
  //global $username;
  $thesql = "SELECT users.admin FROM users JOIN sessions ON users.id= :current_user_id;";
  $params = array(
    ':current_user_id' => $current_user['user_id']
  );
  $admins = exec_sql_query($db, $thesql, $params)->fetchAll();
  if ($admins[0][0] =='1') {
    return TRUE;
  }
  else {
    return FALSE;
  };
}

//check whether user's ID matches headshot
function is_active_user($imageID, $userID) {
  global $db;

  $check = array(
    ':images' => $imageID,
  );

  $call_to_check_user = exec_sql_query($db, "select * from profiles where profiles.id = :images", $check);

  foreach ($call_to_check_user as $verify) {
    if ($verify['user_id']==$userID) {
      return true;
    }
    else {
      return false;
    }
  }
}

?>
