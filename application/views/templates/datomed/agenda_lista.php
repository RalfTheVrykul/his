<h1 class="display-4">Mis Citas M&eacute;dicas</h1>
<?php if($rol == 0) { ?>
<p class="lead">
    Agregue, edite o elimine reserva de citas m&eacute;dicas.
</p>
<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
    <div class="btn-group mr-2" role="group" aria-label="First group">
        <a href="<?=site_url('datomed/agenda/create'); ?>">
            <button type="button" class="btn btn-secondary">
                <i class="fa fa-plus" aria-hidden="true"></i> Crear nueva cita m&eacute;dica
            </button>
        </a>
    </div>   
</div>
<?php } ?>
<br />
<?php if(isset($results)){ ?>
<table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Nombre</th>            
            <th scope="col">Tipo Atenci&oacute;n</th>
            <th scope="col">Motivo Consulta</th>
            <th scope="col">Estado de la solicitud</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
            for($n = 0; $n < count($results); $n++){
                if($results[$n]['estado'] == 1){
                    $estado[] = "<span class=\"badge badge-warning\">En espera</span>";
                }elseif($results[$n]['estado'] == 2){
                    $estado[] = "<span class=\"badge badge-success\">Aprobado</span>";
                }else{
                    $estado[] = "<span class=\"badge badge-danger\">Rechazado</span>";
                }
                if($results[$n]['tipo_atencion'] == 1){
                    $atencion[] = "<i class=\"fas fa-user-friends\"></i>&nbsp;Presencial";
                }else{
                    $atencion[] = "<i class=\"fas fa-video\"></i>&nbsp;TeleMedicina";
                }               
                $fecha_format[] = date("d-m-Y", strtotime($results[$n]['fecha']));
                /** 
                 * Si viene el rut, significa que es el rut del paciente y lo esta consultando
                 * un doctor. Para poder crear la ficha clínica
                 * 
                */
                if(isset($results[$n]['rut_paciente'])){
                    $rut_paciente[] = $results[$n]['rut_paciente'];
                    //<i class="fas fa-file"></i>
                }
                if(isset($rut_paciente[$n])){
                    $edit[] = "<a href=\"".site_url('datomed/agenda/edit/'.$results[$n]['id'].'')."\""
                    . "class=\"badge badge-info\">"
                    . "<i class=\"fa fa-cogs\" aria-hidden=\"true\"></i>"
                    . "</a>"
                    . "<a href=\"".site_url('datomed/ficha/create/'.$rut_paciente[$n].'/'.$results[$n]['tipo_atencion'])."\""
                    . "class=\"badge badge-sucess\">"
                    . "<i class=\"fa fa-plus\" aria-hidden=\"true\"></i><i class=\"fas fa-file\" aria-hidden=\"true\"></i>"
                    . "</a>"            
                    . "<a href=\"".site_url('datomed/agenda/delete/'.$results[$n]['id'].'')."\""
                    . "class=\"badge badge-danger\">"
                    . "<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>"
                    . "</a>";
                }else{
                    $edit[] = "<a href=\"".site_url('datomed/agenda/edit/'.$results[$n]['id'].'')."\""
                    . "class=\"badge badge-info\">"
                    . "<i class=\"fa fa-cogs\" aria-hidden=\"true\"></i>"
                    . "</a>"
                    . "<a href=\"".site_url('datomed/agenda/delete/'.$results[$n]['id'].'')."\""
                    . "class=\"badge badge-danger\">"
                    . "<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>"
                    . "</a>";
                }
                
                echo "<tr>"
                        . "<td>".$results[$n]['id']."</td>"
                        . "<td>".$fecha_format[$n]."</td>"
                        . "<td>".$results[$n]['hora']."</td>"
                        . "<td>".$results[$n]['first_name']." ".$results[$n]['last_name']."</td>"
                        . "<td><a href=\"https://appr.tc/r/655694180\" target=\"_blank\">".$atencion[$n]."</a></td>"
                        . "<td>".$results[$n]['motivo']."</td>"
                        . "<td>".$estado[$n]."</td>"
                        . "<td>".$edit[$n]."</td>"
                        . "</tr>";              
            }
        ?>
    </tbody>    
</table>
<?php }else{ ?>
<div class="alert alert-info">
    <p>
        <i class="fa fa-exclamation" aria-hidden="true"></i> No existen datos para mostrar
    </p>
</div>
<?php } ?>
<?php if(isset($links)){ ?>
    <?php
        echo $links;
    ?>
<?php } ?>