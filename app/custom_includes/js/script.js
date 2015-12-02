jQuery(document).on("click", ".deleterow", function () {
    var jQuerykillrow = jQuery(this).parent('tr');
    jQuerykillrow.addClass("danger");
    jQuerykillrow.fadeOut(2000, function () {
        jQuery(this).remove();
    });
});


jQuery(".addnewrow").on("click", function(){

	var categoryType = jQuery('#categoryType').val();
	jQuery('table tr:last').after(getHtmlForCategory(categoryType));

});

function getHtmlForCategory(categoryType){
	if(categoryType == 'PI')
		return "<tr> <td> <select class='form-control' name='desc[]'> <option value='Polo'>Polo</option> </select> </td> <td> <select class='form-control' name='brand[]'> <option value='Gilden'>Gilden</option> </select> </td> <td> <select  name='style[]' class='form-control'> <option value='A1234'>A1234</option> </select> </td> <td> <select name='color[]' class='form-control'> <option value='Black'>Black</option> </select> </td><td><input type='text' name='total_pieces[]' class='form-control'></td> <td class='deleterow'><i class='fa fa-remove'></i></td> </tr>";
	else
		return "<tr> <td> <select class='form-control' name='desc[]'> <option value='Polo'>Polo</option> </select> </td> <td> <select class='form-control' name='brand[]'> <option value='Gilden'>Gilden</option> </select> </td> <td> <select  name='style[]' class='form-control'> <option value='A1234'>A1234</option> </select> </td> <td> <select name='color[]' class='form-control'> <option value='Black'>Black</option> </select> </td> <td><input type='text' name='qty_youth_xs[]' class='form-control'></td> <td><input type='text' name='qty_youth_s[]' class='form-control'></td> <td><input type='text' name='qty_youth_m[]' class='form-control'></td> <td><input type='text' name='qty_youth_l[]' class='form-control'></td> <td><input type='text' name='qty_youth_xl[]' class='form-control'></td> <td><input type='text' class='form-control' name='qty_adult_xs[]'></td> <td><input type='text' name='qty_adult_s[]' class='form-control'></td> <td><input type='text' name='qty_adult_m[]' class='form-control'></td> <td><input type='text' class='form-control' name='qty_adult_l[]'></td> <td><input type='text' name='qty_adult_xl[]' class='form-control'></td> <td><input type='text' name='qty_adult_2xl[]' class='form-control'></td> <td><input type='text' name='qty_adult_3xl[]' class='form-control'></td> <td><input type='text' name='qty_adult_4xl[]' class='form-control'></td> <td><input type='text' class='form-control' name='qty_adult_5xl[]'></td> <td><input type='text' class='form-control' name='qty_adult_6xl[]'></td> <td class='deleterow'><i class='fa fa-remove'></i></td> </tr>"
}

jQuery('#datetimepicker1').datetimepicker({
	format: 'MM-DD-YYYY'
});


// jQuery(function(){
// 	jQuery(".addnewrow").on("click", function(){
// 		console.log()
// 	})
// })
