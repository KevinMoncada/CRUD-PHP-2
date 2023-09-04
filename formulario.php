<?php
include("conexion.php"); //Incluimos el archivo de conexion y asi podemos usar las variables creadas en ese documento
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Document</title>
    <?php
            $nitocc="";
            $nombre="";
            $direccion="";
            $telefono="";
            $fechaingreso="";
            $cupocredito="";
            $foto="";
            if(isset($_POST['buscar']))
            {
                $nitoccbuscar=$_POST['nitoccbus'];//Valor que nos escriben en el input de buscar, que corresponde al nit o cc que se desea buscar
                $consulta=$conexion->query("select * from tblcliente where nitocc='$nitoccbuscar'");
                while($resultadoconsulta=$consulta->fetch_array())
                {
                    $nitocc=$resultadoconsulta[0];
                    $nombre=$resultadoconsulta[1];
                    $direccion=$resultadoconsulta[2];
                    $telefono=$resultadoconsulta[3];
                    $fechaingreso=$resultadoconsulta[4];
                    $cupocredito=$resultadoconsulta[5];
                    $foto=$resultadoconsulta[6];
                }
            }
    ?>
</head>
<body>
    <center>
            <h2>Manipulación de datos con PHP</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <label for="">Buscar:</label>
                <input type="text" name="nitoccbus" id="" placeholder="Buscar Cliente">
                <input type="submit" value="Buscar" name="buscar" >
                <input type="submit" value="Listar todos los clientes" name="listar">
                <hr>
               </form>
               <form action="consultas.php" method="post" enctype="multipart/form-data">
                <label for="">Nit o CC:</label>
                <input type="text" name="nitocc" id="" placeholder="Ingrese el nit o cc del nuevo cliente" value="<?php echo  $nitocc; ?>">
                <br> <br>
                <label for="">Nombres:</label>
                <input type="text" name="nombre" id="" placeholder="Ingresa el nombre completo" value="<?php echo $nombre;  ?>">
                <br> <br>
                <label for="">Dirección:</label>
                <input type="text" name="direccion" id="" placeholder="Ej: Cll 34#12-20" value="<?php echo $direccion; ?>">
                <br> <br>
                <label for="">Telefono:</label>
                <input type="number" name="telefono" id="" placeholder="Ej: 300-2345-6789" value="<?php echo $telefono; ?>">
                <br> <br>
                <label for="">Fecha de Ingreso:</label>
                <input type="date" name="fechaingreso" id="" value="<?php echo $fechaingreso ?>">
                <br> <br>
                <label for="">Cupo del credito:</label>
                <input type="number" name="cupocredito" id="" placeholder="$ valor en pesos" value="<?php echo $cupocredito ?>">
                <br> <br>
                <label for="">Subir foto:</label>
                <input type="file" name="foto" id="">
                <br><br>
                <label for="">Foto:</label>
                <img src="<?php echo $foto ?>" alt="" width="80" height="80">
                <br> <br>
                <input type="submit" value="Guardar Nuevo Cliente" name="guardar">
                <input type="submit" value="Actualizar Cliente" name="actualizar">
                <input type="submit" value="Eliminar Cliente" name="eliminar">
            </form>
    </center>
       <?php
                if (isset($_POST['listar'])){
                    echo "<center>
                    <table border = '3'>
                    <tr>
                    <th>Nit o CC</th>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Fecha de Ingreso</th>
                    <th>Cupo de Credito </th>
                    <th>Foto del Cliente</th>
                    </tr>";
                    $buscar = $conexion-> query("select * from tblcliente");
                    while($resultado = $buscar->fetch_array()){
                        $nitocc = $resultado[0];
                        $nombre = $resultado[1];
                        $direccion = $resultado[2];
                        $telefono = $resultado[3];
                        date_default_timezone_set('America/Bogota');
                        $fechaingreso = date("d-m-Y",strtotime($resultado[4]));
                        $cupocredito =number_format ($resultado[5]);
                        $foto=$resultado[6];
                        echo"<tr>
                        <td>$nitocc</td>
                        <td>$nombre</td>
                        <td>$direccion</td>
                        <td>$telefono</td>
                        <td>$fechaingreso</td>
                        <td>$cupocredito</td>
                        <td>
                        <img src='$foto' width = '30%' height='30%'>
                        </td>
                        </tr>";
                    
                    }
                
                    echo  "</table></center>";
                 }
       ?>

</body>
</html>