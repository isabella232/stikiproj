<?php
/**
 * @author NudeSource
 * @copyright 2014
 */
?>
<style type="text/css">
#hdr-ijin, #hdr-hdr, #hdr-blm{
    text-align: center;
    display: block;
    padding-right: 4px;
    padding-left: 4px;
    margin-right: 5px;
    -webkit-border-radius: 8px;
    border-radius: 8px;
}
#hdr-ijin{
    background-color: red;
    color: #ffffff;
}
#hdr-hdr{
    background-color: green;
    color: #ffffff;
}
#filtgl, #filbln,#filthn{
    width: 50px;
}
#filabsen{
    margin-top: 0px;
    margin-left: 10px;
    width: 100px;
    height: 35px;
    cursor:pointer;
}
</style>

<div class="alert alert-info">
    <i class="icon-magnet"></i> Ruang Kelas</a>
    <button id="cmdnew"> NEW </button>    
</div>

<div class="well txjudulmenu">
    <div id="kopjadwal">
    <input type="text" id="cariruang" class="caridata">
    <span id="pagging"></span>
    </div>
        
    <div id="tampildata"></div>
        
</div>
<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="moduls/js/ruangkelas.js"></script>