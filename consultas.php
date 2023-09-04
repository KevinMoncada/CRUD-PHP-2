<?php 
include("conexion.php");
 //Los datos de entrada almacenados en variables
 $nitocc=$_POST['nitocc'];
 $nombre=$_POST['nombre'];
 $direccion=$_POST['direccion'];
 $telefono=$_POST['telefono'];
 $fechaingreso=$_POST['fechaingreso'];
 $cupocredito=$_POST['cupocredito'];
 //Manejo de archivos:
 $nombre_foto=$_FILES['foto']['name'];//Nombre de la foto
 $ruta=$_FILES['foto']['tmp_name'];//ruta o path del archivo
 $foto='fotos/'.$nombre_foto;//ruta y el nombre del archivo
 


 
 if(isset($_POST['guardar'])) 
 {
  
      //Verificar que no existan valores duplicados para el campo de Nit o CC
      $sqlbuscar="SELECT nitocc FROM tblcliente WHERE nitocc='$nitocc' ORDER BY nitocc";
      if($resultado=mysqli_query($conexion,$sqlbuscar))
      {
          $nroregistros=mysqli_num_rows($resultado);
          if($nroregistros>0)
          {
              echo "<script>alert('Ese NIT o CC ya existe!!');</script>";
          }
          else
          {
            copy($ruta,$foto);//Guarda el archivo en una ruta especifica
              mysqli_query($conexion,"INSERT INTO tblcliente (nitocc,nombre,direccion,telefono,fechaingreso,cupocredito,foto)VALUES ('$nitocc','$nombre','$direccion','$telefono','$fechaingreso','$cupocredito','$foto')");
              echo "<script>alert('Datos Guardados Correctamente')</script>";
          }
      }
      
 }

 if (isset($_POST['actualizar'])) {
  {
      mysqli_query($conexion,"UPDATE tblcliente SET nombre='$nombre', direccion='$direccion',telefono='$telefono',fechaingreso= '$fechaingreso',cupocredito='$cupocredito',foto='$foto' WHERE nitocc ='$nitocc'");
      echo "<script>alert('Datos actualizados correctamente'); window.location.href='formulario.php'</script>";
  }
 }

 

 if(isset($_POST['eliminar'])){

    mysqli_query($conexion, "DELETE FROM tblcliente where nitocc = '$nitocc'");
    echo "<script>alert('Cliente eliminado correctamente'); window.location.href='formulario.php'</script>";
 }

?>