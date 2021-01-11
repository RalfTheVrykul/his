<h1 class="display-4">Mis Fichas M&eacute;dicas</h1>
<br />
<?php if(isset($results)){ ?>
<table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Fecha</th>
            <th scope="col">Tipo Atenci&oacute;n</th>
            <th scope="col">Nombre</th>
            <th scope="col">Motivo Consulta</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
            for($n = 0; $n < count($results); $n++){
                if($results[$n]['tipo_atencion'] == 1){
                    $atencion[] = "<i class=\"fas fa-user-friends\"></i>&nbsp;Presencial";
                }else{
                    $atencion[] = "<i class=\"fas fa-video\"></i>&nbsp;TeleMedicina";
                }               
                $fecha_format[] = date("d-m-Y", strtotime($results[$n]['fecha']));
                $edit[] = "<a href=\"".site_url('datomed/ficha/detail/'.$results[$n]['id'].'')."\">"
                . "<i class=\"fas fa-eye\"></i>"
                . "</a>";
                
                echo "<tr>"
                        . "<td>".$results[$n]['id']."</td>"
                        . "<td>".$fecha_format[$n]."</td>"
                        . "<td>".$atencion[$n]."</td>"
                        . "<td>".$results[$n]['first_name']." ".$results[$n]['last_name']."</td>"
                        . "<td>".$results[$n]['motivo_consulta']."</td>"
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