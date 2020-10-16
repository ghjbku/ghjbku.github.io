<?php 
/**
 * A kategória aloldal felépítése. Ez a fájl kívülről nem érhető el.
 */
if(basename($_SERVER['SCRIPT_FILENAME']) != 'index.php') die();?>
<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <div class="row">
                <label for='api'>Az API kulcsod:</label>
                <input type='text' id='api' class='form-control' readonly value='<?=User::getUserData()->api?>'>
                <button class='btn btn-success' style="margin-top :10px" id="regenApiKey"> <i class='fa fa-undo'></i> Új kulcsgenerálás</button>
            </div>
        </div>
    </div>
</div>