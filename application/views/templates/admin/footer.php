
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

</body>
</html>