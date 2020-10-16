<?php 
/**
 * A feltöltés aloldal felépítése. Ez a fájl kívülről nem érhető el.
 */
if(basename($_SERVER['SCRIPT_FILENAME']) != 'index.php') die();?>
<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <div class="row">
                <form action="api/uploadImage" class="dropzone" id="fileUpload">
                </form>
            </div>
            <div class="row">
                <div id="uploaded"></div>
            </div>
        </div>
    </div>
</div>