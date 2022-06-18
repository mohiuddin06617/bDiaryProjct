function view_data() {
        $.ajax({
            url:'../design_bdiary/dynamic_food_menu_table_edit.php',
            method:'POST',
            data: {command:'view'},
        }).done(function(data){
            $('tbody').html(data);
            table_data();
        });
    }
function table_data(){
    $('#breakfastUserFoodMenu').Tabledit({
        url: 'dynamic_food_menu_table_edit.php',
        columns: {
            identifier: [0, 'foodMenuId'],
            editable: [[1, 'manager_id'], [2, 'inserted_date'], [3, 'inserted_time'],[4, 'item_name']]
        },
        onDraw: function() {
            console.log('onDraw()');
        },
        onSuccess: function(data, textStatus, jqXHR) {
            /* console.log('onSuccess(data, textStatus, jqXHR)');
             console.log(data);
             console.log(textStatus);
             console.log(jqXHR);
             */
            alert('Successfully Changed');

        },
        onFail: function(jqXHR, textStatus, errorThrown) {
            console.log('onFail(jqXHR, textStatus, errorThrown)');
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        },
        onAjax: function(action, serialize) {
            console.log('onAjax(action, serialize)');
            console.log(action);
            /*console.log(serialize);*/
        }
    });

}