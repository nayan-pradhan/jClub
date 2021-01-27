<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="loginstyles.css">
  <title>Login/SignUp</title>
  <!--Font Awesome-->
  <script src="https://kit.fontawesome.com/7594947089.js" crossorigin="anonymous"></script>
  <link href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-shims.min.css" media="all" rel="stylesheet">
  <link href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css" media="all" rel="stylesheet">
  <script type="javascript" src="./particlesjs-config.json"></script>
  <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>


<body>
  <section id="container">
    <div id="particle-div"></div>
    <script>
      particlesJS.load('particle-div', 'particlesjs-config.json', function() {
        // console.log('particles-js config loaded');
      });
    </script>
    <div id="formid" class="form">
      <div class="button">
        <div id="btn-color"></div>
        <button type="button" class="btn" name="button" onclick="login()">
          <p id="blue">Login</p>
        </button>
        <button type="button" class="btn" name="button" onclick="register()">
          <p id="yellow">&#32; Sign Up</p>
        </button>
      </div>
      <div class="socials">
        <a class="fb" href="#"><i class="fab fa-facebook-f fa-lg"></i></a>
        <a class="in" href="#"><i class="fab fa-instagram fa-lg"></i></a>
        <a class="tw" href="#"><i class="fab fa-twitter fa-lg"></i></a>
      </div>
      <form id="login" class="input-group" action="includes/login-in.php" method="post">
        <input class="input-field" type="text" name="userid" placeholder="Username/Email" required>
        <input class="input-field" type="password" name="password" placeholder="Enter password" required>
        <input class="check-box" type="checkbox" name="rememberpass"><span>Remember Password</span><br>
        <button type="submit" class="btn btn-outline-warning submit-btn btn-sm" name="buton">Login</button>
      </form>
      <?php

      if (isset($_GET["error"])) {
        if ($_GET["error"] == "invaliduid") {
          echo "<p class='error-msg' style='text-align:center; padding: 15px; color:red'>Invalid Username</p>";
        }
        if ($_GET["error"] == "invalidemail") {
          echo "<p class='error-msg' style='text-align:center; padding: 15px; color:red'>Use a proper email.</p>";
        } else if ($_GET["error"] == "passmatch") {
          echo "<p class='error-msg' style='text-align:center; padding: 15px; color:red'>Password doesn't match.</p>";
        } else if ($_GET["error"] == "usertaken") {
          echo "<p class='error-msg' style='text-align:center; padding: 15px; color:red'>Username already exists!</p>";
        } else if ($_GET["error"] == "prestatefailed") {
          echo "<p class='error-msg' style='text-align:center; padding: 15px; color:red'>Oops! Something is not right.</p>";
        } else if ($_GET["error"] == "none") {
          echo "<p class='error-msg' style='text-align:center; padding: 15px; color:green'>Success. Now you can login.</p>";
        } else if ($_GET['error'] == 'wronguserorpass') {
          echo "<p class='error-msg' style='text-align:center; padding: 15px; color:red'>Wrong Username or Password.</p>";
        }
      }

      ?>
      <form id="register" class="input-group" action="includes/signup-in.php" method="post">
        <input class="input-field" type="text" name="studentname" placeholder="Full Name" required>
        <input class="input-field" type="email" name="email" placeholder="Email Address" required>
        <input class="input-field" type="text" name="username" placeholder="Username" required>
        <input class="input-field" type="password" name="pwd" placeholder="Enter password" required>
        <input class="input-field" type="password" name="repwd" placeholder="Repeat password" required>
        <input class="input-field" type="text" name="major" placeholder="Major">
        <input class="input-field" type="text" name="accountdes" placeholder="Tell us what you love to do! (Optional)">
        <label for="date">Date of Birth:</label>
        <input class="input-field" type="date" id="dob" name="dob" required>
        <input class="check-box" type="checkbox" name="rememberpass" required><span>I agree to terms and conditions.</span><br>
        <button class="submit-btn" type="submit" name="button">Register</button>
      </form>
    </div>
    <!--to display error messages-->
  </section>

  <!-- Javascript -->
  <script>
    var x = document.getElementById("login");
    var y = document.getElementById("register");
    var z = document.getElementById("btn-color");
    var w = document.getElementById("formid");

    function register() {
      x.style.left = "-450px";
      y.style.left = "50px";
      z.style.left = "94px";
      w.style.paddingBottom = "300px";
      document.getElementByID("yellow").style.color = "black";
    }

    function login() {
      x.style.left = "50px";
      y.style.left = "450px";
      z.style.left = "0px";
      w.style.paddingBottom = "5px";
      document.getElementByID("blue").style.color = "black";
    }
  </script>

</body>

</html>