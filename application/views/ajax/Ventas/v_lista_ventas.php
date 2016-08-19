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
		
	</div>
</div>


<!-- widget grid -->
<section id="widget-grid" class="">
	<div class="row">
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
			<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">

				<header>
					<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
					<h2>Consulta </h2>

				</header>
				
				<!-- widget div-->
				<div>

					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->

					</div>
					<!-- end widget edit box -->

					<!-- widget content -->
					<div class="widget-body no-padding">

						<form action="#" class="smart-form">
							<header>
								Filtrar por rango de fechas
							</header>

							<fieldset>
								
								<div class="row">
									<section class="col col-6">
										<label class="input"> <i class="icon-append fa fa-calendar"></i>
											<input type="text" name="desde" id="desde" placeholder="Desde">
										</label>
									</section>
									<section class="col col-6">
										<label class="input"> <i class="icon-append fa fa-calendar"></i>
											<input type="text" name="hasta" id="hasta" placeholder="Hasta">
										</label>
									</section>
								</div>
							
							</fieldset>
							

							<footer>
								<button id="btnConsultar" class="btn btn-primary">
									Consultar
								</button>
							</footer>
						</form>

					</div>
					<!-- end widget content -->

				</div>
				<!-- end widget div -->

			</div>
		</article>

		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
			<div class="jarviswidget jarviswidget-color-blueDark" id="grillaClienteMoroso" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
				
				<header>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Listado de Ventas</h2>

				</header>

				<div>

					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->

					</div>
					
					<div class="widget-body no-padding table-responsive">

						<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
					        <?= $grilla; ?>
						</table>

					</div>
				
				</div>
			</div>
		</article>
	</div>
	
</section>
<!-- end widget grid -->

<!-- Dynamic Modal -->  
<div class="modal fade" id="remoteModal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">  
	<div class="modal-dialog" style="width: 700px;">  
		<div class="modal-content">
			<!-- content will be filled here from "ajax/modal-content/model-content-1.html" -->
		</div>  
	</div>  
</div>  
<!-- /.modal --> 

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

		// START AND FINISH DATE
		$('#desde').datepicker({
			dateFormat : 'yy-mm-dd',
			prevText : '<i class="fa fa-chevron-left"></i>',
			nextText : '<i class="fa fa-chevron-right"></i>',
			onSelect : function(selectedDate) {
				$('#hasta').datepicker('option', 'minDate', selectedDate);
			}
		});
		
		$('#hasta').datepicker({
			dateFormat : 'yy-mm-dd',
			prevText : '<i class="fa fa-chevron-left"></i>',
			nextText : '<i class="fa fa-chevron-right"></i>',
			onSelect : function(selectedDate) {
				$('#desde').datepicker('option', 'maxDate', selectedDate);
			}
		});

		$('#desde').val('<?= $desde; ?>');
		$('#hasta').val('<?= $hasta; ?>');

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

		$("#btnConsultar").click(function(e) {
			e.preventDefault();
			
			var desde = $("#desde").datepicker({ dateFormat: 'yy-mm-dd' }).val();
			var hasta = $("#hasta").datepicker({ dateFormat: 'yy-mm-dd' }).val();
			var hash =  "/" + desde + "/" + hasta;

			url = "Ventas/Ventas/listaVentas" + hash;

			var datos = "";
			var posting = $.get( url );

			abrirCargandoVista( $("#idiomaSelec").val() );

			posting.done(function( data ) {
				$( "#content" ).html( data );
			});
			posting.fail(function(xhr, textStatus, errorThrown) {
				abrirErrorVista( "No fue posible encontrar la pagina solicitada, recargue la página." );
				//alert(xhr.responseText);
			});
			posting.always(function() {
				window.location.hash = url;
			});
		});	
		
	};
	
	loadScript("assets/js/plugin/jquery-form/jquery-form.min.js", function(){
		loadScript("assets/js/plugin/datatables/jquery.dataTables.min.js", function(){
			loadScript("assets/js/plugin/datatables/dataTables.colVis.min.js", function(){
				loadScript("assets/js/plugin/datatables/dataTables.tableTools.min.js", function(){
					loadScript("assets/js/plugin/datatables/dataTables.bootstrap.min.js", function(){
						loadScript("assets/js/plugin/datatable-responsive/datatables.responsive.min.js", pagefunction)
					});
				});
			});
		});
	});
</script>
