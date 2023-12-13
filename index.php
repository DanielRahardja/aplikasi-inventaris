<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <!-- Style -->
    <style>
        *{
            font-family: 'poppins','sans serif';
        }
        .login{
            height: 100vh;
        }
        .header h1{
            font-weight: 600;
            font-size: 32px;
            line-height: 48px;
            /* identical to box height */
            color: #000000;
        }
        .header p{
            font-style: normal;
            font-weight: 400;
            font-size: 14px;
            line-height: 21px;
            /* identical to box height */
            color: #737373;
            margin-bottom: 20px;
        }
        .login-left img{
            width: 675px;
            height: 663px;
            top: 0px;
        }
        .login-form label{
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 24px;
            /* identical to box height */
            color: #000000;
            margin-top:20px;
        }
        .login-form input{
            box-sizing: border-box;
            background: #FFFFFF;
            border: 1px solid #BCBCBC;
            border-radius: 8px;
        }
        .login-form .signin{
            width: 100%;
            height: 42px;

            background: green;
            border-radius: 8px;
            color: #fff;
            border: none;
        }   
    </style>
</head>
<body>
    <section class="login d-flex">
                <div class="login-left w-50 h-100">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img src="assets/images/inventaris.jpg" class="d-block"  alt="Decoration">
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="login-right w-50 h-100">
                    <div class="row justify-content-center align-items-center h-100">
                        <div class="col-6">
                            <div class="header">
                                <h1>Aplikasi Inventaris</h1>
                                <p>Silahkan ketik username dan passwordnya</p>
								<?php 
									if(isset($_GET['pesan'])){
										if($_GET['pesan']=="gagal"){
											echo "
											<div class='alert bg-danger text-light'><strong>AKSES DITOLAK!</strong> Proses Login gagal!</div>";
										}
									}
								?>
                            </div>
                            <div class="login-form">
                                <form action="cek_login.php" method="POST">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="uname" placeholder="Masukkan Username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                                    </div>
                                    <button type="submit" class="signin">Sign In</button>
                                </form>
                            </div>
                        <!-- End -->
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>