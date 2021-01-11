<h1 class="display-4">Editar Perfil</h1>
<?php echo validation_errors(); ?>
<?php if(isset($message)){ ?>
<div class="alert alert-warning">
    <p>
        <i class="fa fa-exclamation" aria-hidden="true"></i> <?php echo $message; ?>
    </p>
</div>
<?php } ?>
<?php echo form_open('datomed/usuarios/index'); ?>
<table class="table table-striped">
    <tr>
        <td>ID:</td>
        <td>
            <input type="text" name="id" class="form-control" value="<?php echo $info_usuario['user_info']->id; ?>" readonly="">
        </td>
    </tr>
    <tr>
        <td>RUT/DNI:</td>
        <td>
            <input type="text" name="rut" class="form-control" value="<?php echo $info_usuario['user_info']->rut; ?>" readonly="">
        </td>
    </tr>    
    <tr>
        <td>Nombre:</td>
        <td>
        <input type="text" name="nombre" class="form-control" value="<?php echo $info_usuario['user_info']->first_name; ?>">
        </td>
    </tr>
    <tr>
        <td>Apellidos:</td>
        <td>
        <input type="text" name="apellido" class="form-control" value="<?php echo $info_usuario['user_info']->last_name; ?>">
        </td>
    </tr>
    <tr>
        <td>Direcci&oacute;n:</td>
        <td>
        <input type="text" name="direccion" class="form-control" value="<?php echo $info_usuario['user_info']->direccion; ?>">
        </td>
    </tr>
    <tr>
        <td>Contrase&ntilde;a:</td>
        <td>
        <input type="password" name="passwordoriginal" class="form-control" value="">
        <input type="password" name="passwordcheck" class="form-control" value="">
        </td>
    </tr>    
    <?php if(isset($especialidades)) { ?>  
    <tr>
        <td>RUT Colegio M&eacute;dico:</td>
        <td>
        <input type="text" name="rut_m" class="form-control" value="<?php echo $info_usuario['user_info']->rut_colegio_medico; ?>">
        </td>
    </tr>    
    <tr>
        <td>Especialidad:</td>
        <td>
        <select name="especialidad" class="form-control">
        <option value="-0" selected="selected" disabled="disabled">Elegir Especialidad M&eacute;dica:</option>
        <?php
            for($n = 0; $n < count($especialidades); $n++){
                echo "<option value=\"".$especialidades[$n]['id']."\">".$especialidades[$n]['nombre']."</option>";
            }
        ?>
        </select>
        </td>
    </tr>
    <?php } ?>    
	<tr>
        <td colspan="2">
            <input type="submit" class="btn btn-primary" value="Editar">
        </td>
	</tr>	
</table>
<?php echo form_close(); ?>