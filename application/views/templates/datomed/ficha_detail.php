<h1 class="display-6">Ficha RME</h1>
<table class="table table-striped">
    <tr>
        <td><strong>Nombre:</strong>&nbsp;<?php echo $info_usuario['user_info']->first_name.' '.$info_usuario['user_info']->last_name; ?></td>
        <td><strong>RUT/DNI:</strong>&nbsp;<?php echo $info_usuario['user_info']->rut; ?></td>
        <td><strong>Sexo:</strong>&nbsp;<?php echo trim($results[0]['sexo']); ?></td>
        <td><strong>&#191;Fuma?:</strong>&nbsp;<?php echo trim($results[0]['fuma']); ?></td>
        <td><strong>&#191;Bebe Alcohol?:</strong>&nbsp;<?php echo trim($results[0]['alcohol']); ?></td>
        <td><strong>Peso:</strong>&nbsp;<?php echo trim($results[0]['peso']); ?> <strong>Talla:</strong>&nbsp;<?php echo trim($results[0]['talla']); ?><strong>Tipo Sangre:</strong>&nbsp;<?php echo trim($results[0]['sangre']); ?></td>
    </tr>
</table>
<table class="table table-striped">
    <tr>
        <td>Fecha Consulta:</td>
        <td>
            <?php echo trim($results[0]['fecha']); ?>
        </td>
    </tr>
    <tr>
        <td>Doctor:</td>
        <td>
            <?php echo trim($results[0]['first_name'])." ".trim($results[0]['first_name']); ?>
        </td>
    </tr>
    <tr>
        <td>RUT Colegio M&eacute;dico:</td>
        <td>
            <?php echo trim($results[0]['rut_colegio_medico']); ?>
        </td>
    </tr>
    <tr>
        <td>Atenci&oacute;n:</td>
        <td>
            <?php
                if($results[0]['tipo_atencion'] == 2){
                    echo "TeleMedicina";
                }else{
                    echo "Presencial";
                }
            ?>
        </td>
    </tr>       
    <tr>
        <td>Motivo Consulta:</td>
        <td>
        <?php echo trim($results[0]['tipo_atencion']); ?>
        </td>
    </tr>
    <tr>
        <td>Diagn&oacute;stico:</td>
        <td>
        <?php echo trim($results[0]['diagnostico']); ?>
        </td>
    </tr>
    <!--
	<tr>
        <td colspan="2">
            <input type="button" class="btn btn-primary" value="Descargar PDF">
        </td>
	</tr>
    -->
</table>