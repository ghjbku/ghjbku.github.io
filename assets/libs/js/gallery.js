/**
 * Egy kép betöltése
 */
loadImage = (imgs) =>{
    $("#gallery").append(`
    <div class="col-lg-12 frame item" style="max-width: 200px; cursor:pointer" data-sub-html="<a href='`+HOST_URL+`/uploads/`+imgs+`'>`+HOST_URL+`/uploads/`+imgs+`</a><br>`+getDate(fetchHeader(HOST_URL+'/uploads/'+imgs,'Last-Modified'))+`" data-src="`+HOST_URL+"/uploads/"+imgs+`" id="`+imgs+`">
    <div class="card card-figure">
        <figure class="figure">
            <div class="figure-attachment">
            <img draggable="false" src="`+HOST_URL+`/uploads/`+ imgs +`" alt="Image Alt" class="img-fluid"><div style="text-align: center; "></div>
        </figure>
        <div class="card-footer text-center"><a target="_blank" href='`+HOST_URL+`/uploads/`+imgs+`'>`+imgs+`</a></div>
    </div>
  </div>
  `);
}


$(document).ready(function() {
  $('#gallery').html("");
  $.ajax({ 
    type: 'POST', 
    url: 'api/getFiles',
    data: {
      type: [
        "png",
        "jpg",
        "jpeg",
        "gif",
      ]
    },
    success: function(r) {
      var imgs = r.files;
      if(imgs == "") $("#gallery").append("Nincsenek képek. Tölts fel egyet <a href='upload'>itt</a>!")
    for(let i = 0; i<imgs.length; i++) {
        loadImage(imgs[i]);
    }

    $('#gallery').lightGallery({
        thumbnail:true,
        showThumbByDefault: false
      });
    $('#gallery').on('onBeforeSlide.lg', function(event, prevIndex, index){
        $('.lg-outer').css('background-color', '#282C30')
      });
      $('#gallery').on('onAfterOpen.lg', function(event, prevIndex, index){
        var k = $('.lg-toolbar');
        var span = document.createElement('span');
        span.innerHTML="<img style='width: 100px; padding: 10px; margin-bottom: -10px;' draggable='false' src='https://ts.fgtsrv.hu/images/upld.png'>";
        k.prepend(span)
    });
  }});
})