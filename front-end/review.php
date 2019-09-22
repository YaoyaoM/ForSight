<?php
   // INCLUDE ON EVERY TOP-LEVEL PAGE!
   include("includes/init.php");

   //FORM
   if (isset($_POST['submit'])) {
     // Assume the submit is valid
     // Name is required.
     $message = trim(filter_input(INPUT_POST, 'message',FILTER_SANITIZE_STRING));

     if ( $message == '' ) {
       //No message was given
       $valid_submit = FALSE;
       $show_message_error = TRUE;
     }

     if ( $message != '' ) {
       $valid_submit = TRUE;
     }

   } else {
     // Form was not submitted.
     $name = '';
     $email = '';
     $message = '';
   }
   ?>
<!DOCTYPE html>
<html lang="en">
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
   <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
      <title>Join</title>
   </head>
   <body>
      <?php include("includes/header.php"); ?>
      <div class="whole_form_page">
         <div class="reviewform">

            <!-- Create review form -->
            <div class="apply_text">
               <h1 class="loginform">Spreading awareness by engaging your design principles, using your code.</h1>
               <p class="newp"> Our web app works together your code and evaluates how visually inclusive it is, according to industry and healthcare standards. Together, we can build more holistic products.</p>
               <form id="reviewform" action="/review" method="post">
                  <fieldset>
                     <label for="message_input"> Copy your CSS code here!</label>
                     <p class="form_error <?php if ( !isset($show_message_error) ) { echo 'hidden'; } ?>">Please enter a valid CSS code. This can be copy and pasted from your coding environment!</p>
                     <textarea id="message_input" name="message"  rows="4" cols="45">

  <?php
                        if( isset($message) )
                        { echo htmlspecialchars($message);
                         } ?>
  </textarea>
                     <input class="the_button" type="submit" name="submit" value="Submit"/>
                  </fieldset>
               </form>
            </div>
         </div>
      </div>
      <?php include("includes/footer.php"); ?>
   </body>
</html>
