 /** Cookie beállítása */
setCookie = (cname, cvalue, exdays) => { var d = new Date(); d.setTime(d.getTime() + (exdays*24*60*60*1000)); var expires = "expires="+ d.toUTCString(); document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/"; } 
/** Már beállított cookie értékének lekérése */
getCookie = (cname) => { var name = cname + "="; var decodedCookie = decodeURIComponent(document.cookie); var ca = decodedCookie.split(';'); for(var i = 0; i <ca.length; i++) { var c = ca[i]; while (c.charAt(0) == ' ') { c = c.substring(1); } if (c.indexOf(name) == 0) { return c.substring(name.length, c.length); } } return ""; }
/** HEAD információk lekérése az adott URL alapján */
fetchHeader = (url, wch) => { try { var req=new XMLHttpRequest(); req.open("HEAD", url, false); req.send(null); if(req.status== 200){ return req.getResponseHeader(wch); } else return false; } catch(er) { return er.message; } }

/** Magyar dátum generálása az adott dátumstringből */
getDate = (date) => {
    var months = ['01','02','03','04','05','06','07','08','09','10','11','12'];
    var hours = ['0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23'];
    var d = new Date(date);
    var day = d.getDate();
    var minute = d.getMinutes();
    var sec = d.getSeconds();
    if(day.toString().length == 1)
    var day = "0"+d.getDate();
    if(minute.toString().length == 1)
    var minute = "0"+d.getMinutes();
    if(sec.toString().length == 1)
    var sec = "0"+d.getSeconds();
  
    return d.getFullYear() + "-" + months[d.getMonth()] + "-" + day + " " + hours[d.getHours()] + ":" + minute + ":" + sec;
  }