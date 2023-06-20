<?PHP 
$modulo = 3;
$pagina=0;
include_once '../SYS_auth/includes/db_connect.php';
include_once '../SYS_auth/includes/functions.php';
include '../SYS_include/clase.permisos.php';


error_reporting(0); // -1 muestra todos los errores--0 deshabilita errores
sec_session_start();
$instancia = $_SESSION["entorno"];
$sucursal = $_SESSION["sucursal"];
$tagnodo = $_SESSION["idestructura"];

$suc ="select SU_ID, SU_NOMBRE from key_empresas_sucursales WHERE SU_ID = '".$_SESSION['sucursal']."'";
$stmt = sqlsrv_query($conn, $suc);
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
	
	$nomsuc = $row['SU_NOMBRE'];
}

 ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>KeyCloud | Dashboard </title>

  <!-- Font Awesome Icons -->
  <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="../SYS_assets/css/bootstrap-treeview.css">
  <link rel="stylesheet" href="../SYS_assets/css/glyp.css">
  <link rel="stylesheet" href="../SYS_assets/css/hierarchy-select.min.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!---------------------------------->

  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />

  <!-- Nucleo Icons -->
  <link href="../SYS_include2/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../SYS_include2/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../SYS_include2/css/keycloud-dashboard.css" rel="stylesheet" />

  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

<!-- style introjs -->
<!-- <link href="https://unpkg.com/intro.js/minified/introjs.min.css" rel="stylesheet"> -->

  
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7
  <link rel="stylesheet" href="plugins/bootstrap/js/css/bootstrap.min.css">
  Font Awesome
  <link rel="stylesheet" href="plugins/bower_components/font-awesome/css/font-awesome.min.css"> -->
  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="plugins/dist/css/AdminLTE.min.css"> -->
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <!-- <link rel="stylesheet" href="plugins/dist/css/skins/_all-skins.min.css"> -->
  <!-- Morris chart -->
  <!-- <link rel="stylesheet" href="plugins/bower_components/morris.js/morris.css"> -->
  <!-- jvectormap -->
  <!-- <link rel="stylesheet" href="plugins/bower_components/jvectormap/jquery-jvectormap.css"> -->
  <!-- Date Picker -->
  <!-- <link rel="stylesheet" href="plugins/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"> -->
  <!-- Daterange picker -->
  <!-- <link rel="stylesheet" href="plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css"> -->
  <!-- bootstrap wysihtml5 - text editor -->
  <!-- <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> -->
  
  <link rel="stylesheet" href="dist/css/adminlte.css">

  

<script>

 function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    console.log("html");
	console.log(tableHTML);
	
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';

    // Create download link element
    downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);

    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

        // Setting the file name
        downloadLink.download = filename;

        //triggering the function
        downloadLink.click();
    }
}

	


</script>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

	<!-- ANIMACION PRECARGA -->
	<div id="contenedor">
		<div class="contenedor-loader">
			<div class="loader"></div>
		</div>
		<div class="cargando">Cargando...</div>
	</div>
	
	<!-- SECCION MENU FILTRO USUARIO -->
	<section class="section-head">
        <div class="container-fluid">
            <!-- Navbar Primary -->
            <div class="row">
                <!-- <div class="container-fluid"> -->
                    <nav class="navbar navbar-expand-lg rounded shadow-primary navbar-primary">
                        <div class="container-fluid">
                            <a class="navbar-brand d-flex flex-column head-mobile" href="./index.html">
                                <img src="../SYS_include2/img/logos/Logo-light-Smartime.svg" alt="SmarTime" width="100%"
                                    height="60">
								<h4 class="text-white fs-6 text-end m-0">Versión V1.1.3</h4>
                                <!-- <span class="ms-1 font-weight-bold fs-2 ms-3"></span> -->
                            </a>
                            <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button> -->
							<button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#collapsingNavbar3">
								<span class="navbar-toggler-icon"></span>
							</button>
                            <div class="collapse navbar-collapse text-center flex-row-reverse title-icon"
                                id="collapsingNavbar3">
                                <ul class="navbar-nav flex-wrap submenu-flex">
                                    <li class="nav-item active-link">
                                        <a class="nav-link " href="./DashAssistance.php">
                                            <div
                                                class="d-flex icon-sm w-100 border-radius-md text-center align-items-center justify-content-center">
                                                <i
                                                    class="fad fa-desktop text-primary fs-5 font-weight-bold opacity-100"></i>
                                            </div>
                                            <span class="nav-link-text ms-1">Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="./Monitor.php">
                                            <div
                                                class="d-flex icon-sm w-100 border-radius-md text-center align-items-center justify-content-center">
                                                <i
                                                    class="fad fa-analytics text-warning fs-5 font-weight-bold opacity-100"></i>
                                            </div>
                                            <span class="nav-link-text ms-1">Monitor</span>
                                        </a>
                                    </li>
                                    <li class="nav-item nav-link  dropdown">
										<div
											class="d-flex icon-sm w-100 border-radius-md text-center align-items-center justify-content-center">
											<i
												class="fad fa-map-marked-alt text-success fs-5 font-weight-bold opacity-100"></i>
										</div>
										<span class="nav-link-text ms-1 dropbtn ">
											Geopoint<span class="ms-1"><i class="fas fa-caret-down"></i></span>
											<div class="dropdown-content text-start">
													<a href="./GeoPoint.php">Visor GeoPonit</a>
													<!-- <a href="./GeoAccess.php">Visor GeoUbicación</a> -->
													<a href="./AjustesGeoPoint.php">Ajustes GeoPoint</a>
													<a href="./CheckPoint.php">CheckPoint</a>
													<a href="./ReporteMarcaZona.php">Marcajes en zona</a>
												</div>
										</span>
                                    <li class="nav-item nav-link  dropdown">
										<div
											class="d-flex icon-sm w-100 border-radius-md text-center align-items-center justify-content-center">
											<i class="fad fa-clipboard-user text-info fs-5 font-weight-bold opacity-100"></i>
										</div>
										<span class="nav-link-text ms-1 dropbtn ">
											Adm. Marcas<span class="ms-1"><i class="fas fa-caret-down"></i></span>
											<div class="dropdown-content text-start">
													<a href="./GestionMarcas.php">Gestionar Marcajes</a>
													<a href="./VisorMarcas.php">Visor de Marcas</a>
													<a href="./Excepciones.php">Excepciones</a>
													<a href="./Ausencias.php">Ausencias</a>
													<a href="./Atrasos.php">Atrasos en zona</a>
												</div>
										</span>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="./GestionTurnos.php ">
                                            <div
                                                class="d-flex icon-sm w-100 border-radius-md text-center align-items-center justify-content-center">
                                                <i
                                                    class="fad fa-business-time text-danger fs-5 font-weight-bold opacity-100"></i>
                                            </div>
                                            <span class="nav-link-text ms-1">Turnos y Horarios</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="./Colaboradores.php">
                                            <div
                                                class="d-flex icon-sm w-100 border-radius-md text-center align-items-center justify-content-center">
                                                <i
                                                    class="fad fa-user-friends text-primary fs-5 font-weight-bold opacity-100"></i>
                                            </div>
                                            <span class="nav-link-text ms-1">Colaboradores</span>
                                        </a>
                                    </li>
									<li class="nav-item nav-link  dropdown">
										<div
											class="d-flex icon-sm w-100 border-radius-md text-center align-items-center justify-content-center">
											<i class="fad fa-file-chart-pie text-info fs-5 font-weight-bold opacity-100"></i>
										</div>
										<span class="nav-link-text ms-1 dropbtn ">
										Reportes SmarTime<span class="ms-1"><i class="fas fa-caret-down"></i></span>
											<div class="dropdown-content text-start">
													<a href="./ReporteGeneral.php">Reporte General</a>
													<a href="./ReporteMensualV4.php">Reporte detallado</a>
													<!-- <a href="./ReporteAsistenciaMolymet.php">Asistencia</a> -->
													<a href="./ReporteTurno.php">Estado de turnos</a>
												</div>
										</span>
                                    </li>
									<li class="nav-item nav-link  dropdown">
										<div
											class="d-flex icon-sm w-100 border-radius-md text-center align-items-center justify-content-center">
											<i class="fad fa-file-download text-info fs-5 font-weight-bold opacity-100"></i>
										</div>
										<span class="nav-link-text ms-1 dropbtn ">
										Exportación en Bruto<span class="ms-1"><i class="fas fa-caret-down"></i></span>
											<div class="dropdown-content text-start">
													<a href="./ExportacionMarcas.php">Marcas de asistencia</a>
													<a href="./MaestroUsuarios.php">Maestro de colaborador</a>

												</div>
										</span>
                                    </li>
									<li class="nav-item nav-link  dropdown">
										<div
											class="d-flex icon-sm w-100 border-radius-md text-center align-items-center justify-content-center">
											<i class="fad fa-tools text-info fs-5 font-weight-bold opacity-100"></i>
										</div>
										<span class="nav-link-text ms-1 dropbtn ">
										Herramientas<span class="ms-1"><i class="fas fa-caret-down"></i></span>
											<div class="dropdown-content text-start">
													<a href="./Auditoria.php">Auditoría</a>
													<a href="./SinMarcaje.php">Colaborador sin marcaje</a>
													<a href="./Incidencia.php">Inicidecia</a>

												</div>
										</span>
                                    </li>
                                    <!-- <li class="nav-item mx-2">
										<a class="nav-link " href="./pages/rtl.html">
										<div
											class="d-flex icon-sm w-100 border-radius-md text-center align-items-center justify-content-center">
											<i class="fad fa-users-cog text-info fs-5 font-weight-bold opacity-100"></i>
										</div>
										<span class="nav-link-text ms-1">Configuración</span>
										</a>
									</li> -->
                                </ul>
                            </div>
                        </div>
                    </nav>
                <!-- </div> -->
            </div>
            <!-- End Navbar Primary -->
			<!-- inicio barra notificaciones -->
			<div id="barNotification" class="row row-bar-notification row-bar-noti-none">
				<div class="container-fluid content-notification">
					<div class="col-title">
						<i class="fas fa-bell-exclamation"></i>
						<div class="content-text-noti">
							<h1>"Felicidades. Tienes activa la última versión de SmarTime" accede a ella dando click en<span><i class="fad fa-chevron-double-right icon-title"></i></span></h1>
							<h1>Deseas mantener esta versión da clic en: <span><i class="fad fa-chevron-double-right icon-title"></i></span></h1>
						</div>
						
					</div>
					<div class="col-button">
						<button type="button" class="btn btn-light m-0 rounded-3 btn-sm" id="btnNoti" onclick="fadeBtnNoti()">Actualizar</button>
						<button type="button" class="btn btn-light m-0 rounded-3 btn-sm" id="btnNotiMantener" onclick="fadeBtnNoti()">Mantener</button>
					</div>
				</div>
			</div>
			<!-- fin barra notificaciones -->

			<section>
				<div class="container">
					<div class="row">
						<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 my-5 text-white text-center">
							<h4 id="saludoFecha"></h4>
							<h1 id="saludoUser"></h1>
						</div>
					</div>
				</div>
			</section>

            <div class="container mt-2">
                <div class="row">
                    <nav class="navbar navbar-main navbar-expand-lg shadow-none border-radius-xl " id="navbarBlur"
                        data-scroll="false">
                        <div class="container-fluid mb-4">
                            <div class="col-6 d-flex align-items-center d-flex-filter" data-step="1" data-title="Titulo" data-intro="Aquí puedes seleccionar el área que deseas visualizar">
                                <div class="nav-item-hierarchical">
                                    <br>
                                    <h2 style=" font-size:16px; "> Filtro jerarquíco actual...</h2>
                                    <button id="selArbol" onchange="funcioncargar()">
                                        <span class="spinner-grow spinner-grow-sm" role="status"></span>
                                        <span id="txtBotonArbol"></span>
                                        <h4><span class="btn btn-sm btn-light float-left d-none">
                                                <div id="txtBotonArbol2" onchange="funcioncargar()">
                                            </span></h4>
                                    </button>
                                </div>

                            </div>
                            <!-- <nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
									<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
									<li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard</li>
								</ol>
								<h6 class="font-weight-bolder text-white mb-0 fs-1 mt-3">Dashboard Jerárquico</h6>
							</nav> -->

                            <div class="navbar-collapse mt-sm-0 mt-2 justify-content-end" id="navbar">
                                <!-- <div class="ms-md-auto pe-md-3 d-flex align-items-center">
									<div class="input-group">
									<span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
									<input type="text" class="form-control" placeholder="Type here...">
									</div>
                  				</div> -->
                                <ul class="navbar-nav align-items-center d-flex-option-user">
									<li class="nav-item d-flex align-items-center">
										<div id="">
											<!-- <button class="btn-presentation-dash " data-bs-target="javascript:introJs().start();" data-bs-toggle="modal">
												<i class="fas fa-question-circle"></i>
											</button> -->
											<!--ICONO DE AYUDA-->
											<a class="btn-presentation-dash" href="javascript:void(0);" onclick="javascript:introJs().start();"  data-toggle="tooltip" title="Ayuda" data-placement="bottom">
												<i style="font-size: 30px" class="fa fa-question-circle"></i>
											</a>
										</div>
									</li>
                                    <li class="nav-item d-flex align-items-center">
										<div id="">
											<img src="../SYS_include2/img/logos/logo-sintexto-smarttime.svg" class="avatar avatar-sm me-2" alt="">
										</div>
									</li>

									<li class="nav-item dropdown d-flex align-items-center" data-step="2" data-title="Hello" data-intro="Aquí puedes cambiar tu aplicación, acceder a tu perfil o cerrar sesión.">
                                        <a href="javascript:;" class="nav-link text-white p-0 text-white" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
											<h6 class="text-white m-0">
												<?php echo htmlentities($_SESSION['username']); echo $_SESSION['nombre'];?>
												<i class="fas fa-caret-down"></i>	
											</h6>
                                        </a>
                                        <ul class="dropdown-menu  dropdown-menu-end"
                                            aria-labelledby="dropdownMenuButton">
											<i class="fas fa-caret-up icon-dropdown-session"></i>
                                            <li class="mb-2 ">
                                                <a class="dropdown-item border-radius-md" href="./DashAssistance.php">
                                                    <div class="d-flex text-white">
                                                        <div class="my-auto">
														<i class="fad fa-exchange me-3"></i>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="text-sm font-weight-normal mb-0">
                                                                Ir a la aplicación anterior
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="mb-2">
                                                <a class="dropdown-item border-radius-md" href="../MOD_Configuracion/index.php">
                                                    <div class="d-flex text-white">
                                                        <div class="my-auto">
														<i class="fad fa-user-cog me-3"></i>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="text-sm font-weight-normal mb-0">
                                                                Mi Perfil
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="mb-2">
                                                <a class="dropdown-item border-radius-md" href="../SYS_auth/includes/logout.php">
                                                    <div class="d-flex text-white">
                                                        <div class="my-auto">
															<i class="fad fa-power-off me-3"></i>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="text-sm font-weight-normal mb-0">
                                                                Cerrar Sesión
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

									<li class="dropdown mx-2 icon-mobile-menu" data-step="3" data-title="Hello" data-intro="Aquí podrás acceder a todas las configuraciones de SmarTime">
										
											<div class="dropdown-content-sub">
												Ir a configuración
											</div>
											<div class="d-flex dropbtn icon-sm w-100 border-radius-md text-center align-items-center justify-content-center">
												<a href="./Configuracion.php">
													<i class="fa fa-cog text-white fs-5 font-weight-bold opacity-100"></i>
												</a>
											</div>
										
										
										
										<!-- <span class="nav-link-text ms-1  ">
										Herramientas<span class="ms-1"><i class="fas fa-caret-down"></i></span>
											<div class="dropdown-content">
												<a href="./Auditoria.php">Auditoría</a>
											</div>
										</span> -->
                                    </li>

                                    <li class="nav-item dropdown pe-2 d-flex align-items-center icon-mobile-menus" data-step="4" data-title="Hello" data-intro="Aquí podrás observar las últimas Notificaciones">
                                        <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-bell text-white cursor-pointer fs-5"></i>
                                        </a>
                                        <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n2"
                                            aria-labelledby="dropdownMenuButton">
											<i class="fas fa-caret-up text-white icon-dropdown-session fs-5"></i>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <!-- End Navbar -->
                </div>

            </div>
            <!-- Navbar Second -->

        </div>
    </section>

	<!-- <section class="section-filter-main">
		<div class="container">
			<div class="row">
				<div class="col-6 d-flex align-items-center">
					<div class="nav-item-hierarchical">
						<br>
						<h2 style=" font-size:16px; "> Filtro jerarquíco actual...</h2>
						<button id="selArbol" onchange="funcioncargar()">
							<span class="spinner-grow spinner-grow-sm" role="status" ></span>
							<span id="txtBotonArbol" ></span>
							<h4><span  class="btn btn-sm btn-light float-left d-none" ><div id="txtBotonArbol2" onchange="funcioncargar()"></span></h4>   
						</button>
					</div>
					
				</div>
				<div class="col-6 d-flex align-items-center justify-content-end">
					<i class="fad fa-arrow-alt-to-left text-white me-2"></i>
					<a class="text-white" href="DashAssistance.php">Ir a versión anterior</a>
				</div>
				<!-- Content Header (Page header)
				<div class="">
					<div class="container-fluid">
						<div class="row mb-2">
						<div class="col-sm-6">
						
						ARBOL JERARQUICO
							<h1 class="m-0 text-dark" style="font-size:40px; line-height:48px; font-weight:500;">Dashboard Jerárquico</h1>
							<li class="nav-item-hierarchical">
								<br>
								<h2 style=" font-size:16px; "> Filtro jerarquíco actual...</h2>
									<button id="selArbol" onchange="funcioncargar()">
										<span class="spinner-grow spinner-grow-sm" role="status" ></span>
										<span id="txtBotonArbol" ></span>
										<h4><span  class="btn btn-sm btn-light float-left d-none" ><div id="txtBotonArbol2" onchange="funcioncargar()"></span></h4>   
									</button>
								</li>
						</div>/.col
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="DashAssistance.php">Ir a versión anterior</a></li>
							</ol>
						</div>/.col
						</div>/.row
					</div>/.container-fluid
				</div>
				/.content-header
			</div>
		</div>
	</section> -->

	<!-- SECTION DASHBOARD GlOBAL -->
	<section>
		<div class="container" data-step="5" data-intro="Este gráfico nos muestra el comportamiento de asistencias versus ausencias del mes en curso" >
			<!-- <div class="row container-fluid">
				<div class="col-md-5 hidden-xs" style="font-size: 2.5rem; display:inline-block; margin-bottom:2px">
					<h1 class="mt-4 text-white " style="color: #212529; font-weight: 700; line-height: 1.2;">Dashboard Global</h1>
					<?php
						if (false && $instancia=="DPW0") { 
					?>								
						<a style="color: blue; font-size: 2rem; font-weight: 100; line-height: 0.5;"href="index2.php">
							Ir a la nueva versión
						</a>
					<?php } ?>
                </div>
				ICONO DE AYUDA
				<div class='col-md-1 hidden-xs' style="float: right">
					<a href="javascript:void(0);" onclick="javascript:introJs().start();"  data-toggle="tooltip" title="Ayuda" data-placement="bottom">
						<i style="font-size: 30px" class="fa fa-question-circle"></i>
					</a>
				</div>
            </div> -->
			<div class="row">
				<div class="">
                    <!-- INICIO GRÁFICO PARA MOSTRAR AUSENCIAS Y ASISTENCIAS -->
                    <div id="grafico" class="row">
                        <div id="morris-area-example" style="width:100%;height:auto;margin-top: 10px;-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                            <div id="mensajeCarga" class="col-md-2 col-md-push-2" style="text-align: center;font-size: 15px;"><b></b></div>
                        </div>
                    </div>
                    <!-- FIN GRGÁFICO PARA MOSTRAR AUSENCIAS Y ASISTENCIAS -->
                </div>
			</div>
		</div>
	</section>

	<section>
		<!-- segunda fila de cards -->
		<div class="container text-center mt-4">
			<div class="row" data-step="6" data-title="Hello" data-intro="Utiliza este buscador para encontrar rápidamente lo que necesites">
				<div class="col-search">
					<!-- Busqueda -->
					<div class="container">
						<h1 style="background: -webkit-linear-gradient(0deg, rgba(38,175,215,1) 0%, rgba(22,182,220,1) 25%, rgba(38,197,208,1) 42%, rgba(57,201,202,1) 53%, rgba(51,215,207,1) 63%, rgba(68,219,200,1) 79%, rgba(78,224,196,1) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;" class="title-search">Buscador de Contenido</h1>
						<div class="d-flex">
							<input id="buscadortr" type="text" class="form-control" placeholder="Ingrese palabra clave" aria-label="Recipient's username" aria-describedby="button-addon2">
							<button id="btnbuscadortr" class="btn btn-buscador" type="button" id="button-addon2">
								<i class="fad fa-search-plus text-white"></i>
							</button>
						</div>
						<div class="content-table">
							<table>
								<tbody id="resultadoBusqueda">											
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- <div class="col-support">
					<a href="https://soporte.smartime.cl/portal/es/signin">
						<div class="contenedor">
							<div class="tarjeta">
								<h2 class="canal">Soporte Técnico</h2>
								<i class="fas fa-user-headset"></i>
							</div>
						</div>
					</a>
				</div> -->
			</div>
		</div>
	</section>

	<!-- CATEGORIA COLABORADORES -->

	<section id="middle" class="content section-content-main mt-4">
        <div class="container">
            <!-- primera fila de cards -->
            <div class="container text-center">
                <div class="row">
                    <div class="col col-sm col-md mt-3" data-step="7" data-intro="Este indicador te muestra el estado de vida del enrolamiento cuando es mayor a 81% es Verde, entre 51% y 80% es Amarillo y bajo el 50% es Rojo">
                        <div class="placement_container">
                            <div class="placement_item_container">
                                <div class="placement_card zoom">
										<!-- <div class="grid-text-chart">
											<h1 class="text-white">Biometrías registradas<br>en plataforma
												<span class="chart-biometric-i">
													<i class="fad fa-chart-pie-alt ms-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
														<div class="pointer-biometric-card">
															<i class="fas fa-bullseye-pointer"></i>
														</div>
													</i>
													<div class="parent-card-collaborations-biometric-chart">
														Click para ver el Gráfico
													</div>
													<div class="">
														<canvas id="myChartBiometric" width="300" height="200" ></canvas>
													</div>
												</span>
											</h1>
											<p class="info-box-text" id="usrsAct" onload="carga()" style="font-weight: 700; display: none;"></p>
										</div> -->
										<div class="div-chart-bioc">
											<div class="col-7 col-text-chart">
												<h1 class="title-text-chart-bioc" id="">Biometrías<br>registradas</h1>   
                                                <p class="d-none" id="enrPers"></p>
											</div>
											<div class="col-5">
												<div class="biometric-chart">
													<!-- <canvas id="myChartBiometric"></canvas> -->
                                                    <!-- <div class="container">
                                                        <div class="circular-progress">
                                                            <span class="progress-value">0%</span>
                                                        </div>
                                                    </div> -->
													<div class="chart-wrapper">
														<canvas id="myChartBioc" width="250" height="250"></canvas>
														<div id="chartjs-tooltip">
															<div><p id="enrPerChart"></p></div>
														</div>
													</div>
												</div>
												
											</div>
										</div>
										
                                    <div class="placement_image2">
										<a class="placement_image_second_plus" href="./TransaccionesMonitor/Enrolar.php">
											<img src="../SYS_include2/img/add-user.png"></img>
										</a> 
                                    </div>
                                    <div class="numerogrande">
                                        <hr class="hr_style"style="">
                                        <div class="parent-card-collaborations-biometric">
                                            <div class="card-hover-content mt-3">
                                                <p class="text-absences-card-collaborations-biometric">Colaboradores<br>registrados</p>
                                                <p class="number-absences-card-collaborations d-none" id="huellas"></p>
                                                <p class="number-absences-card-collaborations" id="bioCol"></p>                                             
                                            </div>                                          
                                            <div class="card-hover-content-card-collaborations mt-3">
                                                <p class="text-absences-card-collaborations-biometric">Porcentaje<br>Enrolado</p>
                                                <p class="number-absences-card-collaborations-perc" id="enrPer"></p>
                                            </div>  
                                            <div class="card-hover-content-card-collaborations mt-3">
                                                <p class="text-absences-card-collaborations-biometric">Biometrías con <br>Rostros</p>
                                                <p class="number-absences-card-collaborations" id="rostro"></p>
                                                <p class="number-absences-card-collaborations" id="rostroprueba"></p>
                                            </div>                          
                                            <!-- <div class="card-hover-content mt-2">
                                                <p class="text-absences-card-collaborations-biometric">Prueba objeto</p>
                                                <p class="number-absences-card-collaborations" id="str"></p>                                                
                                            </div> -->
                                        </div>
                                        
                                        <!-- <h3 id="numeroGrande2" onload="cargar2()"></h3> -->
                                        <hr class="hr_style"style="">
										<div class="w-100 mt-3">
											<a class="fs-6 text-white" href="https://app3.keycloud.cl/v4/BIO_Assistance/TransaccionesMonitor/Enrolar.php">Acceso directo a enrolamiento</a>
										</div>
										
                                    </div>
                                    <div class="placement_bottom" id="10" style="height: 40px;">
                                        <a href="#" class="box-footer-card">Ver más <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                  
                    <div class="col col-sm col-md mt-3" data-step="8" data-intro="Este indicador muestra el porcentaje de asistencias de las personas que han realizado marcas hoy ">
                        <div class="placement_container">
                            <div class="placement_item_container">
                                <div class="placement_card zoom">
                                    <!-- <div class="placement_text">
                                        <h1>Asistencias<br>hoy</h1>
                                        <p class="info-box-text" id="usrsAct" onload="carga()" style="font-weight: 700; display: none;"></p>
                                    </div> -->
									<div class="div-chart-bioc">
										<div class="col-7 col-text-chart">
											<h1 class="title-text-chart-bioc" id="">Asistencias<br>hoy</h1>
											<p class="d-none" id="perRegEntAtt"></p>   
										</div>
										<div class="col-5">
											<div>
												<!-- <canvas id="myChartAttendance"></canvas> -->
												<!-- <div class="container">
													<div class="circular-progress-attendance">
														<span class="progress-value-attendance">0%</span>
													</div>
												</div> -->
												<div class="chart-wrapper">
														<canvas id="myChartAsis" width="250" height="250"></canvas>
														<div id="chartjs-tooltip">
															<div><p id="perRegEntTwo"></p></div>
														</div>
													</div>
											</div>
											
										</div>
									</div>
                                    <div class="placement_image">
                                        <i class="fad fa-users placement_image_second" heigth="80" width="130"></i>
                                    </div>
                                    <div class="numerogrande">
                                        <hr class="hr_style"style="">
                                        <div class="parent-card-collaborations" style="padding: 1.77rem 0;">
                                            <div class="card-hover-content-card-collaborations mt-2">
                                                <p class="text-absences-card-collaborations">Porcentaje</p>
                                                <p class="number-absences-card-collaborations" id="perRegEnt"></p>
                                            </div>
                                            <div class="card-hover-content mt-2">
                                                <p class="text-absences-card-collaborations">Personas</p>
                                                <p class="number-absences-card-collaborations" id="regPriEntrada"></p>
                                                
                                            </div>
                                        </div>
                                        <!-- <h3 id="numeroGrande2" onload="cargar2()"></h3> -->
                                        <hr class="hr_style"style="">
                                    </div>
                                    <div class="placement_bottom" id="primeramarca">
                                        <a href="#" class="box-footer-card">Ver más <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                  
                    <div class="col col-sm col-md mt-3" data-step="9" data-intro="Aquí podrá ver quíen marco presencialmente o vía remota, desde la app o desde el portal del colaborador">
                        <div class="placement_container">
                            <div class="placement_item_container">
                                <div class="placement_card zoom">
									<div class="div-chart-bioc">
										<div class="col-7 col-text-chart">
											<h1 class="title-text-chart-bioc" id="">Registros<br>de entrada</h1>  
											<h1 id="regPresencial" class="d-none"></h1> 
										</div>
										<div class="col-5">
											<!-- <canvas id="myChart" width="113" height="113"></canvas> -->
											<!-- <div class="position-relative" id="donut-example" width="113" height="113"></div> -->
											<div class="chart-wrapper">
												<canvas id="myChartRecordsInput" width="250" height="250"></canvas>
												<div id="chartjs-tooltip">
													<div><p id="data-chart-records"></p></div>
												</div>
											</div>
													
										</div>
									</div>
                                    <div class="placement_image">
                                        <i class="fad fa-users placement_image_second" heigth="80" width="130"></i>
                                    </div>
                                    <div class="numerogrande">
                                        <hr class="hr_style"style="">
                                        <div class="parent-card-collaborations" style="padding: 1.77rem 0;">
                                            <div class="card-hover-content mt-2">
                                                <p class="text-absences-card-collaborations">Presencial</p>
                                                <p class="number-absences-card-collaborations" id="presencial-registros"></p>
                                                
                                            </div>
											<div class="card-hover-content-card-collaborations mt-2">
                                                <p class="text-absences-card-collaborations">Remoto</p>
                                                <p class="number-absences-card-collaborations" id="app-registros"></p>
                                            </div>
                                        </div>
                                        <hr class="hr_style"style="">
                                    </div>
                                    <div class="placement_bottom" id="">
                                        <a href="./GestionMarcas.php" class="box-footer-card">Ver más <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                  
                </div>
            </div>


			<!-- segunda fila de cards -->
            <div class="container text-center mt-4">
                <div class="row">
                    <div class="col">
						<!----------monitor en tiempo real------------------>

				<div id="content" class="monitoring-mobile rounded-3" style="" data-step="10" data-intro="Este monitor te muestra los últimos diez registros en tiempo real">
					<div class="card collapsed-card  real-time-monitor">
						<div class="card-header real-time-monitor-header">

							<span class="card-title me-2 fs-3 text-white">
								<!-- panel title -->
								<strong>Monitor en Tiempo Real</strong>
								<!-- <button type="button" id="selArbol" class="btn btn-light "> -->
								<div id="txtBotonArbol2" class="d-none">Posición</div></button>
							</span>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse"><i
										class="fas fa-plus"></i>
								</button>
								<!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
							</div>

							<!-- right options -->
							<ul class="options pull-right list-inline d-none">
								<li><a href="javascript:void(0);" onclick="javascript:introJs().start();"
										data-toggle="tooltip" title="Ayuda" data-placement="bottom"><i
											style="font-size: 25px" class="fa fa-question-circle"></i></a></li>
							</ul>
							<!-- /right options -->
						</div>
						<div class="card-body text-dark monitorTiempoReal">
							<div class="table-responsive monitorTiempoReal">
								<table id="tablaMonitor" class="table table-hover dataTable table-striped width-full"									
									style="color:#676A6C;">
									<thead>
										<tr>
											<th style="width: 6.875rem;">
												Imagen</th>
											<th style="width: 6.875rem;">
												Departamento</th>
											<th style="width: 6.875rem;">RUT
											</th>
											<th style="width: 6.875rem;">
												Nombre</th>
											<th style="width: 6.875rem;">
												Cargo</th>
											<th style="width: 6.875rem;">
												Fecha</th>
											<th style="width: 6.875rem;">
												Hora
											</th>
											<th style="width: 6.875rem;">
												Terminal
											</th>
											<th style="width: 6.875rem;">Tipo
											</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Imagen</th>
											<th>Nombre</th>
											<th>RUT</th>
											<th>Cargo</th>
											<th>Fecha</th>
											<th>Hora</th>
											<th>Terminal</th>
											<th>Tipo</th>
										</tr>
									</tfoot>
									<tbody id="monitorTiempoReal">
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td>Cargando datos, aguarda unos segundos...</td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

					</div>
				</div>
			</div>

            <!-- tercera fila de cards -->
            <div class="container text-center mt-4">
                <div class="row">
					<div class="col" data-step="11" data-intro="Este indicador te muestra los dispositivos conectados y desconectados en tiempo real, además nos envía una notificación cuando se desconectan">
						<div class="placement_container">
							<div class="placement_item_container">
								<div class="placement_card_dis_bioc zoom">
									<!-- <div class="placement_text">
										<h1>Dispositivos<br>biométricos</h1>
										<p class="info-box-text" id="usrsAct" onload="carga()" style="font-weight: 700; display: none;"></p>
									</div> -->
									<div class="div-dis-bioc">
										<div class="col-text-dis-bioc">
											<h1 class="title-text-dis-bioc" id="">Dispositivos<br>biométricos</h1>   
											<p class="d-none" id="enrPers"></p>
										</div>
										<div class="col-icon-dis-bioc" data-bs-toggle="modal" data-bs-target="#disBiocModal">
											<i class="fad fa-globe-americas dis-bio-map"></i>
										</div>
									</div>
									<div class="placement_image">
										<i class="fad fa-users placement_image_second" heigth="80" width="130"></i>
									</div>
									<div class="numerogrande">
										<hr class="hr_style"style="">
										<div class="parent-card-collaborations">
											<div class="card-hover-content">
												<p class="text-absences-card-collaborations">Conectados</p>
												<p class="number-absences-card-collaborations" id="dispoConecOnline"></p>
												
											</div>
											<div class="card-hover-content-card-collaborations">
												<p class="text-absences-card-collaborations">Desconectados</p>
												<p class="number-absences-card-collaborations" id="dispoConecOffline"></p>
											</div>
										</div>
										<!-- <h3 id="numeroGrande2" onload="cargar2()"></h3> -->
										<hr class="hr_style"style="">
									</div>
									<div class="placement_bottom" id="totalDispositivos">
										<a href="https://app3.keycloud.cl/SmarTime/v3/GestionarDispositivos.php" class="box-footer-card">Ver más <i class="fa fa-arrow-circle-right"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
                    <div class="col" data-step="12" data-intro="Este indicador totaliza todas las marcas de entrada">
                        <div class="placement_container">
                            <div class="placement_item_container">
                                <div class="placement_card_dis_bioc zoom">
									<div class="div-chart-bioc">
										<div class="col-7 col-text-chart">
											<h1 class="title-text-chart-bioc" id="" style="font-size: 1.5rem;">Registros totales de Entradas Diarias</h1>  
											<h1 id="regPresencial" class="d-none"></h1>
										</div>
										<div class="col-5">
											<!-- <canvas id="myChart" width="113" height="113"></canvas> -->
											<!-- <div class="position-relative" id="donut-example" width="113" height="113"></div> -->
											<div class="chart-wrapper">
												<canvas id="myChartAllRecordsInput" width="250" height="250"></canvas>
												<div id="chartjs-tooltip">
													<div><p id="totalRegEntDia"></p></div>
												</div>
											</div>
													
										</div>
									</div>
                                    <!-- <div class="placement_text">
                                        <h1>Registros totales de<br>entradas diarias</h1>
                                        <p class="info-box-text" id="usrsAct" onload="carga()" style="font-weight: 700; display: none;"></p>
                                    </div> -->
                                    <div class="placement_image">
                                        <i class="fad fa-users placement_image_second" heigth="80" width="130"></i>
                                    </div>
                                    <div class="numerogrande">
                                        <hr class="hr_style"style="">
                                        <div class="parent-card-collaborations-registre-two">
                                            <div class="card-hover-content-card-collaborations mt-2">
                                                <p class="number-absences-card-collaborations-two" id="numeroGrande3"></p>
                                            </div>
                                        </div>
                                        <!-- <h3 id="numeroGrande2" onload="cargar2()"></h3> -->
                                        <hr class="hr_style"style="">
                                    </div>
                                    <div class="placement_bottom" id="soloingresos">
                                        <a href="#" class="box-footer-card">Ver más <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col" data-step="13" data-intro="Este indicador considera a las personas que han realizado marcas de entrada y de salida hasta ahora">
                        <div class="placement_container">
                            <div class="placement_item_container">
                                <div class="placement_card_dis_bioc zoom">
									<div class="div-chart-bioc">
										<div class="col-7 col-text-chart">
											<h1 class="title-text-chart-bioc" id="" style="font-size: 1.5rem;">Colaboradores con <br>entrada y salida</h1>  
											<h1 id="regPresencial" class="d-none"></h1>
										</div>
										<div class="col-5">
											<!-- <canvas id="myChart" width="113" height="113"></canvas> -->
											<!-- <div class="position-relative" id="donut-example" width="113" height="113"></div> -->
											<div class="chart-wrapper">
												<canvas id="myChartInputOutputCollaborators" width="250" height="250"></canvas>
												<div id="chartjs-tooltip">
													<div><p id="colEntSal2"></p></div>
												</div>
											</div>
													
										</div>
									</div>
                                    <!-- <div class="placement_text">
                                        <h1>Registros totales de<br>entradas diarias</h1>
                                        <p class="info-box-text" id="usrsAct" onload="carga()" style="font-weight: 700; display: none;"></p>
                                    </div> -->
                                    <div class="placement_image">
                                        <i class="fad fa-users placement_image_second" heigth="80" width="130"></i>
                                    </div>
                                    <div class="numerogrande">
                                        <hr class="hr_style"style="">
                                        <div class="parent-card-collaborations-registre-two">
                                            <div class="card-hover-content-card-collaborations mt-2">
                                                <p class="number-absences-card-collaborations-two" id="colEntSal"></p>
                                            </div>
                                        </div>
                                        <!-- <h3 id="numeroGrande2" onload="cargar2()"></h3> -->
                                        <hr class="hr_style"style="">
                                    </div>
                                    <div class="placement_bottom" id="ingresost">
                                        <a href="#" class="box-footer-card">Ver más <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col">
                        <div class="placement_container">
                            <div class="placement_item_container">
                                <div class="placement_card_dis_bioc zoom">
                                    <div class="placement_text">
                                        <h1>Colaboradores con <br>entrada y salida</h1>
                                        <p class="info-box-text" id="usrsAct" onload="carga()" style="font-weight: 700; display: none;"></p>
                                    </div>
                                    <div class="placement_image">
                                        <i class="fad fa-users placement_image_second" heigth="80" width="130"></i>
                                    </div>
                                    <div class="numerogrande">
                                        <hr class="hr_style"style="">
                                        <div class="parent-card-collaborations-registre-two">
                                            <div class="card-hover-content-card-collaborations mt-2">
                                                <p class="number-absences-card-collaborations-two" id="colEntSal"></p>
                                            </div>
                                        </div>
                                        <h3 id="numeroGrande2" onload="cargar2()"></h3>
                                        <hr class="hr_style"style="">
                                    </div>
                                    <div class="placement_bottom" id="ingresost">
                                        <a href="#" class="box-footer-card">Ver más <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>

			<!-- tercer fila -->
            <div class="text-center mt-4">
                <div class="row">
					<div class="col" data-step="14" data-intro="Este indicador muestra todos los intentos de envío d eimagenes bajo estandar a los distintos dispositivos y además muestra los envios en estado de espera. Ejemplo: Equipos desconetados">
						<div class="placement_container">
							<div class="placement_item_container">
								<div class="placement_card zoom" style="background: #DD1C1A;">
									<div class="placement_text">
										<h1 class="text-white">Alertas del<br>Sistema</h1>
										<p class="info-box-text" id="usrsAct" onload="carga()" style="font-weight: 700; display: none;"></p>
									</div>
									<div class="placement_image">
										<i class="fad fa-users placement_image_second" heigth="80" width="130"></i>
									</div>
									<div class="numerogrande">
										<hr class="hr_style"style="">
										<div class="parent-card-alert">
											<div class="card-hover-content mt-2 ms-2">
												<p class="text-absences-card-collaborations text-white fs-5">Envío de imágenes bajo standar</p>
												<p class="number-absences-card-collaborations text-white" id="alertIps"></p>
												
											</div>
											<div class="card-hover-content-card-collaborations mt-2">
												<p class="text-absences-card-collaborations text-white">Esperando</p>
												<p class="number-absences-card-collaborations text-white" id="alertWaiting"></p>
											</div>
										</div>
										<!-- <h3 id="numeroGrande2" onload="cargar2()"></h3> -->
										<hr class="hr_style"style="">
									</div>
									<div class="placement_bottom" id="totalDispositivos" style="background: #783332;">
										<a href="https://app3.keycloud.cl/v4/BIO_Assistance/TransaccionesMonitor/transaccionesFiltro.php" class="box-footer-card">Ver más <i class="fa fa-arrow-circle-right"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
                    <div class="col" data-step="15" data-intro="Acceso rápido para eliminar colaborador">
                        <div class="placement_container">
                            <div class="placement_item_container">
                                <div class="placement_card zoom">
                                    <div class="placement_text" style="padding: 105px 0 0 0;">
                                        <h1 style="font-size: 2.5rem; line-height:3rem;">Eliminar<br>Colaborador</h1>
                                        <!-- <p class="info-box-text" id="usrsAct" onload="carga()" style="font-weight: 700; display: none;"></p> -->
                                    </div>
                                    <div class="placement_image">
                                        <i class="fad fa-user-plus placement_image_second" heigth="80" width="130"></i>
                                    </div>
                                    <!-- <div class="numerogrande">
                                        <hr class="hr_style"style="">
                                        <h3 id="numeroGrande" onload="cargar2()"></h3>
                                        <hr class="hr_style"style="">
                                    </div> -->
                                    <div class="placement_bottom" id="">
                                        <a href="./TransaccionesMonitor/perfilesNewV2.php" class="box-footer-card">Impedir Acceso <i class="fad fa-plus-circle"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col" data-step="16" data-intro="Acceso rápido para agregar colaborador">
                        <div class="placement_container">
                            <div class="placement_item_container">
                                <div class="placement_card zoom">
                                    <div class="placement_text" style="padding: 105px 0 0 0;">
                                        <h1 style="font-size: 2.5rem; line-height:3rem;">Agregar<br>Colaborador</h1>
                                        <!-- <p class="info-box-text" id="usrsAct" onload="carga()" style="font-weight: 700; display: none;"></p> -->
                                    </div>
                                    <div class="placement_image">
                                        <i class="fad fa-user-plus placement_image_second" heigth="80" width="130"></i>
                                    </div>
                                    <!-- <div class="numerogrande">
                                        <hr class="hr_style"style="">
                                        <h3 id="numeroGrande" onload="cargar2()"></h3>
                                        <hr class="hr_style"style="">
                                    </div> -->
                                    <div class="placement_bottom" id="">
                                        <a href="Configuracion.php" class="box-footer-card">Agregar <i class="fad fa-plus-circle"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



	

	<!-- CATEGORIA REGISTROS -->

	<section id="middle" class="content section-content-main mt-4">
		<div class="container">
			<div class="row row-mobile">
				<div class="col-12 col-sm-4 px-0" data-step="15" data-intro="Indicador de cantidad de usuarios que cuentan con atrasos recurrentes dentro del periodo (la cantidad de atrasos necesarios para ser considerado atraso recurrente puede ser configurada).">
					<div class="placement_container-records-category">
						<div class="placement_item_container-records-category">
							<div class="placement_card-records-category zoom">
								<div class="div-chart-tunrs">
									<div class="col-7 title-card-turns">
										<h1 class="" id="">Colaboradores Sin Turno Asignado</h1>  
									</div>
									<div class="col-5">
										<div class="chart-wrapper-tunrs">
											<canvas id="myChartTurns" width="150" height="150"></canvas>
											<div id="chartjs-tooltip">
												<div><p id="data-chart-turns"></p></div>
											</div>
										</div>
									</div>
								</div>
								<div class="placement_image-records-category">
									<i class="fad fa-users placement_image_second-records-category" heigth="80" width="130"></i>
								</div>
								<div class="numerogrande-records-category">
									<hr class="hr_style-records-category"style="">
									<h3 id="usrLibress" onload="cargar2()"></h3>
									<hr class="hr_style-records-category"style="">
								</div>
								<div class="placement_bottom-records-category" id="justificacion1">
									<a href="#" class="box-footer-card-records-category">Ver más <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-4 px-0" data-step="15" data-intro="Indicador de cantidad de usuarios que cuentan con atrasos recurrentes dentro del periodo (la cantidad de atrasos necesarios para ser considerado atraso recurrente puede ser configurada).">
					<div class="placement_container-records-category">
						<div class="placement_item_container-records-category">
							<div class="placement_card-records-category zoom">
								<div class="div-chart-tunrs">
									<div class="col-7 title-card-turns">
										<h1 class="" id="">Colaboradores con Justificación</h1>  
									</div>
									<div class="col-5">
										<div class="chart-wrapper-tunrs">
											<canvas id="myChartJustification" width="150" height="150"></canvas>
											<div id="chartjs-tooltip">
												<div><p id="sinJustifiaciones"></p></div>
											</div>
										</div>
									</div>
								</div>
								<div class="placement_image-records-category">
									<i class="fad fa-users placement_image_second-records-category" heigth="80" width="130"></i>
								</div>
								<div class="numerogrande-records-category">
									<hr class="hr_style-records-category"style="">
									<h3 id="sinJustifiacion" onload="cargar2()"></h3>
									<hr class="hr_style-records-category"style="">
								</div>
								<div class="placement_bottom-records-category" id="justificacion1">
									<a href="#" class="box-footer-card-records-category">Ver más <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-4 px-0" data-step="15" data-intro="Indicador de cantidad de usuarios que cuentan con atrasos recurrentes dentro del periodo (la cantidad de atrasos necesarios para ser considerado atraso recurrente puede ser configurada).">
					<div class="placement_container-records-category">
						<div class="placement_item_container-records-category">
							<div class="placement_card-records-category zoom">
								<div class="div-chart-tunrs">
									<div class="col-7 title-card-turns">
										<h1 class="" id="">Colaboradores con atraso según turno</h1>  
									</div>
									<div class="col-5">
										<div class="chart-wrapper-tunrs">
											<canvas id="myChartBackwardness" width="150" height="150"></canvas>
											<div id="chartjs-tooltip">
												<div><p id="usrsRecs"></p></div>
											</div>
										</div>
									</div>
								</div>
								<div class="placement_image-records-category">
									<i class="fad fa-users placement_image_second-records-category" heigth="80" width="130"></i>
								</div>
								<div class="numerogrande-records-category">
									<hr class="hr_style-records-category"style="">
									<h3 id="usrsRec" onload="cargar2()"></h3>
									<hr class="hr_style-records-category"style="">
								</div>
								<div class="placement_bottom-records-category" id="justificacion1">
									<a href="#" class="box-footer-card-records-category">Ver más <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-4 px-0" data-step="15" data-intro="Indicador de cantidad de usuarios que cuentan con atrasos recurrentes dentro del periodo (la cantidad de atrasos necesarios para ser considerado atraso recurrente puede ser configurada).">
					<div class="placement_container-records-category">
						<div class="placement_item_container-records-category">
							<div class="placement_card-records-category zoom">
								<div class="div-chart-tunrs">
									<div class="col-7 title-card-turns">
										<h1 class="" id="">Colaboradores Desvinculados</h1>  
									</div>
									<div class="col-5">
										<div class="chart-wrapper-tunrs">
											<canvas id="myChartDisengaged" width="150" height="150"></canvas>
											<div id="chartjs-tooltip">
												<div><p id="usrsDesvc"></p></div>
											</div>
										</div>
									</div>
								</div>
								<div class="placement_image-records-category">
									<i class="fad fa-users placement_image_second-records-category" heigth="80" width="130"></i>
								</div>
								<div class="numerogrande-records-category">
									<hr class="hr_style-records-category"style="">
									<h3 id="usrsDesv" onload="cargar2()"></h3>
									<hr class="hr_style-records-category"style="">
								</div>
								<div class="placement_bottom-records-category" id="11">
									<a href="#" class="box-footer-card-records-category">Ver más <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- <div class="col-12 col-sm-4 px-0" data-step="19" data-intro="Este indicador te muestra los colaboradores desvinculados en el mes">
					<div class="placement_container-records-category">
						<div class="placement_item_container-records-category">
							<div class="placement_card-records-category zoom">
								<div class="placement_text-records-category">
									<h1 id="">Colaboradores<br>Desvinculados</h1>
									<p class="info-box-text-records-category" id="usrsAct" onload="carga()" style="font-weight: 700; display: none;"></p>
								</div>
								<div class="placement_image-records-category">
									<i class="fad fa-users placement_image_second-records-category" heigth="80" width="130"></i>
								</div>
								<div class="numerogrande-records-category">
									<hr class="hr_style-records-category"style="">
									<h3 id="usrsDesv"></h3>
									<hr class="hr_style-records-category"style="">
								</div>
								<div class="placement_bottom-records-category" id="11">
									<a href="#" class="box-footer-card-records-category">Ver más <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div> -->
			</div>
		</div>
	</section>

	<!-- CATEGORIA MONITOREO -->

	<section id="middle" class="content section-content-main mt-4">
		<div class="container">

			<!-----nueva fila graficos--->

			<div class="row mt-5" data-step="20" data-intro="Este indicador te muestra los colaboradores con más ausencias en el mes">
				<div class="col monitoring-mobile-two">
					<div id="panel-3" class="card card-secondary collapsed-card rounded-4 row-graphics-two">
						<div class="card-header rounded-4 card-graphics-two">
							<h3 class="card-title fs-3">
								<strong>Ranking de Ausencias</strong> <!-- panel title -->
							</h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse"><i
										class="fas fa-plus"></i>
								</button>
								<!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
							</div>
						</div>

						<!-- panel content -->
						<div class="card-body">
							<div class="table-responsive">
								<table id="rankingAusencias"
									class="table table-hover dataTable table-striped width-full">
									<tr>
										<td></td>
										<td style="text-align:center;" class="text-sm text-muted"
											style="color:#4b5354;">Aguarda unos segundos.</td>
										<td></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

			
		</div>
	</section>

	<!-- CATEGORIA DATOS COLABORADORES -->

	<section id="middle" class="content section-content-main mt-4">
		<div class="container">

			<!-----nueva fila graficos--->

			<div class="row">
				<div class="container">
					<?php
						if ($instancia!="QA00")
						{ ?>
						<div class="row">
							<div class="col">
								<article class="machine-card bs-card-one" id="6">

									<i class="fad fa-poll-people icon-card"></i>

									<div class="machine-card__content bs-card-content-one">
										<div class="content_title_card">
											<h4 class="machine-card__title">Ausencias del Mes</h4>
											<span>
												<a>Ver más</a>
												<i class="fad fa-angle-double-right"></i>
											</span>
										</div>

										<div class="machine-card__description">
											<div class="parent">
												<div class="card-hover-content mt-2">
													<p class="number-absences" id="et">0</p>
													<p class="text-absences">Ausencias según turno</p>
												</div>
												<div class="card-hover-content mt-2">
													<p class="number-absences" id="mes">0</p>
													<p class="text-absences">Durante el mes en curso</p>
												</div>
											</div>
										</div>
									</div>
								</article>
							</div>
							<div class="col">
								<article class="machine-card bs-card-two" id="7">

									<i class="fad fa-user-clock icon-card"></i>

									<div class="machine-card__content bs-card-content-two">
										<div class="content_title_card">
											<h4 class="machine-card__title">Permisos del Mes</h4>
											<span>
												<a>Ver más</a>
												<i class="fad fa-angle-double-right"></i>
											</span>
										</div>

										<div class="machine-card__description">
											<div class="parent">
												<div class="card-hover-content mt-2">
													<p class="number-absences" id="pd">0</p>
													<p class="text-absences">Permisos</p>
												</div>
												<div class="card-hover-content mt-2">
													<p class="number-absences" id="pm">0</p>
													<p class="text-absences">Permisos en el mes en curso</p>
												</div>
											</div>
										</div>
									</div>
								</article>
							</div>
							<div class="col">
								<article class="machine-card bs-card-three" id="8">

									<i class="fad fa-user-shield icon-card"></i>

									<div class="machine-card__content bs-card-content-three">
										<div class="content_title_card">
											<h4 class="machine-card__title">Licencias del Mes</h4>
											<span>
												<a>Ver más</a>
												<i class="fad fa-angle-double-right"></i>
											</span>
										</div>

										<div class="machine-card__description">
											<div class="parent">
												<div class="card-hover-content mt-2">
													<p class="number-absences" id="ld">0</p>
													<p class="text-absences">Licencias</p>
												</div>
												<div class="card-hover-content mt-2">
													<p class="number-absences" id="lm">0</p>
													<p class="text-absences">Durante el mes en curso</p>
												</div>
											</div>
										</div>
									</div>
								</article>
							</div>
						</div>
					<div class="row">
						<div class="col">
							<article class="machine-card bs-card-four" id="9">

								<i class="fad fa-swimmer icon-card"></i>

								<div class="machine-card__content bs-card-content-four">
									<div class="content_title_card">
										<h4 class="machine-card__title">Vacaciones del Mes</h4>
										<span>
												<a>Ver más</a>
												<i class="fad fa-angle-double-right"></i>
											</span>
									</div>

									<div class="machine-card__description">
										<div class="parent">
											<div class="card-hover-content mt-2">
												<p class="number-absences" id="vd">0</p>
												<p class="text-absences">Vacaciones</p>
											</div>
											<div class="card-hover-content mt-2">
												<p class="number-absences" id="vm">0</p>
												<p class="text-absences">Vacaciones en el mes en curso</p>
											</div>
										</div>
									</div>
								</div>
							</article>
						</div>
						<?php } ?>

						<div class="col">
							<?php
								if ($instancia!="QA00")
							{ ?>
							<article class="machine-card bs-card-five" id="11">

								<i class="fad fa-user-times icon-card"></i>

								<div class="machine-card__content bs-card-content-five">
									<div class="content_title_card">
										<h4 class="machine-card__title">Colaboradores Desvinculados</h4>
										<span>
											<a>Ver más</a>
											<i class="fad fa-angle-double-right"></i>
										</span>
									</div>

									<div class="machine-card__description">
										<div class="parent-2">
											<div class="card-hover-content mt-2 mb-4">
												<p class="number-absences" id="usrsDesv">0</p>
												<p class="text-absences">Desvinculaciones</p>
											</div>
										</div>
									</div>
								</div>
							</article>
							<?php } ?>
						</div>

						<div class="col">
							<article class="machine-card bs-card-six" id="15">

								<i class="fad fa-users-class icon-card"></i>

								<div class="machine-card__content bs-card-content-six">
									<div class="content_title_card">
										<h4 class="machine-card__title">Turnos Colaboradores</h4>
										<span>
											<a>Ver más</a>
											<i class="fad fa-angle-double-right"></i>
										</span>
									</div>

									<div class="machine-card__description">
										<div class="parent-2">
											<div class="card-hover-content mt-2 mb-4">
												<p class="number-absences" id="usrLibres">0</p>
												<p class="text-absences">Sin turno asignado</p>
											</div>
										</div>
									</div>
								</div>
							</article>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<!-- Menu configuracion off-canvas-->
	<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
		<div class="offcanvas-header">
			<h5 class="offcanvas-title" id="offcanvasRightLabel">Configuración General Dashboard</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>
		<div class="offcanvas-body">
			...
		</div>
	</div>

	<!-- Modal gráficos biometrias -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-chart-biometric">
			<div class="modal-content modal-biometric-chart">
			<div class="modal-header d-flex-modal">
				<h1 class="modal-title" id="exampleModalLabel">Gráfico de Biometrías registradas</h1>
				<p class="d-none" id="totalRegistrosBioc"></p>
				<p class="d-none" id="enrPers"></p>
				<i class="fas fa-times " data-bs-dismiss="modal" aria-label="Close"></i>
				<!-- <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button> -->
			</div>
			<div class="modal-body">
				<canvas id="myChartBiometric" width="300" height="200" ></canvas>
			</div>
			<div class="modal-footer">
				<!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button> -->
			</div>
			</div>
		</div>
	</div>

	<!-- modal imagen dispositivos biometricos -->

	<div class="modal fade" id="disBiocModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Mapa instalación dispositivos DPWORLD</h1>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img width="100%" src="../SYS_include2/img/mapa_instalacion_dispositivos_DPWORLD.png">
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>










<div class="wrapper">
  <!-- /.navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light d-none">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" data-toggle="push-menu" href="#" role="button"><i class="fas fa-bars"></i>
			<span class="sr-only">Toggle navigation</span>
		</a>
		
      </li>
	  
    </ul>
		
	<ul class="navbar-nav" style="float: right;">
		<li class="nav-item " style="float: right;">
	   <a href=""  data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<span class="user-name">
								<span class="hidden-xs">
									<?php echo htmlentities($_SESSION['username']); echo $_SESSION['nombre'];?><i class="fa fa-angle-down"></i>
								</span>
							</span>
			</a>
			<ul class="dropdown-menu hold-on-click">
				<li>
					<a href="../"><i class="fa fa-exchange"></i> Cambiar de Aplicación</a>
				</li>
				<li class="divider"></li>

				<li><!-- lockscreen -->
					<a href="../MOD_Configuracion/index.php"><i class="fa fa-cogs"></i> Mi Perfil</a>
				</li>
				<li><!-- logout -->
					<a href="../SYS_auth/includes/logout.php"><i class="fa fa-power-off"></i> Cerrar Sesión</a>
				</li>
			</ul>
		</li>
	</ul>


  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 d-none">
    <!-- Brand Logo -->
    <a href="index2.php" class="brand-link">
      <span class="d-flex brand-text font-weight-bold" style="margin-left:6px;">KeyCloud</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-1  mb-2 d-flex">
        <div class="info">
          <a href="#" class="d-block"><?php echo htmlentities($_SESSION['username']); echo " (".$_SESSION['nombre']." ".$nomsuc.")";?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
			<li class="nav-item">
				<?php 
				
				sec_session_start();
				$in = $_SESSION["entorno"];
				$es = $_SESSION["idestructura"];
				$url_insite = "http://biocov.smartime.cl/Reports/ColaboradoreInSite.aspx?instancia=$in&jerarquia=$es";
				$url_aforo = "http://biocov.smartime.cl/Reports/ConsultaAforos.aspx?instancia=$in";
			
				if ($instancia=='LL00' || $instancia='DPW0') { ?>
					<a class="nav-link active">
						<i class="fas fa-tachometer-alt nav-icon"></i>
						<p onclick="window.location.href='index2.php';">Dashboard</p>
						<i class="right fa fa-chevron-circle-right pull-right"></i>
					</a>
				<?php }else{ ?>
					<a class="nav-link active">
						<i class="fas fa-tachometer-alt nav-icon"></i>
						<p onclick="window.location.href='index.php';">Dashboard</p>
						<i class="right fa fa-chevron-circle-right pull-right"></i>
					</a>
				<?php } ?>
				<ul class="nav nav-treeview">
					<li class="nav-item"><a class="nav-link" href="<?php echo $url_aforo?>"><i class="label label-success pull-left"></i>&nbsp;&nbsp; Aforo</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo $url_insite?>"><i class="label label-success pull-left"></i>&nbsp;&nbsp; InSite</a></li>
				</ul>
			</li>
		  <li class="nav-item">
                <a href="Monitor.php" class="nav-link">
                  <i class="fas fa-clock nav-icon"></i>
                  <p>Monitor</p>
                </a>
           </li>
		   
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-map"></i>
              <p>
                GeoPoint
                <i class="right fa fa-chevron-circle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a class="nav-link" href="GeoPoint.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp; Visor GeoPoint</a></li>
			  <li class="nav-item"><a class="nav-link" href="GeoAccess.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp; Visor GeoUbicación</a></li>
			  <li class="nav-item"><a class="nav-link" href="AjustesGeoPoint.php"><i class="label label-success pull-left"> </i>&nbsp;&nbsp; Ajustes GeoPoint</a></li>
			  <li class="nav-item"><a class="nav-link" href="CheckPoint.php"><i class="label label-success pull-left"> </i>&nbsp;&nbsp; CheckPoint</a></li>
			  <li class="nav-item"><a class="nav-link" href="ReporteMarcaZona.php"><i class="label label-success pull-left"> </i>&nbsp;&nbsp;Marcajes en zona</a></li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-calendar-check"></i>
              <p>
                Asistencia
                <i class="right fa fa-chevron-circle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
				<li class="nav-item"><a class="nav-link" href="GestionMarcas.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp; Gestionar Marcajes</a></li>
				<li class="nav-item"><a class="nav-link" href="VisorMarcas.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp; Visor de Marcas</a></li>
				<li class="nav-item"><a class="nav-link" href="Excepciones.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp; Excepciones</a></li>
				<li class="nav-item"><a class="nav-link" href="Ausencias.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp; Ausencias</a></li>
				<li class="nav-item"><a class="nav-link" href="Atrasos.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp; Atrasos</a></li>
            </ul>
          </li>
		  <li class="nav-item">
                <a href="./GestionTurnos.php" class="nav-link">
                  <i class="fa fa-calendar-plus nav-icon"></i>
                  <p>Turnos y Horarios</p>
                </a>
           </li>



			<?php
				if ($instancia=='SM00' or $instancia=='TU00' or $instancia=='CU00' or $instancia=='CS00' or $instancia=='LOS00' or $instancia =='VO00' or $instancia =='IN00' or $instancia =='QA00'
					or $instancia =='LA00' or $instancia =='DU00' or $instancia =='PRO01' or $instancia =='UTF00' or $instancia =='MUN00' or $instancia =='MUN01' or $instancia =='US01' or $instancia =='JF00' or $instancia =='LL00')
				{
			?>
                <li class="nav-item has-treeview">

					<a href="#" class="nav-link">
					<i class="nav-icon fa fa-map"></i>
					<p>
						   Reportes Smartime
						 <i class="right fa fa-chevron-circle-right"></i>
					</p>
					</a>
                    <!-- 3rd Level -->
                    <ul class="nav nav-treeview">
					<?php
					if ($instancia == 'CU00')
					   {  ?>
						<li class="nav-item">
							<a class="nav-link" href="ReporteCuprum.php">Especial Cuprum</a>
						</li>	
					<?php   
					   }
					  ?>					
                    <?php
                    if ($instancia=='LOS00') {
                    ?>
                        <li class="nav-item"><a class="nav-link" href="#" onclick="reporteLOS00()"><i class="label label-success pull-left">R </i>&nbsp;&nbsp; Reporte LOS ROBLES</a></li>
                        <?php 
                    }
                        sec_session_start();
                        $var = false;
                        $instancia = $_SESSION["entorno"];
                        $sucursal = $_SESSION["sucursal"];
                        $sqlPM = "select CON_INT from KEY_CONFIGURACION where INSTANCIA='$instancia' and CON_NOMBRE='reporte'";
                        $stmt = sqlsrv_query($conn,$sqlPM);
                        if($stmt === false)
                        {
                            $var=false;
                        }
                        while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC))
                        {
                            if($row['CON_INT']==1){
                                $var=true;
                            }else{
                                $var=false;
                            }
                        }

                        ?>
                            <li class="nav-item">
                                <!-- 4th Level -->
                              
                      <?php     if ($instancia=='TU00') {
                      ?>
									<li class="nav-item"><a class="nav-link" href="ReporteGeneralT.php"><i class="label label-success pull-left">R </i>&nbsp;&nbsp; Reporte General</a></li>
									<?php
									}
								else
								{  ?>
								
									<li class="nav-item"><a class="nav-link" href="ReporteGeneral.php"><i class="label label-success pull-left">R </i>&nbsp;&nbsp; Reporte General</a></li>
									<li class="nav-item"><a class="nav-link" href="ReporteMensualV4.php"><i class="label label-success pull-left">D </i>&nbsp;&nbsp; Reporte Detallado</a></li>

					<?php			}
								?>
					<?php		if ($instancia=='LL00') {
						?>
									<li class="nav-item has-treeview"><a class="nav-link" href="ReporteTurno.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp;Estado de turnos</a></li>
					<?php
					}
					?>

                            </li>
                    </ul><!-- /3rd Level -->
                </li>
   <?php } ?>


		   
		   
		   
<?php
   if ($instancia=='SM00' or $instancia=='TU00' or $instancia=='CU00' or $instancia=='CS00' or $instancia=='LOS00' )
   { 
   if ($instancia=='LOS00') {
?>
                <li class="nav-item has-treeview">
					<a href="#" class="nav-link">
					  <i class="nav-icon fa fa-check-circle"></i>
					  <p>
						Servidor de Reportes
						<i class="right fa fa-chevron-circle-right"></i>
					  </p>
					</a>
									

					<ul class="nav nav-treeview">
						<li><a href="#" onclick="reporteLOS00()"><i class="label label-success pull-left">R </i>&nbsp;&nbsp; Reporte LOS ROBLES</a></li>
					</ul>					
				</li>	
   <?php } ?>				
                <li class="nav-item has-treeview">
					<a href="#" class="nav-link">
					  <i class="nav-icon fa fa-check-circle"></i>
					  <p>
						Reportes Nuevos
						<i class="right fa fa-chevron-circle-right"></i>
					  </p>
					</a>
					
                    <!-- 3rd Level -->
                    <ul class="nav nav-treeview">
                        <?php
                        sec_session_start();
                        $var = false;
                        $instancia = $_SESSION["entorno"];
                        $sucursal = $_SESSION["sucursal"];
                        $sqlPM = "select CON_INT from KEY_CONFIGURACION where INSTANCIA='$instancia' and CON_NOMBRE='reporte'";
                        $stmt = sqlsrv_query($conn,$sqlPM);
                        if($stmt === false)
                        {
                            $var=false;
                        }
                        while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC))
                        {
                            if($row['CON_INT']==1){
                                $var=true;
                            }else{
                                $var=false;
                            }
                        }
                        $var=false;
                        if ($var == true) {
                            ?>
                            <li class="nav-item has-treeview">
                                <a href="#">
                                    <i class="fa fa-menu-arrow pull-right"></i>
                                    <i class="fa fa-folder-open"></i>
                                    Turnos Flexibles
                                </a>
                                <!-- 4th Level -->
                                <ul class="nav nav-treeview">
									<li class="nav-item"><a class="nav-link" href="ReporteSemanalTF2.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp; Reporte</a></li>
									<li class="nav-item"><a class="nav-link" href="ResumenAsistenciaTF.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp; Resumen Asistencia</a></li> 
                                </ul><!-- /4th Level -->
                            </li>
                           <!-- <li>
                                <a href="#">
                                    <i class="fa fa-menu-arrow pull-right"></i>
                                    <i class="fa fa-folder-open"></i>
                                    Colaborador
                                </a>
                                
                                <ul>
                                    <li>
                                        <a href="ReporteSemanal2.php">Semanal </a>
                                    </li>
                                </ul> -->
                            
							-->
                            <?php
                        }else{
                        ?>
                            <li class="nav-item has-treeview">
								<a href="#" class="nav-link">
								  <i class="nav-icon fa fa-folder-open"></i>
								  <p>
									Reporte Unificado
									<i class="right fa fa-angle-right"></i>
								  </p>
								</a>
                                <!-- 4th Level -->
                                <ul class="treeview-menu">
									<li class="nav-item"><a class="nav-link" href="ReporteGeneral.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp; Reporte</a></li>
                                </ul><!-- /4th Level -->
                            </li>
                        <?php }?>
                    </ul><!-- /3rd Level -->
                </li>
			
   <?php } ?>
   
   
   
   
<!-- Reportes Beta -->
<?php
   if ($instancia=='UL00')
   { ?>
                <li class="nav-item has-treeview">
					<a href="#" class="nav-link">
					  <i class="nav-icon fa fa-menu-arrow"></i>
					  <p>
						Reportes Ultranav
						<i class="right fa fa-chevron-circle-right"></i>
					  </p>
					</a>
                    <!-- 3rd Level -->
                    <ul class="nav nav-treeview">
                        <?php
                        sec_session_start();
                        $var = false;
                        $instancia = $_SESSION["entorno"];
                        $sucursal = $_SESSION["sucursal"];
                        $sqlPM = "select CON_INT from KEY_CONFIGURACION where INSTANCIA='$instancia' and CON_SUCURSAL=$sucursal and CON_NOMBRE='reporte'";
                        $stmt = sqlsrv_query($conn,$sqlPM);
                        if($stmt === false)
                        {
                            $var=false;
                        }
                        while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC))
                        {
                            if($row['CON_INT']==1){
                                $var=true;
                            }else{
                                $var=false;
                            }
                        }

                        if ($var == true) {
                            ?>
                            <li class="nav-item has-treeview">
								<a href="#" class="nav-link">
								  <i class="nav-icon fa fa-folder-open"></i>
								  <p>
									Turnos Flexibles
									<i class="right fa fa-angle-right"></i>
								  </p>
								</a>
                                <!-- 4th Level -->
                                <ul class="nav nav-treeview">
								<!--	<li><a href="TurnosFlexibles.php"><i class="label label-success pull-left">C </i>&nbsp;&nbsp; Configuracion</a></li>  -->
									<li class="nav-item"><a class="nav-link" href="ReporteSemanalTF2.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp; Reporte</a></li>
									<li class="nav-item"><a class="nav-link" href="ResumenAsistenciaTF.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp; Resumen Asistencia</a></li> 
                                </ul><!-- /4th Level -->
                            </li>
                           <!-- <li>
                                <a href="#">
                                    <i class="fa fa-menu-arrow pull-right"></i>
                                    <i class="fa fa-folder-open"></i>
                                    Colaborador
                                </a>
                                
                                <ul>
                                    <li>
                                        <a href="ReporteSemanal2.php">Semanal </a>
                                    </li>
                                </ul> -->
                            </li>
							-->
                            <?php
                        }else{
                        ?>
                            <li class="nav-item has-treeview">
								<a href="#" class="nav-link">
								  <i class="nav-icon fa fa-folder-open"></i>
								  <p>
									Turnos Flexibles
									<i class="right fa fa-angle-right"></i>
								  </p>
								</a>

                                <!-- 4th Level -->
                                <ul class="nav nav-treeview">
									<!--<li><a href="TurnosFlexibles.php"><i class="label label-success pull-left">C </i>&nbsp;&nbsp; Configuracion</a></li>-->
									<li class="nav-item"><a class="nav-link" href="ReporteSemanalTF2.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp; Reporte</a></li>
									<li class="nav-item"><a class="nav-link" href="ResumenAsistenciaTF.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp; Resumen Asistencia</a></li> 
                                </ul><!-- /4th Level -->
                            </li>						
                            <li class="nav-item has-treeview">
								<a href="#" class="nav-link">
								  <i class="nav-icon fa fa-folder-open"></i>
								  <p>
									Colaborador
									<i class="right fa fa-angle-right"></i>
								  </p>
								</a>
                                <!-- 4th Level -->
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a class="nav-link" href="ReporteSemanal2.php">Semanal </a>
                                    </li>

                                </ul><!-- /4th Level -->
                            </li>

                        <?php }?>
                    </ul><!-- /3rd Level -->
                </li>
   <?php } ?>	
		  
		  <li class="nav-item">
                <a href="Colaboradores.php" class="nav-link">
                  <i class="fa fa-user nav-icon"></i>
                  <p>Colaboradores</p>
                </a>
           </li>
		   
		   
		   <?php 
		 	if($instancia == 'UL00' or $instancia == 'LL00') {
				 $aux=1;
			 } 
		   if ($aux != 1)
			{ ?>
				
                <li class="nav-item has-treeview">					
					<a href="#" class="nav-link">
					  <i class="nav-icon fa fa-folder-open"></i>
					  <p>
						Reportes de Asistencia
						<i class="right fa fa-chevron-circle-right"></i>
					  </p>
					</a>
                    <!-- 3rd Level -->
                    <ul class="treeview-menu">
                        <?php
                        sec_session_start();
                        $var = false;
                        $instancia = $_SESSION["entorno"];
                        $sucursal = $_SESSION["sucursal"];
                        $sqlPM = "select CON_INT from KEY_CONFIGURACION where INSTANCIA='$instancia' and CON_SUCURSAL=$sucursal and CON_NOMBRE='reporte'";
                        $stmt = sqlsrv_query($conn,$sqlPM);
                        if($stmt === false)
                        {
                            $var=false;
                        }
                        while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC))
                        {
                            if($row['CON_INT']==1){
                                $var=true;
                            }else{
                                $var=false;
                            }
                        }

                        if ($var == true) {
                            ?>
                            <li class="nav-item has-treeview">
								<a href="#" class="nav-link">
								  <i class="nav-icon fa fa-folder-open"></i>
								  <p>
									Colaborador
									<i class="right fa fa-angle-right"></i>
								  </p>
								</a>
                                <!-- 4th Level -->
                                <ul class="treeview-menu">
                                    <li class="nav-item has-treeview">
                                        <a class="nav-link" href="ReporteSemanalNoc.php">Semanal </a>
                                    </li>
                                    <li class="nav-item has-treeview">
                                        <a class="nav-link" href="ReporteMensualNoc.php">Mensual </a>
                                    </li>
                                    <li class="nav-item has-treeview">
                                        <a class="nav-link" href="ReporteMensualPdfNoc.php">Mensual PDF </a>
                                    </li>
                                    <li class="nav-item has-treeview">
                                        <a class="nav-link" href="ReportePersonalizadoNoc.php">Personalizado </a>
                                    </li>
									

                                </ul><!-- /4th Level -->
                            </li>
                            <li class="nav-item has-treeview">
								<a href="#" class="nav-link">
								  <i class="nav-icon fa fa-folder-open"></i>
								  <p>
									Departamento
									<i class="right fa fa-angle-right"></i>
								  </p>
								</a>
                                <!-- 4th Level -->
                                <ul class="treeview-menu">
                                    <li class="nav-item has-treeview">
                                        <a class="nav-link" href="ReporteSemanalPorDeptNoc.php">Semanal </a>
                                    </li>
                                    <li class="nav-item has-treeview">
                                        <a class="nav-link" href="ReporteMensualMasivoNoc.php">Mensual (Detallado) </a>
                                    </li>
                                    <li class="nav-item has-treeview">
                                        <a class="nav-link" href="ReporteTotalizadoMensualNoc.php">Mensual (Resumido) </a>
                                    </li>									
                                </ul><!-- /4th Level -->
                            </li>
                            <?php
                        }else{
                        ?>
                            <li class="nav-item has-treeview">
								<a href="#" class="nav-link">
								  <i class="nav-icon fa fa-folder-open"></i>
								  <p>
									Colaborador
									<i class="right fa fa-angle-right"></i>
								  </p>
								</a>
                                <!-- 4th Level -->
                                <ul class="nav nav-treeview">
                                    <li class="nav-item has-treeview">
                                        <a class="nav-link" href="ReporteSemanal.php">Semanal </a>
                                    </li>
                                    <li class="nav-item has-treeview">
                                        <a class="nav-link" href="ReporteMensual.php">Mensual </a>
                                    </li>
                                    <li class="nav-item has-treeview">
                                        <a class="nav-link" href="ReporteMensualPdf.php">Mensual PDF </a>
                                    </li>
                                    <li class="nav-item has-treeview">
                                        <a class="nav-link" href="ReportePersonalizado.php">Personalizado </a>
                                    </li>

                                </ul><!-- /4th Level -->
                            </li>
                            <li class="nav-item has-treeview">
								<a href="#" class="nav-link">
								  <i class="nav-icon fa fa-folder-open"></i>
								  <p>
									Departamento
									<i class="right fa fa-angle-right"></i>
								  </p>
								</a>
                                <!-- 4th Level -->
                                <ul class="nav nav-treeview">
                                    <li class="nav-item has-treeview">
                                        <a class="nav-link" href="ReporteSemanalPorDept.php">Semanal </a>

                                    </li>
                                    <li class="nav-item has-treeview">
                                        <a class="nav-link" href="ReporteMensualMasivo.php">Mensual (Detallado) </a>
                                    </li>
                                    <li class="nav-item has-treeview">
                                        <a class="nav-link" href="ReporteTotalizadoMensual.php">Mensual (Resumido) </a>
                                    </li>
																									
                                </ul><!-- /4th Level -->
                            </li>
                        <?php }?>
                        <li class="nav-item has-treeview"><a class="nav-link" href="ReporteTurno.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp;Estado de turnos</a></li>
                    </ul><!-- /3rd Level -->
                </li>
				
			<?php } ?>
			
			 <li class="nav-item has-treeview">
				<a href="#" class="nav-link">
				  <i class="nav-icon fa fa-file-excel"></i>
				  <p>
					Exportación en Bruto
					<i class="right fa fa-chevron-circle-right"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview"><!-- submenus -->
					<li class="nav-item has-treeview"><a class="nav-link" href="ExportacionMarcas.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp; Marcas de Asistencia</a></li>
					<li class="nav-item has-treeview"><a class="nav-link" href="MaestroUsuarios.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp; Maestro de Colaboradores</a></li>
					<li class="nav-item has-treeview"><a class="nav-link" href="ReporteSemanalSP.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp; Horas Extras</a></li>
				</ul>
			</li>
		
		</li>
		
		<li class="nav-item has-treeview">
			<a href="#" class="nav-link">
			  <i class="nav-icon fa fa-wrench"></i>
			  <p>
				Herramientas
				<i class="right fa fa-chevron-circle-right"></i>
			  </p>
			</a>
			<ul class="nav nav-treeview"><!-- submenus -->
				<li class="nav-item has-treeview"><a class="nav-link" href="Auditoria.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp; Auditoría</a></li>
				<?php if($instancia != 'LL00'){?>
					<li class="nav-item has-treeview"><a class="nav-link" href="MarcajesErroneos.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp; Marcajes erroneos</a></li>
				<?php } ?>
				<!--<li class="nav-item has-treeview"><a class="nav-link" href="MarcajesErroneos.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp; Marcajes erroneos</a></li>-->
				<li class="nav-item has-treeview"><a class="nav-link" href="SinMarcaje.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp; Colabs. Sin Marcaje</a></li>
				<!--<li class="nav-item has-treeview"><a class="nav-link" href="FolioUnico.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp; Validación de reporte</a></li>-->

				<?php if($instancia != 'LL00'){?>
					<li class="nav-item has-treeview"><a class="nav-link" href="FolioUnico.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp; Validación de reporte</a></li>
				<?php } ?>

				
				<li class="nav-item has-treeview"><a class="nav-link" href="Incidencia.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp; Incidencia</a></li>
				<?php
				$sqlPM = "select CON_INT from KEY_CONFIGURACION where INSTANCIA='$instancia' and CON_NOMBRE='maestro'";
				$stmt = sqlsrv_query($conn,$sqlPM);
				if($stmt === false)
				{
					$var=false;
				}
				while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC))
				{
					if($row['CON_INT']==2){
						$var=true;
					}else{
						$var=false;
					}
				}

				if ($var == true) {
				?>
				<li class="nav-item has-treeview"><a class="nav-link" href="PayRoll.php"><i class="label label-success pull-left"></i>&nbsp;&nbsp; Payroll</a></li>
					<?php
				}
				?>
			</ul>
		</li>
		
		<li class="nav-item">
			<a href="Notificaciones.php" class="nav-link">
				<i class="fa fa-exclamation-triangle nav-icon"></i>
				<p>Notificaciones</p>
			</a>

		</li>
		
		<li class="nav-item">
			<a href="Configuracion.php" class="nav-link">
                  <i class="fa fa-cog nav-icon"></i>
                  <p>Configuración</p>
			</a>

		</li>
		
		</ul>
	</nav>

	
	    
     <br>
	 <br>
	 <br>
	 <br>
	 <br>
	 <br>
	 <br>
	 <br>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  <!-- Content Wrapper. Contains page content json --> 
  <div id="wrapper" class="content-wrapper d-none">

<h1>DESDE AQUÍ ES EL ANTERIOR DASHBOARD</h1>
    <!-- Content Header (Page header) -->
    <!-- <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
		  
		  ARBOL JERARQUICO
            <h1 class="m-0 text-dark" style="font-size:40px; line-height:48px; font-weight:500;">Dashboard Jerárquico</h1>
			   <li class="nav-item d-none d-sm-inline-block mt-2">
				   <br>
				   <h2 style=" font-size:16px; "> Filtro jerarquíco actual...</h2>
					<button id="selArbol" onchange="funcioncargar()" class="btn btn-primary float-left" style=" font-size:22px;">
						<span class="spinner-grow spinner-grow-sm" role="status" ></span><span id="txtBotonArbol" ></span>
						<h4><span  class="btn btn-sm btn-light float-left d-none" ><div id="txtBotonArbol2" onchange="funcioncargar()"></span></h4>   
					</button> 
				</li>
          </div>/.col
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="DashAssistance.php">Ir a versión anterior</a></li>
            </ol>
          </div>/.col
        </div>/.row
      </div>/.container-fluid
    </div> -->
    <!-- /.content-header -->

    <!-- Main content -->
    <section id="middle" class="content padding-20">
      <div class="container-fluid">
        <!-- Info boxes -->
		

		<!--------------------------------CONTADORES------------------------------------------------------------------>
		<div class="row">
			<div id="insite"  class="col-lg-3 col-xs-6">
			</div>
		</div>
		
        <div class="row">
		<!-- card one 2022 -->
		<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="placement_container_two">
            <div class="placement_item_container_two">
              <div class="placement_card_two zoom">
                <div class="placement_text_two">
                  <h1 id="soloTexto"></h1>
                  <!-- <p class="info-box-text" id="usrsAct" onload="carga()" style="font-weight: 700;"></p> -->
                  <!-- <hr class="hr_style"style=""> -->
                  <!-- <h3 id="numeroGrande"  onload="cargar2()"></h3> -->
                </div>
                <div class="placement_image_two">
                  <!-- <i class="ion ion-person-stalker placement_image_second" heigth="80" width="130"></i> -->
                  <h3 id="numeroGrande" onload="cargar2()"></h3>
                </div>
                <div class="placement_bottom_two">
                  <a href="#" class="ov-btn-grow-skew">Más info <i class="fad fa-angle-double-right"></i></a>
                  <!-- box-footer-card -->
                </div>
              </div>
            </div>
          </div>
        </div>




			<div class="col-lg-3 col-xs-6" id="10" style="height: 100%;">
				<!-- small box -->
				<div class="small-box" style=" height:11rem; background-color:#2121E2; color:white; font-size:18px !important; max-height:inherit">
					<div class="inner">
					<h3 id="numeroGrande"  onload="cargar2()" style="font-size: 38px"></h3>
					<p  <b style="font-weight: 700; font-size:20px;line-height:26px;" id="soloTexto"></b></p>
					<p class="info-box-text" id="usrsAct" onload="carga()" style="font-weight: 700;"></p>
					</div>
					
					<div class="icon">
					<i class="ion ion-person-stalker"></i>
					</div>
					<a href="#" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		  <!--resta primer y segundo cuadro-->
		  
		  
			<div class="col-lg-3 col-xs-6" ID="primeramarca">
				<!-- small box -->
				<div class="small-box" style="background-color:#008D4C; color:white; font-size:18px !important; height:11rem;">
					<div class="inner">
					<h3 id="numeroGrande2"  onload="cargar2()" style="font-size: 38px"></h3>
					<p> <b style="font-weight: 700; font-size:20px;line-height:26px;" onload="cargar2()" id="soloTexto2"></b> </p>
					<p class="info-box-text" id="regEntF" onload="carga()" style="font-weight: 700;"></p>
					
					<p id="usrAPP" class="d-none" ></p>
					<p id="usrPresencial" class="d-none" > </p>
					</div>
					
					<div class="icon">
					<i class="ion ion-pie-graph"></i> 
					</div>
					<a href="#" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		  
			<div class="col-lg-3 col-xs-6" style="height: 100%;" ID="sinmarca">
				<!-- small box -->
				<div class="small-box" style=" height:11rem; background-color:#858796; color:white; font-size:18px !important; max-height:inherit">
					<div class="inner">
					<h3 id="numeroGrandeResta" style="font-size: 38px"></h3>
					<p  <b style="font-weight: 700; font-size:20px;line-height:26px;" id="soloTextoResta"></b></p>
					</div>
					
					<div class="icon">
					<i class="ion ion-compass"></i>
					</div>
					<a href="#" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		  
		  
			<div class="col-lg-3 col-xs-6" style="height: 100%;" ID="justificacion1">
				<!-- small box -->
				<div class="small-box" style=" height:11rem; background-color:#900C3F; color:white; font-size:18px !important; max-height:inherit">
					<div class="inner">
					<h3 id="sinJustifiacion" style="font-size: 38px"></h3>
					<p  <b style="font-weight: 700; font-size:20px;line-height:26px;" id="soloTextoSinJustificacion"></b></p>
					
					</div>
					
					<div class="icon">
					<i class="ion ion-ios-bookmarks"></i>
					</div>
					<a href="#" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		
			
			<div class="col-lg-3 col-xs-6" id="ausenciasteoricas">
				<!-- small box -->
				<div class="small-box" style="background-color:#8B008B; color:white; font-size:18px !important; height:10rem;">
					<div class="inner">
					<h3 id="ausenciasTeoricasNumero" style="font-size: 38px"></h3>
					<p class="info-box-text"  <b style="font-weight: 700; font-size:20px;line-height:26px;" onload="carga()" id="ausenciasTeoricas"><b></b></p>
					</div>
					
					<div class="icon">
					<i class="ion ion-load-a"></i>
					</div>
					<a href="#" class="small-box-footer" style="margin-top:-15px;">Más info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		  
			<div class="col-lg-3 col-xs-6" id="totalDispositivos" >
				<!-- small box -->
				<div class="small-box" style="background-color:#ffc107; color:white; font-size:18px !important; height:10rem;">
					<div class="inner">
					<h3 id="disps" style="font-size: 38px"></h3>
					<p class="info-box-text"  <b style="font-weight: 700; font-size:20px;line-height:26px;" onload="carga()" id="numeroDispositivos"><b></b></p>
					</div>
					
					<div class="icon">
					<i class="ion ion-ipad"></i>
					</div>
					<a href="Configuracion.php" class="small-box-footer" style="margin-top:-15px;">Gestionar <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		  
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box" id="12" style="background-color:#E53838; color:white; font-size:18px !important; height:10rem;">
					<div class="inner">
					<h3 id="usrsRec" style="font-size: 38px"></h3>
					<p class="info-box-text" style="font-weight: 700; font-size:20px;line-height:26px;" id="usrsretrasados" onload="carga()"><b></b></p>
					</div>
					
					<div class="icon">
					<i class="ion ion-alert-circled"></i>
					</div>
					<a href="#" class="small-box-footer" style="margin-top:-15px;">Más info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		  
			<div class="col-lg-3 col-xs-6" ID="soloingresos">
			  <!-- small box -->
			  <div class="small-box" style="background-color:#001F3F; color:white; font-size:18px !important; height:10rem;">
				<div class="inner">
				  <h3 id="numeroGrande3"  onload="cargar2()" style="font-size: 38px"></h3>
				  <p  <b style="font-weight: 700; font-size:20px;line-height:26px;" id="soloTexto3"></b></p>
				  <p class="info-box-text" id="regEnt" onload="carga()" style="font-weight: 700;"></p>
				</div>
				
				<div class="icon">
				  <i class="ion ion-bag"></i>
				</div>
				<a href="#" class="small-box-footer" style="margin-top:-15px;">Más info <i class="fa fa-arrow-circle-right"></i></a>
			  </div>
		 	</div>  		
		
			<div class="col-lg-3 col-xs-6" >
			  <!-- small box -->
			  <div class="small-box" style="background-color:#FF7701; color:white; font-size:18px !important; height:11rem;">
				<div class="inner">
				  <h3 style="font-size: 38px">+</h3>
				  <p class="info-box-text" id="solotexto7" style="font-weight: 700; font-size:20px;line-height:26px;" onload="carga()"><b></b></p>
				</div>
				
				<div class="icon">
				  <i class="ion ion-person-add"></i>
				</div>
				<a href="Configuracion.php" class="small-box-footer">Agregar <i class="fa fa-arrow-circle-right"></i></a>
			  </div>
			</div>

			<div class="col-lg-3 col-xs-6" ID="ingresost">
				<!-- small box -->
				<div class="small-box" style="background-color:#798A8A; color:white; font-size:18px !important; height:11rem;">
					<div class="inner">
					<h3 style="font-size: 38px">+</h3>
					<p class="info-box-text" style="font-weight: 700; font-size:20px;line-height:26px;" id="solotexto6" onload="carga()"><b></b></p>
					</div>
					
					<div class="icon">
					<i class="ion ion-stats-bars"></i>
					</div>
					<a href="#" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		  	<div class="col-lg-3 col-xs-6" >
			  <!-- small box -->
			  <div class="small-box" style="background-color:#555299; color:white; font-size:18px !important; height:11rem;">
				<div class="inner">
				  <h3 style="font-size: 38px">+</h3>
				  <p  <b style="font-weight: 700; font-size:20px;line-height:26px;" id="soloTexto4"></b></p>
				  <p  <b style="font-weight: 700; font-size:20px;line-height:26px;" id="carasHuellas" onload="carga()"></b></p>
				</div>
				
				<div class="icon">
				  <i class="ion ion-man"></i>
				</div>
			  </div>
			</div>
			  
			<!--<div id="insite"  class="col-lg-3 col-xs-6">
			</div>-->
			


		</div>
		<!--Termino contadores 1-->
		
		<!-----nueva fila graficos--->
		
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-5 d-none d-md-block">
					<!--<div id="chartContainer" style="height: 300px; width: 100%;"></div>-->
				<!--<figure class="highcharts-figure">
					<div id="graficoMarcaje"></div>
				</figure>-->
				<div  class="card card-primary">
					<div class="card-header">
								<h3 class="card-title" >
									<strong>Métodos de asistencia</strong> <!-- panel title -->
								</h3>
								<div class="card-tools">
								  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
								  </button>
								  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
								</div>
					</div>
					<div class="card-body d-flex justify-content-center" >
						<canvas id="myChart" width="350" height="350" ></canvas>
					</div>
					</div>
				</div>
			
			<!--<div class="col-md-5  d-md-block">

				<div  class="card card-primary">
					<div class="card-header">
								<h3 class="card-title" >
									<strong>Afóro</strong> 
								</h3>
								<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
								</button>
								<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
								</div>
					</div>
					<div class="card-body d-flex justify-content-center" >
						<canvas id="aforo" width="400" height="400" ></canvas>
					</div>
				</div>
			</div>
			-->
			
				
				
				
			
			<!-- TABLA DE RANKING DE AUSENCIAS -->
			<div class="col-md-5">
				<div id="panel-3" class="card card-secondary">
					<div class="card-header">
								<h3 class="card-title" >
									<strong>Ranking de Ausencias</strong> <!-- panel title -->
								</h3>
								<div class="card-tools">
								  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
								  </button>
								  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
								</div>
					</div>

					<!-- panel content -->
					<div class="card-body">
						<div class="table-responsive">
							<table id="rankingAusencias" class="table table-hover dataTable table-striped width-full">
								<tr>
									<td></td>
									<td style="text-align:center;" class="text-sm text-muted" style="color:#4b5354;">Aguarda unos segundos...</td>
									<td></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
            <!-- /.card -->

		
		
		
		
		<!----------monitor en tiempo real------------------>


        <div id="content" class="padding-20 mb-3">
            <div class="card">
                <div class="card-header">

					<span class="card-title"><!-- panel title -->
						<strong>Monitor en Tiempo Real</strong>
						<button type="button" id="selArbol" class="btn btn-light "><div id="txtBotonArbol2" class="d-none">Posición</div></button>
					</span>
						<div class="card-tools">
						  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
						  </button>
						  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
						</div>
					
					
					
					

					<!-- right options -->
					<ul class="options pull-right list-inline">
						<li><a href="javascript:void(0);" onclick="javascript:introJs().start();"  data-toggle="tooltip" title="Ayuda" data-placement="bottom"><i style="font-size: 25px" class="fa fa-question-circle"></i></a></li>
					</ul>
					<!-- /right options -->
				</div>
					<div class="card-body monitorTiempoReal">
						<div class="table-responsive monitorTiempoReal">
							<table id="tablaMonitor" class="table table-hover dataTable table-striped width-full " style="color:#676A6C;">
								<thead>
								<tr>
									<th data-step="3" >Imagen</th>
									<th data-step="3" >Departamento</th>
									<th data-step="4" >RUT</th>
									<th data-step="5" >Nombre</th>
									<th data-step="6" >Cargo</th>
									<th data-step="7" >Fecha</th>
									<th data-step="8" >Hora</th>
									<th data-step="9" >Terminal</th>
									<th data-step="10" >Tipo</th>
								</tr>
								</thead>
								<tfoot>
								<tr>
									<th>Imagen</th>
									<th>Departamento</th>
									<th>RUT</th>
									<th>Nombre</th>
									<th>Cargo</th>
									<th>Fecha</th>
									<th>Hora</th>
									<th>Terminal</th>
									<th>Tipo</th>
								</tr>
								</tfoot>
								<tbody id="monitorTiempoReal">
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>Cargando datos, aguarda unos segundos...</td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		  
		  
		 
          
		<div class="row"> 
		
		<?php
		if ($instancia!="QA00")
			{ ?>
          <!-- /.col -->
		  
		  <div class="col-xxl-3 col-lg-3">
				<div class="card bg-info text-white mb-4" id="6" style="height:9rem;">
				<!--<div class="card bg-info text-white mb-4" style="height:9rem;">-->
					<div class="card-body" >
						<div class="d-flex justify-content-between align-items-center">
							<div class="mr-3" >
								<div class="text-white-75 small" id="et">Ausencias</div>
								<div class="text-lg font-weight-bold" id="mes">Cargando...</div>
							</div>
							<i class="feather-xl text-white-50 ion ion-person-stalker" data-feather="ion ion-person-stalker"></i>
							
				
						</div>
					</div>
					<div class="card-footer d-flex align-items-center justify-content-between">
						<a class="small text-white stretched-link" >Ver más</a>
						<div class="small text-white"><i class="fas fa-angle-right"></i></div>
					</div>
				</div>
			</div>
			
			<div class="col-xxl-3 col-lg-3">
				<div class="card bg-secondary text-white mb-4" id="7" style="height:9rem;">
					<div class="card-body" >
						<div class="d-flex justify-content-between align-items-center">
							<div class="mr-3" >
								<div class="text-white-75 small" id="pd">...Permisos Hoy</div>
								<div class="text-lg font-weight-bold" id="pm">Cargando...</div>
							</div>
							<i class="feather-xl text-white-50 fas fa-business-time" data-feather="fas fa-business-time"></i>
							
				
						</div>
					</div>
					<div class="card-footer d-flex align-items-center justify-content-between">
						<a class="small text-white stretched-link" >Ver más</a>
						<div class="small text-white"><i class="fas fa-angle-right"></i></div>
					</div>
				</div>
			</div>
			
			<div class="col-xxl-3 col-lg-3">
				<div class="card bg-success text-white mb-4" id="8" style="height:9rem;">
					<div class="card-body" >
						<div class="d-flex justify-content-between align-items-center">
							<div class="mr-3" >
								<div class="text-white-75 small" id="ld">...Licencias</div>
								<div class="text-lg font-weight-bold" id="lm">Cargando...</div>
							</div>
							<i class="feather-xl text-white-50 fas fa-briefcase-medical" data-feather="fas fa-business-time"></i>
										
						</div>
					</div>
					<div class="card-footer d-flex align-items-center justify-content-between">
						<a class="small text-white stretched-link" >Ver más</a>
						<div class="small text-white"><i class="fas fa-angle-right"></i></div>
					</div>
				</div>
			</div>
			
			<div class="col-xxl-3 col-lg-3">
				<div class="card bg-dark text-white mb-4" id="9" style="height:9rem;">
					<div class="card-body" >
						<div class="d-flex justify-content-between align-items-center">
							<div class="mr-3" >
								<div class="text-white-75 small" id="vd">...Vacaciones</div>
								<div class="text-lg font-weight-bold" id="vm">Cargando...</div>
							</div>
							<i class="feather-xl text-white-50 fas fa-car-side" data-feather="fas fa-business-time"></i>
										
						</div>
					</div>
					<div class="card-footer d-flex align-items-center justify-content-between">
						<a class="small text-white stretched-link" >Ver más</a>
						<div class="small text-white"><i class="fas fa-angle-right"></i></div>
					</div>
				</div>
			</div>
			
			
		
		  
		 
		<?php } ?>
		</div>
		  
		<div class="row">
			<div class="col-12 col-sm-6 col-md-3"></div>
		<?php
			if ($instancia!="QA00")
		{ ?>
		   <div class="col-xxl-3 col-lg-3">
				<div class="card bg-danger text-white mb-4" id="11" style="height:9rem;">
					<div class="card-body" >
						<div class="d-flex justify-content-between align-items-center">
							<div class="mr-3" >
								<div class="text-white-75 small" id="usrsDesv">...Colaboradores</div>
								<div class="text-lg font-weight-bold">Desvinculados</div>
							</div>
							<i class="feather-xl text-white-50 fas fa-ban" ></i>
							
				
						</div>
					</div>
					<div class="card-footer d-flex align-items-center justify-content-between">
						<a class="small text-white stretched-link" >Ver más</a>
						<div class="small text-white"><i class="fas fa-angle-right"></i></div>
					</div>
				</div>
			</div>
		<?php } ?>
          <!-- /.col -->
		  
		  <!---------------------------------mas contadores------------------------------------->
		  
		    
		  
		    <div class="col-xxl-3 col-lg-3">
				<div class="card bg-primary text-white mb-4" id="15" style="height:9rem;">
					<div class="card-body" >
						<div class="d-flex justify-content-between align-items-center">
							<div class="mr-3" >
								<div class="text-white-75 small" id="usrLibres">...Colaboradores</div>
								<div class="text-lg font-weight-bold">Sin Turno Asignado</div>
							</div>
							<i class="feather-xl text-white-50 fas fa-bed" ></i>
							
				
						</div>
					</div>
					<div class="card-footer d-flex align-items-center justify-content-between">
						<a class="small text-white stretched-link" >Ver más</a>
						<div class="small text-white"><i class="fas fa-angle-right"></i></div>
					</div>
				</div>
			</div>
		  
		  
		    
		  <div class="col-12 col-sm-6 col-md-3"></div>
		  
		 
		  
		  
		  
		  
		  
		  
		  
		<!------------------------------------------CONTADORES--------------------------------------------------------->
        </div>
		<div class="row">
		  <div class="col-md-1">
		  </div>
         <div class="col-md-10">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Gráfico General</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Action</a>
                      <a href="#" class="dropdown-item">Another action</a>
                      <a href="#" class="dropdown-item">Something else here</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-12 col-md-12 ">
                    <p class="text-center">
                      <strong>Dashboard Global</strong>
                    </p>

                    <!--<div class="chart">
                      <!-- Sales Chart Canvas GRAFICO--
                      <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                    </div>-->
					
					  <div id="grafico" class="row" >
                        <div id="morris-area-example" style="width:100%;height:auto;margin-top: 10px;-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">

                            <div id="mensajeCarga" class="col-md-2 col-md-push-2" style="text-align: center;font-size: 15px;"><b>Se está cargando la información del gráfico, por favor aguarda unos segundos...</b></div>

                        </div>
                    </div>
					
					
					
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <!--<div class="col-md-4">
                    <p class="text-center">
                      <strong>Goal Completion</strong>
                    </p>

                    <div class="progress-group">
                      Add Products to Cart
                      <span class="float-right"><b>160</b>/200</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 80%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group --

                    <div class="progress-group">
                      Complete Purchase
                      <span class="float-right"><b>310</b>/400</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: 75%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group --
                    <div class="progress-group">
                      <span class="progress-text">Visit Premium Page</span>
                      <span class="float-right"><b>480</b>/800</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: 60%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group --
                    <div class="progress-group">
                      Send Inquiries
                      <span class="float-right"><b>250</b>/500</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: 50%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group --
                  </div>-->
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <!--<div class="card-footer">
                <div class="row">
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                      <h5 class="description-header">$35,210.43</h5>
                      <span class="description-text">TOTAL REVENUE</span>
                    </div>
                    <!-- /.description-block --
                  </div>
                  <!-- /.col --
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                      <h5 class="description-header">$10,390.90</h5>
                      <span class="description-text">TOTAL COST</span>
                    </div>
                    <!-- /.description-block --
                  </div>
                  <!-- /.col --
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                      <h5 class="description-header">$24,813.53</h5>
                      <span class="description-text">TOTAL PROFIT</span>
                    </div>
                    <!-- /.description-block --
                  </div>
                  <!-- /.col --
                  <div class="col-sm-3 col-6">
                    <div class="description-block">
                      <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                      <h5 class="description-header">1200</h5>
                      <span class="description-text">GOAL COMPLETIONS</span>
                    </div>
                    <!-- /.description-block --
                  </div>
                </div>
                <!-- /.row --
              </div>-->
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
		  
        <!-- /.row -->
		
		<!-- INDICADORES DE HORAS TRABAJADAS Y PLANIFICADAS -->
            <div class="row" style="padding:0px;">
                <!-- INICIO PIE CHARTS -->
				<div class="col-md-1">
				</div>
                <div class="col-md-5" >
                    <div  class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title" >
                                Horas Trabajadas/Asignadas del Mes
                            </h3>
							<div class="card-tools">
									  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
									  </button>
									  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
							</div>
                        </div>
                        <div class="card-body">
                            <div id="contenedor1" class="col-md-12 col-sm-12" style="overflow:visible">

                            </div>
                            <div id="infoPie1"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title" >
                                Horas trabajadas/Asignadas hasta hoy
                            </h3>
							<div class="card-tools">
							  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
							  </button>
							  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
							</div>
							
                        </div>
                        <div class="card-body">
                            <div id="contenedor2" class="col-md-12 col-sm-12" style="overflow:visible">

                            </div>
                            <div id="infoPie2"></div>
                        </div>
                    </div>
                </div>
				<div class="col-md-1"></div>
			</div>
				
                <!-- FIN DONUT CHARTS -->
                <!-- INICIO INDICADOR CON LAS HORAS EXTRA -->
			<div class="row">
                
            </div>
			
			
			<div class="row">
                
                <!-- FIN TABLA RANKING DE AUSENCIAS -->
                <!--PANEL ACTIVIDADES-->
				<div class="col-md-1"></div>
                <div class="col-md-6">

                    <div id="panel-3" class="card card-success">
                        <div class="card-header">
									<h3 class="card-title">
										actividades SmarTime
									</h3>
									<div class="card-tools">
									  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
									  </button>
									  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
									</div>
                        </div>

                        <!-- panel content -->
                        <div class="card-body">

                            <ul class="list-unstyled list-hover slimscroll " id="listaActividades" data-slimscroll-visible="true" style="color:#4b5354;">
                                <li style="text-align: center;" class="text-sm text-muted">Aguarda unos segundos...</li>
                                <!--LISTA DE ACTIVIDADES-->
                            </ul>

                        </div>
                        <div style="font-size:14px !important;" class="card-footer">

                            <a href="Auditoria.php"><i class="fa fa-arrow-right text-muted"></i> Ver registro completo</a>

                        </div>
                    </div>
                </div>
				
				<div class="col-md-4" >
                    <div id="panel-3" class="card card-success">
                        <div class="card-header">
                            <div class="card-title">
                                <strong>Horas adicionales Trabajadas en el Mes</strong>
                            </div>
							<div class="card-tools">
							  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
							  </button>
							  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
							</div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12 col-sm-12">
                                <div class="col-md-12 col-sm-12" style="text-align: center;color:#676a6c;line-height:20px; font-weight:400;">
                                    <b>Total de horas adicionales trabajadas hasta la fecha</b>
                                </div>
                                <div style="">
                                    <div id="horasExtraMes" style="font-weight: bold;font-size: 50px;text-align: center;color:#676a6c;">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				
                    <div id="panel-3" class="card card-success" style="margin-top:-5px;" class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <strong>Horas adicionales Trabajadas Hoy</strong>
                            </div>
							<div class="card-tools">
							  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
							  </button>
							  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
							</div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12 col-sm-12">
                                <div class="col-md-12 col-sm-12" style="text-align: center;color:#676a6c;line-height:20px; font-weight:400;">
                                    <b>Total de horas adicionales trabajadas hoy</b>
                                </div>
                                <div style="">
                                    <div id="horasExtraDia" style="font-weight: bold;font-size: 50px;text-align: center;color:#676a6c;">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIN INDICADOR CON LAS HORAS EXTRA -->
                <!--////PANEL ACTIVIDADES///-->
            </div>
		
		
		
		
      </div><!--/. container-fluid -->
	  
		
    </section>
	
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- aqui termina el dashboard anterior -->
  
  
  
  
  
  
  
  
  
  
  
<!------------------------------------MODAL NOTIFICACIONES--------------------------------------------------->
<!-- <div class="modal fade" id="modalNotification" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-notification">
        <div class="modal-content  ">
            <div style="text-align: center; font-weight: 500; font-size:25px;" class="modal-header">
				"Felicidades. Tienes activa la última versión de SmarTime. " accede a ella dando click en 
            </div>
             <div class="modal-footer">
				<button type="button" onclick="funcioncargar()" class="btn btn-success .btn-sm" id="aceptar" >Seleccionar</button>
				<button type="button" class="btn btn-success .btn-sm" id="irPage" >Actualizar</button>
            </div>
        </div>
    </div>
</div> -->
<!-------------------------------------FIN MODAL NOTIFICACIONES---------------------------------------------->

<!------------------------------------MODAL ARBOL--------------------------------------------------->
<div class="modal fade" id="modalArbol" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-arbol">
        <div class="modal-content  ">
            <div style="text-align: center; font-weight: 500; font-size:25px;" class="modal-header">
                Seleccionar área o departamento que deseas visualizar
            </div>
            <div class="modal-body">
                <div class="row">
                   <div id="arbol"></div>
                </div>
            </div>
             <div class="modal-footer">
				<!-- <button type="button" onclick="funcioncargar()" class="btn btn-success .btn-sm" id="aceptar" >Seleccionar</button> -->
				<button type="button" class="btn btn-success .btn-sm" id="aceptar" >Seleccionar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------FIN MODAL ARBOL---------------------------------------------->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  
  
  
</div>
<!-- ./wrapper -->
<!-----------------------------------------------MODALES------------------------------------------------------->
<!--MODAL SOLO INGRESOS----------------------------------------------------------------------------------------------------->
<div class="modal fade" id="modalSoloIngresos" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" >
		<div class="modal-content modal-responsive" >
			<div class="modal-header">
				<h4 class="modal-title" >Registros de entrada</h4>
				<!--<span>Colaboradores que no han registrado entrada</span>-->
				<!-- <button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
					<span class="sr-only">Cerrar</span>
				</button> -->
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-hover dataTable table-striped width-full" id="tablaSoloIngresos">
						<thead>
						<tr>
							<th>RUT</th>
							<th>Nombre</th>
							<th>Departamento</th>
							<th>Fecha</th>
							<th>Hora</th>
							<th>Tipo Marca</th>
							<th>Dispositivo</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>RUT</th>
							<th>Nombre</th>
							<th>Departamento</th>
							<th>Fecha</th>
							<th>Hora</th>
							<th>Tipo Marca</th>
							<th>Dispositivo</th>
						</tr>
						</tfoot>
						<tbody>
							<tr>
								<td></td>
								<td></td>
								<td style="text-align: center;" class="text-sm text-muted">Aguarda unos segundos...</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<div class="row">
					<div class="col-md-12">
						<!-- <button type="button" class="btn btn-danger .btn-sm" data-dismiss="modal" id="btnCerrar3">Cerrar</button> -->
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
						<button class="btn btn-success .btn-sm" onclick="exportTableToExcel('tablaSoloIngresos', 'Ingresos')">Exportar a XLS</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--MODAL SOLO INGRESOS----------------------------------------------------------------------------------------------------->
<!----------------------------------------MODAL PRIMERA MARCA--------------------------------------------------------------->
<div class="modal fullscreen-modal fade" id="modalPrimeraMarca" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" >
		<div class="modal-content modal-responsive">
			<div class="modal-header">
				<h4 class="modal-title" >Primer registro de entrada por colaborador</h4>
				<!--<span>Colaboradores que no han registrado entrada</span>-->
				<!-- <button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
					<span class="sr-only">Cerrar</span>
				</button> -->
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-hover dataTable table-striped width-full" id="tablaPrimeraMarca">
						<thead>
						<tr>
							<th>RUT</th>
							<th>Nombre</th>
							<th>Departamento</th>
							<th>Fecha</th>
							<th>Hora</th>
							<th>Tipo Marca</th>
							<th>Dispositivo</th>
						</tr>
						</thead>
						<!-- <tfoot>
						<tr>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th> 
							<th></th>
						</tr>
						</tfoot> -->
						<tbody>
							<tr>
								<td></td>
								<td></td>
								<td style="text-align: center;" class="text-sm text-muted">Aguarda unos segundos...</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<div class="row">
					<div class="col-md-12">
						<button type="button" class="btn btn-success" data-bs-dismiss="modal">Cerrar</button>
						<button class="btn btn-primary" onclick="exportTableToExcel('tablaPrimeraMarca', 'Primera_Marca')">Exportar a XLS</button>
						<button class="btn btn-primary" onclick="exportTableToExcel('tablaPrimeraMarca', 'Primera_Marca')">Exportar a CSV</button>
						<button class="btn btn-primary" onclick="exportTableToExcel('tablaPrimeraMarca', 'Primera_Marca')">Exportar a PDF</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!----------------------------------------MODAL SIN MARCA--------------------------------------------------------------->
<div class="modal fullscreen-modal fade" id="modalSinMarca" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" style="max-width: 60rem;" >
		<div class="modal-content modal-responsive">
			<div class="modal-header">
				<h4 class="modal-title" >Colaboradores que no han registrado entrada</h4>
				<!--<span>Colaboradores que no han registrado entrada</span>-->
				<!-- <button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
					<span class="sr-only">Cerrar</span>
				</button> -->
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-hover dataTable table-striped width-full" id="tablaSinMarca" style="width: 99%;">
						<thead>
						<tr style="color: black;">
							<th>RUT</th>
							<th>Nombre</th>
							<th>Departamento</th>
							<!--<th>Fecha</th>
							<th>Hora</th>
							<th>Tipo Marca</th>
							<th>Dispositivo</th>-->
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>RUT</th>
							<th>Nombre</th>
							<th>Departamento</th>
							<!--<th>Fecha</th>
							<th>Hora</th>
							<th>Tipo Marca</th>
							<th>Dispositivo</th>-->
						</tr>
						</tfoot>
						<tbody>
							<tr>
								<td></td>
								<td style="text-align: center;" class="text-sm text-muted">Aguarda unos segundos...</td>
								<td></td>
								<!--<td></td>
								<td></td>
								<td></td>-->
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<div class="row">
					<div class="col-md-12">
						<!-- <button type="button" class="btn btn-danger .btn-sm" data-dismiss="modal" id="btnCerrarSinM">Cerrar</button> -->
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
						<button class="btn btn-success .btn-sm" onclick="exportTableToExcel('tablaSinMarca', 'Sin_Marca')">Exportar a XLS</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!--MODAL JUSTIFICADOS-->
<div class="modal fullscreen-modal fade" id="modalJustificacion" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" >
		<div class="modal-content modal-responsive">
			<div class="modal-header">
				<h4 class="modal-title" >Colaboradores con justificación</h4>
				<!-- <button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
					<span class="sr-only">Cerrar</span>
				</button> -->
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-hover dataTable table-striped width-full" id="tablaJustificados2">
						<tr>
                            <td></td>
                            <td style="text-align:center;" class="text-sm text-muted">Aguarda unos segundos...</td>
							<td></td>
                            <td></td>
                        </tr>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<div class="row">
					<div class="col-md-12">
						<!-- <button type="button" class="btn btn-danger .btn-sm" data-dismiss="modal" id="btnCerrarJustificados">Cerrar</button> -->
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
						<button class="btn btn-success .btn-sm" onclick="exportTableToExcel('tablaJustificados2', 'Justificados')">Exportar a XLS</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!--MODAL AUSENCIAS TEORICAS-->
<div class="modal fullscreen-modal fade" id="modalAusenciasTeoricas" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" >
		<div class="modal-content modal-responsive">
			<div class="modal-header">
				<h4 class="modal-title" >Colaboradores con ausencias teóricas</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
					<span class="sr-only">Cerrar</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-hover dataTable table-striped width-full" id="tablaAusenciasT">
						<thead>
						<tr>
							<th>RUT</th>
							<th>Nombre</th>
							<th>Departamento</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>RUT</th>
							<th>Nombre</th>
							<th>Departamento</th>
						</tr>
						</tfoot>
						<tbody>
							<tr>
								<td></td>
								<td style="text-align: center;" class="text-sm text-muted">Aguarda unos segundos...</td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<div class="row">
					<div class="col-md-12">
						<button type="button" class="btn btn-danger .btn-sm" data-dismiss="modal" id="btnCerrarAusenciasT">Cerrar</button>
						<button class="btn btn-success .btn-sm" onclick="exportTableToExcel('tablaAusenciasT', 'Ausencias_teóricas')">Exportar a XLS</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!--MODAL  EN INGRESOS----------------------------------------------------------------------------------------------------->
<div class="modal fade" id="modalIngresos" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content modal-responsive" >
			<div class="modal-header">
				<h4 class="modal-title" >Registros de entrada y salida</h4>
				<!-- <button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
					<span class="sr-only">Cerrar</span>
				</button> -->
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-hover dataTable table-striped width-full" id="tablaIngresos">
						<thead>
						<tr>
							<th>RUT</th>
							<th>Nombre</th>
							<th>Departamento</th>
							<th>Entrada</th>
							<th>Salida</th>


						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>RUT</th>
							<th>Nombre</th>
							<th>Departamento</th>
							<th>Entrada</th>
							<th>Salida</th>


						</tr>
						</tfoot>
						<tbody>
							<tr>
								<td></td>
								<td></td>
								<td style="text-align: center;" class="text-sm text-muted">Aguarda unos segundos...</td>
								<td></td>
								<td></td>

							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<div class="row">
					<div class="col-md-12">
						<!-- <button type="button" class="btn btn-danger .btn-sm" data-dismiss="modal" id="btnCerrar2">Cerrar</button> -->
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
						<button class="btn btn-success .btn-sm" onclick="exportTableToExcel('tablaIngresos', 'Ingresos/Salidas')">Exportar a XLS</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--MODAL INSITE---------------------------------------------------------------------------------------------------->
<div class="modal fade" id="modalInsite" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content modal-responsive">
			<div class="modal-header">
				<h4 class="modal-title" >Insite</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
					<span class="sr-only">Cerrar</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive" >
					<table class="table table-hover dataTable table-striped width-full" id="tablaInsite">
					</table>
					
				</div>
			</div>
			<div class="modal-footer">
				<div class="row">
					<div class="col-md-12">
						<button type="button" class="btn btn-danger .btn-sm" data-dismiss="modal" id="btnCerrarPr">Cerrar</button>
						<button class="btn btn-success .btn-sm" onclick="exportTableToExcel('tablaInsite', 'Primera_Marca')">Exportar a XLS</button>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>

<!--MODAL AUSENCIAS MENSUALES----------------------------------------------------------------------------------------------------->
<div class="modal fade" id="modalAusenciasM" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-responsive" >
            <div style="text-align: center;" class="modal-header">
				<h4 class="modal-title" >Detalle de ausencias del día por departamento</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
					<span class="sr-only">Cerrar</span>
				</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!--table id="ausenciasMM" class="table-bordered" style="width:100%"-->
                    <table id="ausenciasMM" class="table table-hover dataTable table-striped" style="width:90%;margin:0 auto;">
                        <tr>
                            <td></td>
                            <td style="text-align:center;" class="text-sm text-muted">Aguarda unos segundos...</td>
							<td></td>
                            <td></td>
							<td></td>
                        </tr>
                    </table>
                </div>
				<hr>
					<button class="btn btn-success .btn-sm" onclick="exportTableToExcel('ausenciasMM', 'Ausencias')">Exportar a XLS</button>
            </div>
            <!--div class="modal-footer">
            </div-->
        </div>
    </div>
</div>
<!--MODAL USUARIOS DESVINCULADOS----------------------------------------------------------------------------------------------------->
<div class="modal fade" id="modalDesvinculados" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" >
            <div style="text-align: center;" class="modal-header">
				<h4 class="modal-title" >Colaboradores Desvinculados</h4>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
				<!-- <button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
					<span class="sr-only">Cerrar</span>
				</button> -->
            </div>
            <div class="modal-body">
                <div class="row">
                    <table id="tablaDesv" class="table table-hover dataTable table-striped" style="width:90%;margin:0 auto;">
                        <tr>
                            <td></td>
                            <td style="text-align: center;" class="text-sm text-muted">Aguarda unos segundos...</td>
                            <td></td>
                        </tr>
                    </table>
                </div>
				<hr>
					<button class="btn btn-success .btn-sm" onclick="exportTableToExcel('tablaDesv', 'Desvinculados')">Exportar a XLS</button>
            </div>
            <div class="modal-footer">
                <!-- INICIO INFORMACIÓN -->
                <p style="font-style: italic;text-align:left;padding: 0;margin: 0;font-size:12px;">
                    *Corresponden a los colaboradores eliminados en el ciclo de facturación actual
                </p>
            <!-- FIN INFORMACIÓN -->
            </div>
        </div>
    </div>
</div>
<!--MODAL ATRASOS RECURRENTES----------------------------------------------------------------------------------------------------->
<div class="modal fade" id="modalAtrasosR" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-responsive" >
            <div style="text-align: center;" class="modal-header">
				<h4 class="modal-title" >Trabajadores con atrasos Hoy</h4>
				<!-- <button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
					<span class="sr-only">Cerrar</span>
				</button> -->
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <table id="atrasosR" class="table table-hover dataTable table-striped" style="width:90%;margin:0 auto;">
                        <tr>
                            <td></td>
                            <td style="text-align: center;" class="text-sm text-muted">Aguarda unos segundos...</td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
			<div class="modal-footer">
				<div class="row">
					<div class="col-md-12">
						<!-- <button type="button" class="btn btn-danger .btn-sm" data-dismiss="modal" >Cerrar</button> -->
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
						<button class="btn btn-success .btn-sm" onclick="exportTableToExcel('atrasosR', 'Atrasos_Hoy')">Exportar a XLS</button>
						
					</div>
				</div>
				</form>
			</div>
        </div>
    </div>
</div>
<!--MODAL USUARIOS SIN TURNO ASIGNADO----------------------------------------------------------------------------------------------------->
<div class="modal fade" id="modalSinT" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-responsive" >
            <div style="text-align: center;" class="modal-header">
				<h4 class="modal-title" >Colaboradores sin Turno Asignado</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
					<span class="sr-only">Cerrar</span>
				</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <table id="tablaSinT" class="table table-hover dataTable table-striped" style="width:90%;margin:0 auto;">
                        <tr>
                            <td></td>
                            <td style="text-align: center;" class="text-sm text-muted">Aguarda unos segundos...</td>
                            <td></td>
                        </tr>
                    </table>
                </div>
				<hr>
					<button class="btn btn-success .btn-sm" onclick="exportTableToExcel('tablaSinT', 'Sin_Turno')">Exportar a XLS</button>
            </div>
            <div class="modal-footer">
                <!-- INICIO INFORMACIÓN -->
                <p style="font-style: italic;text-align:left;padding: 0;margin: 0;font-size:12px;">
                    *Corresponden a los colaboradores sin turno asignado
                </p>
            <!-- FIN INFORMACIÓN -->
            </div>
        </div>
    </div>
</div>
<!--MODAL PERMISOS----------------------------------------------------------------------------------------------------->
<div class="modal fade" id="modalPermisos" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-responsive">
            <div style="text-align: center;" class="modal-header">
				<h4 class="modal-title" > Detalle de permisos</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
					<span class="sr-only">Cerrar</span>
				</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <table id="permisosM" class="table table-hover dataTable table-striped" style="width:90%;margin:0 auto;">
                        <tr>
                            <td></td>
                            <td style="text-align:center;" class="text-sm text-muted">Aguarda unos segundos...</td>
                            <td></td>
                        </tr>
                    </table>
                </div>
					<hr>
					<button class="btn btn-success .btn-sm" onclick="exportTableToExcel('permisosM', 'Permisos')">Exportar a XLS</button>
            </div>
            <!--div class="modal-footer">
            </div-->
        </div>
    </div>
</div>
<!--MODAL LICENCIAS----------------------------------------------------------------------------------------------------->
<div class="modal fade" id="modalLicencias" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-responsive" >
            <div style="text-align: center;" class="modal-header">
				<h4 class="modal-title" >Detalle de licencias</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
					<span class="sr-only">Cerrar</span>
				</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!--table id="ausenciasMD" class="table-bordered" style="width:100%"-->
                    <table id="licenciasM" class="table table-hover dataTable table-striped" style="width:90%;margin:0 auto;">
                        <tr>
                            <td></td>
                            <td style="text-align:center;" class="text-sm text-muted">Aguarda unos segundos...</td>
                            <td></td>
                        </tr>
                    </table>
                </div>
					<hr>
					<button class="btn btn-success .btn-sm" onclick="exportTableToExcel('licenciasM', 'Licencias')">Exportar a XLS</button>
            </div>
            <!--div class="modal-footer">
            </div-->
        </div>
    </div>
</div>

<!--MODAL VACACIONES----------------------------------------------------------------------------------------------------->
<div class="modal fade" id="modalVacaciones" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-responsive"  >
            <div style="text-align: center;" class="modal-header">
				<h4 class="modal-title" >Detalle de vacaciones</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
					<span class="sr-only">Cerrar</span>
				</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!--table id="ausenciasMD" class="table-bordered" style="width:100%"-->
                    <table id="vacacionesM" class="table table-hover dataTable table-striped" style="width:90%;margin:0 auto;">
                        <tr>
                            <td></td>
                            <td style="text-align:center;" class="text-sm text-muted">Aguarda unos segundos...</td>
                            <td></td>
                        </tr>
                    </table>

                </div>
				<hr>
					<button class="btn btn-success .btn-sm" onclick="exportTableToExcel('vacacionesM', 'Vacaciones')">Exportar a XLS</button>
            </div>

            <!--div class="modal-footer">
            </div-->
        </div>
    </div>
</div>
<!--------------------------------------------FIN MODALES------------------------------------------------------>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/g/html2canvas.js"></script>
<script src="https://cdn.jsdelivr.net/g/filesaver.js"></script>

<!-- script introjs -->
<script src="https://unpkg.com/intro.js/minified/intro.min.js"></script>

<script>

	$(document).load();

		
</script>

<!-- Bootstrap 3.3.6 -->
<!-- <script type="text/javascript" src="plugins/bootstrap/js/bootstrap.min.js"></script> -->
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<script src="dist/js/adminlte.min.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="plugins/chart.js/Chart.js"></script>

<!-- PAGE SCRIPTS -->
<!-- <script src="dist/js/pages/dashboard2.js"></script> -->



<!------------------------AGREGADOS DEL ANTERIOR DASHBOARD------------------------------------------------->

<script type="text/javascript">var plugin_path = '../SYS_assets/plugins/';</script>
<script src="../SYS_assets/plugins/chart.morris/morris.min.js"></script>
<script type="text/javascript" src="../SYS_assets/plugins/chart.Highcharts-5.0.5/highcharts.js"></script>
<script type="text/javascript" src="../SYS_assets/plugins/chart.Highcharts-5.0.5/exporting.js"></script>
<script type="text/javascript" src="../SYS_assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../SYS_assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="../SYS_assets/plugins/datatables/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="../SYS_assets/plugins/chosen/chosen.jquery.js"></script>


<!-- FastClick -->
<script type="text/javascript" src="plugins/fastclick/fastclick.js"></script>
<!-- <script type="text/javascript" src="dist/js/app.min.js"></script> -->
<script type="text/javascript" src="../SYS_assets/js/bootstrap-treeview.js"></script>
<!-------------------------------------------------------------------------------------------------------->




<script type="text/javascript">

	//json
	$(document).ready(function() {
		//alert("Carga Spinter");
		var contenedor = document.getElementById('contenedor');

		contenedor.style.display = 'none';
	});
	
    var staticIdNodo = 0;
	dept="";
	cenco="";
	var idNodo = $("#arbol").data('idNodo');

	$(document).ready(function () {


		cargaArbol(<?php echo $_SESSION['idestructura'] ?>);
		var idNodo = $("#arbol").data('idNodo');
			//console.log('VALOR DEL INSITE '+idNodo);
		staticIdNodo = 0<?php echo $tagnodo ?>;
		comparacionHoras(dept,<?php echo $tagnodo; ?>);

		dept=$("selectDept").val();

		//selectCencos();
		insite(<?php echo $_SESSION['idestructura'] ?>);
	});

	function cargaArbol(){
		//console.log("Cargando Arbol....");
		$.ajax({
			url: "WS/Usuarios/WS_getArbol.php",
			type: 'POST',
			success: function (response) {
				if (response != "error")
					{

					//console.log("json="+response);
					json=response;
					creaArbol($("#arbol"), json);
					jArbol=JSON.parse(json);
					$('#arbol').data("idNodo",jArbol[0].tag);
					idNodo=$('#arbol').data("idNodo");
					console.log('nodo que carga '+idNodo);
					staticIdNodo = idNodo;
					comparacionHoras(dept,idNodo);
					//contadores(dept,cenco,idNodo);
					//dispoConect(data);
					cargarRanking(dept,idNodo);
					
					$('#arbol').on('nodeSelected', function(event, data) {

						//var idNodo = data.tag;
						var txtNodo = data.text;

						$('#arbol').data('idNodo',data.tag);

						$("#txtBotonArbol").html(data.text);

						function obtenerSaludo() {
							var hora = new Date().getHours();
							var saludo;
							var nameUser;

							if (hora >= 5 && hora < 12) {
								saludo = '¡Buenos días!, ';
							} else if (hora >= 12 && hora < 18) {
								saludo = '¡Buenas tardes!, ';
							} else {
								saludo = '¡Buenas noches!, ';
							}

							return saludo;
						};

						var opcionesFecha = { weekday: 'long', day: 'numeric', month: 'long'};
						var fechaCompleta = new Date().toLocaleDateString('es-ES', opcionesFecha);
						var palabrasFecha = fechaCompleta.split(' ');
						palabrasFecha = palabrasFecha.map(function(palabra) {
							if (palabra.toLowerCase() === 'de') {
								return palabra.toLowerCase(); // Mantener "de" en minúscula
							} else {
								return palabra.charAt(0).toUpperCase() + palabra.slice(1);
							}
						});

						fechaCompleta = palabrasFecha.join(' ');

						let saludoUser = obtenerSaludo() + data.text;
						$("#saludoUser").html(saludoUser);
						
						$("#saludoFecha").html(fechaCompleta);

						console.log("saludo => " + fechaCompleta + obtenerSaludo() + data.text);
						

						var idNodo = $("#arbol").data('idNodo');
						staticIdNodo = idNodo;

						//enviamos el valor del nodo seleccionado
						//a las distintas funciones que lo utilizan
						$("#morris-area-example").empty();
						contadores(dept,cenco,idNodo);
						//dispoConect(data);
						insite(idNodo);
						grafico(dept,cenco, idNodo);
						chartDountReg();


					});

					var idSel = $("#arbol")[0].innerText;
					$("#txtBotonArbol").html(idSel);
					//alert(idSel);
					nodes(idSel);
					insite(idNodo);
					nombreJerarquia();
					}
					else
						console.log("Error de carga de arbol:"+response);
			}
		});
	}

	function insite(idNodo){
		//console.log('llega el nodo: '+idNodo);
		$.ajax({
			url: "WS/DashAssistance/WS_insite2.php",
			type: 'POST',
			data : {idNodo: idNodo},
			success: function (response)
			{
				//console.log("idNodo="+idNodo+" insite="+response);
				if (response != "error"){
					$("#insite").html(response);
				}
				else
					console.log("Error de carga Insite:"+response);
			}
		});
		console.log("feooos");
	}




   	//SE SUPONE QUE ACA SE CREA LA FUNCION PARA IR A LEER EL PRIMER NODO
	//Y QUE SE CARGUE AL ABRIR LA PAGINA
	function nodes(idSel){
		//alert(idSel);
		$.ajax({
			url: "WS/DashAssistance/WS_GetNodo.php",
			type: 'GET',
			data: {idSel:idSel},
			success: function (response) {
				//alert(idSel);
				//alert(response);
				var idNodo = JSON.parse(response);
				//alert("metodo nodes: "+response);
				//$(window).on('ready', function() {
					//window.addEventListener('load', function() {

					//alert(response);
					//console.log('nodo actual '+idNodo)
					contadores(dept,cenco,idNodo);
					//dispoConect(data);
					cargarRanking(dept,idNodo);
					initMap(dept,idNodo);
					cargarTabla(dept,idNodo);
					atrasosConse(dept,idNodo);
					comparacionHoras(dept,idNodo);
					Ref(idNodo);//enviamos esta variable a la funcion nueva que creamos.
					$("#arbol").data("idNodo", idNodo);
				//});


			}
		});
	}


		function creaArbol(arbol, json)
		{
			arbol.treeview({
				levels: 1,
				showBorder: false,
				data: json
			});
		}

		function buscarNodo(arbol, tag)
		  {
		  if (arbol.tag==tag ){
			 return (arbol);
		  }
		  else
			 if (arbol.nodes != null)
			 {
				var i;
				var result=null;
				for(i=0; result == null && i < arbol.nodes.length; i++){
				   result = buscarNodo(arbol.nodes[i], tag);
				 }
			   return result;
			 }
		  return null;
		  }

        $("#datosAusencia").hide();

        function cargarTabla(dept, idNodo){
            $.ajax({
                url: "WS/DashAssistance/WS_Monitor_Tiempo_Real.php",
                type: 'GET',
                asynch: true,
                data: {dept:dept, idNodo:idNodo},
                success: function (response) {
                    $("#monitorTiempoReal").html(response);
                }
            });
        }
		
		
        //cargarTabla(dept);
		//setInterval(cargarTabla, 1000);

		//oculta la modal al presionar el boton seleccionar
		$(document).on('click','#aceptar' , function(){
            $("#modalArbol").modal('hide');
            $("#modalNotification").modal('show');


			//enviamos el valor del nodo seleccionado
			//a las distintas funciones que lo utilizan
			//var dept = 0;

			var idNodo = staticIdNodo;
			//alert(idNodo);

			contadores(dept,cenco,idNodo);
			cargarRanking(dept,idNodo);
			initMap(dept,idNodo);
			cargarTabla(dept,idNodo);
			atrasosConse(dept,idNodo);
			comparacionHoras(dept,idNodo);
			//dispoConect(data);



        });


		//jorge
		//creamosuna nueva funcion que reciba el valor del nodo
		//al cargar la pagina
			function Ref(idNodo){
			Cnode = idNodo;
			//alert(Cnode);
		}

        $(document).on('click','#1' , function(){
            $("#modalAusenciasD").modal('show');
			var idNodo = $("#arbol").data('idNodo');
			//jorge
			//creamos un if preguntando que si la variable es indefinida
			//guardamos en idNodo el valor del nodo que se lee al cargar
			//la pagina
			/*if(typeof(idNodo == "undefined")){

			var idNodo = Cnode;

			//sino guardamos el valor del nodo que viene al seleccionar
			//algun item en el arbol jerarquico
			}else{

			var idNodo = $("#arbol").data('idNodo');

			}*/
            $.ajax({
                url: 'WS/DashAssistance/WS_Personal_Ausente_D.php',
                type: 'POST',
                data: {dept:dept,cenco:cenco, idNodo:idNodo},
                success:function(response){
                    //console.log(response);
                    $("#ausenciasMD").html(response);
                }
            });
        });




        $(document).on('click','#2' , function(){
            $("#modalEnTurno").modal('show');
			//jorge
			//creamos un if preguntando que si la variable es indefinida
			//guardamos en idNodo el valor del nodo que se lee al cargar
			//la pagina
			var idNodo = $("#arbol").data('idNodo');
			console.log("en el click 2 ---- idNodo="+idNodo);
		/*	if(typeof(idNodo === "undefined")){

			var idNodo = Cnode;

			//sino guardamos el valor del nodo que viene al seleccionar
			//algun item en el arbol jerarquico
			}else{

			var idNodo = $("#arbol").data('idNodo');

			}*/
			//var idNodo = $("#arbol").data('idNodo');   //FCM
            $.ajax({
                url: 'WS/DashAssistance/WS_En_Turno.php',
                type: 'POST',
                data: {dept:dept,cenco:cenco,idNodo:idNodo},
                success:function(response){
                    //console.log(response);
                    $("#enTurno").html(response);
                }
            });
        });



		////////////////////////////////////////////////para la modal del grafico circular atrasados///////////////////////////////////////////////////
		//aqui esta la modal que se abre al hacer click sobre el
		//contador circular "colaboradores atrasados"
        $(document).on('click','#3' , function(){
            $("#modalAtrasos").modal('show');
			var idNodo = $("#arbol").data('idNodo');

			//jorge
			//creamos un if preguntando que si la variable es indefinida
			//guardamos en idNodo el valor del nodo que se lee al cargar
			//la pagina
			/*if(typeof(idNodo == "undefined")){

			var idNodo = Cnode;

			//sino guardamos el valor del nodo que viene al seleccionar
			//algun item en el arbol jerarquico
			}else{

			var idNodo = $("#arbol").data('idNodo');

			}*/


            $.ajax({
                url: 'WS/DashAssistance/WS_Personal_Atrasado.php',
                type: 'POST',
                data: {dept:dept,cenco:cenco,idNodo:idNodo},
                success:function(response){
                    //console.log(response);
                    $("#atrasos").html(response);
                }
            });
        });

		////////////////////////////////////////////////////fin modal atrasados///////////////////////////////////////////////////////////////////////////////

		///////////////////////////////////////modal grafico circular sobredotacion//////////////////////////////////////////////////////////////////////////
        $(document).on('click','#4' , function(){
            $("#modalSobredotacion").modal('show');
			var idNodo = $("#arbol").data('idNodo');
			//jorge
			//creamos un if preguntando que si la variable es indefinida
			//guardamos en idNodo el valor del nodo que se lee al cargar
			//la pagina
			/*if(typeof(idNodo == "undefined")){

			var idNodo = Cnode;

			//sino guardamos el valor del nodo que viene al seleccionar
			//algun item en el arbol jerarquico
			}else{

			var idNodo = $("#arbol").data('idNodo');

			}*/


            $.ajax({
                url: 'WS/DashAssistance/WS_Personal_Sobredotacion.php',
                type: 'POST',
                data: {dept:dept,idNodo:idNodo},
                success:function(response){
                 //console.log(response);
                    $("#sobredotacionTabla").html(response);
                }
            });
        });
	////////////////////////////////////////////////////////////fin modal sobredotacion////////////////////////////////////////////////////////////////////




		$("#btnCerrar").on('click', function(){
			$('#tablaEnTunel').DataTable().destroy();
		});

		$("#btnCerrar2").on('click', function(){
			$('#tablaIngresos').DataTable().destroy();
		});

		$("#btnCerrarAtrasos").on('click', function(){
			$('#atrasosR').DataTable().destroy();
		});

		$("#btnCerrar3").on('click', function(){
			$('#tablaSoloIngresos').DataTable().destroy();
		});
		
		$("#btnCerrarPr").on('click', function(){
			$('#tablaPrimeraMarca').DataTable().destroy();
		});
		
		$("#btnCerrarSinM").on('click', function(){
			$('#tablaSinMarca').DataTable().destroy();
		});
		
		
		$("#btnCerrarJustificados").on('click', function(){
			$('#tablaJustificados2').DataTable().destroy();
		});
		
		$("#btnCerrarAusenciasT").on('click', function(){
			$('#tablaAusenciasT').DataTable().destroy();
		});


		$("#btnCerrar4").on('click', function(){
			$('#tablaDispositivos').DataTable().destroy();
		});

		$("#ingresost").on('click',function(){
			$("#modalIngresos").modal('show');
			ingresos(staticIdNodo);
		});

 		$("#soloingresos").on('click',function(){
			$("#modalSoloIngresos").modal('show');
			soloingresos(staticIdNodo);
		});
		
		$("#sinmarca").on('click',function(){
			$("#modalSinMarca").modal('show');
			sinmarca(staticIdNodo);
		});
		$("#primeramarca").on('click',function(){
			$("#modalPrimeraMarca").modal('show');
			primeramarca(staticIdNodo);
		});
		
		$("#primeramarca2").on('click',function(){
			primeramarca2(staticIdNodo);
		});
		
		$("#justificacion").on('click',function(){
			$("#modalJustificacion").modal('show');
			justificacion(staticIdNodo);
		});
		
		
		$("#ausenciasteoricas").on('click',function(){
			$("#modalAusenciasTeoricas").modal('show');
			ausenciasteoricas(staticIdNodo);
		});
		
		
		

		$("#totalDispositivos").on('click', function(){
			location.href = '/SmarTime/v3/GestionarDispositivos.php';
			//$('#modalDisps').modal('show');
			//tablaDispositivos();
		});

        /*$("#modalAusenciasM").modal('show');

		$.ajax({
		url: 'WS/DashAssistance/WS_Personal_Ausente_M.php',
		type: 'POST',
		success:function(response){
		$("#ausenciasMM").html(response);
		}
		});*/
        $(document).on('click','#5' , function(){
            $("#modalCambiosT").modal('show');
			var idNodo = $("#arbol").data('idNodo');
			//jorge
			//creamos un if preguntando que si la variable es indefinida
			//guardamos en idNodo el valor del nodo que se lee al cargar
			//la pagina
			/*if(typeof(idNodo == "undefined")){

			var idNodo = Cnode;

			//sino guardamos el valor del nodo que viene al seleccionar
			//algun item en el arbol jerarquico
			}else{

			var idNodo = $("#arbol").data('idNodo');

			}*/

			//alert(idNodo);
            $.ajax({
                url: 'WS/DashAssistance/WS_Cambios_Turnos.php',
                type: 'POST',
                data: {dept:dept, idNodo:idNodo},
                success:function(response){
                    $("#cambiosTabla").html(response);
                }
            });
        });

	///////////////////////////////////////////////////////////CUADRO AUSENCIAS//////////////////////////////////////////////////////////////////
        //Abre modal con los detalles del personal ausente en el mes
        $(document).on('click','#6' , function(){
            $("#modalAusenciasM").modal('show');
			var idNodo = $("#arbol").data('idNodo');
			//jorge
			//creamos un if preguntando que si la variable es indefinida
			//guardamos en idNodo el valor del nodo que se lee al cargar
			//la pagina
			/*if(typeof(idNodo == "undefined")){

			var idNodo = Cnode;

			//sino guardamos el valor del nodo que viene al seleccionar
			//algun item en el arbol jerarquico
			}else{

			var idNodo = $("#arbol").data('idNodo');

			}*/

            $.ajax({
                url: 'WS/DashAssistance/WS_Personal_Ausente_M2.php',
                type: 'POST',
                data: {dept:dept,idNodo:idNodo},
                success:function(response){
                    $("#ausenciasMM").html(response);
                }
            });
        });
		
		$(document).on('click','#justificacion1' , function(){
            $("#modalJustificacion").modal('show');
			var idNodo = $("#arbol").data('idNodo');
			//jorge
			//creamos un if preguntando que si la variable es indefinida
			//guardamos en idNodo el valor del nodo que se lee al cargar
			//la pagina
			/*if(typeof(idNodo == "undefined")){

			var idNodo = Cnode;

			//sino guardamos el valor del nodo que viene al seleccionar
			//algun item en el arbol jerarquico
			}else{

			var idNodo = $("#arbol").data('idNodo');

			}*/

            $.ajax({
                url: 'WS/DashAssistance/WS_Justificados.php',
                type: 'POST',
                data: {dept:dept,idNodo:idNodo},
                success:function(response){
                    $("#tablaJustificados2").html(response);
                }
            });
        });

		//////////////////////////////////////////////////////////////CUADRO ATRASO R////////////////////////////////////////////////////////////////////////
        $(document).on('click','#12' , function(){
            $("#modalAtrasosR").modal('show');
			var idNodo = $("#arbol").data('idNodo');
			//jorge
			//creamos un if preguntando que si la variable es indefinida
			//guardamos en idNodo el valor del nodo que se lee al cargar
			//la pagina
			/*if(typeof(idNodo == "undefined")){

				var idNodo = Cnode;

			//sino guardamos el valor del nodo que viene al seleccionar
			//algun item en el arbol jerarquico
			}else{

			var idNodo = $("#arbol").data('idNodo');

			}*/

            $.ajax({
                url: 'WS/DashAssistance/WS_Personal_Atrasado.php',
                type: 'POST',
                data: {dept:dept, idNodo:idNodo},
                success:function(response){
				//console.log(response);
                    $("#atrasosR").html(response);
                }
            });
        });

		$("#enTunel").on('click',function(){
			$("#modalEnTunel").modal('show');
			enTunel();
		});


        /*$("#modalEnTurno").modal('show');
		$.ajax({
		url: 'WS/DashAssistance/WS_En_Turno.php',
		type: 'POST',
		success:function(response){
		//console.log(response);
		$("#enTurno").html(response);
		}
		});*/



        function listarActividades(){
            var id = <?php echo $_SESSION['user_id']; ?>;
            $.ajax({
                url: "WS/DashAssistance/WS_listarActividades.php",
                type: 'POST',
                data: {id:id},
                success: function(response) {
                    //console.log(response);
                    $("#listaActividades").html(response);
                }
            });
        }
		listarActividades();

        $(document).on('click','#selArbol' , function(){
            $("#modalArbol").modal('show');

        });

		///////////////////////////////////////////////////////CUADRO PERMISOS////////////////////////////////////////////////////////////////////
        //abre el modal con la información de los permisos
        $(document).on('click','#7' , function(){
            $("#modalPermisos").modal('show');
			var idNodo = $("#arbol").data('idNodo');
			//jorge
			//creamos un if preguntando que si la variable es indefinida
			//guardamos en idNodo el valor del nodo que se lee al cargar
			//la pagina
			/*if(typeof(idNodo == "undefined")){

			var idNodo = Cnode;

			//sino guardamos el valor del nodo que viene al seleccionar
			//algun item en el arbol jerarquico
			}else{

			var idNodo = $("#arbol").data('idNodo');

			}*/

            $.ajax({
                url: 'WS/DashAssistance/WS_Personal_PermisosN.php',
                type: 'POST',
                data: {dept:dept, idNodo:idNodo},
                success:function(response){
			//console.log(response);
                    $("#permisosM").html(response);
                }
            });
        });





		/////////////////////////////////////////////CUADRO LICENCIAS/////////////////////////////////////////////////////////////////////////
        //abre el modal con la información de las licencias
        $(document).on('click','#8' , function(){
            $("#modalLicencias").modal('show');
			var idNodo = $("#arbol").data('idNodo');
			//jorge
			//creamos un if preguntando que si la variable es indefinida
			//guardamos en idNodo el valor del nodo que se lee al cargar
			//la pagina
			/*if(typeof(idNodo == "undefined")){

			var idNodo = Cnode;

			//sino guardamos el valor del nodo que viene al seleccionar
			//algun item en el arbol jerarquico
			}else{

			var idNodo = $("#arbol").data('idNodo');

			}*/

            $.ajax({
                url: 'WS/DashAssistance/WS_Personal_LicenciasN.php',
                type: 'POST',
                data: {dept:dept, idNodo:idNodo},
                success:function(response){
                    //console.log(response);
                    $("#licenciasM").html(response);
                }
            });
        });

		//////////////////////////////////////////////////////////////CUADRO VACACIONES/////////////////////////////////////////////////////////////////////
        //abre el modal con la información de las vacaciones
        $(document).on('click','#9' , function(){
            $("#modalVacaciones").modal('show');
			var idNodo = $("#arbol").data('idNodo');
			//console.log('VACACIONES NODO '+idNodo);
			//jorge
			//creamos un if preguntando que si la variable es indefinida
			//guardamos en idNodo el valor del nodo que se lee al cargar
			//la pagina
			/*if(typeof(idNodo == "undefined")){

			var idNodo = Cnode;

			//sino guardamos el valor del nodo que viene al seleccionar
			//algun item en el arbol jerarquico
			}else{

			var idNodo = $("#arbol").data('idNodo');

			}*/

            $.ajax({
                url: 'WS/DashAssistance/WS_Personal_VacacionesN.php',
                type: 'POST',
                data: {dept:dept, idNodo:idNodo},
                success:function(response){
                    //                    console.log(response);
                    $("#vacacionesM").html(response);
                }
            });
        });

        //abre el modal con la información de las vacaciones
        $(document).on('click','#10' , function(){
            location.href = 'Colaboradores.php';
        });

		///////////////////////////////////////////////////CUADRO INTERIOR DESVINCULADOS///////////////////////////////////////////////////////////////////
	    //abre el modal con la información de las vacaciones
        $(document).on('click','#11' , function(){
            $("#modalDesvinculados").modal('show');
			var idNodo = $("#arbol").data('idNodo');
			//jorge
			//creamos un if preguntando que si la variable es indefinida
			//guardamos en idNodo el valor del nodo que se lee al cargar
			//la pagina
			/*if(typeof(idNodo == "undefined")){

			var idNodo = Cnode;

			//sino guardamos el valor del nodo que viene al seleccionar
			//algun item en el arbol jerarquico
			}else{

			var idNodo = $("#arbol").data('idNodo');

			}*/

            $.ajax({
                url : 'WS/DashAssistance/WS_Personal_DesvinculadoN.php',
                type: 'POST',
                data: {dept:dept, idNodo:idNodo},
                success:function(response){
                    $("#tablaDesv").html(response);
                }
            });
        });

		/*
		//FERNANDO ACA ES DONDE SE DEBERIA ENVIAR LOS DATOS PARA TRAER LA INFO DEL NUEVO CUADRO
		$(document).on('click','#28' , function(){
            $("#modalDesvinculados2").modal('show');
			var idNodo = $("#arbol").data('idNodo');
            $.ajax({
                url : 'WS/DashAssistance/WS_Hour.php',
                type: 'POST',
                data: {idNodo:idNodo},
                success:function(response){
					//console.log('respuesta horas '+response);
                    $("#tablaHour").html(response);
                }
            });
        });*/
		///////////////////////////////////////////////////CUADRO SIN TURNO///////////////////////////////////////////////////////////////////
        //abre el modal con la información de las vacaciones
        $(document).on('click','#15' , function(){
            $("#modalSinT").modal('show');
			var idNodo = $("#arbol").data('idNodo');
			//jorge
			//creamos un if preguntando que si la variable es indefinida
			//guardamos en idNodo el valor del nodo que se lee al cargar
			//la pagina
			/*if(typeof(idNodo == "undefined")){

			var idNodo = Cnode;

			//sino guardamos el valor del nodo que viene al seleccionar
			//algun item en el arbol jerarquico
			}else{

			var idNodo = $("#arbol").data('idNodo');

			}*/

            $.ajax({
                url : 'WS/DashAssistance/WS_Personal_SinT.php',
                type: 'POST',
                data: {dept:dept, idNodo:idNodo},
                success:function(response){
                    $("#tablaSinT").html(response);
                }
            });
        });


        //CARGA LA INFORMACIÓN EN LA TABLA DE RANKING DE AUSENCIAS
        function cargarRanking(dept,idNodo) {
			var idNodo = $("#arbol").data('idNodo');
			console.log("nodo ausencias "+idNodo);
            $.ajax({
                url: "WS/DashAssistance/WS_Ranking_Ausencias.php",
                type: 'GET',
                data: {dept:dept, idNodo:idNodo},
                success: function (response) {
					//console.log(response);
                    $("#rankingAusencias").html(response);
                }
            });
        }
		cargarRanking(dept);


        /*función para mostrar el mapa de geolocalización*/
        function initMap(dept,idNodo) {
            $.ajax({
                url: "WS/DashAssistance/WS_Dash_Geo_Point.php",
                type: 'GET',
                data: {dept:dept,idNodo:idNodo},
                success: function (response) {
                    //console.log("GP:"+response);
                    //se revisa la respuesta de ws, si no está vacia muestra el mapa con las marcas
                    if(response != '[]')
                    {
                        var objeto = JSON.parse(response);
                        var map = new google.maps.Map(document.getElementById('geoPoint'), {
                            center: {lat: -33.4463038, lng: -70.6634667 },
                            zoom: 10
                        });
                        $.each(objeto, function (i,v)
                        {
                            var latitud = parseFloat(v.latitud);
                            var longitud = parseFloat(v.longitud);
                            var marker = new google.maps.Marker({
                                position: {lat: latitud, lng: longitud}
                            });
                            marker.setMap(map);
                        });
                    }
                    else
                    {
                        //si no, muestra un mensaje
                        $("#geoPoint").html("No hay marcas con Geo-Referencia");
                    }

                }
            });
        }


        /*FUNCIÓN PARA RESCATAR LA INFO DE LOS TRABAJADORES CON AUSENCIAS SEGUIDAS, 2 LUNES FALTANDO Y 3 AUSENCIAS EN EL MES*/
        function atrasosConse(dept, idNodo) {
            //AJAX PARA TRAER COLABS. CON 2 ATRASOS CONSECUTIVOS
            $.ajax({
                url: "WS/DashAssistance/WS_Info_Atrasos.php",
                type: "GET",
                asynch: true,
                data: { dosSeguidos: true, dept : dept, idNodo : idNodo },
                success: function(response){
                    var content = "";
                    var objeto = JSON.parse(response);
                    if(objeto.length > 0)
                    {
                        $("#datosAusencia").show();
                        $("#contenedorDosDias").css('visibility','visible');
                        for(var x = 0; x < objeto.length; x++)
                        {
                            content += objeto[x]["rut"]+" "+objeto[x]["Nombre"]+"<br>";
                        }
                        $("#usrDosDias").html(content);
                    }
                    $.ajax({
                        url: "WS/DashAssistance/WS_Info_Atrasos.php",
                        type: "GET",
                        asynch: true,
                        data: { lunes: true, dept : dept, idNodo : idNodo },
                        success: function(response){
                            var content = "";
                            var objeto = JSON.parse(response);
                            if(objeto.length > 0)
                            {
                                $("#datosAusencia").show();
                                $("#contenedorDosLunes").css('visibility','visible');
                                for(var x = 0; x < objeto.length; x++)
                                {
                                    content += objeto[x]["rut"]+" "+objeto[x]["Nombre"]+"<br>";
                                }
                                $("#usrDosLunes").html(content);
                            }

                            $.ajax({
                                url: "WS/DashAssistance/WS_Info_Atrasos.php",
                                type: "GET",
                                asynch: true,
                                data: { tresAus: true, dept : dept, idNodo : idNodo },
                                success: function(response){
                                    var content = "";
                                    var objeto = JSON.parse(response);
                                    //console.log(objeto);
                                    if(objeto.length > 0)
                                    {
                                        $("#datosAusencia").show();
                                        $("#contenedorTresDias").css('visibility','visible');
                                        for(var x = 0; x < objeto.length; x++)
                                        {
                                            content += objeto[x]["rut"]+" "+objeto[x]["Nombre"]+"<br>";
                                        }
                                        $("#usrTresDias").html(content);
                                    }
                                }
                            });
                        }
                    });
                }
            });
        }
        //atrasosConse(dept);
        /*FUNCIÓN PARA RESCATAR LA INFO DE LOS TRABAJADORES CON AUSENCIAS SEGUIDAS, 2 LUNES FALTANDO Y 3 AUSENCIAS EN EL MES*/

		function enTunelporDepto()
		{
			$.ajax({
				url: "/v2/BIO_Access/WS/DashAccess/WS_EnTunel_PorDepto.php",
				type: 'POST',
				success: function (response){
					//console.log(response);
					var table = $('#tablaPorDepartamento');
					var jsonResponse = response;
					//console.log(jsonResponse);
					var data = JSON.parse(jsonResponse);

					//var data = JSON.parse(response);

					/* Table tools samples: https://www.datatables.net/release-datatables/extras/TableTools/ */

					/* Set tabletools buttons and button container */

					jQuery.extend(true, jQuery.fn.DataTable.TableTools.classes, {
						"container": "btn-group tabletools-btn-group pull-right",
						"buttons": {
							"normal": "btn btn-sm btn-default",
							"disabled": "btn btn-sm btn-default disabled"
						}
					});
					var oTable = table.dataTable({
						"processing": true,
						"bFilter": false,
						"bLengthChange": false,
						"data": data,
						"order": [
							[0, 'asc']
						],
						"lengthMenu": [
							[5, 10, 15, 20, -1],
							[5, 10, 15, 20, "All"] // change per page values here
						],

						// set the initial value
						"pageLength": 10,
						"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

						"tableTools": {
							"sSwfPath": plugin_path + "datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
							"aButtons": [{
								"sExtends": "pdf",
								"sButtonText": "PDF"
							}, {
								"sExtends": "csv",
								"sButtonText": "CSV"
							}, {
								"sExtends": "xls",
								"sButtonText": "Excel"
							}, {
								"sExtends": "print",
								"sButtonText": "Imprimir",
								"sInfo": 'Please press "CTRL+P" to print or "ESC" to quit',
								"sMessage": "Creado por KeyCloud"

							}, {
								"sExtends": "copy",
								"sButtonText": "Copiar"
							}]
						}
					});

				//var tableWrapper = jQuery('#tableOchoHoras_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
				//tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown
				}
			});
		}




	//////////////////////////////////////////////////////HASTA AQUI FUNCIONES DEL ARBOL/////////////////////////////////////////////////////////////
 	//FUNCION LISTAR DEPARTAMENTOS CON AJAX

	function contadores(dept,cenco) {
		$.ajax({
			url: "WS/DashAssistance/WS_contadores_dashassistanceN.php",
			type: "GET",
			asynch: true,
			data: {dept:dept, cenco:cenco},
			success: function (response) {
				var objeto = JSON.parse(response);
				//console.log(objeto);
				//console.log("recarga CNT");
			}
		});
	}

	function dispoConect(data) {

		$.ajax({
			url: "WS/DashAssistance/WS_TransaccionesErr.php",
			type: 'GET',
			asynch: true,
			dataType: 'json',
			data: {dispt:data},
			success: function (res) {
				//console.log("resultado= " + res.online);
				$("#dispoConecOnline").text(res.online);
				$("#dispoConecOffline").text(res.offline);
			}
		});
	}

	

	//función para rellenar el gráfico que se muestra en el dashboard
    function grafico(dept,cenco, idNodo) {

	$.ajax({
		url: "WS/DashAssistance/WS_Grafico_AsistenciaN.php",
		type: "GET",
		asynch: true,
		data: {dept:dept,cenco:cenco, idNodo:idNodo},
		success: function (response) {
			//console.log(response);
			//se revisa la respuesta, si está vacia no muetra nada
			if(response=='[]') {
				$("#mensajeCarga").html("<b>Aún no contamos con registros suficientes para desplegar el gráfico</b>");
			}else{
				$("#mensajeCarga").html("Se está cargando la información del gráfico, por favor aguarda unos segundos...");
				//si se devolvió información, se rellena el gráfico
				var asistencias = JSON.parse(response);
				console.log(" datos api AsistenciaN => " + asistencias);
				Morris.Area({
					//se le asigna donde cargar el gráfico
					element: 'morris-area-example',
					//se le asigna la informaicón a mostrar
					data: asistencias,
					//se define que representa el eje x
					xkey: 'dia',
					//para hacer que los labels del eje x se muestren como días
					xLabels: ['day'],
					//para cambiar el formato de la fecha en los xLabels
					xLabelFormat: function(x){ return x.getDate()+"/"+(x.getMonth()+1)+"/"+x.getFullYear();},
					//para cambiar el angulo de los xLabel's
					xLabelAngle: 45,
					//permite que el gráfico cambie de tamaño cuando el tamaño de la página cambia
					resize: true,
					//se define que representa el eje y
					ykeys: ['presentes', 'ausentes'],
					//ykeys: ['ausentes', 'presentes'],
					//para evitar que se sumen los totales de los ausentes con los presentes
					behaveLikeLine: true,
					//se asignan labales a la información a mostrar
					labels: ['Trabajadores Presentes', '<span style="color: #000;">'+'Trabajadores Ausentes'],
					//se definen colores para cada linea
					lineColors: ['#2b3ea4', '#f8f9fa'],
					//se define el ancho de las lineas
					lineWidth: 5,
					//se define el tamaño de los puntos
					pointSize: 4,
					//se definen los colores de relleno de los puntos
					pointFillColors: ['#f8f9fa', '#f8f9fa'],
					//se definen los colores del "trazo?" de los puntos
					pointStrokeColors: ['#2b3ea4', '#f8f9fa'],
					//para cambiar el formato de la fecha en el cuadro que aparece en el gráfico indicando ausentes y presentes
					dateFormat: function(x){ return new Date(x).getDate()+"/"+(new Date(x).getMonth()+1)+"/"+new Date(x).getFullYear();}
				});
			}
		}
	});
	}

    function selectCencos(){
        $.ajax({
            url: "WS/DashAssistance/WS_select_cencos.php",
            type: "GET",
            success: function (response) {
                //console.log(response);
                if(response=="error" || response=="desactivado"){
                }else{
                    $("#liCenco").css('display','block');
                    $("#selectCencos").html(response);
                    $('#selectCencos').trigger("chosen:updated");
                    $("#selectCencos").chosen({
                        width: "100%",
                        placeholder_text_single: "Centro de costo",
                        no_results_text: "No se encontraron registros",
                        single_backstroke_delete: false,
                        search_contains: true
                    });
                }
            }
        });
    };

    function comparacionHoras(dept,idNodo)
    {
		//LIMPIAR LOS CONTENEDORES
		$("#contenedor1").empty();
		$("#contenedor2").empty();
        //se agrega al contenedor1 y al contenedor2 los div's para mostrar la info de las horas y los gráficos
        $('#contenedor1').append('<div id="horasTrabajadas" class="col-md-12 col-sm-12" style="text-align: center;">' +
            '<b>... Horas asignadas para el mes</b>' +
            '</div>' +
            '<div id="donutHoras" class="col-md-11 col-lg-11 col-md-push-1" style="overflow: visible;width:220px !important;height: 220px !important;margin:0 auto;"></div>');
        $('#contenedor2').append('<div id="horasTrabajadasHH" class="col-md-12 col-sm-12" style="text-align: center;">' +
            '<b>... Horas asignadas hasta hoy</b>' +
            '</div>' +
            '<div id="donutHorasHH" class="col-md-11 col-lg-11 col-md-push-1" style="overflow: visible;width:220px !important;height: 220px !important;margin:0 auto;"></div>');
        //ajax para rescatar la información e las horas trabajadas y asignadas
		console.log("inicio grafico");
        $.ajax({
            url: "WS/DashAssistance/WS_Info_Horas.php",
            type: "GET",
            asynch: true,
            data: {dept : dept, idNodo : idNodo},
            success: function(response)
            {
                console.log("Info_horas"+response);
                var objeto = JSON.parse(response);
                //resta entre las horas pragamadas y las horas trabajadas en el mes
                var noTrabajadas = objeto[0] - objeto[2];
                //resta entre las horas programadas y las horas trabajadas hasta el día de hoy
                var noTrabajadasHH = objeto[1] - objeto[2];
                //se agrega la info en los divs necesarios
                $("#horasTrabajadas").html("<b>"+objeto[0]+" Horas Programadas para el mes</b>");
                $("#horasTrabajadasHH").html("<b>"+objeto[1]+" Horas Programadas hasta la fecha</b>");
                //se definen los colores para los piecharts
                var bgColors1 = ["#007E33","#ffbb33"];
                var bgColors2 = ["#007E33","#CC0000"];
                /*PIE CHART CREADO CON HIGHCHARTS*/
                //información del primer piechart
                var data1 = [
                    { name : "Horas Trabajadas", y : objeto[2] },
                    { name : "Horas No Trabajadas", y : noTrabajadas }
                ];
                // Radialize the colors
				
	console.log("o1="+objeto[0]);
	console.log("o2="+objeto[1]);
	console.log("o3="+objeto[2]);

                Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
                    return {
                        radialGradient: {
                            cx: 0.5,
                            cy: 0.3,
                            r: 0.7
                        },
                        stops: [
                            [0, color],
                            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                        ]
                    };
                });
                // Build the chart
                Highcharts.chart('donutHoras', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: ""
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                connectorPadding: 5,
                                distance: 15,
                                enabled: true,
                                format: '{point.y}',
                                style: {
                                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
                                    fontSize: '14px !important'
                                },
                                connectorColor: 'silver'
                            }
                        }
                    },
                    colors: bgColors1,
                    responsive:{
                        rules: [{
                            condition: {
                                maxHeight: 220,
                                maxWidth: 220
                            }
                        }]
                    },
                    //series que se muestran en el gráfico
                    series: [{
                        name: 'Horas Trabajadas/No Trabajadas del Mes',
                        data: data1
                    }]
                });
                /*PIE CHART CREADO CON HIGHCHARTS*/
                $("#infoPie1").html(
                    '<div class="col-md-6 col-sm-6 col-lg-6"><i class="fa fa-square" style="color:#007E33;"></i> <b>'+objeto[2]+'</b> Horas Trabajadas Hasta la Fecha</div>' +
                    '<div class="col-md-6 col-sm-6 col-lg-6"><i class="fa fa-square" style="color:#ffbb33;"></i> <b>'+noTrabajadas+'</b> Horas No Trabajadas Durante el Mes</div>'
                );

                /*PIE CHART CREADO CON HIGHCHARTS*/
                var data2 = [
                    { name : "Horas Trabajadas", y : objeto[2] },
                    { name : "Horas No Trabajadas", y : noTrabajadasHH }
                ];

                // Build the chart
                Highcharts.chart('donutHorasHH', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: ""
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                connectorPadding: 5,
                                distance: 15,
                                enabled: true,
                                format: '{point.y}',
                                style: {
                                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
                                    fontSize: '14px !important'
                                },
                                connectorColor: 'silver'
                            }
                        }
                    },
                    colors: bgColors2,
                    responsive:{
                        rules: [{
                            condition: {
                                maxHeight: 220,
                                maxWidth: 220
                            }
                        }]
                    },
                    series: [{
                        name: 'Horas Trabajadas/No Trabajadas Hasta Hoy',
                        data: data2
                    }]
                });
                /*PIE CHART CREADO CON HIGHCHARTS*/

                $("#infoPie2").html(
                    '<div class="col-md-6 col-sm-6 col-lg-6"><i class="fa fa-square" style="color:#007E33;"></i> <b>'+objeto[2]+'</b> Horas Trabajadas Hasta la Fecha</div>' +
                    '<div class="col-md-6 col-sm-6 col-lg-6"><i class="fa fa-square" style="color:#CC0000;"></i> <b>'+noTrabajadasHH+'</b> Horas No Trabajadas Hasta la Fecha</div>'
                );


                $("#horasExtraMes").html(objeto[3]);
                $("#horasExtraDia").html(objeto[4]);
            }
        });
    }
    //comparacionHoras(dept, idNodo);

	$( document ).ready(function() {
		$('#modalArbol').modal('toggle')
	});
	
	$( document ).ready(function() {
		$('#modalNotification').modal('toggle')
	});

	function enTunel() {
		$.ajax({
			url: "WS/DashAssistance/WS_Dentro_Tunel.php",
			type: 'POST',
			success: function (response){
				//console.log("enTunel="+response);
				var table = $('#tablaEnTunel');
				var jsonResponse = response;
				//console.log(jsonResponse);
				var data = JSON.parse(jsonResponse);

				//var data = JSON.parse(response);

				/* Table tools samples: https://www.datatables.net/release-datatables/extras/TableTools/ */

				/* Set tabletools buttons and button container */

				jQuery.extend(true, jQuery.fn.DataTable.TableTools.classes, {
					"container": "btn-group tabletools-btn-group pull-right",
					"buttons": {
						"normal": "btn btn-sm btn-default",
						"disabled": "btn btn-sm btn-default disabled"
					}
				});
				var oTable = table.dataTable({
					"processing": true,
					"data": data,
					"order": [
						[0, 'asc']
					],
					"lengthMenu": [
						[5, 10, 15, 20, -1],
						[5, 10, 15, 20, "All"] // change per page values here
					],

					// set the initial value
					"pageLength": 10,
					"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

					"tableTools": {
						"sSwfPath": plugin_path + "datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
						"aButtons": [{
							"sExtends": "pdf",
							"sButtonText": "PDF"
						}, {
							"sExtends": "csv",
							"sButtonText": "CSV"
						}, {
							"sExtends": "xls",
							"sButtonText": "Excel"
						}, {
							"sExtends": "print",
							"sButtonText": "Imprimir",
							"sInfo": 'Please press "CTRL+P" to print or "ESC" to quit',
							"sMessage": "Creado por KeyCloud"

						}, {
							"sExtends": "copy",
							"sButtonText": "Copiar"
						}]
					}
				});

	//                var tableWrapper = jQuery('#tableOchoHoras_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
	//                tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
						alert("Status: " + textStatus); alert("Error: " + errorThrown);
					}
		});
	}

	function soloingresos(idNodo) {
		$.ajax({
			url: "WS/DashAssistance/WS_SoloIngresos.php",
			type: 'POST',
			data: {idNodo:idNodo},
			success: function (response){
				//console.log(response);
				var table = $('#tablaSoloIngresos');
				var jsonResponse = response;
				//console.log(jsonResponse);
				var data = JSON.parse(jsonResponse);

				jQuery.extend(true, jQuery.fn.DataTable.TableTools.classes, {
					"container": "btn-group tabletools-btn-group pull-right",
					"buttons": {
						"normal": "btn btn-sm btn-default",
						"disabled": "btn btn-sm btn-default disabled"
					}
				});
				var oTable = table.dataTable({
					"processing": true,
					"retrieve" : true,
					"data": data,
					"order": [
						[3, 'desc']
					],
					"lengthMenu": [
						[5, 10, 15, 20, 20,-1],
						[5, 10, 15, 20, 20,"All"] // change per page values here
					],

					//Para habilitar botones flash agregar T este trozo <'col-md-12'>T>
					// set the initial value
					"pageLength": 10,
					"dom": "<'row' <'col-md-12'>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

					"tableTools": {
						"sSwfPath": plugin_path + "datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
						"aButtons": [{
							"sExtends": "pdf",
							"sButtonText": "PDF"
						}, {
							"sExtends": "csv",
							"sButtonText": "CSV"
						}, {
							"sExtends": "xls",
							"sButtonText": "Excel"
						}, {
							"sExtends": "print",
							"sButtonText": "Imprimir",
							"sInfo": 'Please press "CTRL+P" to print or "ESC" to quit',
							"sMessage": "Creado por KeyCloud"

						}, {
							"sExtends": "copy",
							"sButtonText": "Copiar"
						}]
					}
				});

	//                var tableWrapper = jQuery('#tableOchoHoras_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
	//                tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown
			}
		});
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	function primeramarca(idNodo) {
		$.ajax({
			url: "WS/DashAssistance/WS_Primera_Entrada.php",
			type: 'POST',
			data: {idNodo:idNodo},
			success: function (response){
				//console.log(response);
				var table = $('#tablaPrimeraMarca');
				var jsonResponse = response;
				//console.log(jsonResponse);
				var data = JSON.parse(jsonResponse);

				jQuery.extend(true, jQuery.fn.DataTable.TableTools.classes, {
					"container": "btn-group tabletools-btn-group pull-right",
					"buttons": {
						"normal": "btn btn-sm btn-default",
						"disabled": "btn btn-sm btn-default disabled"
					}
				});
				var oTable = table.dataTable({
					"processing": true,
					"retrieve" : true,
					"data": data,
					"order": [
						[3, 'desc']
					],
					"lengthMenu": [
						[5, 10, 15, 20, 20,-1],
						[5, 10, 15, 20, 20,"All"] // change per page values here
					],

					// set the initial value
					//PARA HABILITAR BOTONES FLASH SE AGREGA UNA T A ESTA PARTE <'col-md-12'T>>
					"pageLength": 10,
					"dom": "<'row' <'col-md-12'>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-6 col-sm-12 text-info-page'i><'col-md-6 col-sm-12'p>>", // horizobtal scrollable datatable

					"tableTools": {
						"sSwfPath": plugin_path + "datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
						"aButtons": [{
							"sExtends": "pdf",
							"sButtonText": "PDF"
						}, {
							"sExtends": "csv",
							"sButtonText": "CSV"
						}, {
							"sExtends": "xls",
							"sButtonText": "Excel"
						}, {
							"sExtends": "print",
							"sButtonText": "Imprimir",
							"sInfo": 'Please press "CTRL+P" to print or "ESC" to quit',
							"sMessage": "Creado por KeyCloud"

						}, {
							"sExtends": "copy",
							"sButtonText": "Copiar"
						}]
					}
				});

	//                var tableWrapper = jQuery('#tableOchoHoras_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
	//                tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown
			}
		});
	}


	function sinmarca(idNodo) {
		$.ajax({
			url: "WS/DashAssistance/WS_Sin_Entrada.php",
			type: 'POST',
			data: {idNodo:idNodo},
			success: function (response){
				//console.log(response);
				var table = $('#tablaSinMarca');
				var jsonResponse = response;
				//console.log(jsonResponse);
				var data = JSON.parse(jsonResponse);
				console.log(data);
				console.log("sin marcas");
				jQuery.extend(true, jQuery.fn.DataTable.TableTools.classes, {
					"container": "btn-group tabletools-btn-group pull-right",
					"buttons": {
						"normal": "btn btn-sm btn-default",
						"disabled": "btn btn-sm btn-default disabled"
					}
				});
				var oTable = table.dataTable({
					"processing": true,
					"retrieve" : true,
					"data": data,
					"order": [
						[2, 'desc']
					],
					"lengthMenu": [
						[5, 10, 15, 20, 20,-1],
						[5, 10, 15, 20, 20,"All"] // change per page values here
					],
					// set the initial value
					//PARA HABILITAR BOTONES FLASH SE AGREGA UNA T A ESTA PARTE <'col-md-12'T>>
					"pageLength": 10,
					"dom": "<'row' <'col-md-12'>><'row w-90'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row w-90'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

					"tableTools": {
						"sSwfPath": plugin_path + "datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
						"aButtons": [{
							"sExtends": "pdf",
							"sButtonText": "PDF"
						}, {
							"sExtends": "csv",
							"sButtonText": "CSV"
						}, {
							"sExtends": "xls",
							"sButtonText": "Excel"
						}, {
							"sExtends": "print",
							"sButtonText": "Imprimir",
							"sInfo": 'Please press "CTRL+P" to print or "ESC" to quit',
							"sMessage": "Creado por KeyCloud"

						}, {
							"sExtends": "copy",
							"sButtonText": "Copiar"
						}]
					}
				});

	//                var tableWrapper = jQuery('#tableOchoHoras_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
	//                tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown
			}
		});
	}


	function justificacion(idNodo) {
		$.ajax({
			url: "WS/DashAssistance/WS_Justificados.php",
			type: 'POST',
			data: {idNodo:idNodo},
			success: function (response){
				//console.log(response);
				var table = $('#tablaJustificados');
				var jsonResponse = response;
				//console.log(jsonResponse);
				var data = JSON.parse(jsonResponse);
				console.log(data);
				console.log("justificados");
				jQuery.extend(true, jQuery.fn.DataTable.TableTools.classes, {
					"container": "btn-group tabletools-btn-group pull-right",
					"buttons": {
						"normal": "btn btn-sm btn-default",
						"disabled": "btn btn-sm btn-default disabled"
					}
				});
				var oTable = table.dataTable({
					"processing": true,
					"retrieve" : true,
					"data": data,
					"order": [
						[2, 'desc']
					],
					"lengthMenu": [
						[5, 10, 15, 20, 20,-1],
						[5, 10, 15, 20, 20,"All"] // change per page values here
					],

					// set the initial value
					//PARA HABILITAR BOTONES FLASH SE AGREGA UNA T A ESTA PARTE <'col-md-12'T>>
					"pageLength": 10,
					"dom": "<'row' <'col-md-12'>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

					"tableTools": {
						"sSwfPath": plugin_path + "datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
						"aButtons": [{
							"sExtends": "pdf",
							"sButtonText": "PDF"
						}, {
							"sExtends": "csv",
							"sButtonText": "CSV"
						}, {
							"sExtends": "xls",
							"sButtonText": "Excel"
						}, {
							"sExtends": "print",
							"sButtonText": "Imprimir",
							"sInfo": 'Please press "CTRL+P" to print or "ESC" to quit',
							"sMessage": "Creado por KeyCloud"

						}, {
							"sExtends": "copy",
							"sButtonText": "Copiar"
						}]
					}
				});

	//                var tableWrapper = jQuery('#tableOchoHoras_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
	//                tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown
			}
		});
	}


	function ausenciasteoricas(idNodo) {
		$.ajax({
			url: "WS/DashAssistance/WS_AusenciasT.php",
			type: 'POST',
			data: {idNodo:idNodo},
			success: function (response){
				//console.log(response);
				var table = $('#tablaAusenciasT');
				var jsonResponse = response;
				//console.log(jsonResponse);
				var data = JSON.parse(jsonResponse);
				console.log(data);
				console.log("ausencias");
				jQuery.extend(true, jQuery.fn.DataTable.TableTools.classes, {
					"container": "btn-group tabletools-btn-group pull-right",
					"buttons": {
						"normal": "btn btn-sm btn-default",
						"disabled": "btn btn-sm btn-default disabled"
					}
				});
				var oTable = table.dataTable({
					"processing": true,
					"retrieve" : true,
					"data": data,
					"order": [
						[2, 'desc']
					],
					"lengthMenu": [
						[5, 10, 15, 20, 20,-1],
						[5, 10, 15, 20, 20,"All"] // change per page values here
					],

					// set the initial value
					//PARA HABILITAR BOTONES FLASH SE AGREGA UNA T A ESTA PARTE <'col-md-12'T>>
					"pageLength": 10,
					"dom": "<'row' <'col-md-12'>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

					"tableTools": {
						"sSwfPath": plugin_path + "datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
						"aButtons": [{
							"sExtends": "pdf",
							"sButtonText": "PDF"
						}, {
							"sExtends": "csv",
							"sButtonText": "CSV"
						}, {
							"sExtends": "xls",
							"sButtonText": "Excel"
						}, {
							"sExtends": "print",
							"sButtonText": "Imprimir",
							"sInfo": 'Please press "CTRL+P" to print or "ESC" to quit',
							"sMessage": "Creado por KeyCloud"

						}, {
							"sExtends": "copy",
							"sButtonText": "Copiar"
						}]
					}
				});

	//                var tableWrapper = jQuery('#tableOchoHoras_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
	//                tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown
			}
		});
	}

	function primeramarca2(idNodo) {
		$.ajax({
			url: "WS/DashAssistance/WS_Primera_Entrada.php",
			type: 'POST',
			data: {idNodo:idNodo},
			success: function (response){
				//console.log(response);
				var table = $('#tablaPrimeraMarca2');
				var jsonResponse = response;
				//console.log(jsonResponse);
				var data = JSON.parse(jsonResponse);

				jQuery.extend(true, jQuery.fn.DataTable.TableTools.classes, {
					"container": "btn-group tabletools-btn-group pull-right",
					"buttons": {
						"normal": "btn btn-sm btn-default",
						"disabled": "btn btn-sm btn-default disabled"
					}
				});
				var oTable = table.dataTable({
					"processing": true,
					"retrieve" : true,
					"data": data,
					"order": [
						[3, 'desc']
					],
					"lengthMenu": [
						[5, 10, 15, 20, 20,-1],
						[5, 10, 15, 20, 20,"All"] // change per page values here
					],

					// set the initial value
					//PARA HABILITAR BOTONES FLASH SE AGREGA UNA T A ESTA PARTE <'col-md-12'T>>
					"pageLength": -1,
					"dom": "<'row' <'col-md-12'>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

					"tableTools": {
						"sSwfPath": plugin_path + "datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
						"aButtons": [{
							"sExtends": "pdf",
							"sButtonText": "PDF"
						}, {
							"sExtends": "csv",
							"sButtonText": "CSV"
						}, {
							"sExtends": "xls",
							"sButtonText": "Excel"
						}, {
							"sExtends": "print",
							"sButtonText": "Imprimir",
							"sInfo": 'Please press "CTRL+P" to print or "ESC" to quit',
							"sMessage": "Creado por KeyCloud"

						}, {
							"sExtends": "copy",
							"sButtonText": "Copiar"
						}]
					}
				});

	//                var tableWrapper = jQuery('#tableOchoHoras_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
	//                tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown
			}
		});
	}

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function ingresos(idNodo) {
		$.ajax({
			url: "WS/DashAssistance/WS_Ingresos_Hoy.php",
			type: 'POST',
			data: {idNodo:idNodo},
			success: function (response){
				//console.log(response);
				var table = $('#tablaIngresos');
				var nFilas = $("#tablaIngresos").length;
				//alert(nFilas);
				//alert(table);
				var jsonResponse = response;
				//console.log(jsonResponse);
				var data = JSON.parse(jsonResponse);

				jQuery.extend(true, jQuery.fn.DataTable.TableTools.classes, {
					"container": "btn-group tabletools-btn-group pull-right",
					"buttons": {
						"normal": "btn btn-sm btn-default",
						"disabled": "btn btn-sm btn-default disabled"
					}
				});
				var oTable = table.dataTable({
					"processing": true,
					"retrieve" : true,
					"data": data,
					"order": [
						[3, 'desc']
					],
					"lengthMenu": [
						[5, 10, 15, 20, 20,-1],
						[5, 10, 15, 20, 20,"All"] // change per page values here
					],

					// set the initial value
					"pageLength": 10,
					"dom": "<'row' <'col-md-12'>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

					"tableTools": {
						"sSwfPath": plugin_path + "datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
						"aButtons": [{
							"sExtends": "pdf",
							"sButtonText": "PDF"
						}, {
							"sExtends": "csv",
							"sButtonText": "CSV"
						}, {
							"sExtends": "xls",
							"sButtonText": "Excel"
						}, {
							"sExtends": "print",
							"sButtonText": "Imprimir",
							"sInfo": 'Please press "CTRL+P" to print or "ESC" to quit',
							"sMessage": "Creado por KeyCloud"

						}, {
							"sExtends": "copy",
							"sButtonText": "Copiar"
						}]
					}
				});

	//                var tableWrapper = jQuery('#tableOchoHoras_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
	//                tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown
			}
		});
	}


		$("#ingresost").on('click',function(){
			$("#modalIngresos").modal('show');
			ingresos(staticIdNodo);
		});


	function tablaDispositivos(){
		$.ajax({
			url:  'WS/DashAssistance/WS_Dispositivos_Acceso.php',
			type: 'POST',
			success: function (response)
			{
				//console.log(response);
				var table = $('#tablaDispositivos');
				var jsonResponse = response;
				var data = JSON.parse(jsonResponse);
				jQuery.extend(true, jQuery.fn.DataTable.TableTools.classes, {
					"container": "btn-group tabletools-btn-group pull-right",
					"buttons": {
						"normal": "btn btn-sm btn-default",
						"disabled": "btn btn-sm btn-default disabled"
					}
				});
				var oTable = table.dataTable({
					"processing": true,
					"data": data,
					"order": [
						[0, 'asc']
					],
					"lengthMenu": [
						[5, 10, 15, 20, -1],
						[5, 10, 15, 20, "All"] // change per page values here
					],

					// set the initial value
					"pageLength": 10,
					"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

					"tableTools": {
						"sSwfPath": plugin_path + "datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
						"aButtons": [{
							"sExtends": "pdf",
							"sButtonText": "PDF"
						}, {
							"sExtends": "csv",
							"sButtonText": "CSV"
						}, {
							"sExtends": "xls",
							"sButtonText": "Excel"
						}, {
							"sExtends": "print",
							"sButtonText": "Imprimir",
							"sInfo": 'Please press "CTRL+P" to print or "ESC" to quit',
							"sMessage": "Creado por KeyCloud"

						}, {
							"sExtends": "copy",
							"sButtonText": "Copiar"
						}]
					}
				});

	//                var tableWrapper = jQuery('#tableOchoHoras_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
	//                tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown

			}
		});
	}

	function detalleInsite(idZona, idNodo){
		//$("#modalInsite").html("<table class='table tabe-stripped'><thead><tr><th>#</th><th>DNI</th><th>Nombre</th><th>Fecha</th></tr></thead><tbody></table>");
		console.log("feaas");
		$.ajax({
			url:  'WS/DashAssistance/WS_DetalleInsite.php',
			type: 'POST',
			data: {idZona : idZona, idNodo: idNodo},
			success: function (response)
			{
				$("#modalInsite").modal('show');
				$("#tablaInsite").html(response);

			}
		});
		
	}

	function funcioncargar(){//ACCION CUANDO CARGUE LA PAGINA o se haga click a aceptar modal arbol
		
		document.getElementById("soloTexto4").innerHTML="Bíometrias registradas en plataforma";

		var aux = document.getElementById("regEnt").innerText;
		aux=aux.replace(/[^\d]/g, '');
		document.getElementById("numeroGrande3").innerHTML=aux;
		var sin=document.getElementById("regEnt").innerText;
		sin = sin.replace(/[0-9]/g, '');
		document.getElementById("soloTexto3").innerHTML="Registros totales de entradas diarias";
		document.getElementById("regEnt").style.display = 'none';
		
		
		var aux = document.getElementById("usrsAct").innerText;
		aux = aux.replace(/[^\d]/g, '');
		document.getElementById("numeroGrande").innerHTML = aux;

		var bioCol = document.getElementById("numeroGrande").innerHTML;
		document.getElementById("bioCol").innerHTML = bioCol;

		var sin=document.getElementById("usrsAct").innerText;
		sin = sin.replace(/[0-9]/g, '');
		document.getElementById("soloTexto").innerHTML="Colaboradores registrados en plataforma";
		document.getElementById("usrsAct").style.display = 'none';

		var apps = document.getElementById("usrAPP").innerText;
		var presencial = document.getElementById("usrPresencial").innerText;

		var chartPresReg = document.getElementById("presencial-registros").innerText;
		var chartAppReg = document.getElementById("app-registros").innerText;
		
		var rostros = document.getElementById("rostro").innerText;
		var huellas = document.getElementById("huellas").innerText;

		var x=apps;
		var y=presencial;
		
		var aux2 = document.getElementById("regEntF").innerText;
		aux2=aux2.replace(/[^\d]/g, '');
		document.getElementById("numeroGrande2").innerHTML=aux2;
		var sin=document.getElementById("regEntF").innerText;
		sin = sin.replace(/[0-9]/g, '');
		
		var resta = aux - aux2;
		document.getElementById("numeroGrandeResta").innerHTML=resta;
		document.getElementById("soloTextoResta").innerHTML="Colaboradores sin registro de entrada hoy";
		
		var total_permisos=document.getElementById("pd").innerText;
		total_permisos=total_permisos.replace(/[^\d]/g, '');
		total_permisos=parseFloat(total_permisos);
		var licencias_dia=document.getElementById("ld").innerText;
		licencias_dia=licencias_dia.replace(/[^\d]/g, '');
		licencias_dia=parseFloat(licencias_dia);
		var vacaciones_dia=document.getElementById("vd").innerText;
		vacaciones_dia=vacaciones_dia.replace(/[^\d]/g, '');
		vacaciones_dia=parseFloat(vacaciones_dia);
		var totalexcepciones=parseInt(total_permisos+licencias_dia+vacaciones_dia);
		
		
		
		var ausenciasteoricas= resta-totalexcepciones;
		
		
		document.getElementById("sinJustifiacion").innerHTML=parseInt(totalexcepciones);
		document.getElementById("sinJustifiaciones").innerHTML=parseInt(totalexcepciones) + "%";
		document.getElementById("soloTextoSinJustificacion").innerHTML= "Colaboradores con justificación";
		document.getElementById("ausenciasTeoricasNumero").innerHTML=ausenciasteoricas;
		document.getElementById("ausenciasTeoricas").innerHTML=" Ausencias teóricas en el día";
		document.getElementById("numeroDispositivos").innerHTML=" Dispositivos biométricos en plataforma ";
		document.getElementById("usrsretrasados").innerHTML=" Colaboradores con atraso, según turno";
		
		


		
		document.getElementById("soloTexto2").innerHTML="Registros de entrada";
		document.getElementById("app-registros").innerHTML=apps;
		document.getElementById("presencial-registros").innerHTML=presencial;
		// document.getElementById("soloTexto2").innerHTML="Registros de entrada<br> "+apps+" App | " +presencial+" Presencial";
		// document.getElementById("soloTexto2").innerHTML="Registros de entrada<br> "+count+" App | " +count2+" Presencial";
		document.getElementById("regEntF").style.display ='none';
		document.getElementById("usrAPP").style.display = 'none';
		document.getElementById("usrPresencial").style.display = 'none';

		// grafico biometrias registradas

		var dataEnrPer = document.getElementById("totalRegistrosBioc").innerText;
		var totalRegiBioc = document.getElementById("bioCol").innerText;
		var retTotalBioc = totalRegiBioc - dataEnrPer;

		var ctx = document.getElementById("myChartBioc");
		//document.getElementById("data-chart-records").innerHTML = totalRegEntr;
		var myChart = new Chart(ctx, {
			type: 'doughnut',
			data: {
			labels: ['Smartphone App:'+ apps, 'Presencial:'+ presencial],
			datasets: [{
				label: '# of Tomatoes',
				data: [dataEnrPer, retTotalBioc],
				backgroundColor: [
					'#2b3ea4',
					'#fff',
					
				],
				borderColor: [
					'#2b3ea4',
					'#fff',
				],
				borderWidth: 1
			}]
			},
			options: {
				legend: {
					display: false
				},
				cutoutPercentage: 73,
				circumference: 2 * Math.PI,
				maintainAspectRatio: false,
				animation: {
					animateRotate: true,
					animateScale: false
				},
				tooltips: {
					enabled: false
				}
			},
		});

		// grafico biometrias registradas huellas

		var dataEnrPer = document.getElementById("totalRegistrosBioc").innerText;
		var totalRegiBioc = document.getElementById("bioCol").innerText;
		var retTotalBioc = totalRegiBioc - dataEnrPer;

		var ctx = document.getElementById("myChartBioc");
		//document.getElementById("data-chart-records").innerHTML = totalRegEntr;
		var myChart = new Chart(ctx, {
			type: 'doughnut',
			data: {
			labels: ['Smartphone App:'+ apps, 'Presencial:'+ presencial],
			datasets: [{
				label: '# of Tomatoes',
				data: [dataEnrPer, retTotalBioc],
				backgroundColor: [
					'#2b3ea4',
					'#fff',
					
				],
				borderColor: [
					'#2b3ea4',
					'#fff',
				],
				borderWidth: 1
			}]
			},
			options: {
				legend: {
					display: false
				},
				cutoutPercentage: 73,
				circumference: 2 * Math.PI,
				maintainAspectRatio: false,
				animation: {
					animateRotate: true,
					animateScale: false
				},
				tooltips: {
					enabled: false
				}
			},
		});

		// grafico asistencias hoy

		var dataEnrPer = document.getElementById("totalRegistrosBioc").innerText;
		var totalRegiBioc = document.getElementById("bioCol").innerText;
		var retTotalBioc = totalRegiBioc - dataEnrPer;

		var ctx3 = document.getElementById("myChartAsis");
		//document.getElementById("data-chart-records").innerHTML = totalRegEntr;
		var myChart = new Chart(ctx3, {
			type: 'doughnut',
			data: {
			labels: ['Smartphone App:'+ apps, 'Presencial:'+ presencial],
			datasets: [{
				label: '# of Tomatoes',
				data: [retTotalBioc, dataEnrPer],
				backgroundColor: [
					'#fff',
					'#2b3ea4',
					
					
				],
				borderColor: [
					
					'#fff','#2b3ea4',
				],
				borderWidth: 1
			}]
			},
			options: {
				legend: {
					display: false
				},
				cutoutPercentage: 73,
				circumference: 2 * Math.PI,
				maintainAspectRatio: false,
				animation: {
					animateRotate: true,
					animateScale: false
				},
				tooltips: {
					enabled: false
				}
			},
		});

				
		// grafico registros de entrada
		//var total = count+count2;
		
		var ctx = document.getElementById("myChartRecordsInput");
		//document.getElementById("data-chart-records").innerHTML = totalRegEntr;
		var myChart = new Chart(ctx, {
			type: 'doughnut',
			data: {
			labels: ['Smartphone App:'+ apps, 'Presencial:'+ presencial],
			datasets: [{
				label: '# of Tomatoes',
				data: [apps, presencial],
				backgroundColor: [
					'#fff',
					'#2b3ea4',
					
					
				],
				borderColor: [
					
					'#fff','#2b3ea4',
				],
				borderWidth: 1
			}]
			},
			options: {
				legend: {
					display: false
				},
				cutoutPercentage: 73,
				circumference: 2 * Math.PI,
				maintainAspectRatio: false,
				animation: {
					animateRotate: true,
					animateScale: false
				},
				tooltips: {
					enabled: false
				}
			},
		});

		// graficos colaboradores sin turno asignado

		var ctxTurns = document.getElementById("myChartTurns");
		var assigns = document.getElementById("usrLibress").innerHTML;
		//alert(assigns);
		//document.getElementById("data-chart-records").innerHTML = totalRegEntr;
		var myChart = new Chart(ctxTurns, {
			type: 'doughnut',
			data: {
			datasets: [{
				data: [assigns, retTotalBioc],
				backgroundColor: [
					'#21A1FC',
					'#fff',
				],
				borderColor: [
					'#fff',
					'#21A1FC',
				],
				borderWidth: 1
			}]
			},
			options: {
				legend: {
					display: false
				},
				cutoutPercentage: 73,
				circumference: 2 * Math.PI,
				maintainAspectRatio: false,
				animation: {
					animateRotate: true,
					animateScale: false
				},
				tooltips: {
					enabled: false
				}
			},
		});

		// graficos colaboradores con justificacion

		var ctxJustification = document.getElementById("myChartJustification");
		var justification = document.getElementById("sinJustifiacion").innerHTML;
		//alert(assigns);
		//document.getElementById("data-chart-records").innerHTML = totalRegEntr;
		var myChart = new Chart(ctxJustification, {
			type: 'doughnut',
			data: {
			datasets: [{
				data: [justification, retTotalBioc],
				backgroundColor: [
					'#21A1FC',
					'#fff',
				],
				borderColor: [
					'#fff',
					'#21A1FC',
				],
				borderWidth: 1
			}]
			},
			options: {
				legend: {
					display: false
				},
				cutoutPercentage: 73,
				circumference: 2 * Math.PI,
				maintainAspectRatio: false,
				animation: {
					animateRotate: true,
					animateScale: false
				},
				tooltips: {
					enabled: false
				}
			},
		});

		// graficos colaboradores con justificacion

		var ctxBackwardness = document.getElementById("myChartBackwardness");
		var backwardness = document.getElementById("usrsRec").innerHTML;
		//alert(assigns);
		//document.getElementById("data-chart-records").innerHTML = totalRegEntr;
		var myChart = new Chart(ctxBackwardness, {
			type: 'doughnut',
			data: {
			datasets: [{
				data: [backwardness, retTotalBioc],
				backgroundColor: [
					'#21A1FC',
					'#fff',
				],
				borderColor: [
					'#fff',
					'#21A1FC',
				],
				borderWidth: 1
			}]
			},
			options: {
				legend: {
					display: false
				},
				cutoutPercentage: 73,
				circumference: 2 * Math.PI,
				maintainAspectRatio: false,
				animation: {
					animateRotate: true,
					animateScale: false
				},
				tooltips: {
					enabled: false
				}
			},
		});

		// graficos colaboradores con justificacion

		var ctxDisengaged = document.getElementById("myChartDisengaged");
		var disengaged = document.getElementById("usrsDesv").innerHTML;
		//alert(assigns);
		//document.getElementById("data-chart-records").innerHTML = totalRegEntr;
		var myChart = new Chart(ctxDisengaged, {
			type: 'doughnut',
			data: {
			datasets: [{
				data: [disengaged, retTotalBioc],
				backgroundColor: [
					'#21A1FC',
					'#fff',
				],
				borderColor: [
					'#fff',
					'#21A1FC',
				],
				borderWidth: 1
			}]
			},
			options: {
				legend: {
					display: false
				},
				cutoutPercentage: 73,
				circumference: 2 * Math.PI,
				maintainAspectRatio: false,
				animation: {
					animateRotate: true,
					animateScale: false
				},
				tooltips: {
					enabled: false
				}
			},
		});

		// grafico registro totales de entradas diarias

		var AllRegEnt = document.getElementById('totalRegEntDia').innerText;

		var ctx = document.getElementById("myChartAllRecordsInput");
		//document.getElementById("data-chart-records").innerHTML = totalRegEntr;
		var myChart = new Chart(ctx, {
			type: 'doughnut',
			data: {
			labels: [],
			datasets: [{
				label: '',
				data: [AllRegEnt, totalRegiBioc],
				backgroundColor: [
					'#fff',
					'#2b3ea4',
					
					
				],
				borderColor: [
					
					'#fff','#2b3ea4',
				],
				borderWidth: 1
			}]
			},
			options: {
				legend: {
					display: false
				},
				cutoutPercentage: 73,
				circumference: 2 * Math.PI,
				maintainAspectRatio: false,
				animation: {
					animateRotate: true,
					animateScale: false
				},
				tooltips: {
					enabled: false
				}
			},
		});

		// grafico Colaboradores con entrada y salida

		var colEntSal = document.getElementById('colEntSal').innerText;

		var ctx = document.getElementById("myChartInputOutputCollaborators");
		//document.getElementById("data-chart-records").innerHTML = totalRegEntr;
		var myChart = new Chart(ctx, {
			type: 'doughnut',
			data: {
			labels: [],
			datasets: [{
				label: '',
				data: [colEntSal],
				backgroundColor: [
					'#2b3ea4','#fff',
					
					
					
				],
				borderColor: [
					'#2b3ea4',
					'#fff',
				],
				borderWidth: 1
			}]
			},
			options: {
				legend: {
					display: false
				},
				cutoutPercentage: 73,
				circumference: 2 * Math.PI,
				maintainAspectRatio: false,
				animation: {
					animateRotate: true,
					animateScale: false
				},
				tooltips: {
					enabled: false
				}
			},
		});



			// var ctx2 = document.getElementById('aforo').getContext('2d');
			// var myChart2 = new Chart(ctx2, {
			// 	type: 'doughnut',
			// 	data: {
			// 		labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
			// 		datasets: [{
			// 			label: '# of Votes',
			// 			data: [12, 19, 3, 5, 2, 3],
			// 			backgroundColor: [
			// 				'rgba(255, 99, 132, 0.2)',
			// 				'rgba(54, 162, 235, 0.2)',
			// 				'rgba(255, 206, 86, 0.2)',
			// 				'rgba(75, 192, 192, 0.2)',
			// 				'rgba(153, 102, 255, 0.2)',
			// 				'rgba(255, 159, 64, 0.2)'
			// 			],
			// 			borderColor: [
			// 				'rgba(255, 99, 132, 1)',
			// 				'rgba(54, 162, 235, 1)',
			// 				'rgba(255, 206, 86, 1)',
			// 				'rgba(75, 192, 192, 1)',
			// 				'rgba(153, 102, 255, 1)',
			// 				'rgba(255, 159, 64, 1)'
			// 			],
			// 			borderWidth: 1
			// 		}]
			// 	},
			// 	options: {
			// 		scales: {
			// 			yAxes: [{
			// 				ticks: {
			// 					beginAtZero: true
			// 				}
			// 			}]
			// 		}
			// 	}
			// });
			
			/*var ctx2 = document.getElementById("myChart2");
				var myChart = new Chart(ctx2, {
				type: 'pie',
				data: {
					labels: ['PERMITIDO:', 'ACTUAL'],
					datasets: [{
					label: '# of Tomatoes',
					data: [10, 23],
					backgroundColor: [
						'rgba(0, 123, 255, 1)',
						'rgba(255, 0, 0, 1)'
					],
					borderColor: [
						'rgba(0, 123, 255, 1)',
						'rgba(255, 0, 0, 1)'
					],
					borderWidth: 1
					}]
				},
				options: {
					//cutoutPercentage: 40,
					responsive: true,

				}
			});*/
			
	}

	

	// function chartDountReg (){
		
	// 	// // codigo barra progreso registros de entrada
	// 	// Morris.Donut({
	// 	// 	element: 'donut-example',
	// 	// 	data: [
	// 	// 		{label: "Download Sales", value: 12},
	// 	// 	],
	// 	// 	formatter: function(x, data) {
	// 	// 		return data.formatter;
	// 	// 	},
	// 	// 	resize: true,
	// 	// });
	// 	(function ($, window, document, undefined) {
	// 		'use strict';
	// 		function sumOfDataVal(dataArray) {
	// 				return dataArray['datasets'][0]['data'].reduce(function (sum, value) {
	// 					return sum + value;
	// 				}, 0);
	// 			}

	// 		var dataResponse = {
	// 			datasets: [{
	// 				data: [38, 12],
	// 				backgroundColor: [
	// 					'#7d2ae8',
	// 					'#ffffff',
	// 					'#e9c061',
	// 					'#d95d6b',
	// 					'#9173d8'
	// 				],
	// 				borderColor: '#25272f',
	// 				borderWidth: 0,
	// 				hoverBackgroundColor: [
	// 					'#7d2ae2',
	// 				],
	// 				hoverBorderColor: '#7d2ae2',
	// 				hoverBorderWidth: 1
	// 			}],

	// 			// These labels appear in the legend and in the tooltips when hovering different arcs
	// 			labels: [
	// 				'Blue',
	// 				'Green',
	// 				'Yellow',
	// 				'Red',
	// 				'Violet'
	// 			]
	// 		};


	// 		Chart.defaults.global.tooltips.custom = function (tooltip) {
	// 			// Tooltip Element

	// 			var tooltipEl = document.getElementById('chartjs-tooltip');

	// 			// Hide if no tooltip
	// 			if (tooltip.opacity === 0) {
	// 				tooltipEl.style.color = "#464950";
	// 				$("#chartjs-tooltip div p").text("100%");

	// 				tooltipEl.style.opacity = 0;
	// 				return;
	// 			}

	// 			// Set caret Position
	// 			tooltipEl.classList.remove('above', 'below', 'no-transform');
	// 			if (tooltip.yAlign) {
	// 				tooltipEl.classList.add(tooltip.yAlign);
	// 			} else {
	// 				tooltipEl.classList.add('no-transform');
	// 			}

	// 			function getBody(bodyItem) {
	// 				return bodyItem.lines;
	// 			}

	// 			// Set Text
	// 			if (tooltip.body) {
	// 				var bodyLines = tooltip.body.map(getBody);
	// 				var innerHtml = '<p>';
	// 				bodyLines.forEach(function (body, i) {
	// 					var dataNumber = body[i].split(":");
	// 					var dataValNum = parseInt(dataNumber[1].trim());
	// 					var dataToPercent = (dataValNum / sumOfDataVal(dataResponse) * 100).toFixed(2) + '%';
	// 					innerHtml += dataToPercent;
	// 				});

	// 				innerHtml += '</p>';

	// 				var tableRoot = tooltipEl.querySelector('div');
	// 				tableRoot.innerHTML = innerHtml;
	// 			}


	// 			tooltipEl.style.opacity = 1;
	// 			tooltipEl.style.color = "#FFF";
	// 		};


	// 		var ctx = document.getElementById('myChart').getContext('2d');
	// 		var myDoughnutChart = new Chart(ctx, {
	// 			type: 'doughnut',
	// 			data: dataResponse,
	// 			options: {
	// 				legend: {
	// 					display: false
	// 				},
	// 				cutoutPercentage: 73,
	// 				circumference: 2 * Math.PI,
	// 				maintainAspectRatio: false,
	// 				animation: {
	// 					animateRotate: false,
	// 					animateScale: true
	// 				},
	// 				tooltips: {
	// 					enabled: false
	// 				}
	// 			}
	// 		});
	// 	})(jQuery, window, document);
	// }



	function nombreJerarquia(){
		document.getElementById("primeramarca2").click();
	}
	// scripts monitor en tiempo real



	$(document).ready(function () {
		
		/////////////////////////////////////////////////FUNCIONES AGREGADAS MOSTRAR ARBOL/////////////////////////////////////////////////////////////////
		var staticIdNodo = 0;
		var idNodo = $("#arbol").data('idNodo');

		
		
		function cargaArbol2(){
			//console.log("Cargando Arbol....");
			$.ajax({
				url: "WS/Usuarios/WS_getArbol.php",
				type: 'POST',
				success: function (response) {
					if (response != "error"){
						//console.log("json="+response);
						json=response;
						creaArbol($("#arbol"), json);
						$('#arbol').on('nodeSelected', function(event, data) {

							//var idNodo = data.tag;
							var txtNodo = data.text;

							$('#arbol').data('idNodo',data.tag);

							$("#txtBotonArbol2").html(data.text);
							var idNodo = $("#arbol").data('idNodo');
							staticIdNodo = idNodo;
							//alert(idNodo);
							//enviamos el valor del nodo seleccionado
							//a las distintas funciones que lo utilizan
							
							//contadores(dept,cenco,idNodo);
							//cargarRanking(dept,idNodo);
							//initMap(dept,idNodo);
							//cargarTabla(dept,idNodo);
							//atrasosConse(dept,idNodo);
							//comparacionHoras(dept,idNodo);
							
						});
						//cargarTabla();
						var idSel = $("#arbol")[0].innerText;
						$("#txtBotonArbol2").html(idSel); 
						//alert(idSel);
						nodes(idSel);
					}else console.log("Error de carga de arbol:"+response);
				}
			});
		}
		var enrPer = document.getElementById("enrPers").innerText;
		console.log("resultado %: " + enrPer);
		//var totalEnrPer = document.getElementById("totalRegistrosBioc").innerText;

		//SE SUPONE QUE ACA DEBERIAMOS CREAR LA FUNCION PARA IR A LEER EL PRIMER NODO
		//Y QUE SE CARGUE AL ABRIR LA PAGINA
		function nodes(idSel){
			//alert(idSel);
            $.ajax({
                url: "WS/DashAssistance/WS_GetNodo.php",
                type: 'GET',
                data: {idSel:idSel},
                success: function (response) {
					//alert(idSel);
					//alert(response);
					var idNodo = response;
					//alert("metodo nodes: "+response);
					//$(window).on('ready', function() {
						//window.addEventListener('load', function() {

						//alert(response);
						//console.log('nodo actual '+idNodo)
						//cargarTabla(idNodo);
						//Ref(idNodo);//enviamos esta variable a la funcion nueva que creamos.	
                        $("#arbol").data("idNodo", idNodo);					
					//});
                }
            });
        }
		
		function creaArbol(arbol, json)
		{
			arbol.treeview({
				levels: 1,
				showBorder: false,
				data: json
			});	
		}
		
		function buscarNodo(arbol, tag){
			if (arbol.tag==tag ){
				return (arbol);
			}
			else
				if (arbol.nodes != null) 
				{  
				var i;
				var result=null;
				for(i=0; result == null && i < arbol.nodes.length; i++){
					result = buscarNodo(arbol.nodes[i], tag);
					}
				return result;
				}
			return null;
			}
		cargaArbol(); 
		dispoConect();
		
		$("#datosAusencia").hide();
		function cargarTabla(idNodo){
			//alert(idNodo);
            $.ajax({
                url: "WS/Monitor/WS_Monitor_Tiempo_Real.php",
                type: 'GET',
                asynch: true,
                data: {idNodo:idNodo},
                success: function (response) {
					//console.log('recarga TRN '+idNodo)
                    $("#monitorTiempoReal").html(response);
					//$('#monitorTiempoReal > tr').eq(2).children('td').addClass('td-rut');
					//console.log("recarga TR");
                }
				
            });
        }

		setInterval(
			function(){
				cargarTabla($("#arbol").data('idNodo'))
			}, 1000
		);

		// funcion contadores que se recargar cada cierto tiempo
		function contadores(idNodo) {
			$.ajax({
				url: "WS/DashAssistance/WS_contadores_dashassistanceN.php",
				type: "GET",
				asynch: true,
				data: {idNodo:idNodo},
				success: function (response) {
					//console.log("Contadores="+response);
					//var jsonResponse = response;
					var objeto = JSON.parse(response);
					console.log("imp objeto " + objeto);
					//console.log("recarga CNT");
					/*$("#et").text(objeto[16] + " Colaboradores");*/
					
					$("#soloTexto3").text("Registros totales de entrada");
					$("#solotexto6").text("Colaboradores con entrada y salida");
					$("#solotexto7").text("Agregar Colaborador");
					$("#et").text(objeto[30]);
					$("#pd").text(objeto[1]);
					$("#pm").text(objeto[0]);
					$("#ld").text(objeto[3]);
					$("#lm").text(objeto[2]);
					$("#vd").text(objeto[5]);
					$("#vm").text(objeto[4]);
					$("#cam").text(objeto[13] + " Usuarios");
					$("#can").text("Con mas de "+objeto[12]+" Cambios");
					$("#porAsisD").text((objeto[6]));
					$("#porAsisD2").attr('data-percent', objeto[9]);
					$("#porAsisD3").text(objeto[9]);
					$("#porAsisM").text((objeto[7]));
					$("#porAsisM2").attr('data-percent', objeto[10]);
					$("#porAsisM3").text(objeto[10]);
					$("#porAtra").text(objeto[8]);
					$("#porAtra2").attr('data-percent', objeto[11]);
					$("#porAtra3").text(objeto[11]);
					/*$("#porAtraR").text(objeto[9]);
					$("#porAtraR2").attr('data-percent', objeto[13]);
					$("#porAtraR3").text(objeto[13]);*/
					$("#porSobre").text(objeto[17]);
					$("#porSobre2").attr('data-percent', objeto[18]);
					$("#porSobre3").text(objeto[18]);
					$("#usrsAct").text(objeto[15] + " Colaboradores activos");

					var arrayAlert = objeto[35];
					//console.log(arrayAlert);
					//var sumaCant = 0

					for(i = 0; i < arrayAlert.length; i++ ){
						if(arrayAlert[i].nombreEstado == "INCORRECT_PHOTO_SEND"){
							var alertIps = arrayAlert[i].cantidad;
							$("#alertIps").text(alertIps);
						}
						if(arrayAlert[i].nombreEstado == "WAITING"){
							var alertWaiting = arrayAlert[i].cantidad;
							//console.log("jaison >" + alertWaiting);
							$("#alertWaiting").text(alertWaiting);
						}
					};
					
					var numbioc = objeto[15].replace(".","");
					//alert("objeto 15 >" + numbioc);
					
					if (objeto[20] == 0 && objeto[21] == 0){
						$("#rostro").text("0");
						var numbiocdos = 0;
					}else {
						$("#rostro").text(objeto[20]);
						var numbiocdos = objeto[20];
						//console.log("jsonfun > " + numbiocdos)
						// $("#rostroprueba").text(objeto[20]);
						// var numbiocdos = objeto[20];
						// console.log("rostroprueba > " + numbiocdos)
					}

					var dataChartTurns = objeto[29];

					if(numbioc == 0 && dataChartTurns == 0){
						var enrollPerceTurns = 0;
						$("#data-chart-turns").text(enrollPerceTurns + "%");
					}else{
						var enrollPerceTurns = Math.round((dataChartTurns * 100) / numbioc);
						// alert(enrolledPercentage + "%");
						$("#data-chart-turns").text(enrollPerceTurns + "%");
					}

					if(numbioc == 0 && numbiocdos == 0){
						var enrolledPercentage = 0;
						$("#enrPer").text(enrolledPercentage + "%");
					}else{
						var enrolledPercentage = Math.round((numbiocdos * 100) / numbioc);
						// alert(enrolledPercentage + "%");
						$("#enrPer").text(enrolledPercentage + "%");
					}

					// var enrolledPercentage = Math.round((numbiocdos * 100) / numbioc);
					// // alert(enrolledPercentage + "%");
					// $("#enrPer").text(enrolledPercentage + "%");
					$("#enrPerChart").text(enrolledPercentage + "%");
					$("#enrPers").text(enrolledPercentage);

					if(enrolledPercentage <= 50){
						$('.number-absences-card-collaborations-perc').css('color', 'red');
					}if(enrolledPercentage >= 51 && enrolledPercentage <=80){
						$('.number-absences-card-collaborations-perc').css('color', 'yellow');
					}if(enrolledPercentage >= 81 && enrolledPercentage <=100){
						$('.number-absences-card-collaborations-perc').css('color', 'green');
					}
					
					if (objeto[20] == 0 && objeto[21] == 0)
						$("#huellas").text("Activos ");
					else
						$("#huellas").text(objeto[21]);

					var totalRegistrosBioc = objeto[20] + objeto[21];
					//alert(totalRegistrosBioc);
					$("#totalRegistrosBioc").text(totalRegistrosBioc);
					$("#usrsDesv").text(objeto[16]);	
					$("#usrsDesvc").text(objeto[16] + "%");	

					$("#usrsRec").text(objeto[19]);
					$("#usrsRecs").text(objeto[19] + "%");
					//alert("atraso hoy > " + objeto[19]);

					$("#unaEnt").text(objeto[22] + " Entradas del día");
					$("#regEnt").text(objeto[23] + " Registros de entrada");
					$("#totalRegEntDia").text(objeto[23]);


					var regtotalentrada = objeto[31] + objeto[32];
					//alert(regtotalentrada);
					$("#regPriEntrada").text(regtotalentrada);

					var colTotales = objeto[15].replace(".","");

					if(colTotales == 0 && regtotalentrada == 0){
						var resPerRegEnt = 0;
						$("#perRegEnt").text(resPerRegEnt + "%");
						$("#perRegEntTwo").text(resPerRegEnt + "%");
					}else{
						var perRegEnt = Math.round((regtotalentrada * 100) / colTotales);
						// alert(enrolledPercentage + "%");
						$("#perRegEnt").text(perRegEnt + "%");
						$("#perRegEntTwo").text(perRegEnt + "%");
					}

					// var perRegEnt = Math.round((regtotalentrada * 100) / numbioc);
					// //alert(perRegEnt + "%");
					// $("#perRegEnt").text(perRegEnt + "%");
					//$("#perRegEntTwo").text(perRegEnt + "%");
					$("#perRegEntAtt").text(perRegEnt);

					var entSal = objeto[34];
					//alert(entSal);

					var colEntSal = objeto[34];
					//alert(colEntSal);
					$("#colEntSal").text(colEntSal);
					$("#colEntSal2").text(colEntSal);

					$("#disps").text(objeto[26] );
					$("#smDisps").text("con marcas de un total de "+objeto[26]);
					$("#sinTurno").text(objeto[27]+" Colaboradores sin turno");
					$("#regEntF").text(objeto[28] + " Primera(s) Entrada(s)");
					$("#usrLibres").text(objeto[29]);
					$("#usrLibress").text(objeto[29]);
					$("#mes").text(objeto[14]);
					// nuevos datos
					$("#usrAPP").text(objeto[31]);
					$("#usrPresencial").text(objeto[32]);
					console.log("pruebaregentrada > " + objeto[32]);				
					$("#regPresencial").text(objeto[32]);
					var totalRegEntr = (objeto[31] + objeto[32]);	
					$("#data-chart-records").text(totalRegEntr);			
					funcioncargar();

					// // $(function() {
					// // 	//create instance
					// // 	$('.chart').easyPieChart({animate: 2000});
					// // 	//update instance after 5 sec
					// // 	setTimeout(function() {
					// // 		$('#porAsisD2').data('easyPieChart').update(objeto[9]);
					// // 	}, 1);
					// // 	setTimeout(function() {
					// // 		$('#porAsisM2').data('easyPieChart').update(objeto[10]);
					// // 	}, 1);
					// // 	setTimeout(function() {
					// // 		$('#porAtra2').data('easyPieChart').update(objeto[11]);
					// // 	}, 1);
					// // 	/*setTimeout(function() {
					// // 		$('#porAtraR2').data('easyPieChart').update(objeto[13]);
					// // 	}, 1);*/
					// // 	setTimeout(function() {
					// // 		$('#porSobre2').data('easyPieChart').update(objeto[18]);
					// // 	}, 1);
					// // });
					
				}
			});
		};

		setInterval(
			function(){
				contadores($("#arbol").data('idNodo'))
			}, 3000
		);

		const webs = [
			{nombre: 'monitor', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/Monitor.php'},
			{nombre: 'visor geopoint', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/GeoPoint.php'},
			{nombre: 'ajustes geopoint', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/AjustesGeoPoint.php'},
			{nombre: 'checkpoint', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/CheckPoint.php'},
			{nombre: 'marcajes en zona', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/ReporteMarcaZona.php'},
			{nombre: 'gestionar marcajes', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/GestionMarcas.php'},
			{nombre: 'visor de marcas', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/VisorMarcas.php'},
			{nombre: 'excepciones', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/Excepciones.php'},
			{nombre: 'ausencias', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/Ausencias.php'},
			{nombre: 'atrasos', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/Atrasos.php'},
			{nombre: 'turnos y horarios', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/GestionTurnos.php'},
			{nombre: 'reporte general', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/ReporteGeneral.php'},
			{nombre: 'reporte detallado', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/ReporteMensualV4.php'},
			{nombre: 'estados de turnos', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/ReporteTurno.php'},
			{nombre: 'reporte dpw', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/ReporteDPW.php'},
			{nombre: 'colaboradores', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/Colaboradores.php'},
			{nombre: 'marcas de asistencia', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/ExportacionMarcas.php'},
			{nombre: 'Maestro de Colaboradores', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/MaestroUsuarios.php'},
			{nombre: 'auditoria', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/Auditoria.php'},
			{nombre: 'Colabs. Sin Marcaje', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/SinMarcaje.php'},
			{nombre: 'incidencia', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/Incidencia.php'},
			{nombre: 'payroll', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/PayRoll.php'},
			{nombre: 'notificaciones', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/Notificaciones.php'},
			{nombre: 'configuracion', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/Configuracion.php'},
			{nombre: 'nueva generacion', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/TransaccionesMonitor/perfilesNewV2.php'},
			{nombre: 'gestionar colaboradores', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/Colaboradores.php'},
			{nombre: 'agregar colaborador', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/Configuracion.php'},
			{nombre: 'pre-enrolamiento', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/PreEnrolamiento.php'},
			{nombre: 'eliminar colaborador', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/Configuracion.php'},
			{nombre: 'colaboradores por caducar', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/Caducidad.php'},
			{nombre: 'revertir desvinculación', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/Configuracion.php'},
			{nombre: 'asignacion masiva', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/asignamasivo.php'},
			{nombre: 'gestionar biometricos', enlace:'https://app.keycloud.cl/SmarTime/v3/GestionarDispositivos.php'},
			{nombre: 'administrador transacciones', enlace:'http://biocov.smartime.cl/Reports/CONSULTATRANSACCIONES.ASPX?instancia=DPW0'},
			{nombre: 'gestionar celulares/tablets', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/DispositivosMoviles.php'},
			{nombre: 'gestionar sectores', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/SectoresE.php'},
			{nombre: 'reglas de asistencia', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/ReglasAsistencia.php'},
			{nombre: 'portal del colaborador', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/Configuracion.php'},
			{nombre: 'gestionar feriados', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/Feriados.php'},
			{nombre: 'administrador excepciones', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/AdministradorExcepciones.php'},
			{nombre: 'sindicatos', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/Sindicatos.php'},
			{nombre: 'usuarios de keycloud', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/Usuarios.php'},
			{nombre: 'perfiles / roles de', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/Perfiles.php'},
			{nombre: 'administración', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/Perfiles.php'},
			{nombre: 'departamentos', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/Departamentos.php'},
			{nombre: 'razones sociales', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/RazonSocial.php'},
			{nombre: 'configuración avanzada', enlace:'https://app.keycloud.cl/v4/sinprivilegios.php'},
			{nombre: 'niveles de jerarquía', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/Jerarquia.php'},
			{nombre: 'modulo de envio fs', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/Jerarquia.php'},
			{nombre: 'modulo de envio terceros', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/asignamasivo.php'},
			{nombre: 'monitor transacciones fs', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/TransaccionesMonitor/transaccionesFiltro.php'},
			{nombre: 'ver marcas', enlace:'https://app3.keycloud.cl/v4/BIO_Assistance/GestionMarcas.php'},
			{nombre: 'monitor transacciones terceros', enlace:'http://biocov.smartime.cl/Reports/CONSULTATRANSACCIONES.ASPX?instancia=DPW0'},
			{nombre: 'gestionar dispositivos', enlace:'https://app3.keycloud.cl/SmarTime/v3/GestionarDispositivos.php'},
			{nombre: 'subir apk', enlace:'https://app.keycloud.cl/v4/subeAPK.php'},
			{nombre: 'administrar personas', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/TransaccionesMonitor/admPersonas.php'},
			{nombre: 'colaboradores', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/Colaboradores.php'},
			{nombre: 'modulo enrolamiento', enlace:'https://app.keycloud.cl/v4/BIO_Assistance/TransaccionesMonitor/Enrolar.php'},
			{nombre: 'facepass', enlace:'https://app.keycloud.cl/v4/facepass.php'},
		]

		const buscadorTr = document.querySelector('#buscadortr');
		const btnBuscadorTr = document.querySelector('#btnbuscadortr');

		const filtroBuscar = (e)=>{
			e.preventDefault();
			resultadoBusqueda.innerHTML = '';
			const textoUsuario = buscadorTr.value.toLowerCase();
			//alert("Resultado: " + textoUsuario);
			for(i = 0; i < webs.length; i++ ){
				let nombreWeb = webs[i].nombre.toLowerCase();
				if(nombreWeb.indexOf(textoUsuario) !== -1){
					resultadoBusqueda.innerHTML += `
						<tr><td><a href="${webs[i].enlace}" target="_blank">${webs[i].nombre}</a></td></tr>
					`
					buscadorTr.classList.add('brBuscador');
					btnbuscadortr.classList.add('br-btn-Buscador');
				}
			}

			if ($("#buscadortr").val() == ""){
				$("#resultadoBusqueda").fadeOut(300);
				buscadorTr.classList.remove('brBuscador');
				btnbuscadortr.classList.remove('br-btn-Buscador');
			}else{
				$("#resultadoBusqueda").fadeIn(300);
			}
			
			if(resultadoBusqueda.innerHTML == ''){
				resultadoBusqueda.innerHTML += `
						<tr><td><a href="#">Contenido no encontrado ingrese nuevamente una palabra válida</a></td></tr>
					`
				buscadorTr.classList.add('brBuscador');
				btnbuscadortr.classList.add('br-btn-Buscador');
			}
		}

		if(buscadorTr === ''){
			alert("El campo está vacio");
			return false;
		}else{
			btnbuscadortr.addEventListener('click', filtroBuscar);
		}
		
		buscadorTr.addEventListener('keyup', filtroBuscar);

		// $('#btnbuscadortr').on('click', function(){
		// 	alert("Resultado: " + buscadortr.value);
        // });

		
		$(document).on('click','#selArbol' , function(){
            $("#modalArbol").modal('show');

        });
		
		
		//oculta el modal al presionar el boton ir
		$(document).on('click','#irPage' , function(){
            $("#modalNotification").modal('hide');
        });

		//oculta la modal al presionar el boton seleccionar
		$(document).on('click','#aceptar' , function(){
            $("#modalArbol").modal('hide');
			$('#barNotification').removeClass("row-bar-noti-none");
			$('#barNotification').addClass("slidein");
			//alert(staticIdNodo);
			cargarTabla(staticIdNodo);
        });

		$(document).on('click','#btnNoti' , function(){
			$('#barNotification').addClass("slide-out-bar-noti");
			$('#barNotification').addClass("fadeOutNoti");
		});

		$(document).on('click','#btnNotiMantener' , function(){
			$('#barNotification').addClass("slide-out-bar-noti");
			$('#barNotification').addClass("fadeOutNoti");
		});
		///////////////////////////////////////////////////hasta aqui funciones agregadas para mostrar arbol/////////////////////////////////////////////

        /*function cargarTabla(){
            $.ajax({
                url: "WS/Monitor/WS_Monitor_Tiempo_Real.php",
                type: 'POST',
                success: function (response) {
                    console.log(response);
                    $("#monitorTiempoReal").html(response);
                }
            });
        }
        cargarTabla();*/
		
        $(document).on('click','.imagen' , function(){
            var id= $(this).attr('data-id');
            var checktime = $(this).attr('data-hora');
            $.ajax({
                url: "WS/Monitor/WS_Monitor_Obtener_Imagen.php",
                type: 'POST',
                data: {id:id, checktime:checktime},
                success: function (response) {
                    //console.log(response);
                    $("#modalImagen").modal('show');
                    $("#imagen").attr('src',response);
                }
            });

        });

        $(document).on('click','.mapa' , function(){
            var map;
            sessionStorage.setItem('latitud',parseFloat($(this).attr('data-lat')));
            sessionStorage.setItem('longitud',parseFloat($(this).attr('data-long')));

            $("#modalMapa").modal('show');
        });

        $('#modalMapa').on('shown.bs.modal', function (e) {
            var latitud = sessionStorage.getItem('latitud');
            var longitud = sessionStorage.getItem('longitud');
            latitud = parseFloat(latitud);
            longitud = parseFloat(longitud);
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: latitud, lng: longitud},
                zoom: 15
            });
            var marker = new google.maps.Marker({
                position: {lat: latitud, lng: longitud}
            });
            marker.setMap(map);
            // do something...
        });
    });

    function reporteLOS00(){
            var idNodo=$('#arbol').data("idNodo");
            location.href="http://biocov.smartime.cl/Reports/LosRobles.Report.aspx?key=FptjWQW%c!xzgIz!HHS&usuario=ecastillo&estructura="+idNodo;
        }
</script>
<script type="text/javascript">
var $zoho=$zoho || {};$zoho.salesiq = $zoho.salesiq || {widgetcode:"d71e9d307ce3959150887a3c04fce72fab0fdef945b12cb28b92e84a0a113393b91fcbceb430794b814d921368e2f4da", values:{},ready:function(){}};var d=document;s=d.createElement("script");s.type="text/javascript";s.id="zsiqscript";s.defer=true;s.src="https://salesiq.zoho.com/widget";t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);d.write("<div id='zsiqwidget'></div>");
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
	var swiper = new Swiper(".mySwiper", {
		slidesPerView: 3,
		// autoplay: {
		// 	delay: 2500,
		// 	disableOnInteraction: false,
		// },
		spaceBetween: 20,
		freeMode: true,
		grabCursor: true,
		pagination: {
			el: ".swiper-pagination",
			type: "fraction",
			},
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
			},
		breakpoints: {
			410: {
			slidesPerView: 1,
			spaceBetween: 10,
			},
			640: {
			slidesPerView: 2,
			spaceBetween: 20,
			},
			768: {
			slidesPerView: 4,
			spaceBetween: 40,
			},
			1024: {
			slidesPerView: 5,
			spaceBetween: 50,
			},
		},
		// loop: true,
	});
</script>
<?php include '../SYS_include/footerGeneral.php'; ?> 

</body>
</html>
