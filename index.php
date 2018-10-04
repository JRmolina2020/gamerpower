<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GamersBI | Log in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="public/css/bootstrap.min.css">
<link rel="stylesheet" href="public/css/font-awesome.css">
<link rel="stylesheet" href="public/css/AdminLTE.min.css">
<link rel="stylesheet" href="public/css/_all-skins.min.css">
<link rel="apple-touch-icon" href="public/img/apple-touch-icon.png">
<link rel="shortcut icon" href="public/img/favicon.ico">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"/>
<link rel="stylesheet" type="text/css" hre="">
</head>
<body class="hold-transition">
<div class="login-box">
   <div class="login-logo">
    <a href="../../index2.html"><b>Gamers</b>BI</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Valide sus datos para iniciar</p>
    <form  id="frmAcceso"  method="post">
      <div class="form-group has-feedback">
        <input type="email" name="logina" id="logina" class="form-control" placeholder="Email" focus>
        <span class="fa fa-users form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="clavea" id="clavea" class="form-control" placeholder="Password">
        <span class="fa fa-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-6 col-md-4 col-sm-6 col-lg-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar
            <i class="fa fa-key"></i>
          </button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <br><br>
    <div class="alert  alert-danger" id="alert_error">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <strong>DENEGADO</strong> Datos invalidos
    </div>
  </div>
</div>
   <script type="text/javascript" src="public/js/jquery-3.1.1.min.js"></script>
   <script type="text/javascript" src="view/scripts/login.js"></script>
   <script type="text/javascript" src="public/js/validator.js"></script>
</body>
</html>
