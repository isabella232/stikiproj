<?php
/**
 * @author NudeSource
 * @copyright 2014
 */
?>
<div class="alert alert-info">
    <i class="icon-user"></i> User Management <strong></strong>
    <button id="cmdnew"> NEW </button>
</div>

<div class="well txjudulmenu">
    <div id="kopjadwal">
    <input type="text" id="carimk" class="caridata" onblur="if(this.value=='')this.value='Filter User';" onfocus="if(this.value=='Filter User')this.value='';" value="Filter User">
    <span id="pagging"></span>
    </div>
        
    <div id="tampildata"></div>
        
</div>
<div class="lodata"></div>
<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="moduls/js/user.js"></script>