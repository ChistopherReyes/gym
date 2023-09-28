<?php 
include("../../bd.php"); 
if($_POST){

    // Recepcionamos los valores del formulario
    $titulo=(isset($_POST['titulo']))?$_POST['titulo']:"";
    $subtitulo=(isset($_POST['subtitulo']))?$_POST['subtitulo']:"";
    $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
    $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
    $proveedor=(isset($_POST['proveedor']))?$_POST['proveedor']:"";
    $categoria=(isset($_POST['categoria']))?$_POST['categoria']:"";


    $fecha_imagen=new DateTime();
    $nombre_archivo_imagen=($imagen!="")? $fecha_imagen->getTimestamp()."_".$imagen:"";

    $tmp_imagen=$_FILES["imagen"]["tmp_name"];
    if($tmp_imagen!=""){
        move_uploaded_file($tmp_imagen,"../../../assets/img/portfolio/".$nombre_archivo_imagen);
    }


    $sentencia=$conexion->prepare("INSERT INTO `tbl_portafolio`
     (`ID`, `titulo`, `subtitulo`, `imagen`, `descripcion`, `proveedor`, `categoria`) 
     VALUES (NULL,:titulo,:subtitulo,:imagen,:descripcion,:proveedor,:categoria);");;
    
    $sentencia->bindParam(":titulo",$titulo);
    $sentencia->bindParam(":subtitulo",$subtitulo);
    $sentencia->bindParam(":imagen",$nombre_archivo_imagen);
    $sentencia->bindParam(":descripcion",$descripcion);
    $sentencia->bindParam(":proveedor",$proveedor);
    $sentencia->bindParam(":categoria",$categoria);
    
    
    $sentencia->execute();
    $mensaje="Producto agregado con éxito.";
    header("Location:index.php?mensaje=".$mensaje);


}
include("../../templates/header.php"); 
?>


<div class="card">
    <div class="card-header">
        Agregar Productos
    </div>
    <div class="card-body">
    <form action="" enctype="multipart/form-data" method="post">

<div class="mb-3">
  <label for="titulo" class="form-label">Titulo:</label>
  <input type="text"
    class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Título">
</div>

<div class="mb-3">
  <label for="subtitulo" class="form-label">Subtitulo:</label>
  <input type="text"
    class="form-control" name="subtitulo" id="subtitulo" aria-describedby="helpId" placeholder="subtitulo">
</div>

<div class="mb-3">
  <label for="imagen" class="form-label">Imagen:</label>
  <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Imagen" aria-describedby="fileHelpId">
</div>

<div class="mb-3">
  <label for="descripcion" class="form-label">Descripción del Producto:</label>
  <input type="text"
    class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripción">
</div>

<div class="mb-3">
  <label for="proveedor" class="form-label">Proveedor:</label>
  <input type="text"
    class="form-control" name="proveedor" id="proveedor" aria-describedby="helpId" placeholder="Proveedor">
</div>

<div class="mb-3">
  <label for="categoria" class="form-label">Categoría:</label>
  <input type="text"
    class="form-control" name="categoria" id="categoria" aria-describedby="helpId" placeholder="Categoría">
</div>

<button type="submit" class="btn btn-success">Agregar</button>

    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

</form>

    </div>
    <div class="card-footer text-muted">
        
    </div>
</div>





<?php include("../../templates/footer.php"); ?>


