.<!-- Top Bar Start -->
<div style="background-color: #a00024" class="topbar">

	<!-- LOGO -->
	<div style="background-color: #a00024" class="topbar-left">
		<div class="text-center">
			<a href="#" class="logo"> <span>CARGO XPRESS</span></a>
		</div>
	</div>

	<!-- Button mobile view to collapse sidebar menu -->
        <nav style="background-color: #a00024" class="navbar-custom">

		<ul class="list-inline float-right mb-0">
			<li class="list-inline-item notification-list hide-phone">
				<a class="nav-link waves-light waves-effect" href="#" id="btn-fullscreen">
					<i class="mdi mdi-crop-free noti-icon"></i>
				</a>
			</li>

			<li class="list-inline-item dropdown notification-list">
				<a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
				aria-haspopup="false" aria-expanded="false">
                                    <img style="width: 100px" src="../../images/Logo Horizontal 2.png" alt="user" >
                               
			</a>
			<div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">

				<!-- item-->
				<a href="javascript:void(0);" class="dropdown-item notify-item">
					<i class="mdi mdi-account-star-variant"></i> <span>Perfil</span>
				</a>

				<!-- item-->
				<a href="../../login.php?logout" class="dropdown-item notify-item">
					<i class="mdi mdi-logout"></i> <span>Salir</span>
				</a>

			</div>
		</li>

	</ul>

	<ul class="list-inline menu-left mb-0">
		<li class="float-left">
			<button style="background-color: #a00024" class="button-menu-mobile open-left waves-light waves-effect">
				<i class="mdi mdi-menu"></i>
			</button>
		</li>
	</ul>

</nav>

</div>
<!-- Top Bar End -->
<!-- ========== Left Sidebar Start ========== -->

<div class="left side-menu">
	<div class="sidebar-inner slimscrollleft">
		<!--- Divider -->
		<div id="sidebar-menu">
			<ul>
				<li class="menu-title">Menu</li>

				
                                        <?php
                                         if($_SESSION['cargo_users']==1){
                                         ?>
                                <li>
					<a href="principal.php" class="waves-effect waves-primary"><i
						class="ti-home"></i><span> Inicio </span></a>
					</li>
                                        <li>
					<a href="usuarios_empresa.php" class="waves-effect waves-primary"><i
						class="ti-user"></i><span> Usuarios Clientes </span></a>
					</li>
                                        <li>
					<a href="clientes.php" class="waves-effect waves-primary"><i
						class="ti-user"></i><span> Clientes </span></a>
					</li>
                                         
                                                
                                                 
                                          
                                         <li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-map"></i><span> Direcciones
						</span> <span class="menu-arrow"></span></a>

					<ul class="list-unstyled">
						<!--li><a href="../html/new_cotizacion.php">Agregar Pedido</a></li-->
						<li><a href="#">Nuevo Directorio</a></li>
                                                <li><a href="#">Mis  Directorios</a></li>
	

						



					</ul>
                                                    
				</li>       
                                           <li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-receipt"></i><span> Recolecciones
						</span> <span class="menu-arrow"></span></a>

					<ul class="list-unstyled">
						<!--li><a href="../html/new_cotizacion.php">Agregar Pedido</a></li-->
						<li><a href="#">Recolecciones</a></li>
                                                

						



					</ul>
                                                    
				</li>     
                                                
                                                <li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-receipt"></i><span> Ordenes
						</span> <span class="menu-arrow"></span></a>

					<ul class="list-unstyled">
						<!--li><a href="../html/new_cotizacion.php">Agregar Pedido</a></li-->
						<li><a href="#">Nuevo Envío</a></li>
                                                <li><a href="#">Nuevo Retiro</a></li>
                                                <li><a href="#">Ingreso Manual</a></li>
                                                <li><a href="#">Órdenes</a></li>
                                                <li><a href="#">Historial de Notificacione</a></li>
                                                <li><a href="#">Validación de Órdenes</a></li>
                                                <li><a href="#">Directorio</a></li>
	

						



					</ul>
                                                    
				</li>
					
					<?php
                                         }
                                         ?>	
						 <?php
                                         if($_SESSION['cargo_users']==4){
                                         ?>	
<li>
						<a href="../html/solicitudes.php" class="waves-effect waves-primary"><i
							class="ti-user"></i><span> Solicitudes </span></a>
						</li>
                                                
							
<?php
                                         }else{
                                           if($_SESSION['cargo_users']==7){?>
                                                <li>
						<a href="../html/clientes.php" class="waves-effect waves-primary"><i
							class="ti-user"></i><span> Clientes </span></a>
						</li> 
                                             <li>
						<a href="../html/bodegas_empresa.php" class="waves-effect waves-primary"><i
							class="ti-map"></i><span> Bodegas </span></a>
						</li> 
                                                <?php
                                           }  
                                         }
                                         ?>
                                                 <?php
                                         if($_SESSION['cargo_users']==6){
                                         ?>	
<li>
						<a href="../html/documentos_socio.php" class="waves-effect waves-primary"><i
							class="ti-user"></i><span> Informacion </span></a>
						</li>
                                                <li>
						<a href="../html/documentacion_socio.php" class="waves-effect waves-primary"><i
							class="ti-files"></i><span> Documentacion </span></a>
						</li>
                                                <li>
						<a href="../html/camiones_socio.php" class="waves-effect waves-primary"><i
							class="ti-car"></i><span> Camiones </span></a>
						</li>
                                                 <li>
						<a href="../html/choferes_socio.php" class="waves-effect waves-primary"><i
							class="ti-user"></i><span> Choferes </span></a>
						</li>
                                                
                                                
							
<?php
                                         }
                                         ?>
								<!--<li>
									<a href="../html/traslados.php" class="waves-effect waves-primary"><i
										class="ti-truck"></i><span> Traslados </span></a>
									</li>-->

									
									
										

											<li class="has_sub">
												<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-files"></i><span> Reportes </span> <span class="menu-arrow"></span></a>
												<ul class="list-unstyled">
													<!--<li><a href="../html/rep_producto.php">Reporte Productos</a></li>-->
													<!--li><a href="../html/rep_ventas.php">Reporte de Visitas </a></li-->
													
													
												</ul>
											</li>

											<li class="has_sub">
												<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-settings"></i><span> Configuración </span> <span class="menu-arrow"></span></a>
												<ul class="list-unstyled">
													<li><a href="../html/empresa.php">Empresa</a></li>
													
													<li><a href="../html/usuarios.php">Usuario</a></li>
													<li><a href="../html/grupos.php">Grupos de Usuarios</a></li>
												</ul>
											</li>

										</ul>

										<div class="clearfix"></div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
							<!-- Left Sidebar End -->
