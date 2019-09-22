<?php
   // INCLUDE ON EVERY TOP-LEVEL PAGE!
   include("includes/init.php");
   ?>

<!DOCTYPE html>
<html lang="en">
   <head>


<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat:600i&display=swap" rel="stylesheet">
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
      <title>Home</title>
   </head>
   <body>
      <?php include("includes/header.php"); ?>

         <div class="home_text">
         <img src = "images/hero4.png" class = ".backgroundimg" alt = "two CSS code images stacked on top of each other, with speech bubbles coming off of them with text">
         <h1 class="home_title"> Refine your design education to prioritize accessibility.</h1>
         <p class="home_text_b"> Forsight is a code review service that grounds an inclusive design education within an interactive environment. We work with your unique provided code, run it through our system with research-based guidelines, and provide recommendations on how to approve your design. </p>
      </div>


      </div>
      <div class="home_text2">
         <h1> We've Got High Standards </h1>
         <!-- Content source: http://orgsync.rso.cornell.edu/show_profile/169438-mediocre-melodies -->
         <p class="newp"> We used the following accessibility standard guides to form our product. </p>
      </div>
      <div class="guidebox">
         <div class="guide_display">
            <div class="guide_div1">
            <h2> Royal National Institute of Blind People (RNIB)</h2>
               <!-- Content source: https://www.rnib.org.uk/eye-health-eye-conditions/information-standard -->
               <p class="guide_learn"> "RNIB is the leading provider of eye health and social care information people living with a sight condition in the UK, their family, friends and carers and the professionals who work with them."</a> </p>
            </div>
            <div class="guide_div2">
               <h2> Web Content Accessibility Guidelines (WCAG)</h2>
               <!-- Content source: https://www.w3.org/WAI/standards-guidelines/wcag/ -->
               <p class="guide_learn"> "The Web Content Accessibility Guidelines (WCAG) are part of a series of web accessibility guidelines published by the Web Accessibility Initiative (WAI) of the World Wide Web Consortium (W3C), the main international standards organization for the Internet." <a href="">Click here to learn more!</a> </p>
            </div>

         </div>
      </div>
      <?php include("includes/footer.php"); ?>
   </body>
</html>
