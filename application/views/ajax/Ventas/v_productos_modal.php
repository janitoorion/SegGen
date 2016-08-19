<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
		&times;
	</button>
	<h4 class="modal-title" id="myModalLabel"><?= $tituloModal; ?></h4>
</div>
<div class="modal-body" id="modalCliente">
	<div class="row">
		<div class="col-md-12">
			

			<!-- widget grid -->
			<section id="widget-grid" class="">
				<div class="row">
					<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="jarviswidget jarviswidget-color-blueDark" id="grillaClienteMoroso" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
							
							<header>
								<span class="widget-icon"> <i class="fa fa-table"></i> </span>
								<h2>Listado de Productos</h2>

							</header>

							<div>

								<div class="jarviswidget-editbox">
									<!-- This area used as dropdown edit box -->

								</div>
								
								<div class="widget-body no-padding table-responsive">
									
									<table id="dt_basic_modal" class="table table-striped table-bordered table-hover" width="100%">
										<?= $grilla; ?>
									</table>
							
								</div>
							
							</div>
						</div>
					</article>
				</div>
				
			</section>
			<!-- end widget grid -->





		</div>
	</div>
</div>

<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal" id="btnVolver">
		Cerrar
	</button>
</div>

<!-- SCRIPTS ON PAGE EVENT -->
<script type="text/javascript">
	pageSetUp();
	
	// pagefunction	
	var pagefunction = function() {
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
				
		$('#dt_basic_modal').dataTable({
			"language": {
				"url": datatableLang
			},
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
				"t"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				if (!responsiveHelper_dt_basic) {
					responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic_modal'), breakpointDefinition);
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
				content : "Esta seguro de eliminar este producto del sistema?",
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
														
								datos = "",
								url = "Productos/Productos/listaProductos";
								
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
				}
			});
			
		});
		
	};
		
	loadScript("assets/js/plugin/datatables/jquery.dataTables.min.js", function(){
		loadScript("assets/js/plugin/datatables/dataTables.colVis.min.js", function(){
			loadScript("assets/js/plugin/datatables/dataTables.tableTools.min.js", function(){
				loadScript("assets/js/plugin/datatables/dataTables.bootstrap.min.js", function(){
					loadScript("assets/js/plugin/datatable-responsive/datatables.responsive.min.js", pagefunction)
				});
			});
		});
	});	
</script>
