
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<center>
<footer class="blockquote-footer">
    Sitio desarrollado sobre&nbsp;
    <a href="<?php echo $this->config->item('url_owner'); ?>" target="_blank">
    <?php echo $this->config->item('sistema');?>&nbsp;
    <?php echo $this->config->item('version_ns');?></a> - Page rendered in <strong>{elapsed_time}</strong> seconds. 
    <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>'
    . CI_VERSION . '</strong>' : '' ?>
</footer>
</center>
</div>
<script src=<?=base_url("assets/js/jquery-3.3.1.min.js")?>></script>
<script src=<?=base_url("assets/js/bootstrap.min.js")?>></script>
<script src=<?=base_url("assets/js/bootstrap.min.js")?>></script>
<script src=<?=base_url("assets/js/tinymce/jquery.tinymce.min.js")?>></script>
<script src=<?=base_url("assets/js/tinymce/tinymce.min.js")?>></script>
<script>tinymce.init({ selector:'textarea' });</script>
<script>
$(document).ready(function(){
    /*Agenda filtrar por especialidad*/
    $(".medico_agenda_create").hide();
    $("select[name='especialidad_med_create']").change(function(){        
        $.post("get_medico_by_especialidad",{id:$("select[name='especialidad_med_create']").val()},function(data){
            if(data.length == 0){
                $(".medico_agenda_create").hide();
                alert("No hay M\u00E9dicos con esa especialidad en Datomed.");
            }else{
                $(".medico_agenda_create").show();
                var html = "<select name=\"agenda_medico_med_create\" class=\"form-control\">";
                html += "<option value=\"-0\" selected=\"selected\" disabled=\"disabled\">Elegir Doctor</option>"
                $.each(data, function( index, value ) {
                    html += "<option value=\""+value.rut+"\">"+value.first_name+" "+value.last_name+"</option>";
                });
                html += "</select>";
                $("#show_docs_filter").html(html);
            }
        });
    });
    /*Ir a Sala de Telemedicina*/
    $("button[name='telemedicina_btn']").click(function(){
        window.open('https://appr.tc/r/655694180');
        return false;
    });
});
</script>

</body>
</html>