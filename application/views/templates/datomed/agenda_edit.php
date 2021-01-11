<h1 class="display-4">Solicitar hora</h1>
<?php echo validation_errors(); ?>
<?php if(isset($message)){ ?>
<div class="alert alert-warning">
    <p>
        <i class="fa fa-exclamation" aria-hidden="true"></i> <?php echo $message; ?>
    </p>
</div>
<?php } ?>
<?php echo form_open('datomed/agenda/edit'); ?>
<table class="table table-striped">
    <tr>
        <td>Id:</td>
        <td>
            <input type="text" name="id" class="form-control" value="<?php echo $agenda_seleccion[0]['id']; ?>" readonly="">
        </td>
    </tr> 
    <tr>
        <td>Especialidad M&eacute;dica:</td>
        <td>
        <input type="text" name="edit_especialidad_med_create" class="form-control" value="<?php echo $agenda_seleccion[0]['nombre']; ?>" readonly="">
        </td>
    </tr>
    <tr>
        <td>Doctor:</td>
        <td>
        <input type="text" name="edit_agenda_medico_med_create" class="form-control" value="<?php echo $agenda_seleccion[0]['first_name']." ".$agenda_seleccion[0]['last_name']; ?>" readonly="">
        </td>
    </tr>
    <tr>
        <td>Tipo de Atenci&oacute;n:</td>
        <td>
            <?php
                if($agenda_seleccion[0]['tipo_atencion'] == 1){
                    $atencion = "Presencial";
                }else{
                    $atencion = "TeleMedicina";
                }
            ?>
            Tipo de Atenci&oacute;n solicitado anteriormente: <strong><?php echo $atencion; ?></strong>
            <select name="atencion" class="form-control">
            <option value="-0" selected="selected" disabled="disabled">Elegir Tipo de Atenci&oacute;n:</option>
            <option value="1">Atención Presencial</option>
            <option value="2">Atención TeleMedicina</option>
            </select>
        </td>
    </tr>    
    <tr>
        <td>Elegir Fecha de atenci&oacute;n:</td>
        <td>
        <input type="date" name="fecha" class="form-control">
        </td>
    </tr>
    <tr>
        <td>Elegir Hora de atenci&oacute;n:</td>
        <td>
        <input type="time" name="hora" class="form-control">
        </td>
    </tr>
    <tr>
        <td>Motivo consulta:</td>
        <td>
        <textarea class="form-control" name="motivo" rows="3"></textarea>        
        </td>
    </tr>          
	<tr>
        <td colspan="2">
            <input type="submit" class="btn btn-primary" value="ReAgendar cita m&eacute;dica">
        </td>
	</tr>	
</table>
<?php echo form_close(); ?>