<?php
/**
 * Autoload betöltése, hogy minden zökkenőmentesen menjen.
 */
if(basename($_SERVER['SCRIPT_FILENAME']) != 'index.php') die();
require_once 'autoload.php';
?>
<div class="container">
    <div class="form-signin">
        <h1 class="form-signin-heading text-muted"><img width='150px' src="assets/images/logo.png"></h1>
        <input type="text" class="form-control" placeholder="Felhasználónév" required="" autofocus="">
        <input type="password" class="form-control" placeholder="Jelszó" required="">
        <button class="btn btn-lg btn-primary btn-block" id="send" type="submit">
            Bejelentkezés
        </button>
    </div>
</div>

<script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $("input[type='password']").on('keyup', function(e) {
        if (e.keyCode === 13) {
            $("#send").click()
        }
    });

    $("#send").click(function(){
        var username = $("input[type='text']").val();
        var password = $("input[type='password']").val();
        if(username != "" && password != ""){
            $.ajax({ 
                type: 'POST', 
                url: 'api/login', 
                data: { 
                    username: username,
                    password: password
                }, 
                success: function(r) {
                    if(r.error) {
                        Swal.fire(
                            'Bejelentkezés sikertelen',
                            r.message,
                            'error'
                            )
                    } else {
                        location.reload();
                    }
            }});
        }
    });
</script>
