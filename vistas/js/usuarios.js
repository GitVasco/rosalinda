
/*=============================================
TABLA DE USUARIOS
=============================================*/
$('.tablaUsuarios').DataTable({
    "ajax": "ajax/maestros/tabla-usuarios.ajax.php?perfil="+$("#perfilOculto").val(),
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "order": [[0, "asc"]],
	"pageLength": 20,
	"lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
    "language": {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
    }    
  });


/*=============================================
SUBIENDO LA FOTO DEL USUARIO
=============================================*/
$(".nuevaFoto").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaFoto").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaFoto").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar").attr("src", rutaImagen);

  		})

  	}
})

/*=============================================
EDITAR USUARIO
=============================================*/
$(".tablaUsuarios").on("click", ".btnEditarUsuario", function(){

    var idUsuario = $(this).attr("idUsuario");
	
	var datos = new FormData();
	datos.append("idUsuario", idUsuario);

	$.ajax({

		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			$("#idUsuario").val(respuesta["id"]);
            $("#editarNombre").val(respuesta["nombre"]);
			$("#editarUsuario").val(respuesta["usuario"]);
			$("#editarPerfil").html(respuesta["perfil"]);
			$("#editarPerfil").val(respuesta["perfil"]);
            $("#fotoActual").val(respuesta["foto"]);
            
            $("#passwordActual").val(respuesta["password"]);

            if(respuesta["foto"] != ""){

				$(".previsualizar").attr("src", respuesta["foto"]);

			}else{

				$(".previsualizar").attr("src", "vistas/img/usuarios/default/anonymous.png");

			}

		}

	});
	var datos2 = new FormData();
	datos2.append("idUsuario2", idUsuario);
	$.ajax({

		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos2,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta2){
			// console.log(respuesta2);
			$("input[name='permisos[]']").prop('checked',false);
			var cantidad= $("input[name='permisos[]']");
			for (let index = 0; index < respuesta2.length; index++) {
				
				$("input[name='permisos[]']").each(function(indice,elemento){
					if (cantidad[indice].value==respuesta2[index]["idpermiso"]){
						$(cantidad[indice]).prop('checked',true);
					}
				})
	
			}
			
		}

	});

})

/*=============================================
ACTIVAR USUARIO
=============================================*/
$(".tablaUsuarios").on("click", ".btnActivarUS", function(){

	var idUsuario = $(this).attr("idUsuario");
	var estadoUsuario = $(this).attr("estadoUsuario");

	var datos = new FormData();
 	datos.append("activarId", idUsuario);
  	datos.append("activarUsuario", estadoUsuario);

		$.ajax({

		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){

			if(window.matchMedia("(max-width:767px)").matches){

			swal({
			   title: "El usuario ha sido actualizado",
			   type: "success",
			   confirmButtonText: "¡Cerrar!"
			 }).then(function(result) {
				 if (result.value) {

					 window.location = "usuarios";

				 }


			 });

		   }

		}

	  })
	  
  	if(estadoUsuario == 0){

		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html('Desactivado');
		$(this).attr('estadoUsuario',1);

	}else{

		$(this).addClass('btn-success');
		$(this).removeClass('btn-danger');
		$(this).html('Activado');
		$(this).attr('estadoUsuario',0);

	}

})


/*=============================================
REVISAR SI EL USUARIO YA ESTÁ REGISTRADO
=============================================*/

$("#nuevoUsuario").change(function(){

	$(".alert").remove();

	var usuario = $(this).val();

	var datos = new FormData();
	datos.append("validarUsuario", usuario);

	 $.ajax({
	    url:"ajax/usuarios.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevoUsuario").parent().after('<div class="alert alert-warning">Este usuario ya existe en la base de datos</div>');

	    		$("#nuevoUsuario").val("");

	    	}

	    }

	})
})

/*=============================================
ELIMINAR USUARIO
=============================================*/
$(".tablaUsuarios").on("click", ".btnEliminarUsuario", function(){

	var idUsuario = $(this).attr("idUsuario");
	var fotoUsuario = $(this).attr("fotoUsuario");
	var usuario = $(this).attr("usuario");
  
	swal({
	  title: '¿Está seguro de borrar el usuario?',
	  text: "¡Si no lo está puede cancelar la accíón!",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar usuario!'
	}).then(function(result){
  
	  if(result.value){
  
		window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;
  
	  }
  
	})
  
  })

$(".tablaUsuarios").on("click", ".btnEditarCorreo", function(){
	var idUsuario = $(this).attr("idUsuario");
	$("#idUsuarioCorreo").val(idUsuario);
	var datos = new FormData();
	datos.append("idUsuario", idUsuario);

	$.ajax({

		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            $("#editarNombreCorreo").val(respuesta["nombre"]);
			$("#editarUsuarioCorreo").val(respuesta["usuario"]);
			if(respuesta["correo"] == 1){
				$("#nuevoCorreo").prop('checked',true);
			}else{
				$("#nuevoCorreo").prop('checked',false);
			}
			
			if(respuesta["datos"] == 1){
				$("#nuevoDatos").prop('checked',true);
			}else{
				$("#nuevoDatos").prop('checked',false);
			}
			}
		})
});

/*=============================================
EDITAR USUARIO
=============================================*/
$(".tablas").on("click", ".btnEditarConexion", function(){

    var idConexion = $(this).attr("idConexion");
	
	var datos = new FormData();
	datos.append("idConexion", idConexion);

	$.ajax({

		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			console.log(respuesta);
			$("#idConexion").val(respuesta["id"]);
            $("#editarIP").val(respuesta["ip"]);
			$("#editarBD").val(respuesta["db"]);
			$("#editarUser").val(respuesta["user"]);
            $("#editarPwd").val(respuesta["pwd"]);

		}

	});
})

/*=============================================
ELIMINAR USUARIO
=============================================*/
$(".tablas").on("click", ".btnEliminarConexion", function(){

	var idConexion = $(this).attr("idConexion");
  
	swal({
	  title: '¿Está seguro de borrar esta conexión?',
	  text: "¡Si no lo está puede cancelar la accíón!",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar conexion!'
	}).then(function(result){
  
	  if(result.value){
  
		window.location = "index.php?ruta=conexionjf&idConexion="+idConexion;
  
	  }
  
	})
  
  })