window.onload = init;

function init() {

    /**
     * A div tag of a html document.
     * @typedef {(HTMLElement)} HTMLElement_div
     * 
     * A Button tag of a html document.
     * @typedef {(HTMLElement)} HTMLElement_Button
     */
    /**
     * adds a new delete button
     * 
     * if the div doesnt have any children, then the counter starts from 1.
     * @param {HTMLElement_div} deletion_div the div containing the "row delete" buttons
     * @param {String} new_button_template template for the delete button 
     */
    function add_new_deletion_button(deletion_div, new_button_template) {
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

        new_button_template = `<button class="deletion_div_buttons"
        id="tr_${counter}_delete">delete</button>`;
        deletion_div.innerHTML = deletion_div.innerHTML + new_button_template;
    }

    /*deletes the button that was clicked*/
    function remove_deletion_button(clicked_id) {
        document.getElementById(clicked_id).remove();
    }

    /*adds a new row to the table and a delete button associated with it */
    function add_row(deletion_div, new_button_template) {
        date_var = document.getElementById("modal_date_text").value;
        distance_var = document.getElementById("modal_distance_text").value;
        carbon_var = document.getElementById("modal_carbon_text").value;
        var counter;

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
        new_row_template = `
        <tr id="tr_${counter}" class="history_table_row">
            <td class="date_col no_border_bottom">${date_var}</td>
            <td class="distance_col no_border_bottom">${distance_var}</td>
            <td class="carbon_col no_border_bottom">${carbon_var}</td>
        </tr>
        `;
        history_table.innerHTML = history_table.innerHTML + new_row_template;
        modal.style.display = "none";
        add_new_deletion_button(deletion_div, new_button_template);
        init();
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

    /*init variables used to store data */
    var date_var, distance_var, carbon_var, new_row_template, new_button_template;

    /*variables for modal */
    var modal = document.getElementById("add_row_modal");
    var new_row_button = document.getElementById("add_row_button");
    var modal_add_row = document.getElementById("modal_add_row");
    var close_button = document.getElementById("close");
    var history_table = document.getElementById("history_body");

    /*variables for deletion buttons */
    var deletion_div = document.getElementById("deletion_div");
    var delete_button = document.getElementsByClassName("deletion_div_buttons");

    new_row_button.onclick = function () {
        modal.style.display = "block";
    };
    close_button.onclick = function () {
        modal.style.display = "none";
    };
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };

    modal_add_row.onclick = function () {
        add_row(deletion_div, new_button_template);
    };

    /*this loop goes through all buttons that has the "deletion_div_buttons" class, and adds
    the onClick listener, which fires the "remove_row" function.
    
    every endpoint of a function calls the init() again, so this loop is always up-to-date.
    */
    for (var i = 0; i < delete_button.length; i++) {
        delete_button[i].addEventListener('click', remove_row, false);
    }

}