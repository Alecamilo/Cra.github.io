<?php
	include_once 'conexion.php';

	$sentencia_select=$con->prepare('SELECT *FROM usuarios ORDER BY id DESC');
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();

	// metodo buscar
	if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscar=$con->prepare('SELECT *FROM usuarios WHERE nombre LIKE :campo OR apellido LIKE :campo;');

		$select_buscar->execute(array(
			':campo' =>"%".$buscar_text."%"
		));

		$resultado=$select_buscar->fetchAll();

	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="estillo.css">
</head>
<body>
    <div class="contenedor">
        <h2>Crud en PHP con MYSQL</h2>
        <div class="barra_buscador">
            <form action="" class="formulario" method="post">
                <input type="text" name="buscar" placeholder="buscar nombre o apellido" 
				value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
				<input type="submit" class="btn" name="btn_buscar" value="Buscar">
				<a href="insert.php" class="btn btn__nuevo">Nuevo</a>
			</form>
        </div>
        <table>
            <tr class="head">
                <td>id</td>
                <td>nombre</td>
                <td>apellido</td>
                <td>cedula</td>
                <td colspan="2">Acción</td>
            </tr>
            <?php foreach($resultado as $fila):?>
				<tr >
					<td><?php echo $fila['id']; ?></td>
					<td><?php echo $fila['nombre']; ?></td>
					<td><?php echo $fila['apellido']; ?></td>
					<td><?php echo $fila['cedula']; ?></td>
					<td><a href="update.php?id=<?php echo $fila['id']; ?>"  class="btn__update" >Editar</a></td>
					<td><a href="delete.php?id=<?php echo $fila['id']; ?>" class="btn__delete">Eliminar</a></td>
				</tr>
			<?php endforeach ?>
        </table>
    </div>
</body>
</html>