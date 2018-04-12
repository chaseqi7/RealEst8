<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Ziming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-08
 * File name: account.php
 */

/* Main page with two forms: sign up and log in */
require 'db.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign-Up/Login Form</title>
    <?php include 'css/css.html'; ?>
<!--    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
<!--    <script src="libraries/jquery.validate.js"></script>-->
<!--    <script src="js/index.js"></script>-->
<!--    <script src="js/validation.js"></script>-->
</head>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['login'])) { //user logging in
        require 'login.php';
    }
    elseif (isset($_POST['register'])) {
        //user registering
        require 'register.php';
    }
}
?>
<body>
    <div id="nav-bar">
        <ul class="navbar">
            <li class="navTitle"><a href="index.php">Real Est8</a></li>
            <li id="account-dropdown" class="dropdown">
                <a href="account.php" class="dropbtn">Sign in</a>
            </li>
        </ul>
    </div>
    <div class="form">
        <ul class="tab-group">
            <li class="tab active"><a href="#login">Log In</a></li>
            <li class="tab"><a href="#signup">Sign Up</a></li>
        </ul>
        <div class="tab-content">
            <div id="login">
                <h1>Welcome Back!</h1>
                <form name="signInForm" action="account.php" method="post" autocomplete="off">
                    <div class="field-wrap">
                        <label>
                            Email Address<span class="req"></span>
                        </label>
                        <input type="email" autocomplete="off" name="email"/>
                    </div>
                    <div class="field-wrap">
                        <label>
                            Password<span class="req"></span>
                        </label>
                        <input type="password" autocomplete="off" name="password"/>
                    </div>
                    <p class="forgot"><a href="forgot.php">Forgot Password?</a></p>
                    <button class="button button-block" name="login" id="login"/>Log In</button>
                </form>
            </div>
            <div id="signup">
                <h1>Sign Up</h1>
                <form name="signUpForm" action="account.php" method="post" autocomplete="off">
                    <div class="top-row">
                        <div class="field-wrap">
                            <label>
                                First Name<span class="req"></span>
                            </label>
                            <input type="text" autocomplete="off" name='firstname' />
                        </div>
                        <div class="field-wrap">
                            <label>
                                Last Name<span class="req"></span>
                            </label>
                            <input type="text" autocomplete="off" name='lastname' />
                        </div>
                    </div>
                    <div class="field-wrap">
                        <label>
                            Email Address<span class="req"></span>
                        </label>
                        <input type="email" autocomplete="off" name='email' />
                    </div>
                    <div class="field-wrap">
                        <label>
                            Password<span class="req"></span>
                        </label>
                        <input type="password" autocomplete="off" name='password' id="password"/>
                    </div>
                    <div class="field-wrap">
                        <label>
                            Confirm Password<span class="req"></span>
                        </label>
                        <input type="password" autocomplete="off" name='confirmPassword' id="confirmPassword"/>
                    </div>
                    <div class="field-wrap">
                        <label>
                            Phone Number<span class="req"></span>
                        </label>
                        <input type="text" autocomplete="off" name='phone'/>
                    </div>
                    <button type="submit" class="button button-block" name="register" id="register"/>Register</button>
                </form>
            </div>
        </div><!-- tab-content -->
    </div> <!-- /form -->
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="libraries/jquery.validate.js"></script>
    <script src="js/index.js"></script>
    <script src="js/validation.js"></script>
</body>
</html>
