<h1 class="display-4">Solicitar hora</h1>
<?php echo validation_errors(); ?>
<?php if(isset($message)){ ?>
<div class="alert alert-warning">
    <p>
        <i class="fa fa-exclamation" aria-hidden="true"></i> <?php echo $message; ?>
    </p>
</div>
<?php } ?>
<?php echo form_open('datomed/agenda/create'); ?>
<table class="table table-striped">
    <tr>
        <td>Elegir Especialidad M&eacute;dica:</td>
        <td>
            <select name="especialidad_med_create" class="form-control">
                <option value="-0" selected="selected" disabled="disabled">Especialidad m&eacute;dica</option>
                <?php
                    for($n = 0; $n < count($esp_lista); $n++){
                        echo "<option value=\"".$esp_lista[$n]['id']."\">".$esp_lista[$n]['nombre']."</option>";
                    }
                ?>                
            </select>

        </td>
    </tr>
    <tr class="medico_agenda_create">
        <td>Elegir Doctor:</td>
        <td>
                    <span id="show_docs_filter"></span>
        </td>
    </tr>
    <tr class="medico_agenda_create">
        <td>Tipo de Atenci&oacute;n:</td>
        <td>
            <select name="atencion" class="form-control">
            <option value="-0" selected="selected" disabled="disabled">Elegir Tipo de Atenci&oacute;n:</option>
            <option value="1">Atención Presencial</option>
            <option value="2">Atención TeleMedicina</option>
            </select>
        </td>
    </tr>    
    <tr class="medico_agenda_create">
        <td>Elegir Fecha de atenci&oacute;n:</td>
        <td>
        <input type="date" name="fecha" class="form-control">
        </td>
    </tr>
    <tr class="medico_agenda_create">
        <td>Elegir Hora de atenci&oacute;n:</td>
        <td>
        <input type="time" name="hora" class="form-control">
        </td>
    </tr>
    <tr class="medico_agenda_create">
        <td>Motivo consulta:</td>
        <td>
        <textarea class="form-control" name="motivo" rows="3"></textarea>        
        </td>
    </tr>          
	<tr class="medico_agenda_create">
        <td colspan="2">
            <input type="submit" class="btn btn-primary" value="Solicitar nueva cita m&eacute;dica">
        </td>
	</tr>	
</table>
<?php echo form_close(); ?>