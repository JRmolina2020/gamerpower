<?php include'../config/conexion.php'; 
if (!isset($_SESSION['correo'])) {
//si no existe la session correo no dejara entrar y direcciona al usuario login form  
	header('location:../');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Gamer fly | www.GamersBI.com</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="../public/css/bootstrap.min.css">
	<link rel="stylesheet" href="../public/css/font-awesome.css">
	<link rel="stylesheet" href="../public/css/AdminLTE.min.css">
	<link rel="stylesheet" href="../public/css/_all-skins.min.css">
	<link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
	<link rel="shortcut icon" href="../public/img/favicon.ico">
	<!-- DATATABLES -->
	<link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">    
	<link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
	<link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">
	<!-- VALIDATOR -->
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"/>
	<!-- alert -->
	<link rel="stylesheet" type="text/css" href="../public/css/sweetalert2.min.css">
	<!-- DIV carga de imagen -->
</head>
<body class="hold-transition skin-red sidebar-mini">
	<div class="wrapper">
		<header class="main-header">
			<a href="../../index2.html" class="logo">
				<span class="logo-mini"><b>G</b>PW</span>
				<span class="logo-lg"><b>Gamer</b>PW</span>
			</a>
			<nav class="navbar navbar-static-top">
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
			</nav>
		</header>
		<aside class="main-sidebar">
			<section class="sidebar">
				<div class="user-panel">
					<div class="pull-left image">
						<img src="../files/usuario/<?php echo $_SESSION['imagen']?>" width="40px" height="40px" class="img-circle" alt="User Image">

					</div>
					<div class="pull-left info">
						<p><?php echo $_SESSION['nombre']?></p>
						<a href="#"><i class="fa fa-circle text-success"></i>Enlinea</a>
					</div>
					<br><br>
				</div>
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header"><?php echo $_SESSION['cargo']?></li>
					<!-- ________________________________________ -->

                   <?php if ($_SESSION['cargo']=="ADMIN") {?>
					<li class="treeview">
						<a href="home.php">
							<i class="fa fa-home"></i> <span>Inicio</span>
						</a>
					</li>
					<li class="treeview">
						<a href="indicadores.php">
							<i class="fa fa-bar-chart"></i> <span>Indicadores</span>
						</a>
					</li>
					<li class="treeview">
						<a href="reportes.php">
							<i class="fa  fa-newspaper-o"></i> <span>Reportes</span>
						</a>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-cc-visa"></i> <span>Ventas</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="venta.php"><i class="fa fa-cart-plus "></i>Nueva venta</a></li>
						</ul>
					</li>
					
					<li class="treeview">
						<a href="#">
							<i class="fa fa-truck"></i> <span>Compras</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="ingreso.php"><i class="fa fa-shopping-cart "></i>Nueva compra</a></li>
						</ul>
					</li>
					
					<li class="treeview">
						<a href="#">
							<i class="fa fa-user"></i> <span>Contactos</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="cliente.php"><i class="fa fa-users "></i>Clientes</a></li>
							<li><a href="provedor.php"><i class="fa fa-user " ></i>Provedor</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-cart-plus"></i> <span>Almacèn</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="categoria.php"><i class="fa fa-server "></i>Categoria</a></li>
							<li><a href="Articulo.php"><i class="fa fa-apple " ></i>Productos</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-search"></i> <span>Consultar</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="consulta_venta_cliente.php"><i class="	fa fa-bar-chart" ></i>Ventas por fecha</a></li>
							<li><a href=""><i class="fa fa-bar-chart "></i>Ventas por cliente</a></li>
						</ul>
					</li>

					<li class="treeview">
						<a href="#">
							<i class="fa fa-users"></i> <span>Vendedores</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
								<li><a href="usuario.php"><i class="fa fa-users"></i>Usuarios</a></li>';
						</ul>
					</li>
					<li class="treeview">
						<a href="../controller/usuario.php?op=salir">
							<i class="fa fa-times"></i> <span>Salir</span>
						</a>
					</li>

				<?php }
				elseif ($_SESSION["cargo"]!="ADMIN") { ?>
				<li class="treeview">
						<a href="home.php">
							<i class="fa fa-home"></i> <span>Inicio</span>
						</a>
					</li>
				<li class="treeview">
						<a href="#">
							<i class="fa fa-cc-visa"></i> <span>Ventas</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="venta.php"><i class="fa fa-cart-plus "></i>Nueva venta</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="../controller/usuario.php?op=salir">
							<i class="fa fa-times"></i> <span>Salir</span>
						</a>
					</li>

				<?php	
				}
				?>
				</ul>
				

			</section>
		</aside>







