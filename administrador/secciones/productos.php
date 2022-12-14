<?php include("../template/cabecera.php"); ?>

<?php
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";


include("../configuraciones/base.php");








switch($accion){
    // INSERT INTO `productos` (`id`, `nombre`, `imagen`) VALUES (NULL, 'Gatitos enamorados', 'imagen.jpg');
    
    
    case "Agregar":

        $sentenciaSQL= $conexion->prepare("INSERT INTO productos (nombre,imagen) VALUES (:nombre,:imagen);");
        $sentenciaSQL->bindParam('nombre',$txtNombre);
        
        $fecha= new DateTime();
        $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
        $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
        if($tmpImagen!=""){

            move_uploaded_file($tmpImagen,"../../Resources/img".$nombreArchivo);
        }
        
        
        $sentenciaSQL->bindParam('imagen',$nombreArchivo);
        $sentenciaSQL->execute();

        header("Location:productos.php");
        
        break;
    case "Modificar":
        $sentenciaSQL= $conexion->prepare("UPDATE productos SET nombre=:nombre WHERE id=:id");
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();


        // Para la imagen
        if($txtImagen!=""){
            
            $fecha= new DateTime();
            $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
            move_uploaded_file($tmpImagen,"../../Resources/img".$nombreArchivo);


            $sentenciaSQL= $conexion->prepare("SELECT imagen FROM productos WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
            $productos=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if( isset ($productos["imagen"])&&($productos["imagen"]!="imagen.jpg") ) {
           
            if(file_exists("../../Resources/img".$productos["imagen"])){

               unlink("../../Resources/img".$productos["imagen"]); 

            }
        }


            $sentenciaSQL= $conexion->prepare("UPDATE productos SET imagen=:imagen WHERE id=:id");
            $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
        }
        header("Location:productos.php");

            break;
    case "Cancelar":
        header("Location:productos.php");
            break;
            
     case "Seleccionar":
        // echo "presionado bot??n Seleccionar";
        
        $sentenciaSQL= $conexion->prepare("SELECT * FROM productos WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $productos=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtNombre=$productos['nombre'];
        $txtImagen=$productos['imagen'];

            break;
     case "Borrar":

        $sentenciaSQL= $conexion->prepare("SELECT imagen FROM productos WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $productos=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if( isset ($productos["imagen"])&&($productos["imagen"]!="imagen.jpg") ) {
           
            if(file_exists("../../Resources/img".$productos["imagen"])){

               unlink("../../Resources/img".$productos["imagen"]); 

            }
        }

         $sentenciaSQL= $conexion->prepare("DELETE FROM productos WHERE id=:id");
         $sentenciaSQL->bindParam(':id',$txtID);
         $sentenciaSQL->execute();
        

         header("Location:productos.php");
             break;




}




$sentenciaSQL= $conexion->prepare("SELECT * FROM productos");
$sentenciaSQL->execute();
$listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);






?>


<div class="col-md-5">
  <!-- Formulario para agregar productos -->

 <div class="card">
    <div class="card-header">
        Datos del producto
    </div>

    <div class="card-body">
        
        <form method="POST" enctype="multipart/form-data" >

            <div class = "form-group">
                <label for="txtID">ID:</label>
                <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID">
            </div>

            <div class = "form-group">
                <label for="txtNombre">Nombre:</label>
                <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre del producto">
            </div>

            <div class = "form-group">
                <label for="txtImagen">Imagen:</label>

                <br>
                
                <?php if($txtImagen!=""){ ?> 

                    <img class="img-thumbnail rounded" src="../../Resources/img<?php echo $txtImagen; ?>" width="50" alt="" srcset="">  
                 <?php      
                    }
                ?>

                <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Imagen">
            </div>

            <div class="btn-group" role="group" aria-label="">
                <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="Agregar" class="btn btn-success">Agregar</button>
                <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Modificar" class="btn btn-warning">Modificar</button>
                <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Cancelar" class="btn btn-danger">Cancelar</button>
            </div>


        </form>




    </div>
   
</div>

  
  
  

</div>

<div class="col-md-7">
    <!-- Tahbla de los productos para gestionarlo -->

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

          <?php foreach($listaProductos as $productos) { ?>
                <tr>
                    <td><?php echo $productos['id']; ?></td>
                    <td><?php echo $productos['nombre']; ?></td>
                    <td>        
                    <img class="img-thumbnail rounded" src="../../Resources/img<?php echo $productos['imagen']; ?>" width="50" alt="" srcset="">
                    </td>
                    
                    <td> 
                
                    <form method="post">
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $productos['id']; ?>">
                        <input type="submit" name="accion"  value="Seleccionar" class="btn btn-info"/>
                         <input type="submit" name="accion"  value="Borrar" class="btn btn-danger"/>                 
                    </form>

                    </td>
                
                
                
                </tr>
         <?php } ?> 
            </tbody>
        </table>



</div>

<?php include("../template/pie.php"); ?>