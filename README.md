-Que pasa si no tiene fecha de inicio, implementar de momento un guion en caso de que no este.
-Alerta o correo que notifique liquidaciones con error.
-Validaciones: 
	-fecha en formato correcto(con guion, si esta en palabras o si esta solo guion o si esta vacio).
	-direccion(no esta,cuando no esta rellenar con guion).
	-numero telefono(no esta,cuando no esta rellenar con guion).
	-dias licencia(no esta, se rellena en 0).
	-dias ausencia(no esta, se rellena en 0).
	-haberes afectos(2 variables x que tienen que asignarse una casilla).
	-anticipo, no esta se rellena en 0.
	-agregar validadores al resto de variables, si estan vacias lanzar al listado de error. A las variables con valores int agregar validador de . o ,
	-validar total a pagar(restar total no imponible-total dcto y tiene que ser el mismo al total a pagar, de lo contrario se agrega alistado error). Implementar 
	antes de validador fechas.
	
