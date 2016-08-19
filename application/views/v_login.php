<!DOCTYPE html>
<html lang="en-us" id="extr-page">
	<head>
		<meta charset="utf-8">
		<title> Navia </title>
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<!-- #CSS Links -->
		<!-- Basic Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="assets/css/font-awesome.min.css">

		<!-- SmartAdmin Styles : Caution! DO NOT change the order -->
		<link rel="stylesheet" type="text/css" media="screen" href="assets/css/smartadmin-production-plugins.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="assets/css/smartadmin-production.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="assets/css/smartadmin-skins.min.css">

		<!-- SmartAdmin RTL Support -->
		<link rel="stylesheet" type="text/css" media="screen" href="assets/css/smartadmin-rtl.min.css"> 

		<!-- We recommend you use "your_style.css" to override SmartAdmin
		     specific styles this will also ensure you retrain your customization with each SmartAdmin update.
		<link rel="stylesheet" type="text/css" media="screen" href="assets/css/your_style.css"> -->

		<!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
		<link rel="stylesheet" type="text/css" media="screen" href="assets/css/demo.min.css">

		<!-- #FAVICONS -->
		<link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
		<link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">

		<!-- #GOOGLE FONT -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

		<!-- #APP SCREEN / ICONS -->
		<!-- Specifying a Webpage Icon for Web Clip 
			 Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
		<link rel="apple-touch-icon" href="assets/img/splash/sptouch-icon-iphone.png">
		<link rel="apple-touch-icon" sizes="76x76" href="assets/img/splash/touch-icon-ipad.png">
		<link rel="apple-touch-icon" sizes="120x120" href="assets/img/splash/touch-icon-iphone-retina.png">
		<link rel="apple-touch-icon" sizes="152x152" href="assets/img/splash/touch-icon-ipad-retina.png">
		
		<!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		
		<!-- Startup image for web apps -->
		<link rel="apple-touch-startup-image" href="assets/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
		<link rel="apple-touch-startup-image" href="assets/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
		<link rel="apple-touch-startup-image" href="assets/img/splash/iphone.png" media="screen and (max-device-width: 320px)">

	</head>
	
	<body class="animated fadeInDown">

		<header id="header">

			<div id="logo-group">
				<span id="logo"> <img src="assets/img/logo-light.png" alt="Demo"> </span>
			</div>

		</header>

		<div id="main" role="main">

			<!-- MAIN CONTENT -->
			<div id="content" class="container">

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
						<h1 class="txt-color-red login-header-big"><?= $this->lang->line('inicioSesion', FALSE); ?></h1>
						<div class="hero">

							<div class="pull-left login-desc-box-l">
								<h4 class="paragraph-header"><?= $this->lang->line('inicioSesionTexto', FALSE); ?></h4>
							</div>
							
							<img src="assets/img/demo/iphone5.jpg" class="pull-right display-image" alt="" style="width:180px">

						</div>

					</div>
					<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
						<div class="well no-padding">
							<form action="Login/validar_login" id="login-form" class="smart-form client-form" method="POST">
								<header>
									<?= $this->lang->line('inicioSesion', FALSE); ?>
								</header>

								<fieldset>
									
									<section>
										<label class="label"><?= $this->lang->line('rut', FALSE); ?></label>
										<label class="input"> <i class="icon-append fa fa-user"></i>
											<input type="text" name="username" id="username" onChange="formato_rut(this);">
											<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> <?= $this->lang->line('porfavorIngreseRut', FALSE); ?></b></label>
									</section>

									<section>
										<label class="label"><?= $this->lang->line('contraseña', FALSE); ?></label>
										<label class="input"> <i class="icon-append fa fa-lock"></i>
											<input type="password" name="password" id="password">
											<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> <?= $this->lang->line('porfavorIngreseContraseña', FALSE); ?></b> </label>
										<div class="note">
											<a href="forgotpassword.html"><?= $this->lang->line('olvidoSuContraseña', FALSE); ?></a>
										</div>
									</section>

									<section>
										<label class="checkbox">
											<input type="checkbox" name="remember" checked="">
											<i></i><?= $this->lang->line('seguirConectado', FALSE); ?></label>
									</section>
								</fieldset>
								<footer>
									<button type="submit" class="btn btn-primary">
										<?= $this->lang->line('entrar', FALSE); ?>
									</button>
								</footer>
							</form>

						</div>
						
					</div>
				</div>
			</div>

		</div>

		<!--================================================== -->

		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)
		<script data-pace-options='{ "restartOnRequestAfter": true }' src="js/plugin/pace/pace.min.js"></script>-->


		<!-- #PLUGINS -->
		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script>
			if (!window.jQuery) {
				document.write('<script src="assets/js/libs/jquery-2.1.1.min.js"><\/script>');
			}
		</script>

		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script>
			if (!window.jQuery.ui) {
				document.write('<script src="assets/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
			}
		</script>

		<!-- IMPORTANT: APP CONFIG -->
		<script src="assets/js/app.config.js"></script>

		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
		<script src="assets/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> 

		<!-- BOOTSTRAP JS -->
		<script src="assets/js/bootstrap/bootstrap.min.js"></script>

		<!-- CUSTOM NOTIFICATION -->
		<script src="assets/js/notification/SmartNotification.min.js"></script>

		<!-- JARVIS WIDGETS -->
		<script src="assets/js/smartwidgets/jarvis.widget.min.js"></script>

		<!-- EASY PIE CHARTS -->
		<script src="assets/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>

		<!-- SPARKLINES -->
		<script src="assets/js/plugin/sparkline/jquery.sparkline.min.js"></script>

		<!-- JQUERY VALIDATE -->
		<script src="assets/js/plugin/jquery-validate/jquery.validate.min.js"></script>

		<!-- JQUERY MASKED INPUT -->
		<script src="assets/js/plugin/masked-input/jquery.maskedinput.min.js"></script>

		<!-- JQUERY SELECT2 INPUT -->
		<script src="assets/js/plugin/select2/select2.min.js"></script>

		<!-- JQUERY UI + Bootstrap Slider -->
		<script src="assets/js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>

		<!-- browser msie issue fix -->
		<script src="assets/js/plugin/msie-fix/jquery.mb.browser.min.js"></script>

		<!-- FastClick: For mobile devices: you can disable this in app.js -->
		<script src="assets/js/plugin/fastclick/fastclick.min.js"></script>

		<!--[if IE 8]>
			<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
		<![endif]-->

		<!-- MAIN APP JS FILE -->
		<script src="assets/js/app.min.js"></script>

		<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
		<!-- Voice command : plugin -->
		<script src="assets/js/speech/voicecommand.min.js"></script>

		<!-- SmartChat UI : plugin -->
		<script src="assets/js/smart-chat-ui/smart.chat.ui.min.js"></script>
		<script src="assets/js/smart-chat-ui/smart.chat.manager.min.js"></script>
		
		<script src="assets/js/globales.js"></script>
		<script type="text/javascript">
			runAllForms();
            pageSetUp();
            
			var pagefunction = function() {
				$("#login-form").validate({
					rules : {
						username : {
							required : true
						},
						password : {
							required : true,
							minlength : 3,
							maxlength : 20
						}
					},
					messages : {
						username : {
							required : '<?= $this->lang->line('porfavorIngreseRut', FALSE) ?>'
						},
						password : {
							required : '<?= $this->lang->line('porfavorIngreseContraseña', FALSE) ?>'
						}
					},
					errorPlacement : function(error, element) {
						error.insertAfter(element.parent());
					},
                    submitHandler: function(form) {
                        $.ajax({
                            url: form.action,
                            type: form.method,
                            data: $(form).serialize(),
                            dataType: "json",
                            success: function (data) {
                                if (data['STATUS'] == "TRUE") {
                                        window.location.href = 'Home';
                                    }
                                else{
                                    $.smallBox({
                                        title : '<?= $this->lang->line('atencion', FALSE) ?>',
                                        content : data['STATUS'],
                                        color : "#C46A69",
                                        timeout: 2000,
                                        icon : "fa fa-warning shake animated",
                                    });
                                }
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                $.smallBox({
                                        title : '<?= $this->lang->line('atencion', FALSE) ?>',
                                        content : thrownError,
                                        color : "#C46A69",
                                        timeout: 2000,
                                        icon : "fa fa-warning shake animated",
                                });
                            }                                                
                        });
                    }
                    
				});
			};
            
            loadScript("assets/js/plugin/bootstrap-progressbar/bootstrap-progressbar.min.js", pagefunction);
		</script>

	</body>
</html>