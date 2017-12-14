<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

// Obtener todos los estudiantes

$app->get('/api/estudiantes', function(Request $request, Response $response){
	//echo "Estudiantes";
	$sql = "select * from estudiante";

	try{
		// Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->query($sql);
        $estudiantes = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($estudiantes);
	} catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Obtener un estudiante por Numero de control
$app->get('/api/estudiantes/{Num_control}', function(Request $request, Response $response){
    $Num_control = $request->getAttribute('Num_control');

    $sql = "SELECT * FROM estudiante WHERE Num_control = $Num_control";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->query($sql);
        $estudiantes = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($estudiantes);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Agregar un estudiante
$app->post('/api/estudiantes/add', function(Request $request, Response $response){
    $Num_control = $request->getParam('Num_control');
    $Nombre_estudiante = $request->getParam('Nombre_estudiante');
    $Apellido_p_estudiante = $request->getParam('Apellido_p_estudiante');
    $Apellido_m_estudiante = $request->getParam('Apellido_m_estudiante');
    $Semestre = $request->getParam('Semestre');
    $Carrera_Clave = $request->getParam('Carrera_Clave');

    $sql = "INSERT INTO estudiante (Num_control,Nombre_estudiante, Apellido_p_estudiante, Apellido_m_estudiante, Semestre, Carrera_Clave) VALUES (:Num_control, :Nombre_estudiante, :Apellido_p_estudiante, :Apellido_m_estudiante, :Semestre, :Carrera_Clave)";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':Num_control',      $Num_control);
        $stmt->bindParam(':Nombre_estudiante',         $Nombre_estudiante);
        $stmt->bindParam(':Apellido_p_estudiante',      $Apellido_p_estudiante);
        $stmt->bindParam(':Apellido_m_estudiante',      $Apellido_m_estudiante);
        $stmt->bindParam(':Semestre',       $Semestre);
        $stmt->bindParam(':Carrera_Clave',  $Carrera_Clave);

        $stmt->execute();

        echo '{"notice": {"text": "Estudiante agregado"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Actualizar un estudiante
$app->put('/api/estudiantes/update/{Num_control}', function(Request $request, Response $response){
    $Num_control = $request->getParam('Num_control');
    $Nombre_estudiante = $request->getParam('Nombre_estudiante');
    $Apellido_p_estudiante = $request->getParam('Apellido_p_estudiante');
    $Apellido_m_estudiante = $request->getParam('Apellido_m_estudiante');
    $Semestre = $request->getParam('Semestre');
    $Carrera_Clave = $request->getParam('Carrera_Clave');

    $sql = "UPDATE estudiante SET
                Num_control              = :Num_control,
                Nombre_estudiante       = :Nombre_estudiante,
                Apellido_p_estudiante   =    :Apellido_p_estudiante,
                Apellido_m_estudiante  =    :Apellido_m_estudiante,
                Semestre                = :Semestre,
                Carrera_Clave           = :Carrera_Clave
            WHERE Num_control = $Num_control";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':Num_control',      $Num_control);
        $stmt->bindParam(':Nombre_estudiante',         $Nombre_estudiante);
        $stmt->bindParam(':Apellido_p_estudiante',      $Apellido_p_estudiante);
        $stmt->bindParam(':Apellido_m_estudiante',      $Apellido_m_estudiante);
        $stmt->bindParam(':Semestre',       $Semestre);
        $stmt->bindParam(':Carrera_Clave',  $Carrera_Clave);

        $stmt->execute();

        echo '{"notice": {"text": "Estudiante actualizado"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Borrar estudiante
$app->delete('/api/estudiantes/delete/{Num_control}', function(Request $request, Response $response){
    $Num_control = $request->getAttribute('Num_control');

    $sql = "DELETE FROM estudiante WHERE Num_control = $Num_control";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "Estudiante eliminado"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


//CARRERA
// Obtener todas las carreras

$app->get('/api/carrera', function(Request $request, Response $response){
	//echo "carrera";
	$sql = "select * from carrera";

	try{
		// Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->query($sql);
        $carrera = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
      //  echo json_encode($carrera);
      print_r($carrera);
	} catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Obtener una carrera por clave
$app->get('/api/carrera/{Clave_carrera}', function(Request $request, Response $response){
    $Clave_carrera = $request->getAttribute('Clave_carrera');

    $sql = "SELECT * FROM carrera WHERE Clave_carrera = $Clave_carrera";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->query($sql);
        $carrera = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($carrera);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Agregar una carrera

$app->post('/api/carrera/add', function(Request $request, Response $response){
    $Clave_carrera = $request->getParam('Clave_carrera');
    $Nombre_carrera = $request->getParam('Nombre_carrera');


    $sql = "INSERT INTO carrera (Clave_carrera, Nombre_carrera) VALUES (:Clave_carrera, :Nombre_carrera)";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':Clave_carrera', $Clave_carrera);
        $stmt->bindParam(':Nombre_carrera',$Nombre_carrera);


        $stmt->execute();

        echo '{"notice": {"text": "carrera agregada"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Actualizar carrera
$app->put('/api/carrera/update/{Clave_carrera}', function(Request $request, Response $response){
    $Clave_carrera = $request->getParam('Clave_carrera');
    $Nombre_carrera = $request->getParam('Nombre_carrera');


    $sql = "UPDATE carrera SET
                Clave_carrera              = :Clave_carrera,
                Nombre_carrera       = :Nombre_carrera
            WHERE Clave_carrera = $Clave_carrera";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':Clave_carrera',      $Clave_carrera);
        $stmt->bindParam(':Nombre_carrera',         $Nombre_carrera);

        $stmt->execute();

        echo '{"notice": {"text": "Carrera actualizada"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Borrar carrera
$app->delete('/api/carrera/delete/{Clave_carrera}', function(Request $request, Response $response){
    $Clave_carrera = $request->getAttribute('Clave_carrera');

    $sql = "DELETE FROM carrera WHERE Clave_carrera = $Clave_carrera";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "carrera eliminado"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


//DEPARTAMENTO

// Obtener todos los departamentos

$app->get('/api/departamento', function(Request $request, Response $response){
	//echo "departamento";
	$sql = "select * from departamento";

	try{
		// Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->query($sql);
        $departamento = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
      //  echo json_encode($departamento);
      print_r($departamento);
	} catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Obtener un departamento por clave
$app->get('/api/departamento/{Clave_departamento}', function(Request $request, Response $response){
    $Clave_departamento = $request->getAttribute('Clave_departamento');

    $sql = "SELECT * FROM departamento WHERE Clave_departamento = $Clave_departamento";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->query($sql);
        $departamento = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($departamento);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Agregar un departamento

$app->post('/api/departamento/add', function(Request $request, Response $response){
    $Clave_departamento = $request->getParam('Clave_departamento');
    $Nombre_departamento = $request->getParam('Nombre_departamento');
		$Trabajador_rfc = $request->getParam('Trabajador_rfc');


    $sql = "INSERT INTO departamento (Clave_departamento, Nombre_departamento, Trabajador_rfc) VALUES (:Clave_departamento, :Nombre_departamento, :Trabajador_rfc)";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':Clave_departamento', $Clave_departamento);
        $stmt->bindParam(':Nombre_departamento',$Nombre_departamento);
				$stmt->bindParam(':Trabajador_rfc' ,$Trabajador_rfc);


        $stmt->execute();

        echo '{"notice": {"text": "departamento agregado"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Actualizar departamento
$app->put('/api/departamento/update/{Clave_departamento}', function(Request $request, Response $response){
    $Clave_departamento = $request->getParam('Clave_departamento');
    $Nombre_departamento = $request->getParam('Nombre_departamento');
		$Trabajador_rfc=$request->getParam('Trabajador_rfc');


    $sql = "UPDATE departamento SET
                Clave_departamento       = :Clave_departamento,
                Nombre_departamento      = :Nombre_departamento,
								Trabajador_rfc           = :Trabajador_rfc

            WHERE Clave_departamento = $Clave_departamento";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':Clave_departamento',   $Clave_departamento);
        $stmt->bindParam(':Nombre_departamento',  $Nombre_departamento);
				$stmt->bindParam(':Trabajador_rfc',  $Trabajador_rfc);


        $stmt->execute();

        echo '{"notice": {"text": "departamento actualizado"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Borrar departamento
$app->delete('/api/departamento/delete/{Clave_departamento}', function(Request $request, Response $response){
    $Clave_departamento = $request->getAttribute('Clave_departamento');

    $sql = "DELETE FROM departamento WHERE Clave_departamento = '".$Clave_departamento."'";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "departamento eliminado"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

//INSTITUTOS

//mostrar todos los institutos
$app->get('/api/instituto', function(Request $request, Response $response){
	//echo "instituto";
	$sql = "select * from instituto";

	try{
		// Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->query($sql);
        $instituto = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
    //  echo json_encode($instituto);
      print_r($instituto);
	} catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Obtener un instituto por clave
$app->get('/api/instituto/{Clave_instituto}', function(Request $request, Response $response){
    $Clave_instituto = $request->getAttribute('Clave_instituto');

    $sql = "SELECT * FROM instituto WHERE Clave_instituto = $Clave_instituto";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->query($sql);
        $instituto = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
      print_r($instituto);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Agregar un instituto

$app->post('/api/instituto/add', function(Request $request, Response $response){
    $Clave_instituto = $request->getParam('Clave_instituto');
    $Nombre_instituto = $request->getParam('Nombre_instituto');

    $sql = "INSERT INTO instituto (Clave_instituto, Nombre_instituto) VALUES (:Clave_instituto, :Nombre_instituto)";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':Clave_instituto', $Clave_instituto);
        $stmt->bindParam(':Nombre_instituto',$Nombre_instituto);

        $stmt->execute();

        echo '{"notice": {"text": "instituto agregado"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Actualizar instituto

$app->put('/api/instituto/update/{Clave_instituto}', function(Request $request, Response $response){
    $Clave_instituto = $request->getParam('Clave_instituto');
    $Nombre_instituto = $request->getParam('Nombre_instituto');

    $sql = "UPDATE instituto SET
                Clave_instituto       = :Clave_instituto,
                Nombre_instituto      = :Nombre_instituto

            WHERE Clave_instituto = '".$Clave_instituto."'";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':Clave_instituto',   $Clave_instituto);
        $stmt->bindParam(':Nombre_instituto',  $Nombre_instituto);

        $stmt->execute();

        echo '{"notice": {"text": "instituto actualizado"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Borrar instituto
$app->delete('/api/instituto/delete/{Clave_instituto}', function(Request $request, Response $response){
    $Clave_instituto = $request->getAttribute('Clave_instituto');

    $sql = "DELETE FROM instituto WHERE Clave_instituto = '".$Clave_instituto."'";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "instituto eliminado"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

//trabajador
//todos los trabajadores
$app->get('/api/trabajador', function(Request $request, Response $response){
    //echo "trabajador";
    $sql = "select * from trabajador";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->query($sql);
        $trabajador = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //  echo json_encode($trabajador);
        print_r($trabajador);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Obtener un trabajador por rfc
$app->get('/api/trabajador/{RFC_trabajador}', function(Request $request, Response $response){
    $RFC_trabajador = $request->getAttribute('RFC_trabajador');

    $sql = "SELECT * FROM trabajador WHERE RfC_trabajador = $RFC_trabajador";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->query($sql);
        $trabajador = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($trabajador);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Agregar un trabajador
$app->post('/api/trabajador/add', function(Request $request, Response $response){
    $rfc_trabajador = $request->getParam('rfc_trabajador');
    $Nombre_trabajador = $request->getParam('Nombre_trabajador');
    $Apellido_p_trabajador = $request->getParam('Apellido_p_trabajador');
    $Apellido_m_trabajador = $request->getParam('Apellido_m_trabajador');
    $Clave_presupuestal = $request->getParam('Clave_presupuestal');


    $sql = 	"INSERT INTO trabajador (rfc_trabajador, Nombre_trabajador,Apellido_p_trabajador,Apellido_m_trabajador,Clave_presupuestal) VALUES (:rfc_trabajador,:Nombre_trabajador,:Apellido_p_trabajador,:Apellido_m_trabajador,:Clave_presupuestal)";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':rfc_trabajador',          $rfc_trabajador);
        $stmt->bindParam(':Nombre_trabajador',       $Nombre_trabajador);
        $stmt->bindParam(':Apellido_p_trabajador',              $Apellido_p_trabajador);
        $stmt->bindParam(':Apellido_m_trabajador',              $Apellido_m_trabajador);
        $stmt->bindParam(':Clave_presupuestal',      $Clave_presupuestal);


        $stmt->execute();

        echo '{"notice": {"text": "trabajador agregado"}';

    } catch(PDOException $e){

        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Actualizar trabajador
$app->put('/api/trabajador/update/{rfc_trabajador}', function(Request $request, Response $response){
    $rfc_trabajador = $request->getParam('rfc_trabajador');
    $Nombre_trabajador = $request->getParam('Nombre_trabajador');
    $Apellido_p_trabajador = $request->getParam('Apellido_p_trabajador');
    $Apellido_m_trabajador = $request->getParam('Apellido_m_trabajador');
    $Clave_presupuestal = $request->getParam('Clave_presupuestal');



    $sql = "UPDATE trabajador SET
           rfc_trabajador            = :rfc_trabajador,
           nombre_trabajador         = :Nombre_trabajador,
           Apellido_p_trabajador              = :Apellido_p_trabajador,
           Apellido_m_trabajador                = :Apellido_m_trabajador,
           clave_presupuestal        = :clave_presupuestal
            WHERE rfc_trabajador = $rfc_trabajador";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':rfc_trabajador',   $rfc_trabajador);
        $stmt->bindParam(':Nombre_trabajador',  $Nombre_trabajador);
        $stmt->bindParam(':Apellido_p_trabajador',   $Apellido_p_trabajador);
        $stmt->bindParam(':Apellido_m_trabajador',   $Apellido_m_trabajador);
        $stmt->bindParam(':clave_presupuestal',   $clave_presupuestal);

        $stmt->execute();

        echo '{"notice": {"text": "trabajor actualizado"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Borrar trabajador
$app->delete('/api/trabajador/delete/{rfc_trabajador}', function(Request $request, Response $response){
    $rfc_trabajador = $request->getAttribute('rfc_trabajador');

    $sql = "DELETE FROM trabajador WHERE rfc_trabajador = $rfc_trabajador";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "trabajador eliminado"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

//actividad complementaria
//MOSTRARA TODAS LAS ACTIVIDADES COMPLEMENTARIAS
$app->get('/api/actividad_comp', function(Request $request, Response $response){

    $sql = "select * from actividad_comp";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->query($sql);
        $actividad_comp = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
echo json_encode($actividad_comp);
        //print_r($actividad_comp);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Obtener una actividad por clave
$app->get('/api/actividad_comp/{Num_actividad}', function(Request $request, Response $response){
    $Num_actividad = $request->getAttribute('Num_actividad');

    $sql = "SELECT * FROM actividad_comp WHERE Num_actividad = $Num_actividad";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->query($sql);
        $actividad_comp = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($actividad_comp);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Agregar una actividad
$app->post('/api/actividad_comp/add', function(Request $request, Response $response){
    $Num_actividad = $request->getParam('Num_actividad');
    $Nombre_actividad = $request->getParam('Nombre_actividad');

    $sql = 	"INSERT INTO actividad_comp (Num_actividad, Nombre_actividad) VALUES (:Num_actividad,:Nombre_actividad)";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':Num_actividad',          $Num_actividad);
        $stmt->bindParam(':Nombre_actividad',       $Nombre_actividad);

        $stmt->execute();

        echo '{"notice": {"text": "actividad agregada"}';

    } catch(PDOException $e){

        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Actualizar actividad complementaria
$app->put('/api/actividad_comp/update/{Num_actividad}', function(Request $request, Response $response){
    $Num_actividad = $request->getParam('Num_actividad');
    $Nombre_actividad = $request->getParam('Nombre_actividad');

    $sql = "UPDATE actividad_comp SET
           Num_actividad            = :Num_actividad,
           Nombre_actividad         = :Nombre_actividad

            WHERE Num_actividad = $Num_actividad";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':Num_actividad',   $Num_actividad);
        $stmt->bindParam(':Nombre_actividad',  $Nombre_actividad);

        $stmt->execute();

        echo '{"notice": {"text": "actividad actualizada"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Borrar actividad complementaria
$app->delete('/api/actividad_comp/delete/{Num_actividad}', function(Request $request, Response $response){
    $Num_actividad = $request->getAttribute('Num_actividad');

    $sql = "DELETE FROM actividad_comp WHERE Num_actividad = $Num_actividad";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "actividad complementaria"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
