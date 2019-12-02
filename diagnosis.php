<?php
session_start();
require "inc/connect.php"; 
 $_SESSION["user"] = "true"; 
if(isset($_POST['login'])){
  $password=$_POST["password"];
  $string="ghtyrufjd34677&&*9##";
  $password=$string.$password.$string;
  $query="select * from tbl_patient where fld_password='$password'";
  $result=$conn->query($query);
    $row = $result->fetch_assoc();
    $_SESSION["userID"]=$row['fld_patientid'];
    $_SESSION["firstName"]=$row['fld_firstname'];
     $_SESSION["lastName"]=$row['fld_lastname'];
    $_SESSION["cardNumber"]=$row['fld_cardNumber'];
      if($password!=$row['fld_password']){
        echo '<script type="text/javascript">'; 
        echo 'alert("Invalid Password");'; 
        echo 'window.location.href = "index.php";';
        echo '</script>';

      }
      if($row['fld_diagnosis']==1){ 
        echo '<script>window.location.href = "profile.php";';
        echo '</script>';

      }
  }
if(!isset($_SESSION["userID"])){
 echo '<script type="text/javascript">'; 
echo 'alert("You have to login first");'; 
echo 'window.location.href = "index.php#login";';
echo '</script>';
}



    

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Medical Diagnosis</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="css/swiper.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="style.css">
    <style>
        * {
          box-sizing: border-box;
        }

        body {
          background-color: #f1f1f1;
        }

        #regForm {
          background-color: #ffffff;
          margin: 100px auto;
          font-family: Raleway;
          padding: 40px;
          width: 70%;
          min-width: 300px;
        }

        h1 {
          text-align: center;  
        }

        input[type=text], select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }


        /* Mark input boxes that gets an error on validation: */
        input.invalid {
          background-color: #ffdddd;
        }

        /* Hide all steps by default: */
        .tab {
          display: none;
        }

        button {
          background-color: #4CAF50;
          color: #ffffff;
          border: none;
          padding: 10px 20px;
          font-size: 17px;
          font-family: Raleway;
          cursor: pointer;
        }

        button:hover {
          opacity: 0.8;
        }

        #prevBtn {
          background-color: #bbbbbb;
        }

        /* Make circles that indicate the steps of the form: */
        .step {
          height: 15px;
          width: 15px;
          margin: 0 2px;
          background-color: #bbbbbb;
          border: none;  
          border-radius: 50%;
          display: inline-block;
          opacity: 0.5;
        }

        .step.active {
          opacity: 1;
        }

        /* Mark the steps that are finished and valid: */
        .step.finish {
          background-color: #4CAF50;
        }
</style>
</head>
<body class="single-page">
    <header class="site-header">
        <div class="nav-bar">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
                        <div class="site-branding d-flex align-items-center">
                            <a class="d-block" href="index.php" rel="home"><img class="d-block" src="images/logo.png" alt="logo"></a>
                        </div><!-- .site-branding -->

                        <nav class="site-navigation d-flex justify-content-end align-items-center">
                            <ul class="d-flex flex-column flex-lg-row justify-content-lg-end align-items-center">
                                <li><form method="get" action="index.php"><input class="button gradient-bg" type="submit" value="Log-out" name="logout"></form></li>
                                <li><a href="about.php">About Medical Diagnosis System</a></li>
                                <li class="current-menu-item"><a href="diagnosis.php">E-Medical Diagnosis</a></li>
                                
                                

                                <li class="call-btn button gradient-bg mt-3 mt-md-0">
                                    <a class="d-flex justify-content-center align-items-center" href="#"><img src="images/emergency-call.png">  +234-813-554-1567</a>
                                </li>
                            </ul>
                        </nav><!-- .site-navigation -->

                        <div class="hamburger-menu d-lg-none">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div><!-- .hamburger-menu -->
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .nav-bar -->

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 style="text-align:left;">Diagnosis</h1>

                    <div class="breadcrumbs">
                        <ul class="d-flex flex-wrap align-items-center p-0 m-0">
                            <li><a href="#">Home</a></li>
                            <li>Diagnosis</li>
                        </ul>
                    </div><!-- .breadcrumbs -->
                </div>
            </div>
        </div>

        <img class="header-img" src="images/service-bg.png" alt="">
    </header><!-- .site-header -->


    <div class="container" style="margin-top: 50px">
        <div class="row">
            <div class="col-12">
                <div class="our-departments-wrap">
                    <h2> Hello! <?php echo $_SESSION["firstName"]?></h2>
                    <h3 style="text-align:center; color:white;" >Kindly fiil in the form with your correct information!</h3>
                    <h5 style="text-align:center; color:white;">This information will be used to predict your diabetes status</h5>

                    <form id="regForm" action="diagnosisreport.php" method="POST">
                          
                          <!-- One "tab" for each step in the form: -->
                          <div class="tab">
                                <p style="font-size:20px;">Patient's number of pregnancies</p>
                                <input type="text" name="pregnancies" style="width:100%;">

                                <p style="font-size:20px;">Patient's blood glucose level</p>
                                <input type="text" name="glucose" style="width:100%;">

                                <p style="font-size:20px;">Patient's blood pressure</p>
                                <input type="text" name="bp" style="width:100%;">

                                <p style="font-size:20px;">Patient's skin thickness</p>
                                <input type="text" name="skin" style="width:100%;">
                              </div>
                              <div class="tab">
                                <p style="font-size:20px;">Patient's insulin level</p>
                                <input type="text" name="insulin" style="width:100%;">

                                <p style="font-size:20px;">Patient's BMI</p>
                                <input type="text" name="bmi" style="width:100%;">

                                <p style="font-size:20px;">Patient's Diabetes Pedigree Function</p>
                                <input type="text" name="dpf" style="width:100%;">

                                <p style="font-size:20px;">Patient's age</p>
                                <input type="text" name="age" style="width:100%;">
                              </div>
                              
                              
                              <div style="overflow:auto;">
                                <div style="float:right;">
                                  <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                  <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                </div>
                              </div>
                              <!-- Circles which indicates the steps of the form: -->
                              <div style="text-align:center;margin-top:40px;">
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                              </div>
                            </form>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="services-tabs">
                    <div class="tabs">
                        <ul class="tabs-nav d-flex flex-wrap">
                            <li class="tab-nav d-flex justify-content-center align-items-center" data-target="#tab_1">Pellentesque pulvinar</li>
                            <li class="tab-nav d-flex justify-content-center align-items-center" data-target="#tab_2">  Pellentesque lacinia </li>
                            <li class="tab-nav d-flex justify-content-center align-items-center" data-target="#tab_3">Consectetur diam</li>
                            <li class="tab-nav d-flex justify-content-center align-items-center" data-target="#tab_4">CMauris tortor</li>
                            <li class="tab-nav d-flex justify-content-center align-items-center" data-target="#tab_5">Phasellus sit amet</li>
                        </ul>

                        <div class="tabs-container">
                            <div id="tab_1" class="tab-content">
                                <img src="images/service-tab-img.png" alt="">

                                <h4>Scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. </h4>

                                <p>Amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus. Curabitur ut augue finibus, luctus tortor at, ornare erat. Nulla facilisi. Sed est risus, laoreet et quam non, viverra accumsan leo. Amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus</p>
                            </div>

                            <div id="tab_2" class="tab-content">
                                <img src="images/service-tab-img.png" alt="">

                                <h4>Scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. </h4>

                                <p>Amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus. Curabitur ut augue finibus, luctus tortor at, ornare erat. Nulla facilisi. Sed est risus, laoreet et quam non, viverra accumsan leo. Amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus</p>
                            </div>

                            <div id="tab_3" class="tab-content">
                                <img src="images/service-tab-img.png" alt="">

                                <h4>Scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. </h4>

                                <p>Amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus. Curabitur ut augue finibus, luctus tortor at, ornare erat. Nulla facilisi. Sed est risus, laoreet et quam non, viverra accumsan leo. Amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus</p>
                            </div>

                            <div id="tab_4" class="tab-content">
                                <img src="images/service-tab-img.png" alt="">

                                <h4>Scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. </h4>

                                <p>Amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus. Curabitur ut augue finibus, luctus tortor at, ornare erat. Nulla facilisi. Sed est risus, laoreet et quam non, viverra accumsan leo. Amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus</p>
                            </div>

                            <div id="tab_5" class="tab-content">
                                <img src="images/service-tab-img.png" alt="">

                                <h4>Scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. </h4>

                                <p>Amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus. Curabitur ut augue finibus, luctus tortor at, ornare erat. Nulla facilisi. Sed est risus, laoreet et quam non, viverra accumsan leo. Amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="subscribe-banner">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">
                    <h2>Subscribe to our newsletter</h2>

                    <form>
                        <input type="email" placeholder="E-mail address">
                        <input class="button gradient-bg" type="submit" value="Subscribe">
                    </form>
                </div>
            </div>
        </div>
    </div>
 -->
     <footer class="site-footer">
        <div class="footer-widgets">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="foot-about">
                            <h2><a href="#"><img src="images/logo.png" alt=""></a></h2>

                            <p>We offer a quick and smart system. Patients can trust a 100% efficient system with their health needs, diagnosis and prescription without meeting the doctor physically.</p>

                            <p class="copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved  <i class="fa fa-heart" aria-hidden="true"></i> dejtech solutions
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                        </div><!-- .foot-about -->
                    </div><!-- .col -->

                    <div class="col-12 col-md-6 col-lg-4 mt-5 mt-md-0">
                        <div class="foot-contact">
                            <h2>Contact</h2>

                            <ul class="p-0 m-0">
                                <li><span>Address:</span>Yaba College of Technology</li>
                                <li><span>Phone:</span>+234-813-554-1567</li>
                                <li><span>Email:</span>abrahamajiboye106@gmail.com</li>
                            </ul>
                        </div>
                    </div><!-- .col -->

                    <div class="col-12 col-md-6 col-lg-4 mt-5 mt-md-0">
                        <div class="foot-links">
                            <h2>Useful Links</h2>

                            <ul class="p-0 m-0">
                                <li class="current-menu-item"><a href="index.php">Home</a></li>
                                <li><a href="about.php">About Medical Diagnosis System</a></li>
                                <li><a href="diagnosis.php">E-Medical Diagnosis</a></li>
                                
                            </ul>
                        </div><!-- .foot-links -->
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .footer-widgets -->
    </footer><!-- .site-footer -->

    <script type='text/javascript' src='js/jquery.js'></script>
    <script type='text/javascript' src='js/jquery.collapsible.min.js'></script>
    <script type='text/javascript' src='js/swiper.min.js'></script>
    <script type='text/javascript' src='js/jquery.countdown.min.js'></script>
    <script type='text/javascript' src='js/circle-progress.min.js'></script>
    <script type='text/javascript' src='js/jquery.countTo.min.js'></script>
    <script type='text/javascript' src='js/jquery.barfiller.js'></script>
    <script type='text/javascript' src='js/custom.js'></script>
    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the crurrent tab

            function showTab(n) {
              // This function will display the specified tab of the form...
              var x = document.getElementsByClassName("tab");
              x[n].style.display = "block";
              //... and fix the Previous/Next buttons:
              if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
              } else {
                document.getElementById("prevBtn").style.display = "inline";
              }
              if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Submit";
                
              } else {
                document.getElementById("nextBtn").innerHTML = "Next";
              }
              //... and run a function that will display the correct step indicator:
              fixStepIndicator(n)
            }

            function nextPrev(n) {
              // This function will figure out which tab to display
              var x = document.getElementsByClassName("tab");
              // Exit the function if any field in the current tab is invalid:
              if (n == 1 && !validateForm()) return false;
              // Hide the current tab:
              x[currentTab].style.display = "none";
              // Increase or decrease the current tab by 1:
              currentTab = currentTab + n;
              // if you have reached the end of the form...
              if (currentTab >= x.length) {
                // ... the form gets submitted:
                document.getElementById('nextBtn').addEventListener('click', (e)=> {
                e.preventDefault();
                regForm.submit();
              })
                return false;
              }
              // Otherwise, display the correct tab:
              showTab(currentTab);
            }

            function validateForm() {
              // This function deals with validation of the form fields
              var x, y, i, valid = true;
              x = document.getElementsByClassName("tab");
              y = x[currentTab].getElementsByTagName("input");
              // A loop that checks every input field in the current tab:
              for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                  // add an "invalid" class to the field:
                  y[i].className += " invalid";
                  // and set the current valid status to false
                  valid = false;
                }
              }
              // If the valid status is true, mark the step as finished and valid:
              if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
              }
              return valid; // return the valid status
            }

            function fixStepIndicator(n) {
              // This function removes the "active" class of all steps...
              var i, x = document.getElementsByClassName("step");
              for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
              }
              //... and adds the "active" class on the current step:
              x[n].className += " active";
            }
</script>
</body>
</html>