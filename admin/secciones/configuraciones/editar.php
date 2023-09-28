<?php 
include("../../bd.php");

if(isset($_GET['txtID'])){
    //recuperar los datos del ID 
    $txtID=( isset($_GET['txtID']) )?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM tbl_configuraciones WHERE id=:id ");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $nombreConfiguracion=$registro['nombreConfiguracion'];
    $valor=$registro['valor'];

    }

    if($_POST){

        // Recepcionamos los valores del formulario
            $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
            $nombreConfiguracion=(isset($_POST['nombreConfiguracion']))?$_POST['nombreConfiguracion']:"";
            $valor=(isset($_POST['valor']))?$_POST['valor']:"";
    
            
            $sentencia=$conexion->prepare("UPDATE tbl_configuraciones 
            SET nombreConfiguracion=:nombreConfiguracion,valor=:valor WHERE id=:id ");
        
            $sentencia->bindParam(":nombreConfiguracion",$nombreConfiguracion);
            $sentencia->bindParam(":valor",$valor);
            $sentencia->bindParam(":id",$txtID);
            $sentencia->execute();
    
            $mensaje="Configuración modificada con éxito.";
            header("Location:index.php?mensaje=".$mensaje);
        
        
        }

include("../../templates/header.php"); 
?>

<div class="card">
    <div class="card-header">
        Configuración
    </div>
    <div class="card-body">

    <form action="" method="post">
   
    <div class="mb-3">
      <label for="txtID" class="form-label">ID:</label>
      <input readonly value="<?php echo $txtID;?>" type="text"
        class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
    </div>

    <div class="mb-3">
      <label for="nombreConfiguracion" class="form-label">Nombre:</label>
      <input readonly value="<?php echo $nombreConfiguracion;?>" type="text"
        class="form-control" name="nombreConfiguracion" id="nombreConfiguracion" aria-describedby="helpId" placeholder="Nombre de la configuracion">

    </div>
    
    <div class="mb-3">
      <label for="valor" class="form-label">Valor:</label>
      <input value="<?php echo $valor;?>" type="text"
        class="form-control" name="valor" id="valor" aria-describedby="helpId" placeholder="Valor de la configuración">

    </div>

    <button type="submit" class="btn btn-success">Aceptar</button>

    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


    </form>
    </div>
    <div class="card-footer text-muted">
    
    
</div>

<?php include("../../templates/footer.php"); ?>
