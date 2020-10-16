$("#fileUpload").dropzone({ 
    url: "api/uploadFile",
    paramName: "file",
    maxFilesize: 10,
    acceptedFiles: 'image/*',
    dictDefaultMessage: '<span class="text-white">Húzd ide a fájlokat a feltöltéshez (csak képfájlok, max. 10MB)</span>',
    dictFileTooBig: 'A fájlméret ({{filesize}}MB) túl nagy! Max fájlméret: {{maxFilesize}}MB',
    dictInvalidFileType: 'Csak képeket tölthetsz fel!',
    success: function(r,f) {
        console.log(r);
        $("#"+r.upload.uuid).html(r.name + " sikeresen feltöltve!<br>Link: <a href='"+f.link+"'>"+f.link+"</a>").removeClass('alert-warning').addClass('alert-success');
    },
    error: function(r,e) {
        $("#"+r.upload.uuid).html(r.name + " feltöltése sikertelen!<br>Indok: "+e).removeClass('alert-warning').addClass('alert-danger');
    },

    init: function() {
        this.on("addedfile", function(file) {$("#uploaded").append("<div class='alert alert-warning' id='"+file.upload.uuid+"'>"+file.name+" sikeresen hozzáadva!</div>") });
      }
});