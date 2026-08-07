<?php
session_start();
include("config/db.php");

if(isset($_POST['login']))
{
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $role = $_POST['role'];

    $sql = "SELECT * FROM users
            WHERE email='$email'
            AND password='$password'
            AND role='$role'";

    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)==1)
    {
        $user = mysqli_fetch_assoc($result);

        $_SESSION['user_id']=$user['id'];
        $_SESSION['name']=$user['name'];
        $_SESSION['role']=$user['role'];

        if($role=="admin")
            header("Location: admin/dashboard.php");
        elseif($role=="doctor")
            header("Location: doctor/dashboard.php");
        elseif($role=="patient")
            header("Location: patient/dashboard.php");
        elseif($role=="pharmacy")
            header("Location: pharmacy/dashboard.php");

        exit();
    }
    else
    {
        $error="Invalid Login Credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="assets/css/style.css">

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login - Smart Prescription Management System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{

height:100vh;

background:
linear-gradient(rgba(0,0,0,.55),rgba(0,0,0,.55)),
url("assets/images/hospital2.jpg");

background-size:cover;
background-position:center;
background-repeat:no-repeat;

display:flex;
justify-content:center;
align-items:center;

}

.login-card{

width:420px;

background:rgba(255,255,255,.12);

backdrop-filter:blur(15px);

border-radius:25px;

padding:40px;

color:white;

box-shadow:0 20px 45px rgba(0,0,0,.35);

}

.logo{

font-size:65px;

text-align:center;

color:#0dcaf0;

margin-bottom:15px;

}

.login-card h2{

text-align:center;

font-weight:700;

}

.login-card p{

text-align:center;

opacity:.9;

margin-bottom:30px;

}

.input-group-text{

background:#0d6efd;

border:none;

color:white;

}

.form-control,
.form-select{

border:none;

padding:12px;

}

.form-control:focus,
.form-select:focus{

box-shadow:0 0 10px rgba(13,110,253,.4);

}

.btn-login{

width:100%;

background:#0d6efd;

color:white;

border:none;

padding:12px;

border-radius:50px;

font-size:18px;

font-weight:600;

transition:.3s;

}

.btn-login:hover{

background:#0b5ed7;

transform:translateY(-3px);

}

.home-btn{

margin-top:15px;

display:block;

text-align:center;

color:white;

text-decoration:none;

}

.home-btn:hover{

color:#0dcaf0;

}

.eye{

cursor:pointer;

}

.alert{

border-radius:12px;

}

</style>

</head>

<body>

<div class="login-card">

<div class="logo">

<i class="fa-solid fa-notes-medical"></i>

</div>

<h2>Welcome Back</h2>

<p>Login to Smart Prescription Management System</p>

<?php
if(isset($error))
{
?>
<div class="alert alert-danger">
<?php echo $error; ?>
</div>
<?php
}
?>

<form method="POST" id="loginForm">

<div class="mb-3">

<label class="mb-2">

<i class="fa-solid fa-envelope"></i>

Email

</label>

<div class="input-group">

<span class="input-group-text">

<i class="fa-solid fa-envelope"></i>

</span>

<input
type="email"
name="email"
class="form-control"
placeholder="Enter your email"
required>

</div>

</div>

<div class="mb-3">

<label class="mb-2">

<i class="fa-solid fa-lock"></i>

Password

</label>

<div class="input-group">

<span class="input-group-text">

<i class="fa-solid fa-lock"></i>

</span>

<input
type="password"
id="password"
name="password"
class="form-control"
placeholder="Enter your password"
required>

<span
class="input-group-text eye"
onclick="togglePassword()">

<i id="eyeIcon" class="fa-solid fa-eye"></i>

</span>

</div>

</div>

<div class="mb-4">

<label class="mb-2">

<i class="fa-solid fa-user"></i>

Login As

</label>

<select
name="role"
class="form-select">

<option value="admin">Admin</option>
<option value="doctor">Doctor</option>
<option value="patient">Patient</option>
<option value="pharmacy">Pharmacy</option>

</select>

</div>

<button
type="submit"
name="login"
class="btn-login"
id="loginBtn">

<i class="fa-solid fa-right-to-bracket"></i>

Login to System

</button>

</form>

<a
href="index.php"
class="home-btn">

<i class="fa-solid fa-arrow-left"></i>

Back to Home

</a>

</div>

<script>

function togglePassword(){

var x=document.getElementById("password");

var icon=document.getElementById("eyeIcon");

if(x.type==="password")
{
x.type="text";
icon.className="fa-solid fa-eye-slash";
}
else
{
x.type="password";
icon.className="fa-solid fa-eye";
}

}

document.getElementById("loginForm").addEventListener("submit",function(){

document.getElementById("loginBtn").innerHTML='<span class="spinner-border spinner-border-sm"></span> Logging in...';

});

</script>

</body>

</html>