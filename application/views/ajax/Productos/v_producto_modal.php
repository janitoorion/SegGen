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
						<label class="label">Nombre</label>
						<label class="input"> <i class="icon-append fa fa-edit"></i>
							<input type="text" name="nombre" placeholder="Nombre" value="<?= $result_nombre;  ?>">
							<b class="tooltip tooltip-bottom-right">Ingrese nombre</b> </label>
					</section>
					
					<section>
						<label class="label">Descripcion</label>
						<label class="input"> <i class="icon-append fa fa-edit"></i>
							<input type="text" name="descripcion" placeholder="Descripcion" value="<?= $result_descripcion;  ?>">
							<b class="tooltip tooltip-bottom-right">Ingrese descripcion</b> </label>
					</section>
					
					<section>
						<label class="label">Moneda</label>
						<label class="select">
							<select name="cboMonedas" id="cboMonedas" name="cboMonedas">
								<option value="0" selected="" disabled="">Seleccione</option>
								<?= $cboMonedas; ?>
							</select><i></i>
							<input type="hidden" id="idMoneda" value="<?= $result_id_moneda;  ?>">
						</label>
					</section>
					
					<section>
						<label class="label">Costo Neto</label>
						<label class="input"> <i class="icon-append fa fa-edit"></i>
							<input type="text" name="costo_neto" placeholder="Costo Neto" value="<?= $result_costo_neto;  ?>">
							<b class="tooltip tooltip-bottom-right">Ingrese costo neto</b> </label>
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
				<input type="hidden" id="idProducto" name="idProducto" value="<?= $idProducto; ?>">
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
		
	var pagefunction = function() {
		if ($("#idProducto").val() != "0"){
			$("#cboMonedas").val($("#idMoneda").val());
			$("#cboEstados").val($("#idEstado").val());
		}
		
		$( "#btnGuardar" ).click(function( event ) {
			$("#userForm").submit();  
		});
		
		$("#userForm").validate({
			rules : {
				nombre : {
					required : true,
					minlength : 5,
					maxlength : 200
				},
				descripcion : {
					minlength : 5,
					maxlength : 200
				},
				cboMonedas : {
					required : true
				},
				costo_neto : {
					required : true,
					minlength: 1,
  					maxlength: 15,
  					number: true
				},
				cboEstados : {
					required : true
				}
			},

			messages : {
				nombre : {
					required : 'Ingrese el nombre',
					minlength : 'Ingrese minimo 5 caracteres',
					maxlength : 'Ingrese maximo 200 caracteres'
				},
				descripcion : {
					minlength : 'Ingrese minimo 5 caracteres',
					maxlength : 'Ingrese maximo 200 caracteres'
				},
				cboMonedas : {
					required : 'Seleccione la moneda'
				},
				costo_neto : {
					required  : 'Ingrese costo neto',
					minlength : 'Ingrese minimo 1 digitos',
					maxlength : 'Ingrese maximo 15 digitos',
					number    : 'Debe ingresar solo digitos'
				},
				cboEstados : {
					required : 'Seleccione el estado'
				}
			},
			
			submitHandler: function(form) {
				var formData = new FormData($("#userForm")[0]);
				
				var url = "";
				if ($("#idProducto").val() == "0"){
					url = "Productos/Productos/NuevoProductoGuardar";
				} else {
					url = "Productos/Productos/EditarProductoGuardar";
				}

				abrirCargandoModal($( "#modalProducto" ), $("#idiomaSelec").val());
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
							url = "Productos/Productos/listaProductos";
							
							var posting = $.get( url, { data:datos } );
							
							posting.done(function( data ) {
								cerrarCargandoModal($( "#modalProducto" ));
								$( "#content" ).html( data );
							});
							
						}
						else{
							cerrarCargandoModal($( "#modalProducto" ));
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
