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



jQuery(".addnewimage").on("click", function(){

	jQuery('.addnewimage').before(getHtmlForUploadArtworkRow());

});


jQuery('body').on('click','.upload-artwork-row-close',function()
    {
    $(this).closest('.upload-artwork-row').remove();
    });


jQuery('body').on('click','.artwork-remove',function()
    {
     var el=$(this);
     var artwork_preview_id = el.attr('rel');
     $('.artwork-preview-'+artwork_preview_id).remove(); 
    
    });

function moveUploadedArtworks()
{

   $(".addnewimage").before($('#artwork-uploaded').clone());
}

function getHtmlForUploadArtworkRow(){

    return $('#upload-artwork-row').clone() .find(".image_preview").removeAttr("src").end(); ;
}

function getHtmlForCategory(categoryType){
	if(categoryType == 'PI')
		return "<tr> <td> <select class='form-control' name='desc[]'> <option value='Polo'>Polo</option> </select> </td> <td> <select class='form-control' name='brand[]'> <option value='Gilden'>Gilden</option> </select> </td> <td> <select  name='style[]' class='form-control'> <option value='A1234'>A1234</option> </select> </td> <td> <select name='color[]' class='form-control'> <option value='Black'>Black</option> </select> </td><td><input type='text' name='total_pieces[]' class='form-control'></td> <td class='deleterow'><i class='fa fa-remove'></i></td> </tr>";
	else
		return "<tr> <td> <select class='form-control' name='desc[]'> <option value='Polo'>Polo</option> </select> </td> <td> <select class='form-control' name='brand[]'> <option value='Gilden'>Gilden</option> </select> </td> <td> <select  name='style[]' class='form-control'> <option value='A1234'>A1234</option> </select> </td> <td> <select name='color[]' class='form-control'> <option value='Black'>Black</option> </select> </td> <td><input type='text' name='qty_youth_xs[]' class='form-control'></td> <td><input type='text' name='qty_youth_s[]' class='form-control'></td> <td><input type='text' name='qty_youth_m[]' class='form-control'></td> <td><input type='text' name='qty_youth_l[]' class='form-control'></td> <td><input type='text' name='qty_youth_xl[]' class='form-control'></td> <td><input type='text' class='form-control' name='qty_adult_xs[]'></td> <td><input type='text' name='qty_adult_s[]' class='form-control'></td> <td><input type='text' name='qty_adult_m[]' class='form-control'></td> <td><input type='text' class='form-control' name='qty_adult_l[]'></td> <td><input type='text' name='qty_adult_xl[]' class='form-control'></td> <td><input type='text' name='qty_adult_2xl[]' class='form-control'></td> <td><input type='text' name='qty_adult_3xl[]' class='form-control'></td> <td><input type='text' name='qty_adult_4xl[]' class='form-control'></td> <td><input type='text' class='form-control' name='qty_adult_5xl[]'></td> <td><input type='text' class='form-control' name='qty_adult_6xl[]'></td> <td class='deleterow'><i class='fa fa-remove'></i></td> </tr>"
}

jQuery('#datetimepicker1').datetimepicker({
	format: 'MM-DD-YYYY'
});



function readURL(input) {
   
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
           
            $(input).parents(".upload-artwork-row").find( ".image_preview" ).attr('src', e.target.result); 
            }
        reader.readAsDataURL(input.files[0]);
        }
    }


jQuery('body').on('change','.upload',function(){
    readURL(this);
});

function changeBrand(){
    jQuery.ajax({
        'url' : ajaxUrl + 'ajax-brand-styles/' +jQuery('#order-brand').val(),
        'type' : 'POST',
        'success' : function(styles){
                    var order_style = jQuery('#order-style');
                    var style_id    = 0;
                    order_style.empty();
                    jQuery.each(jQuery.parseJSON(styles), function(key,styles){    
                        if(key == 0)
                            changeStyle(styles.id); //also change the colors dropdown
                        order_style.append('<option value="'+styles.id+'">'+styles.styles+'</option>')
                    });
        }
    });

  
}

function changeStyle(style_id=0){
    if( style_id == 0 )
        style_id = jQuery('#order-style').val();

    jQuery.ajax({
        'url' : ajaxUrl + 'ajax-style-colors/' + style_id,
        'type' : 'POST',
        'success' : function(colors){
                    var order_color = jQuery('#order-color');
                    order_color.empty();
                    jQuery.each(jQuery.parseJSON(colors), function(key,color){                       
                        order_color.append('<option value="'+color.id+'">'+color.color+'</option>')
                    });
        }
    });
}


