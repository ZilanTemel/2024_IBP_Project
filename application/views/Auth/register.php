<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KAYIT OL</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/login.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding-top: 100px;
        }
        .form-title {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }
        .input-group {
            position: relative;
            margin-bottom: 20px;
        }
        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            outline: none;
        }
        .input-group label {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #aaa;
            transition: all 0.3s ease;
            pointer-events: none;
        }
        .input-group input:focus + label,
        .input-group input:not(:placeholder-shown) + label {
            top: 0;
            font-size: 12px;
            color: #007bff;
        }
        .btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .link {
            text-align: center;
            margin-top: 20px;
        }
        .link a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .link a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container" id="signUp" >
        <h1 class="form-title">KAYIT OL</h1>
        <?php echo form_open('Auth/registration_form');?>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="name" if="name" placeholder="First Name" required>
                <label for="fname">İSİM</label>
            </div>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="surname" if="surname" placeholder="Last Name" required>
                <label for="lname">SOYİSİM</label>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <label for="password">ŞİFRE</label>
            </div>
            <input type="submit" class="btn" value="Sign Up" name="signUp">
        <?php echo form_close();?>
        <div class="link">
            <p>Zaten hesabınız var mı? </p>
            <a href="<?php echo base_url();?>Auth">Giriş</a>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    <?php if($this->session->flashdata('suc')){?>
        toastr.success("<?php echo $this->session->flashdata('suc');?>");
    <?php }else if($this->session->flashdata('wrong')){ ?>
        toastr.error("<?php echo $this->session->flashdata('wrong'); ?>");
    <?php }else if($this->session->flashdata('warning')){ ?>
        toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
    <?php } else if($this->session->flashdata('info')){ ?>
        toastr.info("<?php echo $this->session->flashdata('info'); ?>");
    <?php } ?>
        <?php 
        $this->session->unset_userdata('suc');?>
        <?php 
        $this->session->unset_userdata('wrong');?>
    </script>

    </body>
</html>
