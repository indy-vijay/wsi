jQuery(document).on("click", ".deleterow", function () {
    var jQuerykillrow = jQuery(this).parent('tr');
    jQuerykillrow.addClass("danger");
    jQuerykillrow.fadeOut(2000, function () {
        jQuery(this).remove();
    });
});


jQuery(".addnewrow").on("click", function(){
	jQuery('table tr:last').after("<tr> <td> <select class='form-control'> <option value=''>Polo</option> </select> </td> <td> <select class='form-control'> <option value=''>Gilden</option> </select> </td> <td> <select class='form-control'> <option value=''>A1234</option> </select> </td> <td> <select class='form-control'> <option value=''>Black</option> </select> </td> <td><input type='text' class='form-control'></td> <td><input type='text' class='form-control'></td> <td><input type='text' class='form-control'></td> <td><input type='text' class='form-control'></td> <td><input type='text' class='form-control'></td> <td><input type='text' class='form-control'></td> <td><input type='text' class='form-control'></td> <td><input type='text' class='form-control'></td> <td><input type='text' class='form-control'></td> <td><input type='text' class='form-control'></td> <td><input type='text' class='form-control'></td> <td><input type='text' class='form-control'></td> <td><input type='text' class='form-control'></td> <td><input type='text' class='form-control'></td> <td><input type='text' class='form-control'></td> <td class='deleterow'><i class='fa fa-remove'></i></td> </tr>");
});

jQuery('#datetimepicker1').datetimepicker({
	format: 'YYYY-MM-DD'
});



