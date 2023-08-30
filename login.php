<?php
include('conection.php');
//session start for log in
session_start();

$showAlert = false;
$showError = false;
$exists = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['signup'])) {
        // username and password sent from form 
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
        //to check if the user is already present or not in our Database
        $select_user = "Select * from user where username='$username'";
        $result2 = mysqli_query($conn, $select_user);
        $num = mysqli_num_rows($result2);

        if ($num == 0) {
            if (($password == $confirm_password) && $exists == false) {
                $hash = md5($password);
                // Password Hashing is used here. 
                $sql = "INSERT INTO `user` ( `username`, `email`,`password`) 
            VALUES ('$username','$email','$hash')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $showAlert = true;
                }} else {
                $showError = "Passwords do not match";
            } }
        if ($num > 0) {
            $exists = "Username not available";
        }} //// end if 
    //login
    if (isset($_POST['login'])) {
        extract($_POST);
        $hash = md5($password);
        $sql = "SELECT * FROM user where username='$username' and password='$hash'";
        $login = mysqli_query($conn, $sql);
        $row  = mysqli_fetch_array($login);
        if (is_array($row)) {
            $_SESSION["user_id"] = $row['user_id'];
            $_SESSION["email"] = $row['email'];
            $_SESSION["username"] = $row['username'];
            header("Location: index.php");
        } else {
            echo "Invalid Email ID/Password";
        }  }}
$sql = "  SELECT * FROM categories ";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>News</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="icon" type="R.png" href="https://th.bing.com/th/id/OIP.xqxsVRJXXmks4_OTl8-wewHaHa?pid=ImgDet&rs=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/ticker-style.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* Make the image fully responsive */
        .carousel-inner img {
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body lang="ar" dir="rtl">
    <header>
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header ">
                <div class="header-top black-bg d-none d-md-block">
                    <div class="container">
                        <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left">
                                    <ul>

                                        <li><img src="assets/img/icon/header_icon1.png" alt="">34ºc, Sunny </li>
                                        <li><img src="assets/img/icon/header_icon1.png" alt="">Tuesday, 18th June, 2019</li>
                                    </ul>
                                </div>
                                <div class="header-info-right">
                                    <ul class="header-social">
                                
                                        <!--signup-->
                                        <li>
                                            <?php
                                            if ($showAlert) {

                                                echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>Success!</strong> Your account is now created and you can login. 
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                                                 <span aria-hidden="true">×</span> 
                                                 </button> 
                                                  </div> ';
                                            }
                                            if ($showError) {

                                                echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert"> 
                                                <strong>Error!</strong> ' . $showError . '
                                                <button type="button" class="close" data-dismiss="alert aria-label="Close">
                                                <span aria-hidden="true">×</span> 
                                                </button> 
                                                </div> ';
                                            }
                                            if ($exists) {
                                                echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Error!</strong> ' . $exists . '
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                                                 <span aria-hidden="true">×</span> 
                                                </button>
                                                </div> ';
                                            }
                                            ?>
                                            <button onclick="document.getElementById('id02').style.display='block'"> signup</button>
                                            <div id="id02" class="modal">
                                                <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
                                                <form class="modal-content" action="index.php" method="POST">
                                                    <div class="container">
                                                        <h1>Sign Up</h1>
                                                        <p>Please fill in this form to create an account.</p>
                                                        <hr>
                                                        <label for="email"><b>Email</b></label>
                                                        <input class="form-control" type="text" placeholder="Enter Email" id="email" name="email">

                                                        <label for="username"><b>Username</b></label>
                                                        <input class="form-control" type="text" placeholder="Enter username" id="password" name="username" required>

                                                        <label for="password"><b>Password</b></label>
                                                        <input class="form-control" type="password" placeholder="Enter Password" id="password" name="password" required>

                                                        <label for="confirm_password"><b>confirm Password</b></label>
                                                        <input class="form-control" type="password" placeholder="Confirm Password" id="confirm_password" name="confirm_password" required>

                                                        <label>
                                                            <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
                                                        </label>

                                                        <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

                                                        <div class="clearfix">
                                                            <button type="submit" name="signup" class="signupbtn">Sign Up</button>
                                                            <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </li>

                                        <!-- login form -->
                                        <li>
                                            <button onclick="document.getElementById('id01').style.display='block'"> Login</button>
                                            <div id="id01" class="modal">
                                                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;
                                                </span>
                                                <form class="modal-content animate" action="<?php echo htmlspecialchars('index.php'); ?>" method="post">
                                                    <div class="imgcontainer">
                                                        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal"> &times;</span>
                                                        <img src="img_avatar2.png" alt="Avatar" class="avatar">
                                                    </div>

                                                    <div class="container">
                                                        <label for="username"><b>Username</b></label>
                                                        <input type="text" placeholder="Enter Username" name="username" required>

                                                        <label for="password"><b>Password</b></label>
                                                        <input type="password" placeholder="Enter Password" name="password" required>
                                                        <br>
                                                        <button type="submit" name="login" style="background-color:#43e459de;"> Login</button>
                                                        <label style="color: #888;">
                                                            <input type="checkbox" checked="checked" name="remember"> تذكرني
                                                        </label>
                                                    </div>

                                                    <div class="container" style="background-color:#888">
                                                        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                                                        <span class="psw">هل نسيت <a href="#">كلمة السر؟</a></span>
                                                    </div>
                                                </form>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-mid d-none d-md-block ">
                    <div class="container">
                        <div class="row d-flex align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-3 col-lg-3 col-md-3">
                                <div class="logo">
                                    <a href="index.php"><img style="height:100px; width:100px;" src="assets/img/logo/R.png" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-md-9">
                                <div class="header-banner f-right ">
                                    <!-- -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-bottom header-sticky ">
                    <div class="container align-right">
                        <div class="row align-items-center ">
                            <div class="col-xl-10 col-lg-10 col-md-12 header-flex">
                                <!-- sticky -->
                                <div class="sticky-logo">
                                    <a href="index.php"><img style="height:100px; width:100px;" src="assets/img/logo/R.png" alt=""></a>
                                </div>

                            </div>

                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-md-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
    <main>
        <div class="about-area">
            <div class="container">
                <!-- Hot Aimated News Tittle-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="trending-tittle">
                            <strong>اخر الأخبار</strong>
                            <!-- <p>Rem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
                            <div class="trending-animated">
                                <ul id="js-news" class="js-hidden">
                                    <li class="news-item">العفو الدولية تدين الاستخدام "الدنيء والوحشي" للألغام من قبل جيش ميانمار</li>
                                    <li class="news-item">ارتفاع كبير في عدد الوفيات والإصابات بفيروس (كورونا) خلال أسبوع</li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-8">
                        <!-- Trending Tittle -->
                        <div class="about-right mb-90">
                            <div class="about-img">
                                <img src="assets/img/post/about_heor.jpg" alt="">
                            </div>



                            <div class="about-prea">
                                <div id="demo" class="carousel slide" data-ride="carousel">

                                    <!-- Indicators -->
                                    <ul class="carousel-indicators">
                                        <li data-target="#demo" data-slide-to="0" class="active"></li>
                                        <li data-target="#demo" data-slide-to="1" class="active"></li>
                                        <li data-target="#demo" data-slide-to="2" class="active"></li>
                                    </ul>

                                    <!-- The slideshow -->
                                    <div class="carousel-inner">

                                        <div class="carousel-item active">
                                            <img src="assets\img\learn_about_bg.png" alt="..">
                                        </div>
                                        <div class="carousel-item ">
                                            <img src="assets\img\single_blog_2.png" alt="">
                                        </div>
                                        <div class="carousel-item ">
                                            <img src="assets\img\single_blog_2.png" alt="">
                                        </div>
                                    </div>

                                    <!-- Left and right controls -->
                                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </a>
                                    <a class="carousel-control-next" href="#demo" data-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </a>

                                </div>
                            </div>
                            <div class="col-lg-8">
                              
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- Section Tittle -->
                        <div class="section-tittle mb-40">
                            <h3>تابعنا</h3>
                        </div>
                        <!-- Flow Socail -->
                        <div class="single-follow mb-45">
                            <div class="single-box">
                                <div class="follow-us d-flex align-items-center">
                                    <div class="follow-social">
                                        <a href="#"><img src="assets/img/news/icon-fb.png" alt=""></a>
                                    </div>
                                    <div class="follow-count">
                                        <span>8,045</span>
                                        <p>Fans</p>
                                    </div>
                                </div>
                                <div class="follow-us d-flex align-items-center">
                                    <div class="follow-social">
                                        <a href="#"><img src="assets/img/news/icon-tw.png" alt=""></a>
                                    </div>
                                    <div class="follow-count">
                                        <span>8,045</span>
                                        <p>Fans</p>
                                    </div>
                                </div>
                                <div class="follow-us d-flex align-items-center">
                                    <div class="follow-social">
                                        <a href="#"><img src="assets/img/news/icon-ins.png" alt=""></a>
                                    </div>
                                    <div class="follow-count">
                                        <span>8,045</span>
                                        <p>Fans</p>
                                    </div>
                                </div>
                                <div class="follow-us d-flex align-items-center">
                                    <div class="follow-social">
                                        <a href="#"><img src="assets/img/news/icon-yo.png" alt=""></a>
                                    </div>
                                    <div class="follow-count">
                                        <span>8,045</span>
                                        <p>Fans</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                   
                    </div>
                </div>
            </div>
        </div>

    </main>

    <footer>
        <!-- Footer Start-->
        <div class="footer-area footer-padding fix">
            <div class="container">
         
            </div>
        </div>
        </div>
        <!-- footer-bottom aera -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="footer-border">
                    <div class="row d-flex align-items-center justify-content-between">
                        <div class="col-lg-6">
                            <div class="footer-copy-right">
                                <p>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    Copyright &copy;<script>
                                        document.write(new Date().getFullYear());
                                    </script> All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="footer-menu f-right">
                                <ul>
                                    <li><a href="#">Terms of use</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End-->
    </footer>
    <script>
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        var modal = document.getElementById('id02');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <!-- JS here -->

    <!-- All JS Custom Plugins Link Here here -->
    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <!-- Date Picker -->
    <script src="./assets/js/gijgo.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- Breaking New Pluging -->
    <script src="./assets/js/jquery.ticker.js"></script>
    <script src="./assets/js/site.js"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="./assets/js/jquery.scrollUp.min.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>

    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>
</body>

</html>