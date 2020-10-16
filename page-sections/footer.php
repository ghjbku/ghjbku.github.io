<?php

/**
 * A lábrész felépítése. Ez a fájl kívülről nem érhető el.
 */
if (basename($_SERVER['SCRIPT_FILENAME']) != 'index.php') die(); ?>
</div>
<script>
    const HOST_URL = "<?= !empty($_SERVER['HTTPS']) && $_SERVER['HTTP_HOST'] != 'localhost' ? 'https://' . $_SERVER['HTTP_HOST'] : 'http://' . $_SERVER['HTTP_HOST'] ?>";
</script>
<script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous"></script>
<script src="assets/libs/js/functions.js"></script>
<?php if ($currPage == 'upload') { ?>
    <script src="assets/vendor/dropzone/dropzone.js"></script>
    <script src="assets/libs/js/upload.js"></script>
<?php } else if ($currPage == 'gallery') { ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.8.3/js/lightgallery.min.js" integrity="sha512-qnhI/+haxfhK9wO4DSb2JGXIdFU03d4SLda0+oOQ0byrTYxPbig36xmHMHsJ+8PgIwaJbtMk6JyPL+d8cVwyUA==" crossorigin="anonymous"></script>
    <script src="assets/libs/js/gallery.js"></script>
<?php } else if ($currPage == 'settings') { ?>
    <script>
        $("#regenApiKey").click(function() {
                $.ajax({
                    type: 'POST',
                    url: 'api/keyRegen',
                    success: function(r) {
                        if(r.error) {
                            Swal.fire(
                            'Sikertelen kérés',
                            r.message,
                            'error'
                            )
                        } else {
                            location.reload();
                        }
                    }
                });
        });
    </script>
<?php } ?>
</body>