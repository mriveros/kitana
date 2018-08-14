<?php  //modulo de session
    session_start();
    $usuario = $_SESSION['usuario'];
    if(!isset($usuario)){
        header("Location: ../index.php");
    }
    include_once('../control/conexion.php');
    include_once('sidebar.php');
    include_once('script.php');
    ini_set('display_errors', 'on');  //muestra los errores de php
    $sql="SELECT * FROM  especialidad";
	$conectando = new Conection();
    $i = 1;
	$query = pg_query($conectando->conectar(), $sql) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
?>
  <div class="content">
        <div id="pad-wrapper" class="form-page"> 
        <h3>Listas de Especialidades</h3><br>
        <div class="row">
            <div class="col col-md-6">
                <a href="especialidades.php" class="btn btn-primary">
                    <i class="icon-plus-sign" ></i>  Registrar Especialidad
                </a>
                
            </div>                                                    
        </div><br><br>
        <div class="row">
         <table class="table table-condensed table-striped table-hover dataTable" id="table_citas">
            <thead>
            <tr>
                <th>#</th>
                <th>Especialidad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody id="tbody">

<?php	if( pg_num_rows($query) > 0 ){

        $resul = pg_fetch_all($query);
            foreach ( $resul as $value) {
?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $value['esp_nom']; ?></td>
                    <td><?php if ($value['esp_activo']=='t'){echo "Activo";}else echo"Inactivo";; ?></td>
                    
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="show_especialidad.php?esp_cod=<?php echo $value['esp_cod'];?>" class="btn btn-info" title="Ver"><i class="icon-eye-open"></i></a>
                            <a href="edit_especialidad.php?esp_cod=<?php echo $value['esp_cod'];?>" class="btn btn-primary" title="Modificar"><i class="icon-pencil"></i></a>
                            <a href="../control/delete_especialidad.php?esp_cod=<?php echo $value['esp_cod'];?>" class="btn btn-danger" title="Eliminar" onclick="if(confirm('&iquest;Esta seguro que desea Eliminar la Especialidad?')) return true;  else return false;"><i class="icon-trash"></i></a>
                        </div>
                    </td>
                </tr>   
<?php   
            }
    }else{ ?>
        
<?php    }
	


?> 
        </tbody>
        </table>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        
    });
       


</script>