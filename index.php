<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
<link rel="stylesheet" href="public/css/bootstrap.min.css">
<link rel="stylesheet" href="public/css/font-awesome.css">
<link rel="stylesheet" href="public/css/AdminLTE.min.css">
<link rel="stylesheet" href="public/css/_all-skins.min.css">
<link rel="apple-touch-icon" href="public/img/apple-touch-icon.png">
<link rel="shortcut icon" href="public/img/favicon.ico">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"/>
</head>
<body class="hold-transition">
<div class="login-box">
  <div class="login-logo">
    <img src="files/logo.jpg" width="300" height="60">
  </div>
   <div class="login-logo">
    <a href="../../index2.html"><b>Gamer</b>PW</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Valide sus datos para iniciar</p>

    <form name="flogin" id="flogin" action="controller/login/index.php" method="post">
      <div class="form-group has-feedback">
        <input type="email" name="usuario" id="usuario" class="form-control" placeholder="Email" focus>
        <span class="fa fa-users form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="contra" id="contra" class="form-control" placeholder="Password">
        <span class="fa fa-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-danger btn-block btn-flat">Entrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
</div>
</body>
</html>
