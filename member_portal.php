<?php
   // INCLUDE ON EVERY TOP-LEVEL PAGE!
   include("includes/init.php");

   //FORM PHP

   ?>
<!DOCTYPE html>
<html lang="en">
   <head>

<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat:600i&display=swap" rel="stylesheet">
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
      <title>Member Login</title>
   </head>
   <body>
      <?php include("includes/header.php"); ?>
      <div class="whole_form_page">
         <h1 class= "loginform"> Member Portal </h1>
         <p class="loginform" <?php
            if (check_if_logged_in()!=NULL) {
                echo 'hidden';
            }?>> Sign in to view your past code reports. </p>
         <?php if (check_if_logged_in()!=NULL) {
            echo '<p class="loginform"> You are successfully logged in! You can go to your bio page to edit any of your information. </p><form method="post">
            <button name="logout" type="submit" class=logout_button2> Logout '.check_if_logged_in().'</button> </form>';
            }
            ?>
         <form id="login_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <fieldset <?php
               if (check_if_logged_in()!=NULL) {
                   echo 'class=hidden';
               }
               ?>
               >
               <?php
                  foreach ($error_messages as $message) {
                      echo "<p class='form_error'>" . htmlspecialchars($message) . "</p>\n";
                  }
                  ?>
               <div class = "loginformelement">
                  <label for="username">Username:</label>
                  <input id="username" type="text" name="username" placeholder="Username" />
               </div>
               <div class = "loginformelement">
                  <label for="password">Password:</label>
                  <input id="password" class="loginlabelbottom" type="password" name="password" placeholder="Password"  />
               </div>
               <div class = "loginformelement">
                  <button class="the_button" name="login" type="submit">Log In</button>
               </div>
            </fieldset>
         </form>
      </div>
      <?php include("includes/footer.php"); ?>
   </body>
</html>
