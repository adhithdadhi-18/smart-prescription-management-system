<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Smart Prescription Management System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{

background:
linear-gradient(rgba(0,0,0,.60),rgba(0,0,0,.60)),
url("assets/images/hospital.jpg");

background-size:cover;
background-position:center;
height:100vh;
overflow:hidden;

}

.hero{

height:100vh;
display:flex;
justify-content:center;
align-items:center;

}

.glass{

width:700px;

background:rgba(255,255,255,.12);

backdrop-filter:blur(12px);

padding:50px;

border-radius:20px;

text-align:center;

color:white;

box-shadow:0 15px 40px rgba(0,0,0,.35);

}

.logo{

font-size:70px;

color:#0dcaf0;

margin-bottom:20px;

}

h1{

font-weight:700;

margin-bottom:20px;

}

.lead{

font-size:18px;

margin-bottom:30px;

}

.feature{

font-size:18px;

margin:10px 0;

}

.btn-login{

background:rgba(255,255,255,.15);

border:2px solid rgba(255,255,255,.35);

color:white;

padding:14px 45px;

font-size:18px;

font-weight:600;

border-radius:50px;

backdrop-filter:blur(10px);

transition:.3s;

}

.btn-login:hover{

background:#0d6efd;

border-color:#0d6efd;

color:white;

transform:translateY(-4px);

box-shadow:0 10px 25px rgba(13,110,253,.4);

}

.footer{

position:absolute;

bottom:20px;

width:100%;

text-align:center;

color:white;

font-size:15px;

}

</style>

</head>

<body>

<div class="hero">

<div class="glass">

<div class="logo">

<i class="fa-solid fa-notes-medical"></i>

</div>

<h1>

Smart Prescription Management System

</h1>

<p class="lead">

A secure digital platform for managing prescriptions,
patients, doctors, pharmacies and medicines.

</p>

<a
href="login.php"
class="btn btn-primary btn-lg btn-login">

<i class="fa-solid fa-right-to-bracket"></i>

Login to System

</a>