<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

/*
*	Funcion que me permite obtener todos los clientes en concreto.
*/

$app->get('/api/clientes', function(Request $request,Response $response){
	$consulta = 'SELECT * FROM cliente';
	try{
		//instanciacion de BD
		$db = new db();

		//conexion

		$db = $db->conectar();
		$ejecutar = $db->query($consulta);
		$cliente = $ejecutar->fetchAll(PDO::FETCH_OBJ);
		$db = null; //para cerrar la conexion

		//exportar y mostrar en JSON

		echo json_encode($cliente);
	}catch(PDOException $e){
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
});

/*
*	Funcion que me permite obtener los datos de un Cliente en concreto
*/

$app->get('/api/clientes/{id}', function(Request $request,Response $response){
	$id = $request->getAttribute('id');

	$consulta = "SELECT * FROM cliente WHERE id = '$id'";
	try{
		//instanciacion de BD
		$db = new db();

		//conexion

		$db = $db->conectar();
		$ejecutar = $db->query($consulta);
		$cliente = $ejecutar->fetchAll(PDO::FETCH_OBJ);
		$db = null; //para cerrar la conexion

		//exportar y mostrar en JSON un solo cliente

		echo json_encode($cliente);
	}catch(PDOException $e){
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
});

/*
*	Funcion que me permite agregar un Cliente en concreto
*/

$app->post('/api/clientes/agregar', function(Request $request,Response $response){
	
	$nombre = $request->getParam('nombre');
	$apellido = $request->getParam('apellido');
	$telefono = $request->getParam('telefono');
	$email = $request->getParam('email');
	$direccion = $request->getParam('direccion');
	$ciudad = $request->getParam('ciudad');
	$departamento = $request->getParam('departamento');

	$consulta = "INSERT INTO cliente (nombre, apellido, telefono, email, direccion, ciudad, departamento)VALUES(:nombre ,:apellido, :telefono, :email , :direccion, :ciudad ,:departamento)";
	try{
		//instanciacion de BD
		$db = new db();

		//conexion

		$db = $db->conectar();
		$stmt = $db->prepare($consulta);
		$stmt = $db->bindParam(':nombre', $nombre);
		$stmt = $db->bindParam(':apellido', $apellido);
		$stmt = $db->bindParam(':telefono', $telefono);
		$stmt = $db->bindParam(':email', $email);
		$stmt = $db->bindParam(':direccion', $direccion);
		$stmt = $db->bindParam(':ciudad', $ciudad);
		$stmt = $db->bindParam(':departamento', $departamento);
		//exportar y mostrar en JSON un solo cliente
		echo '{"notice": {"text": "Cliente agregado"}';
	}catch(PDOException $e){
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
});



/*
*	Funcion que me permite actualizar un Cliente en concreto
*/
$app->put('/api/clientes/actualizar/{id}', function(Request $request,Response $response){
	
	$id = $request->getAttribute('id');

	$nombre = $request->getParam('nombre');
	$apellido = $request->getParam('apellido');
	$telefono = $request->getParam('telefono');
	$email = $request->getParam('email');
	$direccion = $request->getParam('direccion');
	$ciudad = $request->getParam('ciudad');
	$departamento = $request->getParam('departamento');

	$consulta = "UPDATE cliente SET

				nombre = :nombre,

				apellido = :apellido,

				telefono = :telefono,

				email = :email,

				direccion = :direccion,

				ciudad = :ciudad,

				departamento = :departamento,

				WHERE id = $id";
	try{

		//instanciacion de BD
		$db = new db();

		//conexion

		$db = $db->conectar();
		$stmt = $db->prepare($consulta);
		$stmt = $db->bindParam(':nombre', $nombre);
		$stmt = $db->bindParam(':apellido', $apellido);
		$stmt = $db->bindParam(':telefono', $telefono);
		$stmt = $db->bindParam(':email', $email);
		$stmt = $db->bindParam(':direccion', $direccion);
		$stmt = $db->bindParam(':ciudad', $ciudad);
		$stmt = $db->bindParam(':departamento', $departamento);
		//exportar y mostrar en JSON un solo cliente
		echo '{"notice": {"text": "Cliente Actualizado"}';
	}catch(PDOException $e){
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
});


/*
*	Funcion que me permite eliminar un cliente
*/

$app->delete('/api/clientes/borrar/{id}', function(Request $request,Response $response){
	$id = $request->getAttribute('id');

	$consulta = "delete() FROM cliente WHERE id = '$id'";
	try{
		//instanciacion de BD
		$db = new db();

		//conexion

		$db = $db->conectar();
		$stmt = $db->prepare($consulta);
		$stmt->execute();
		$db = null; //para cerrar la conexion
		echo '{"notice": {"text": "Cliente Borrado	"}';
		//exportar y mostrar en JSON un solo cliente

		echo json_encode($cliente);
	}catch(PDOException $e){
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
});


?>