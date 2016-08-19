<div class="row hidden-mobile">
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
		<h1 class="page-title txt-color-blueDark">
			<!-- PAGE HEADER -->
			<i class="fa-fw fa fa-pencil-square-o"></i> 
				<?= $tituloPagina; ?> 
			<span>>  
				<?= $subTituloPagina; ?>
			</span>
		</h1>
	</div>
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-align-center">
		<h1 class="page-title txt-color-blueDark">
			
		</h1>
	</div>
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-align-right">
		<div class="page-title">
			<a href="#" id="btnNuevo" class="btn btn-primary">Nuevo</a>
		</div>
	</div>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">
	<div class="well col-xs-12 col-sm-12 col-md-6 col-lg-6">
		<div class="input-group">
			<select class="form-control" name="cboEmpresas" id="cboEmpresas">
				<option value="-1" selected="" disabled="">Seleccione un empresa</option>
				<?= $cboEmpresas; ?>
			</select>
			<input type="hidden" id="idEmpresaSel" name="idEmpresaSel" value="<?= $idEmpresaSel; ?>">
			<div class="input-group-btn">
				<button class="btn btn-default btn-primary" type="button" id="btnBuscar">
					<i class="fa fa-search"></i> Buscar
				</button>
			</div>
		</div>
	</div>

	<div class="row">
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="jarviswidget jarviswidget-color-blueDark" id="grillaClienteMoroso" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
				
				<header>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Listado de Usuarios por Empresa</h2>

				</header>

				<div>

					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->

					</div>
					
					<div class="widget-body no-padding table-responsive">
						<div id="laTabla">
						<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
					        <?= $grilla; ?>
						</table>
						</div>
					</div>
				
				</div>
			</div>
		</article>
	</div>
	
</section>
<!-- end widget grid -->

<!-- Dynamic Modal -->  
<div class="modal fade" id="remoteModal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">  
	<div class="modal-dialog">  
		<div class="modal-content">
			<!-- content will be filled here from "ajax/modal-content/model-content-1.html" -->
		</div>  
	</div>  
</div>  
<!-- /.modal --> 

<script src="assets/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="assets/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="assets/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="assets/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="assets/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>

<!-- SCRIPTS ON PAGE EVENT -->
<script type="text/javascript">
	$("#btnNuevo").click(function(e) {
		e.preventDefault();
		
		empresa = $("#cboEmpresas").val();
		if (empresa == null || empresa == ""){
			$.smallBox({
				title : '<?= $this->lang->line('atencion', FALSE) ?>',
				content : 'Antes debe seleccionar una empresa de la lista.',
				color : "#C46A69",
				timeout: 3000,
				icon : "fa fa-warning shake animated",
			});
		} else {
			url = "Sistema/Empresa/NuevoUsuario/" + empresa;
			
			$('#remoteModal').modal({remote: url });
			$('#remoteModal').modal('show');
			
		}
	});

	$("#btnBuscar").click(function(e) {
		e.preventDefault();
		var empresa = $("#cboEmpresas").val();
		var url = "Sistema/Empresa/listaUsuarios/" + empresa + "/true";

		var posting = $.get( url );

		posting.done(function( data ) {

			var resp = '<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">' + data + '</table>';		
			$("#laTabla").html( resp );

			pagefunction();

		});
		
	});

	function pagefunction() {
		var datatableLang = "";
		var responsiveHelper_dt_basic = undefined;		
		var breakpointDefinition = {
			pc : 1700,
			tablet : 1024,
			phone : 480
		};
		var datatableLang = "";

		if ($('#idiomaSelec').val() == "en"){
			datatableLang = "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json";
		}
		else{
			datatableLang = "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json";
		}

		$('#dt_basic').dataTable({
			"language": {
				"url": datatableLang
			},
			"bDestroy": true, //permite reinicializar la tabla.
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
				"t"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				if (!responsiveHelper_dt_basic) {
					responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_dt_basic.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_dt_basic.respond();
			}
		});

		$(".btnEliminar").click(function(e) {
			e.preventDefault();
			url = $(this).attr("href");
			$.SmartMessageBox({
				title : "Eliminar",
				content : "Esta seguro de eliminar este usuario del sistema?",
				buttons : '[No][Si]'
			}, function(ButtonPressed) {
				if (ButtonPressed === "Si") {
					//ELIMINAR!!
					$.ajax({
						url: url,
						type: 'POST',
						data: null,
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
								
								$("#btnBuscar").click();
								
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
				}
			});
			
		});
	};
	
	jQuery(document).ready(function() {
		pageSetUp();
		
		if ($("#idEmpresaSel").val() != ""){
			$("#cboEmpresas").val($("#idEmpresaSel").val());
		}
		
		pagefunction();

		
	});
	
</script>
