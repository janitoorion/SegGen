function abrirErrorVista(texto){
	var layoutCargando = '<h1 class="ajax-loading-animation"><i class="fa fa-refresh fa-spin"></i> ' + texto + '</h1>';
	$( "#content" ).html( layoutCargando );
	$( ".modal-backdrop" ).remove();
}

function abrirCargandoVista(idioma){
	var texto;
	if (idioma == "en"){
		texto = 'Loading...';
	}else {
		texto = 'Cargando...';
	}
	
	var layoutCargando = '<h1 class="ajax-loading-animation"><i class="fa fa-cog fa-spin"></i> ' + texto + '</h1>';
	$( "#content" ).html( layoutCargando );
	$( ".modal-backdrop" ).remove();
}

function abrirCargandoModal(obj, idioma){
	var texto;
	if (idioma == "en"){
		texto = 'Loading...';
	}else {
		texto = 'Cargando...';
	}
	
	var layoutCargando = '<div id="EsperaCargaModal" style="background-color: rgba(255,255,255,255); position: fixed; width: 100%; height: 100%; top: 0; left: 0; right: 0; bottom: 0; z-index: 110001; text-align:center;"><div style="position: fixed;top: 50%; width:100%;"><h1><i class="fa fa-cog fa-spin"></i> ' + texto + '</h1></div></div>';
	$( obj ).append(layoutCargando);
}

function cerrarCargandoModal(obj){
	$( obj ).find("#EsperaCargaModal").remove();
}


function validaRut(campo){
	if ( campo.length == 0 ){ return false; }
	if ( campo.length < 8 ){ return false; }

	campo = campo.replace('-','')
	campo = campo.replace(/\./g,'')
	
	var suma = 0;
	var caracteres = "1234567890K";
	var contador = 0;    
	for (var i=0; i < campo.length; i++){
		u = campo.substring(i, i + 1);
		if (caracteres.indexOf(u) != -1)
		contador ++;
	}
	if ( contador==0 ) { return false }
	
	var rut = campo.substring(0,campo.length-1)
	var drut = campo.substring( campo.length-1 )
	var dvr = '0';
	var mul = 2;
	
	for (i= rut.length -1 ; i >= 0; i--) {
		suma = suma + rut.charAt(i) * mul
                if (mul == 7) 	mul = 2
		        else	mul++
	}
	res = suma % 11
	if (res==1)		dvr = 'K'
                else if (res==0) dvr = '0'
	else {
		dvi = 11-res
		dvr = dvi + ""
	}
	if ( dvr != drut.toLowerCase() ) { return false; }
	else { return true; }
}

function formato_rut(obj) {
    var numero = obj.value.toString();

    numero = numero.toString().replace(".", "").replace(".", "").replace(".", "");
    numero = numero.toString().replace("-", "");
    obj.value = numero;

    if (numero.length > 1)
    {
        var aux = numero.substring(0, numero.length - 1);
        var aux2 = numero.substring(numero.length - 1, numero.length);
        var salida = formatNumberNoDecimal.new(aux) + "-" + aux2.toString().toUpperCase();
        obj.value = salida;
    }
}

function pad(num, size) {
    if (num.toString().length >= size)
        return num;
    return (Math.pow(10, size) + Math.floor(num)).toString().substring(1);
}

function capitalizar(obj)
{
    var str = obj.value.toString();
    var pieces = str.split(" ");
    for (var i = 0; i < pieces.length; i++)
    {
        var j = pieces[i].charAt(0).toUpperCase();
        pieces[i] = j + pieces[i].substr(1);
    }
    obj.value = pieces.join(" ");
}

var formatNumber = {
	separador: ".", // separador para los miles
	sepDecimal: ',', // separador para los decimales
	formatear: function (num) {
		aux = parseFloat(num).toFixed(2);
		num = aux + '';
		var splitStr = num.split('.');
		var splitLeft = splitStr[0];
		var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';

		var regx = /(\d+)(\d{3})/;
		while (regx.test(splitLeft)) {
			splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
		}

		return this.simbol + splitLeft + splitRight;
	},

	new: function (num, simbol) {
		this.simbol = simbol || '';
		return this.formatear(num);
	},

	this: function (obj, simbol) {
		var num = obj.value;
		this.simbol = simbol || '';
		obj.value = this.formatear(num);
	}
}

var formatNumberNoDecimal = {
	separador: ".", // separador para los miles
	sepDecimal: ',', // separador para los decimales
	formatear: function (num) {
		aux = parseFloat(num).toFixed(2);
		num = aux + '';
		var splitStr = num.split('.');
		var splitLeft = splitStr[0];
		var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';

		var regx = /(\d+)(\d{3})/;
		while (regx.test(splitLeft)) {
			splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
		}

		return this.simbol + splitLeft;/* + splitRight;*/
	},

	new: function (num, simbol) {
		this.simbol = simbol || '';
		return this.formatear(num);
	},

	this: function (obj, simbol) {
		var num = obj.value;
		this.simbol = simbol || '';
		obj.value = this.formatear(num);
	}
}