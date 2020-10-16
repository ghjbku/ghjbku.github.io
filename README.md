

# Online galéria

## Készítették:
Hallgatók:
 - Borvíz Róbert
 - Ilosvay Áron
 - Nagy Lajos
 - Tóth Balázs
 - Veress Máté

Oktató:
- Bíró Csaba

2020.09.28. Debrecen

# Tartalomjegyzék

 - [Bevezető](#Bevezető)
 - [Követelményspecifikáció](#Követelményspecifikáció)
     - [Megrendelővel készített riport](#Megrendelővel-készített-riport)
     - [Követelménylista](#Követelménylista)
 - [Használhatóság](#Használhatóság)
 - [Megbízhatóság](#Megbízhatóság)
 - [Teljesítmény](#Teljesítmény)
 - [Tervezési megkötések](#Tervezési-megkötések)
 - [Funkcionális specifikáció](#Funkcionális-specifikáció)
    - [A rendszer céljai](#A-rendszer-céljai)
    - [Jelenlegi helyzet leírása](#Jelenlegi-helyzet-leírása)
    - [Vágyálom rendszer leírása](#Vágyálom-rendszer-leírása)
    - [Használati esetek](#Használati-esetek)
    - [Képernyőterv](#Képernyőterv)
 - [Nagyvonalú rendszerterv](#Nagyvonalú-rendszerterv)
 - [Projekt Elemeinek Követelményei](#Projekt-Elemeinek-követelményei)
    - [Bejelentkezési Oldal](#Bejelentkezési-Oldal)
    - [Fájlfeltöltő Oldal](#Fájlfeltöltő-Oldal)
    - [Ajax Handler Class](#Ajax-Handler-Class)
 

 

## Bevezető

Ez a dokumentum a **Szoftverfejlesztési módszertanok** tantárgyhoz készítendő első kisprojekt specifikációjául szolgál. 


# Követelményspecifikáció

## Megrendelővel készített riport
Mivel egyetemi hallgatók által készített projektről beszélünk, ami gyakorlati tantárgyhoz kötött (nem egy piaci cég által leadott rendelésről), ezért a megszokott "Szabad riport" és "Irányított riport" elmarad.
Továbbá a végtermék értékesítésre sem kerül sor (szabad felhasználás), ezért az "Üzleti modellezés" illetve "Üzleti folyamatok modellezése" is elmarad. 

## Követelménylista
A projekt elkészítésénél fontos lenne, egy bárhol-bármikor, interneten keresztül, böngészőből elérhető saját online galéria, ahova a felhasználó feltöltheti saját képeit, ott tárolhatja és megtekintheti őket.
- A felhasználói felület legyen "letisztult" (maximum 4-5 menüpont, ami a képernyő  maximum 25%-át foglalja csak el).
- A weboldal használata legyen intuitív (a menüpontok beszédesek, mindössze egy-egy szó).
- A fájlok feltöltésére preferált a Drag and Drop módszer, vagy a feltöltő felületre kattinva, fájlok tallózásával való feltöltés.
- Elvárás, hogy nem megfelelő típusú/méretű fájlok feltöltése esetén a felhasználót hibaüzenet értesítse a problémáról.


## Használhatóság
Azok a nem funkcionális követelmények, amelyek a rendszer használhatóságát befolyásolják:

 - A weboldal használatához elegendő az alapvető számítógépes ismeret
 - Egy kép feltöltése néhány másodpercet vegyen időbe
 - Az **online képgaléria** használatához nem szükséges külső szoftver letöltése (egyelőre? >> nagy projekt?)
 - Kizárólag internetelérés és egy böngésző használata szükséges

## Megbízhatóság
A rendszerrel szemben támasztott megbízhatósági követelmények:

- SQL injection elleni védelem
- (ezt még pontosítani kell)

## Teljesítmény

A rendszertől elvárt teljesítmény mutatók:

- áteresztőképesség (pl: 1 feltöltéssel egyszerre csak 1 fájl)
- kapacitás (kezelt adatbázis mérete, feltölthető fájl maximális mérete)
(ennek még utána kell nézni)

## Tervezési megkötések

- Fejlesztéshez használt programozási nyelvek:
    - [PHP](https://www.php.net/)
    - [HTML](https://developer.mozilla.org/en-US/docs/Web/HTML)
    - [CSS](https://developer.mozilla.org/en-US/docs/Web/CSS)
    - [JavaScript](https://www.javascript.com/)
- Fejlesztéshez használt eszközök:
    - [XAMPP](https://www.apachefriends.org/hu/index.html)
    - [Visual Studio](https://visualstudio.microsoft.com/)
    - [Bootstrap](https://getbootstrap.com/)
    - [Font Awesome](https://fontawesome.com/)
- Alkalmazott fejlesztési módszertan: Agilis

# Funkcionális specifikáció

## A rendszer céljai 
- Kezdetben: olyan oldal létrehozása ahova képeket lehet feltölteni illetve megtekinteni.
- Később: Bejelentkezés/Regisztráció, Kategóriák létrehozása/listázása, Fájlok/Képek listázása
## Jelenlegi helyzet leírása
- Program elkezdése from scratch.
- Elvégzendő feladatok átgondolása, kiosztása.
- A feladatok menedzselésének segítésére Trello használata.
- A Programkód feltöltése GitHubra.
## Vágyálom rendszer leírása
 Kezdetben online galéria, képek feltöltéséhez és megtekintéséhez, majd a továbbiakban a rendszer fejlesztése bejelentkezési és regisztrációs felülettel, ahol a felhasználók regisztrálhatják magukat, vagy ha már regisztráltak akkor bejelentkezhetnek.
 
 A későbbiekben, a menüsorból elérhető funkcionalitás:
  - Kategóriák
  - API
  - Beállítások
  - Feltöltés
  - Kilépés
## Használati esetek
 - Az oldalra történő érkezéskor a felhasználót egy bejelentkezési felület fogadja, ahol felhasználónevét és jelszavát megadva beléphet, vagy ha nem regisztrált még akkor regisztrálhat.  
 - Sikeres bejelentkezés után használhatja az oldal funkcionalitását, ami a következő:
    - Kategóriák
    - API
    - Beállítások
    - Feltöltés
    - Kilépés  
 - Kategóriák használata: A weboldalon a Kategóriák menüpontra történő kattintás után elérhető.
 - API dokumentáció elérése: A weboldalon az API menüpontra történő kattintás után elérhető.
 - Beállítások használata: A weboldalon a Beállítások menüpontra történő kattintás után elérhető.
 - Feltöltés használata: A weboldalon a Feltöltés menüpontra történő kattintás után elérhető.
 - Kijelentkezés az oldalról: A weboldalon a Kilépés menüpontra történő kattintás után kijelentkezünk a rendszerből. 
 ### Használati eset diagram  
![enter image description here](https://uni.rfr.hu/uploads/83db766.png)
## Képernyőterv
![enter image description here](https://uni.rfr.hu/uploads/903fd9f.png)

# Nagyvonalú rendszerterv
- **Mit:** Iskolai projekt keretében egy “Online Galéria” létrehozásán dolgozunk, ahol bárki aki ellátogat az oldalra megtekintheti annak tartalmát. 
  - Funkciók, amelyek elérhetők:
    - Bejelentkezés/Regisztráció
    - Oldal nagyítása
    - Kategóriák létrehozása/listázása
    - Kép feltöltése/megtekintése
    - Fájlok/Képek listázása
- **Miért:** Igény van olyan galériára ahonnan egyszerűen elérhető bárki számára a tartalom. És persze a legfontosabb szempont, jegy a tárgyból!!!
- **Hogyan:** Létrehozása a *backend*-ként szolgáló  *PHP* nyelvvel továbbá a *frontendnek* felhasznált *CSS* és *HTML* nyelvekkel történik.
- **Miből:** A projekt megvalósításához nincs is másra szükség mint 5 lelkes tanulóra(programozóra), akik tudásukat felhasználva létrehozzák az “Online Galériát”.
  - Felhasznált erőforrások/eszközök:
    - Önmagunk(élő emberi organizmusok),
    - Internet kapcsolat,
    - Nyelvek: CSS, HTML, PHP, JavaScript
    - Kódolásra alkalmas hardver és szoftver.

# Projekt Elemeinek követelményei

## Bejelentkezési Oldal
 - A Felhasználónév és a Jelszó mezők ne legyenek üresek!
 - Üres mezők esetén ne irányítsa át a főoldalra a felhasználót.
 - Adatbázis összekötés után:
   - Ha nem létezik az adatbázisban a felhasználó, irányítsa át a regisztrációs oldalra.
   - Ha az adatok már jelen vannak, akkor irányítsa át a böngészőt a gallery.php oldalra.
 - Bejelentkezés nélkül az oldal szolgáltatásai nem elérhetőek!

## Fájlfeltöltő Oldal
 - Ha a felhasználó nincs bejelentkezve, ne tudja elérni a féltő oldalt. 
 - Fájl kiválasztása nélkül ne induljon meg a feltöltés. 
 - A kiválasztott fájl képformátumon kívül más nem lehet. 
     - Támogatott formátumok: Png, Jpg, Gif, Jpeg
 - A kép Maximális mérete 10Mb legyen. 
 - A feltöltött kép kap egy unique id-t, ami 2x-es md5 titkosításon megy át, melynek az első 7 karakteréből képezünk egy subsztinget, és azt adjuk a fájl nevéül. 
 - Az objektum tárolási helyét a config.php fájlból kapjuk, melyben létrehozunk egy "uploads" Alkönyvtárat, ahová a fájlok kerülnek. 
 - Sikeres fájlfeltöltés esetén az oldal adjon vissza egy linket, amely a kép helyét tartalmazza. 
 - Továbbá a feltöltött kép jelenjen meg a Gallery oldalon is. 

## Ajax Handler Class
 - A szerver válaszáért felelős.
 - Három metódusa van:
   - **success()**
   - **error()**
   - **onlyLoggedIn()**
- A **success()** abban az esetben hívódik meg, ha a szerverhez intézet kérés sikeres volt. Paraméterül egy **array**-t kap.
- Mivel csak sikeres kéréseket dolgoz fel, ezért az **error**-t *false*-ra állítja és az **array**-t visszaadja *json* formában, amivel már képesek dolgozni a '*.js*' fájlok.
- Az **error()** szintén egy **array**-t vár, csak mivel ez a metódus akkor hívódik meg amikor amikor sikertelen kérést küldtünk a szervernek az **error** itt *true* lesz.
  Továbbá, szintén visszaadja az **array** tartalmát *json* formában.
- Az **onlyLoggedIn()** metódus ellenőrzi, hogy egy felhasználó be van-e jellentkezve vagy sem. Ugyan is az 'Online Galléria' bizonyos funkcióinak ellérésének egy
  elengedhetetlen feltétele, hogy a felhasználó be legyen jelentkezve.
- Amennyiben a felhasználó be van jelentkezve egy *true* értéket ad vissza.
- Ha nincs bejelentkezve, akkor pedig visszaad egy hibaüzenetett, hogy a rendszer nem tudta feldolgozni a kérést.
