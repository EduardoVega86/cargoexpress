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
				<a href="../html/documentos_socio.php" class="dropdown-item notify-item">
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
                                         <li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-user"></i><span> Usuarios
						</span> <span class="menu-arrow"></span></a>

					<ul class="list-unstyled">
						<!--li><a href="../html/new_cotizacion.php">Agregar Pedido</a></li-->
						<li><a href="../html/usuarios.php">Administrar</a></li>
                        			<li><a href="../html/usuarios_clientes.php">Clientes</a></li>
                        			<li><a href="../html/usuarios_mensajero.php">Mensajeros</a></li>
                        
                        					</ul>
                                                    
				</li> 
                                <li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-map"></i><span> Direcciones
						</span> <span class="menu-arrow"></span></a>

					<ul class="list-unstyled">
						<!--li><a href="../html/new_cotizacion.php">Agregar Pedido</a></li-->
						
                        			<li><a href="../html/agregar_bodega.php">Nueva Direccion</a></li>
                        			<li><a href="../html/bodegas_empresa.php">Lista de Direcciones</a></li>
                        
                        					</ul>
                                                    
				</li>
                                                 
                                            

                                                <!--li>
						<a href="../html/documentacion_requerida.php" class="waves-effect waves-primary"><i
							class="ti-archive"></i><span> Documentación </span></a>
						</li-->
                                                <!--li>
						<a href="../html/camiones_socio.php" class="waves-effect waves-primary"><i
							class="ti-car"></i><span> Camiones </span></a>
						</li-->
                                                 <!--li>
						<a href="../html/choferes_socio.php" class="waves-effect waves-primary"><i
							class="ti-user"></i><span> Choferes </span></a>
						</li-->


                                <li>
					<a href="#" class="waves-effect waves-primary"><i
						class="ti-receipt"></i><span> Recolecciones </span></a>
					</li>
  
                                                <li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-receipt"></i><span> Ordenes
						</span> <span class="menu-arrow"></span></a>

					<ul class="list-unstyled">
						<!--li><a href="../html/new_cotizacion.php">Agregar Pedido</a></li-->
						<li><a href="../html/new_cotizacion.php">Nuevo Envío</a></li>
                                                <li><a href="#">Nuevo Retiro</a></li>
                                                <li><a href="#">Ingreso Manual</a></li>
                                                <li><a href="../html/ordenes.php">Órdenes</a></li>
                                                <li><a href="#">Notificaciones</a></li>
                                                <li><a href="#">Validación de Órdenes</a></li>
                                                <li><a href="#">Directorio</a></li>
	

						



					</ul>
                                                    
				</li>
                               <li>
					<a href="#" class="waves-effect waves-primary"><i
						class="ti-map"></i><span> Tracking </span></a>
					</li>
                               <li>
					<a href="#" class="waves-effect waves-primary"><i
						class="ti-receipt"></i><span> Guías Automáticas </span></a>
					</li>
                               <li>
					<a href="#" class="waves-effect waves-primary"><i
						class="ti-receipt"></i><span> Movimientos </span></a>
					</li>
                               <li>
					<a href="#" class="waves-effect waves-primary"><i
						class="ti-receipt"></i><span> Masivos </span></a>
					</li>
                                        <li class="has_sub">
												<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-settings"></i><span> Configuración </span> <span class="menu-arrow"></span></a>
												<ul class="list-unstyled">
													<li><a href="../html/empresa.php">Empresa</a></li>
													
													<li><a href="../html/usuarios.php">Usuario</a></li>
													<li><a href="../html/grupos.php">Grupos de Usuarios</a></li>
												</ul>
											</li>
					
					<?php
                                         }
                                         ?>	
						 <?php
                                                 //rol clientes
                                         if($_SESSION['cargo_users']==4){
                                         ?>
                                        
                                        
					

					<li>
						<a href="../html/principal.php" class="waves-effect waves-primary"><i
							class="ti-dashboard"></i><span> Inicio </span></a>
						</li>
						<!--li><a href="../html/new_cotizacion.php">Agregar Pedido</a></li-->
                                                <li>
						<a href="#" class="waves-effect waves-primary"><i
							class="ti-arrow-right"></i><span> Nuevo Envío </span></a>
						</li>
                                                <li>
						<a href="#" class="waves-effect waves-primary"><i
							class="ti-arrow-left"></i><span> Nuevo Retiro </span></a>
						</li>
                                                <li>
						<a href="#" class="waves-effect waves-primary"><i
							class="ti-pencil"></i><span> Ingreso Manual</span></a>
						</li>
                                                <li>
						<a href="#" class="waves-effect waves-primary"><i
							class="ti-receipt"></i><span> Órdenes </span></a>
						</li>
                                                <li>
						<a href="#" class="waves-effect waves-primary"><i
							class="ti-bell"></i><span> Notificaciones </span></a>
						</li>
                                                <li>
						<a href="#" class="waves-effect waves-primary"><i
							class="ti-check"></i><span> Validación </span></a>
						</li>
                                                <li>
						<a href="../html/agregar_bodega.php" class="waves-effect waves-primary"><i
							class="ti-map"></i><span>Ingresar dirección  </span></a>
						</li>
                                                <li>
						<a href="../html/bodegas_empresa.php" class="waves-effect waves-primary"><i
							class="ti-map-alt"></i><span> Direcciones </span></a>
						</li>
						
                                    
	

						



					
                                                    
				
                                      
                              

                                                
							
<?php
                                         }else{
                                           if($_SESSION['cargo_users']==6){?>
                                             <li>
						<a href="../html/ordenes_mensajero.php" class="waves-effect waves-primary"><i
							class="ti-map"></i><span> Mis ordenes </span></a>
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



											

										</ul>

										<div class="clearfix"></div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
							<!-- Left Sidebar End -->
