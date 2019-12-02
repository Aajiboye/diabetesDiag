<?php session_start();
require "inc/connect.php";
$feedback="Diagnosis Report appears here, ";
$feedback.="Fill the <a href='diagnosis.php' style='color:blue;'>Symptoms Form </a>first";
// get userstatus
$querystatus="SELECT fld_diagnosis from tbl_patient where fld_patientid="
.$_SESSION['userID'];
$exestatus=$conn->query($querystatus);
$exestatus=$exestatus->fetch_assoc();
if(isset($_SESSION["user"]))
{
        $pregnancies=$_POST['pregnancies'];
        $glucose=$_POST['glucose'];
        $bp=$_POST['bp'];
        $skin=$_POST['skin'];
        $insulin=$_POST['insulin'];
        $bmi=$_POST['bmi'];
        $dpf=$_POST['dfp'];
        $age=$_POST['age'];


        if ($headache==1){
            $yellowfever+=1;
            $typhoid+=1;
            $malaria+=1;
        }

        if ($muscleaches==1){
            $yellowfever+=1;
            $malaria+=1;
        }

        if($nauseous==1){
            $yellowfever+=1;
            $malaria+=1;
        }

        if($photophobia==1){
            $yellowfever+=5;
        }
        if($dizzy==1){
            $yellowfever+=5;
        }
        if($redeye==1){
            $yellowfever+=5;
        }
        
        if($appetite==1){
            $yellowfever+=1;
            $typhoid+=1;
        }
        if($dizzy==1){
            $yellowfever+=5;
        }
        
        if($genweakness==1 ){
            $typhoid+=5;
        }

        if( $lethargy==1){
            $typhoid+=5;
        }
        if ($bloodystool==1){
            $malaria+=5;
        }
        if ($convulsion==1){
            $malaria+=5;
        }
        if ($abdominal==1){
            $malaria+=5;
        }
        $report['yellowfever']=$yellowfever;
        $report['typhoid']=$typhoid;
        $report['malaria']=$malaria;
        $disease=max($report);
        $diagnosis = array_search($disease,$report);
            if($disease==0){
                $feedback = "You have no disease that can be diagnosed with the selected options";
            }
            else{
                if($diagnosis=='yellowfever'){
                    $diagnosis = 'Yellow Fever';
                    $comments='. Because there is no cure for the viral infection itself, medical treatment of yellow fever focuses on easing symptoms such as fever, muscle pain, and dehydration. Because of the risk of internal bleeding, avoid aspirin and other nonsteroidal anti-inflammatory drugs. I strongly recommend that you are hospitalized.';
            }
            elseif($diagnosis=='typhoid'){
                $diagnosis = 'Typhoid';
                $comments ='. <p>The only effective treatment for typhoid is antibiotics. The most commonly used are ciprofloxacin (for non-pregnant adults) and ceftriaxone. Other than antibiotics, it is important to rehydrate by drinking adequate water. Visit your physician immediately to determine severity.</p>';
                 $comments ='. <p><b>Drug Recommended:</b> ciprofloxacin</p>. ';
                 $comments.="<p><b>Dosage:</b> 500 mg orally every 12 hours for 10 days </p>";
                 $comments.="<p><b> Other drugs: Ceftriaxone, Cipro, Azithromycin Dose Pack</b></p>";
            }
            elseif($diagnosis=='malaria'){
                $diagnosis = 'Malaria';
                 $comments ='. <p><b>Drug Recommended:</b> ARTEMETHER</p>. ';
                 $comments.="<p><b>Dosage:</b> 35 kg or more: 4 tablets as single initial dose, followed by 4 tablets after 8 hours, and then 4 tablets twice a day (morning and evening) for the following 2 days (total course: 24 tablets). If symptoms persists after 3 days, Kindly call the physician </p>";
                 $comments.="<p><b> Other drugs: Coartem, Malarone, Chloroquine, Doxycycline</b></p>";
            }
        }
             $feedback =  "<b>Hello ". $_SESSION['firstName'].", you have been diagnosed of $diagnosis".$comments."</b>";
             if($exestatus['fld_diagnosis']==0){
                $query="INSERT INTO tbl_symptom (fld_cardNumber,fld_headache,fld_muscleaches,fld_photophobia,fld_nauseous,fld_appetite,fld_dizzy,fld_redeye,fld_lethargy,fld_genpains,fld_diarrhea,fld_sweat,fld_shiver,fld_abdominal,fld_genweakness,fld_bloodystool,fld_convulsion,fld_diagnosis)
                VALUES('$cardNumber',$headache,$muscleaches,$photophobia,$nauseous,$appetite,$dizzy,$redeye,$lethargy,$genpains,$diarrhea,$sweat,$shiver,$abdominal,$genweakness,$bloodystool,$convulsion,'$diagnosis')";
                 $conn->query($query);
            $queryupdate = "update tbl_patient
                            SET fld_diagnosis= 1
                            WHERE fld_cardNumber='".$_SESSION['cardNumber']."'";
                            if($conn->query($queryupdate)){
                                echo "<script>alert('Holla');</script>";
                             }else echo $conn->error;
             }  
             else{
                $query="UPDATE tbl_symptom
                        SET fld_headache=".$headache.",fld_muscleaches=".$muscleaches.",fld_photophobia=".$photophobia.",fld_nauseous=".$nauseous.",fld_appetite=".$appetite.",fld_dizzy=".$dizzy.",fld_redeye=".$redeye.",fld_lethargy=".$lethargy.",fld_genpains=".$genpains.",fld_diarrhea=".$diarrhea.",fld_sweat=".$sweat.",fld_shiver=".$shiver.",fld_abdominal=".$abdominal.",fld_genweakness=".$genweakness.",fld_bloodystool=".$bloodystool.",fld_convulsion=".$convulsion.",fld_diagnosis='".$diagnosis."'               
                             WHERE fld_cardNumber='".$cardNumber."'";
                        $conn->query($query)
             }
             


    unset($_SESSION['user']);

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Report</title>

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
</head>
<body class="single-page">
    <header class="site-header">
        <div class="nav-bar">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
                        <div class="site-branding d-flex align-items-center">
                            <a class="d-block" href="diagnosis.php" rel="home"><img class="d-block" src="images/logo.png" alt="logo"></a>
                        </div><!-- .site-branding -->

                        <nav class="site-navigation d-flex justify-content-end align-items-center">
                            <ul class="d-flex flex-column flex-lg-row justify-content-lg-end align-items-center">
                                <li class="current-menu-item"><a href="diagnosis.php">Home</a></li>
                                <li><form method="get" action="index.php"><input class="button gradient-bg" type="submit" value="Log-out" name="logout"></form></li>
                                

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
                    <h1>Report</h1>

                    <div class="breadcrumbs">
                        <ul class="d-flex flex-wrap align-items-center p-0 m-0">
                            <li><a href="diagnosis.php">Home</a></li>
                            <li>Diagnosis Report</li>
                        </ul>
                    </div><!-- .breadcrumbs -->

                </div>
            </div>
        </div>

        <img class="header-img" src="images/about-bg.png" alt="">
    </header><!-- .site-header -->

    <div class="med-history">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-12 col-lg-6">
                    <h2>Report</h2>

                    <p><?php echo $feedback;?> </p>

                    
                </div>

                <div class="col-12 col-lg-6 mt-5 mt-lg-0">
                    <img class="responsive" src="images/about.jpg" alt="">
                </div>
            </div>
        </div>
    </div>

    

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
</body>
</html>