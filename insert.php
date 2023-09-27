<?php 
	include_once 'conexion.php';
	
	if(isset($_POST['guardar'])){
		$nombre=$_POST['nombre'];
		$apellido=$_POST['apellido'];
		$cedula=$_POST['cedula'];


		if(!empty($nombre) && !empty($apellido) && !empty($cedula)){
			if(!filter_var($cedula)){
				echo "<script> alert('Cedula no valido');</script>";
			}else{
				$consulta_insert=$con->prepare('INSERT INTO usuarios(nombre,apellido,cedula) VALUES(:nombre,:apellido,:cedula)');
				$consulta_insert->execute(array(
					':nombre' =>$nombre,
					':apellido' =>$apellido,
					':cedula' =>$cedula

				));
				header('Location: index.php');
			}
		}else{
			echo "<script> alert('Los campos estan vacios');</script>";
		}

	}


?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nuevo Cliente</title>
	<link rel="stylesheet" href="estillo.css">
</head>
<body>
	<div class="contenedor">
		<h2>CRUD EN PHP CON MYSQL</h2>
		<form action="" method="post">
			<div class="form-group">
				<input type="text" name="nombre" placeholder="Nombre" class="input__text">
				<input type="text" name="apellido" placeholder="Apellido" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="cedula" placeholder="Cedula" class="input__text">
			</div>
            <div class="btn__group">
				<a href="index.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
</html>