<?php

/**
 * @author NudeSource
 * @copyright 2014
 */
?>
<div class="alert alert-info">
    <i class="icon-briefcase"></i> Data User  
</div>

<div class="well txjudulmenu">
    <div id="kopjadwal">
        <span id="pagging"></span>
    </div>
        
    <div id="tampildata"></div>
        
</div>

<script src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('#tampildata').load('moduls/accountlist.php');
});
</script>
