 <!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>TDH System</title>

<link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<style>
    html, body {
        margin: 0;
        padding: 0;
        height: 100%;
        font-family: 'Segoe UI', sans-serif;
        overflow: hidden;
        background: #000;
        position: relative;
    }

    /* Full-screen video */
    .video-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 0;
    }

    .video-background video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        filter: brightness(70%);
    }

    /* Center the login box */
    .login-box {
        position: relative;
        z-index: 10;
        width: 100%;
        max-width: 400px;
        background: rgba(17, 17, 17, 0.85);
        color: #fff;
        border-radius: 12px;
        box-shadow: 0px 8px 20px rgba(255, 165, 0, 0.3);
        padding: 30px;
        margin: auto;
        top: 50%;
        transform: translateY(-50%);
        animation: fadeInUp 0.8s ease;
    }

    @keyframes fadeInUp {
        from { transform: translateY(40px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .form-control {
        background: #1a1a1a;
        border: 1px solid #333;
        border-radius: 8px;
        color: #fff;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: orange;
        box-shadow: 0 0 10px rgba(255, 165, 0, 0.6);
        outline: none;
    }

    .btn-login {
        background: orange;
        border: none;
        border-radius: 8px;
        padding: 12px;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        transform: scale(1.05);
        background: #ff8800;
        box-shadow: 0 5px 20px rgba(255, 165, 0, 0.5);
    }

    .form-check-label {
        color: #bbb;
    }

    .message {
        background: rgba(255, 165, 0, 0.15);
        border-left: 5px solid orange;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 6px;
    }

    h3 {
        color: orange;
        font-weight: bold;
        text-align: center;
        margin-bottom: 30px;
        text-shadow: 0 0 10px #FFA500, 0 0 20px #FF8C00;
        animation: glow 2s ease-in-out infinite alternate;
        font-size: 1.5rem;
    }

    @keyframes glow {
        from { text-shadow: 0 0 5px #FFA500, 0 0 10px #FF8C00; }
        to { text-shadow: 0 0 20px #FFA500, 0 0 40px #FF8C00; }
    }

    @media (max-width: 480px) {
        h3 { font-size: 1.2rem; }
    }

    /* Footer - desktop app style */
    .footer {
        position: fixed;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        color: orange;
        font-size: 14px;
        text-shadow: 0 0 5px #FFA500, 0 0 15px #FF8C00;
        z-index: 20;
        animation: fadeIn 2s ease-in-out;
        font-weight: bold;
        opacity: 0.9;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 0.9; }
    }

</style>
</head>

<body>

<!-- Video Background -->
<div class="video-background">
    <video src="<?php echo base_url(); ?>assets/video/t.mp4" autoplay muted loop playsinline></video>
</div>

<!-- Login Box -->
<div class="login-box">
    <div class="card-body loginpage">
        <?php if (!empty($this->session->flashdata('feedback'))) { ?>
            <div class="message">
                <strong>Alert: </strong><?php echo $this->session->flashdata('feedback') ?>
            </div>
        <?php } ?>

        <h3>Welcome Back, Habibi – Tekrar hoş geldin, Habibi – مرحباً بعودتك، حبيبي</h3>

        <form class="form-horizontal form-material" method="post" id="loginform" action="login/Login_Auth">
            <div class="form-group m-t-20">
                <input class="form-control" name="email" 
                       value="<?php if(isset($_COOKIE['email'])) { echo $_COOKIE['email']; } ?>" 
                       type="text" required placeholder="Access Email">
            </div>

            <div class="form-group">
                <input class="form-control" name="password" 
                       value="<?php if(isset($_COOKIE['password'])) { echo $_COOKIE['password']; } ?>" 
                       type="password" required placeholder=" Password">
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="remember" class="form-check-input" id="remember-me">
                <label class="form-check-label" for="remember-me">Remember Me</label>
            </div>

            <div class="form-group text-center">
                <button class="btn btn-login btn-block text-uppercase text-white" type="submit">
                    Log In
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Desktop App Style Footer -->
<div class="footer">
     Powered by Franklin mr Black.
</div>

<!-- Scripts -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
