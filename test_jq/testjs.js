function loadScript(url) {
    var head = document.getElementsByTagName('head')[0];
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = url;
    head.appendChild(script);
}
window.onload=init;

function refresh_table(obj){
    var base_table=`
        <tbody id="history_body">
            <tr id="history_table_add_row_button_container">
                <td id="refresh_data_button" class="no_border_top" colspan="3">refresh data</td>
            </tr>
            <tr id="history_table_header">
                <th class="date_col no_border_top">ID</th>
                <th class="distance_col no_border_top">Data</th>
            </tr>
        </tbody>`;
    document.getElementById("history_body").remove();
    document.getElementById("history_table").innerHTML = base_table;

    console.log("before 2s");
    setTimeout(function(){add_rows(obj);},2000);
    console.log("after 2s");
}

function add_rows(obj){
    console.log(obj);
    
    var len = obj.length;
    var id_num =[];
    var data_num = [];
    for (let i = 0; i < len; i=i+2) {
       id_num.push(i);
    } 
    for (let j = 1; j < len; j=j+2) {
        data_num.push(j);
    }
    for (let c = 0; c < len/2; c++){
        add_row(obj[id_num[c]],obj[data_num[c]]);
    }
}

/*adds a new row to the table and a delete button associated with it */
function add_row(id,data) {
    var history_table = document.getElementById("history_body");
    id_var = id;
    data_var = data;
    var counter;

    
    history_table.innerHTML = base_table;
    /*the base number of rows is 2, the add row button, and the header row
    so if the length is less than 3, then that means the table is empty,
    so we start the counter from 1!
    */
    if (history_table.rows.length < 3) {
        counter = 1;
    }
    else {
        /*gets the rows of the table, finds the last, and gets it's id */
        var last_row_id = history_table.rows.item(history_table.rows.length - 1).id;
        /*the regex: (.*?) any characters, ^tr_ the "tr_" text is at the start */
        var regex_for_removing_delete_text = /(.*?)^tr_/;
        /*replaces the matched text "tr_" with empty character, and then
        the string is converted into int*/
        counter = parseInt(last_row_id.replace(regex_for_removing_delete_text, "$1")) + 1;
    }
    /*template variable used to add new rows to a table*/
    var new_row_template = `
    <tr id="tr_${counter}" class="history_table_row">
        <td class="date_col no_border_bottom">${id_var}</td>
        <td class="distance_col no_border_bottom">${data_var}</td>
    </tr>
    `;
    history_table.innerHTML = history_table.innerHTML + new_row_template;
    add_new_deletion_button(document.getElementById("deletion_div"));
    init();
}

 /**
     * adds a new delete button
     * 
     * if the div doesnt have any children, then the counter starts from 1.
     * @param {HTMLElement_div} deletion_div the div containing the "row delete" buttons
     * @param {String} new_button_template template for the delete button 
     */
  function add_new_deletion_button(deletion_div) {
    var counter;
    if (deletion_div.childElementCount < 1) {
        counter = 1;
    }
    else {
        /*gets the rows of the table, finds the last, and gets it's id */
        var last_row_id = deletion_div.lastElementChild.id;
        /*the regex: (.*?) any characters, ^tr_ the "tr_" text is at the start */
        var regex_for_removing_delete_text = /(.*?)^tr_/;
        /*replaces the matched text "tr_" with empty character, and then
        the "_delete" string, lastly it is converted into int*/
        counter = last_row_id.replace(regex_for_removing_delete_text, "$1");
        counter = counter.replace(/(.*?)_delete$/, "$1");
        counter = parseInt(counter) + 1;
    }

    var new_button_template = `<button class="deletion_div_buttons"
    id="tr_${counter}_delete">delete</button>`;
    deletion_div.innerHTML = deletion_div.innerHTML + new_button_template;
}

/*deletes the button that was clicked*/
function remove_deletion_button(clicked_id) {
    document.getElementById(clicked_id).remove();
}

 /**
     *  the function fetches the id of the button pressed, and deletes the associated row,
     *  but only if the row exists. 
     *  (because of the init() calling, it will throw an error if you dont check for existence)
     * @param {HTMLElement_Button} self the button that was pressed.
     */
  function remove_row(self) {
    var button_id = self.originalTarget.id;
    var regex_for_removing_delete_text = /(.*?)_delete$/;
    var row_id = button_id.replace(regex_for_removing_delete_text, "$1");
    var row_to_delete = document.getElementById(row_id);
    if (row_to_delete) {
        row_to_delete.remove();
        remove_deletion_button(button_id);
    }
    init();
}

function init(){
    loadScript("https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js");

    $(document).ready(function() {
    
        $("#refresh_data_button").click(function() {    
            console.log("clicked");           
                    $.ajax({
                        url : 'http://127.0.0.1/cooldown/test_jq/display.php', // your php file
                        type : 'GET', // type of the HTTP request
                        success : function(data){
                            var obj = jQuery.parseJSON(data);
                            
                            refresh_table(obj);
                        }
                    });
        });
    });

     /*variables for deletion buttons */
     var delete_button = document.getElementsByClassName("deletion_div_buttons");

      /*this loop goes through all buttons that has the "deletion_div_buttons" class, and adds
    the onClick listener, which fires the "remove_row" function.
    
    every endpoint of a function calls the init() again, so this loop is always up-to-date.
    */
    for (var i = 0; i < delete_button.length; i++) {
        delete_button[i].addEventListener('click', remove_row, false);
    }
}