<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
		&times;
	</button>
	<h4 class="modal-title" id="myModalLabel"><?= $tituloModal; ?></h4>
</div>
<div class="modal-body" id="modalCliente">
	<div class="row">
		<div class="col-md-12">
			<form novalidate="novalidate" id="userForm" class="smart-form" enctype="multipart/form-data" method="post">						
				<fieldset>
					<section>
						<label class="label">Rut</label>
						<label class="input"> <i class="icon-append fa fa-user"></i>
							<input type="text" name="rut" id="rut" placeholder="Rut" onChange="formato_rut(this);" value="<?= $result_rut;  ?>">
							<b class="tooltip tooltip-bottom-right">Ingrese rut</b> </label>
					</section>
					
					<section>
						<label class="label">Nombre</label>
						<label class="input"> <i class="icon-append fa fa-edit"></i>
							<input type="text" name="nombre" placeholder="Nombre" value="<?= $result_nombre;  ?>">
							<b class="tooltip tooltip-bottom-right">Ingrese nombre</b> </label>
					</section>
					
					<section>
						<label class="label">Contacto</label>
						<label class="input"> <i class="icon-append fa fa-edit"></i>
							<input type="text" name="contacto" placeholder="Contacto" value="<?= $result_contacto;  ?>">
							<b class="tooltip tooltip-bottom-right">Ingrese contacto</b> </label>
					</section>
					
					<section>
						<label class="label">Email</label>
						<label class="input"> <i class="icon-append fa fa-edit"></i>
							<input type="email" name="email" placeholder="Email" value="<?= $result_email;  ?>">
							<b class="tooltip tooltip-bottom-right">Ingrese email</b> </label>
					</section>
					
					<section>
						<label class="label">Telefono</label>
						<label class="input"> <i class="icon-append fa fa-edit"></i>
							<input type="text" name="telefono" placeholder="Telefono" value="<?= $result_telefono;  ?>">
							<b class="tooltip tooltip-bottom-right">Ingrese telefono</b> </label>
					</section>

					<section>
						<label class="label">Movil</label>
						<label class="input"> <i class="icon-append fa fa-edit"></i>
							<input type="text" name="movil" placeholder="Movil" value="<?= $result_movil;  ?>">
							<b class="tooltip tooltip-bottom-right">Ingrese movil</b> </label>
					</section>

					<section>
						<label class="label">Direccion</label>
						<label class="input"> <i class="icon-append fa fa-edit"></i>
							<input type="text" name="direccion" placeholder="Direccion" value="<?= $result_direccion;  ?>">
							<b class="tooltip tooltip-bottom-right">Ingrese direccion</b> </label>
					</section>

					<section>
						<label class="label">Region</label>
						<label class="select">
							<select name="cboRegiones" id="cboRegiones" name="cboRegiones">
								<option value="0" selected="">Seleccione</option>
								<?= $cboRegiones; ?>
							</select><i></i>
							<input type="hidden" id="idRegion" value="<?= $result_id_region;  ?>">
						</label>
					</section>

					<section>
						<label class="label">Provincia</label>
						<label class="select">
							<select name="cboProvincias" id="cboProvincias">
								<option value="0" selected="">Seleccione</option>
								<?= $cboProvincias; ?>
							</select><i></i>
							<input type="hidden" id="idProvincia" value="<?= $result_id_provincia;  ?>">
						</label>
					</section>

					<section>
						<label class="label">Comuna</label>
						<label class="select">
							<select name="cboComunas" id="cboComunas" name="cboComunas">
								<option value="0" selected="">Seleccione</option>
								<?= $cboComunas; ?>
							</select><i></i>
							<input type="hidden" id="idComuna" value="<?= $result_id_comuna;  ?>">
						</label>
					</section>
					
					<section>
						<label class="label">Codigo Postal</label>
						<label class="input"> <i class="icon-append fa fa-edit"></i>
							<input type="text" name="codigo_postal" placeholder="Codigo Postal" value="<?= $result_codigo_postal;  ?>">
							<b class="tooltip tooltip-bottom-right">Ingrese codigo postal</b> </label>
					</section>

					<section>
						<label class="label">Estado</label>
						<label class="select">
							<select name="cboEstados" id="cboEstados" name="cboEstados">
								<?= $cboEstados; ?>
							</select><i></i>
							<input type="hidden" id="idEstado" value="<?= $result_id_estado;  ?>">
						</label>
					</section>
					
				</fieldset>
				<input type="hidden" id="idCliente" name="idCliente" value="<?= $idCliente; ?>">
			</form>
		</div>
	</div>
</div>

<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal" id="btnVolver">
		Cancelar
	</button>
	<button type="button" class="btn btn-primary" id="btnGuardar">
		Guardar
	</button>
</div>

<!-- SCRIPTS ON PAGE EVENT -->
<script type="text/javascript">
	pageSetUp();
	
	//abrirCargandoModal($( "#modalCliente" ), $("#idiomaSelec").val());
	//cerrarCargandoModal($( "#modalCliente" ));
	
	var pagefunction = function() {
		//console.log($("#idUsuario").val());
		if ($("#idCliente").val() != "0"){
			$("#cboRegiones").val($("#idRegion").val());
			$("#cboProvincias").val($("#idProvincia").val());
			$("#cboComunas").val($("#idComuna").val());
			$("#cboEstados").val($("#idEstado").val());
			
			$("#rut").attr("disabled","disabled");
			$("#rut").parent().addClass("state-disabled")
		}
		
		$( "#cboRegiones" ).change(function( event ) {
			abrirCargandoModal($( "#modalCliente" ), $("#idiomaSelec").val());
			$.ajax({
				url: "Clientes/Clientes/GetProvincias/" + $("#cboRegiones").val(),
				type: 'GET',
				dataType: "json",
				success: function (data) {
					if (data['status'] == "true") {
						$("#cboComunas").html('<option value="0" selected="" disabled="">Seleccione</option>');
						$("#cboProvincias").html('<option value="0" selected="" disabled="">Seleccione</option>');
						$("#cboProvincias").append(data['datos']);
					}
					else{
						$.smallBox({
							title : '<?= $this->lang->line('atencion', FALSE) ?>',
							content : data['status'],
							color : "#C46A69",
							timeout: 3000,
							icon : "fa fa-warning shake animated",
						});
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					$.smallBox({
						title : '<?= $this->lang->line('atencion', FALSE) ?>',
						content : 'Problemas de conexion',
						color : "#C46A69",
						timeout: 3000,
						icon : "fa fa-warning shake animated",
					});
				}
			});
			cerrarCargandoModal($( "#modalCliente" ));
		});
		
		$( "#cboProvincias" ).change(function( event ) {
			abrirCargandoModal($( "#modalCliente" ), $("#idiomaSelec").val());
			$.ajax({
				url: "Clientes/Clientes/GetComunas/" + $("#cboProvincias").val(),
				type: 'GET',
				dataType: "json",
				success: function (data) {
					if (data['status'] == "true") {
						$("#cboComunas").html('<option value="0" selected="" disabled="">Seleccione</option>');
						$("#cboComunas").append(data['datos']);
					}
					else{
						$.smallBox({
							title : '<?= $this->lang->line('atencion', FALSE) ?>',
							content : data['status'],
							color : "#C46A69",
							timeout: 3000,
							icon : "fa fa-warning shake animated",
						});
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					$.smallBox({
						title : '<?= $this->lang->line('atencion', FALSE) ?>',
						content : 'Problemas de conexion',
						color : "#C46A69",
						timeout: 3000,
						icon : "fa fa-warning shake animated",
					});
				}
			});
			cerrarCargandoModal($( "#modalCliente" ));
		});
		
		$( "#btnGuardar" ).click(function( event ) {
			$("#userForm").submit();  
		});
		
		$.validator.addMethod("rut", function(value, element) { 
				return this.optional(element) || validaRut(value); 
		}, "Revise el Rut");
		
		$("#userForm").validate({
			rules : {
				rut : {
					required : true,
					minlength : 8,
					maxlength : 20,
					rut : true
				},
				nombre : {
					required : true,
					minlength : 5,
					maxlength : 200
				},
				contacto : {
					minlength : 5,
					maxlength : 200
				},
				email : {
					email : true
				},
				telefono : {
					minlength:8,
  					maxlength:11,
  					number: true
				},
				movil : {
					minlength:8,
  					maxlength:11,
  					number: true
				},
				direccion : {
					minlength : 5,
					maxlength : 200
				},
				codigo_postal : {
					maxlength : 15,
					number: true
				}
			},

			messages : {
				rut : {
					required : 'Ingrese el rut',
					minlength : 'Ingrese minimo 8 caracteres',
					maxlength : 'Ingrese maximo 20 caracteres',
					rut : 'El rut ingresado no es valido'
				},
				nombre : {
					required : 'Ingrese el nombre',
					minlength : 'Ingrese minimo 5 caracteres',
					maxlength : 'Ingrese maximo 200 caracteres'
				},
				contacto : {
					minlength : 'Ingrese minimo 5 caracteres',
					maxlength : 'Ingrese maximo 20 caracteres'
				},
				email : {
					email : 'Ingrese un email valido'
				},
				telefono : {
					minlength : 'Ingrese minimo 8 digitos',
					maxlength : 'Ingrese maximo 11 digitos',
					number    : 'Debe ingresar solo digitos'
				},
				movil : {
					minlength : 'Ingrese minimo 8 digitos',
					maxlength : 'Ingrese maximo 11 digitos',
					number    : 'Debe ingresar solo digitos'
				},
				direccion : {
					minlength : 'Ingrese minimo 5 caracteres',
					maxlength : 'Ingrese maximo 200 caracteres'
				},
				codigo_postal : {
					maxlength : 'Ingrese maximo 15 caracteres',
					number    : 'Debe ingresar solo digitos'
				}
			},
			
			submitHandler: function(form) {
				var formData = new FormData($("#userForm")[0]);
				
				var url = "";
				if ($("#idCliente").val() == "0"){
					url = "Clientes/Clientes/NuevoClienteGuardar";
				} else {
					url = "Clientes/Clientes/EditarClienteGuardar";
				}

				abrirCargandoModal($( "#modalCliente" ), $("#idiomaSelec").val());
				$.ajax({
					url: url,
					type: 'POST',
					data: formData,
					async: false,
					cache: false,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function (data) {
						if (data['status'] == "true") {
							
							$.smallBox({
								title : '<?= $this->lang->line('atencion', FALSE) ?>',
								content : 'Proceso terminado con éxito',
								color : "#739E73",
								timeout: 3000,
								icon : "fa fa-check shake animated",
							});

							$("#remoteModal").modal('hide');
							$(".modal-backdrop.fade.in").remove();
													
							datos = "",
							url = "Clientes/Clientes/listaClientes";
							
							var posting = $.get( url, { data:datos } );
							
							posting.done(function( data ) {
								cerrarCargandoModal($( "#modalCliente" ));
								$( "#content" ).html( data );
							});
							
						}
						else{
							cerrarCargandoModal($( "#modalCliente" ));
							$.smallBox({
								title : '<?= $this->lang->line('atencion', FALSE) ?>',
								content : data['status'],
								color : "#C46A69",
								timeout: 3000,
								icon : "fa fa-warning shake animated",
							});
						}
					},
					error: function (xhr, ajaxOptions, thrownError) {
						cerrarCargandoModal($( "#modalCliente" ));
						$.smallBox({
							title : '<?= $this->lang->line('atencion', FALSE) ?>',
							content : 'Problemas de conexion',
							color : "#C46A69",
							timeout: 3000,
							icon : "fa fa-warning shake animated",
						});
					}
				});
				
			},
			
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
			
		});	
	};
	
	loadScript("assets/js/plugin/jquery-form/jquery-form.min.js", pagefunction);
      
</script>
