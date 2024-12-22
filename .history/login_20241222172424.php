<?php
session_start();
/*css design*/
echo "<style>
        h3{
            padding-left:500px;
            color: red;
        }
    </style>";
/*css design ends here*/

include 'db_connect.php';

if (isset($_POST['login'])) {
    $username = htmlspecialchars(trim($_POST['username']));
    $pwd = htmlspecialchars(trim($_POST['password']));
    $usertype = "";

    if (!empty($_POST['usertype'])) {
        $usertype = htmlspecialchars(trim($_POST['usertype']));
    }

    $uid = "";

    $sql_get_user_id = "SELECT uid FROM users WHERE username = ?";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql_get_user_id)) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $uid = $row['uid'];

            $ur_id = "";

            $sql_get_userRole_id = "SELECT ur_id FROM user_roles WHERE role_name = ?";
            $stmt1 = mysqli_stmt_init($conn);

            if (mysqli_stmt_prepare($stmt1, $sql_get_userRole_id)) {
                mysqli_stmt_bind_param($stmt1, "s", $usertype);
                mysqli_stmt_execute($stmt1);
                $result1 = mysqli_stmt_get_result($stmt1);

                if (mysqli_num_rows($result1) > 0) {
                    $row = mysqli_fetch_assoc($result1);
                    $ur_id = $row['ur_id'];

                    $sql_login_user = "SELECT * FROM users WHERE username = ? AND password = ? AND ur_id = ?";
                    $stmt2 = mysqli_stmt_init($conn);

                    if (mysqli_stmt_prepare($stmt2, $sql_login_user)) {
                        mysqli_stmt_bind_param($stmt2, "sss", $username, $pwd, $ur_id);
                        mysqli_stmt_execute($stmt2);
                        $result2 = mysqli_stmt_get_result($stmt2);

                        if (mysqli_num_rows($result2) > 0) {
                            $array = mysqli_fetch_assoc($result2);
                            $_SESSION['username'] = $array['username'];
                            $_SESSION['fullname'] = $array['fullname'];
                            $_SESSION['uid'] = $array['uid'];
                            $_SESSION['uid'] = $array['uid'];

                            $_SESSION['message'] = "Login successful! Redirecting...";
                             
                            echo '<script>
                                    window.onload = function() {
                                        document.getElementById("popupMessage").innerText = "Login successful!";
                                        document.getElementById("popup").style.display = "block";
                                        setTimeout(function() {
                                            window.location.href = "' . ($array['ur_id'] == 2 ? 'insertion.php' :'house_detail1.php') . '";
                                        }, 2000);
                                    };
                                  </script>';
                        } else {
                            $_SESSION['invalid_message'] = "Invalid username or password";
                            echo '<script>
                                    window.onload = function() {
                                        document.getElementById("popupMessage").innerText = "Invalid username or password";
                                        document.getElementById("popup").style.display = "block";
                                    };
                                  </script>';
                        }
                    }
                }
            }
        } else {
            $_SESSION['invalid_message'] = "Invalid username or password";
            echo '<script>
                    window.onload = function() {
                        document.getElementById("popupMessage").innerText = "Invalid username or password";
                        document.getElementById("popup").style.display = "block";
                    };
                  </script>';
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/fontAwesome/css/font-awesome.css" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login Form</title>
    <style>
        

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="margin">
            <div class="form-box">
                <h1>Login Form</h1>
                <form method="POST" action="" autocomplete="off">
                    <div class="input-box">
                        <i class="fa fa-users"></i>
                        <input type="text" name="username" placeholder="Username">
                    </div>
                    <div class="input-box">
                        <i class="fa fa-key" aria-hidden="true"></i>
                        <input type="password" name="password" placeholder="Password" id="myInput" >
                        <span class="eye" onclick="myFunction()">
                            <i id="hide1" class="fa fa-eye"></i>
                            <i id="hide2" class="fa fa-eye-slash"></i>
                        </span>
                    </div>
                    <div class="input-box">
                        <select name="usertype" required>
                            <optgroup label="User Type">
                                <option value="Owner">Owner</option>
                                <option value="Customer">Customer</option>
                            </optgroup>
                        </select>
                    </div>
                    <input type="submit" name="login" value="Log in" class="login-btn">
                    <button class="btn btn-success">
  <a href="index.php" style="text-decoration: none; color: inherit; padding: 0; margin: 0;">Back</a>
</button>

                </form>
            </div>
        </div>
    </div>
    <?php include 'hide_password.php' ?>

    <!-- Popup window -->
    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="document.getElementById('popup').style.display='none'">&times;</span>
            <p id="popupMessage"></p>
        </div>
    </div>

    <script>
        function myFunction() {
            var x = document.getElementById("myInput");
            var hide1 = document.getElementById("hide1");
            var hide2 = document.getElementById("hide2");
            if (x.type === "password") {
                x.type = "text";
                hide1.style.display = "none";
                hide2.style.display = "inline";
            } else {
                x.type = "password";
                hide1.style.display = "inline";
                hide2.style.display = "none";
            }
        }
    </script>
</body>
</html>

<div id="about"><?php
		include 'footer1.php';
		?></div>
