<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
		&times;
	</button>
	<h4 class="modal-title" id="myModalLabel"><?= $tituloModal; ?></h4>
</div>
<div class="modal-body">
	<div class="row">
		<div class="col-md-12">
			<form novalidate="novalidate" id="userForm" class="smart-form" enctype="multipart/form-data" method="post">						
				<fieldset>
					<section>
						<label class="label">Rut</label>
						<label class="input"> <i class="icon-append fa fa-user"></i>
							<input type="text" name="rut" id="rut" placeholder="Rut" onChange="formato_rut(this);" style="text-transform: uppercase" value="<?= $result_rut;  ?>">
							<b class="tooltip tooltip-bottom-right">Ingrese rut</b> </label>
					</section>
					
					<section>
						<label class="label">Nombre</label>
						<label class="input"> <i class="icon-append fa fa-user"></i>
							<input type="text" name="nombre" placeholder="Nombre" style="text-transform: uppercase" value="<?= $result_nombre;  ?>">
							<b class="tooltip tooltip-bottom-right">Ingrese nombre</b> </label>
					</section>
										
					<section>
						<label class="label">Estado</label>
						<label class="select">
							<select name="cboEstados" id="cboEstados">
								<option value="-1" selected="" disabled="">Seleccione</option>
								<?= $cboEstados; ?>
							</select><i></i>
							<input type="hidden" id="idEstado" value="<?= $result_id_estado;  ?>">
						</label>
					</section>
					
				</fieldset>
				<input type="hidden" id="idEmpresa" name="idEmpresa" value="<?= $idEmpresa; ?>">
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
		//console.log($("#idUsuario").val());
		if ($("#idEmpresa").val() != "0"){	
			$("#cboEstados").val($("#idEstado").val());
			$("#rut").attr("disabled","disabled");
			$("#rut").parent().addClass("state-disabled")
		}
		
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
				cboEstados : {
					required : true
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
				cboEstados : {
					required : 'Debe seleccionar un estado'
				}
			},
			
			submitHandler: function(form) {
				var formData = new FormData($("#userForm")[0]);
				
				var url = "";
				if ($("#idEmpresa").val() == "0"){
					url = "Sistema/Empresa/NuevaEmpresaGuardar";
				} else {
					url = "Sistema/Empresa/EditarEmpresaGuardar";
				}
				
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
							url = "Sistema/Empresa/listaEmpresas";
							
							var posting = $.get( url, { data:datos } );
							
							posting.done(function( data ) {
								$( "#content" ).html( data );
							});
							
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
						alert("error");
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
