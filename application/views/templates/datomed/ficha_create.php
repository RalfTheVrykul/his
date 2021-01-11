<h1 class="display-4">Creaci&oacute;n Ficha RME</h1>
<?php echo validation_errors(); ?>
<?php if(isset($message)){ ?>
<div class="alert alert-warning">
    <p>
        <i class="fa fa-exclamation" aria-hidden="true"></i> <?php echo $message; ?>
    </p>
</div>
<?php } ?>
<?php echo form_open('datomed/ficha/create/'.$rut_paciente.'/'.$tipo_atencion); ?>
<table class="table table-striped">
    <tr>
        <td>RUT/DNI Paciente:</td>
        <td>
            <input type="text" name="rut_paciente" class="form-control" value="<?php echo $rut_paciente;?>" readonly>
        </td>
    </tr>
    <?php if($tipo_atencion == 2){ ?>
    <tr>
        <td>TeleMedicina:</td>
        <td>
            <button type="button" name="telemedicina_btn" class="btn btn-success"><i class="fas fa-video"></i>Entrar a Sala</button>
        </td>
    </tr>
    <?php } ?>    
    <tr>
        <td>Motivo Consulta:</td>
            <td>
            <textarea class="form-control" name="motivo" rows="3"><?php echo set_value('titulo'); ?></textarea>        
            </td>
    </tr>
    <tr>
        <td>Enfermedad Actual:</td>
            <td>
            <textarea class="form-control" name="enf_actual" rows="3"><?php echo set_value('titulo'); ?></textarea>        
            </td>
    </tr>    
    <tr>
        <td>Sexo:</td>
        <td>
            <select name="sexo" class="form-control">
            <option value="-0" selected="selected" disabled="disabled">Elegir Sexo:</option>
            <option value="Femenino">Femenino</option>
            <option value="Masculino">Masculino</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Peso:</td>
        <td>
            <input type="text" name="peso" class="form-control" value="<?php echo set_value('titulo'); ?>">
        </td>
    </tr>
    <tr>
        <td>Talla:</td>
        <td>
            <input type="text" name="talla" class="form-control" value="<?php echo set_value('titulo'); ?>">
        </td>
    </tr>
    <tr>
        <td>Tipo Sangre:</td>
        <td>
            <input type="text" name="sangre" class="form-control" value="<?php echo set_value('titulo'); ?>">
        </td>
    </tr>
    <tr>
        <td>Pulso Card&iacute;aco:</td>
        <td>
            <input type="text" name="pulso" class="form-control" value="<?php echo set_value('titulo'); ?>">
        </td>
    </tr>
    <tr>
        <td>Presi&oacute;n Arterial:</td>
        <td>
            <input type="text" name="presion" class="form-control" value="<?php echo set_value('titulo'); ?>">
        </td>
    </tr>
    <tr>
        <td>Temperatura:</td>
        <td>
            <input type="text" name="temperatura" class="form-control" value="<?php echo set_value('titulo'); ?>">
        </td>
    </tr>
    <tr>
        <td>Frecuencia Respiratoria:</td>
        <td>
            <input type="text" name="frec" class="form-control" value="<?php echo set_value('titulo'); ?>">
        </td>
    </tr>    
    <tr>
        <td>Intervenciones Quir&uacute;rgicas previas:</td>
            <td>
            <textarea class="form-control" name="int_quirur" rows="3"><?php echo set_value('titulo'); ?></textarea>        
            </td>
    </tr>
    <tr>
        <td>Alergias:</td>
            <td>
            <textarea class="form-control" name="alergias" rows="3"><?php echo set_value('titulo'); ?></textarea>        
            </td>
    </tr>    
    <tr>
        <td>Enfermedades Previas:</td>
            <td>
            <textarea class="form-control" name="enfermedades" rows="3"><?php echo set_value('titulo'); ?></textarea>        
            </td>
    </tr>
    <tr>
        <td>Medicamentos Prescritos:</td>
            <td>
            <textarea class="form-control" name="medicamentos" rows="3"><?php echo set_value('titulo'); ?></textarea>        
            </td>
    </tr>
    <tr>
        <td>&#191;Fuma?:</td>
            <td>
            <textarea class="form-control" name="fuma" rows="3"><?php echo set_value('titulo'); ?></textarea>        
            </td>
    </tr>
    <tr>
        <td>&#191;Bebe Alcohol?:</td>
            <td>
            <textarea class="form-control" name="alcohol" rows="3"><?php echo set_value('titulo'); ?></textarea>        
            </td>
    </tr>
    <tr>
        <td>&#191;Enfermedades Cong&eacute;nitas?:</td>
            <td>
            <textarea class="form-control" name="enf_congenita" rows="3"><?php echo set_value('titulo'); ?></textarea>        
            </td>
    </tr>
    <tr>
        <td>&#191;Enfermedades Card&iacute;acas?:</td>
            <td>
            <textarea class="form-control" name="enf_cardiaca" rows="3"><?php echo set_value('titulo'); ?></textarea>        
            </td>
    </tr> 
    <tr>
        <td>&#191;Enfermedades Gen&eacute;tica?:</td>
            <td>
            <textarea class="form-control" name="enf_genetica" rows="3"><?php echo set_value('titulo'); ?></textarea>        
            </td>
    </tr>
    <tr>
        <td>Otras Enfermedades:</td>
            <td>
            <textarea class="form-control" name="otras" rows="3"><?php echo set_value('titulo'); ?></textarea>        
            </td>
    </tr>
    <tr>
        <td>Diagn&oacute;stico:</td>
            <td>
            <textarea class="form-control" name="diagnostico" rows="3"><?php echo set_value('titulo'); ?></textarea>        
            </td>
    </tr>
    <tr>
        <td>Pr&oacute;xima Cita:</td>
            <td>
            <textarea class="form-control" name="proxima_cita" rows="3"><?php echo set_value('titulo'); ?></textarea>        
            </td>
    </tr>    
	<tr>
        <td colspan="2">
            <input type="submit" class="btn btn-primary" value="Crear Ficha RME">
        </td>
	</tr>	
</table>
<?php echo form_close(); ?>