<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

//Obtener todos los clientes

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

?>