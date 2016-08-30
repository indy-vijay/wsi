jQuery(document).on("click", ".deleterow", function () {
    var jQuerykillrow = jQuery(this).parent('tr');
    jQuerykillrow.addClass("danger");
    jQuerykillrow.fadeOut(2000, function () {
        jQuery(this).remove();
    });
});

// jQuery(document).on("click", ".deleterow", function () {
//     var current_order_line = jQuery('#current_order_line').val();
//      jQuery('#line_no_'+current_order_line).addClass('hidden');
//       jQuery('#current_order_line').val(parseInt(current_order_line) - 1);
// });



// jQuery(".addnewrow").on("click", function(){

// 	var categoryType = jQuery('#categoryType').val();
// 	jQuery('table tr:last').after(getHtmlForCategory(categoryType));

// });

jQuery(".addnewrow").on("click", function(){
    var current_order_line = jQuery('#current_order_line').val();
    jQuery('#line_no_'+current_order_line).removeClass('hidden');
    jQuery('#current_order_line').val(parseInt(current_order_line) + 1);
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
    var line_no = parseInt(jQuery('#current_order_line').val()) + 1;
	if(categoryType == 'PI')
		return "<tr id='line_no_"+line_no+"'> <td> <select class='form-control' name='desc[]'> <option value='Polo'>Polo</option> </select> </td> <td> <select class='form-control' name='brand[]'> <option value='Gilden'>Gilden</option> </select> </td> <td> <select  name='style[]' class='form-control'> <option value='A1234'>A1234</option> </select> </td> <td> <select name='color[]' class='form-control'> <option value='Black'>Black</option> </select> </td><td><input type='text' name='total_pieces[]' class='form-control'></td> <td class='deleterow'><i class='fa fa-remove'></i></td> </tr>";
	else
		return "<tr id='line_no_"+line_no+"'> <td> <select class='form-control' name='desc[]'> <option value='Polo'>Polo</option> </select> </td> <td> <select class='form-control' name='brand[]'> <option value='Gilden'>Gilden</option> </select> </td> <td> <select  name='style[]' class='form-control'> <option value='A1234'>A1234</option> </select> </td> <td> <select name='color[]' class='form-control'> <option value='Black'>Black</option> </select> </td> <td><input type='text' name='qty_youth_xs[]' class='form-control'></td> <td><input type='text' name='qty_youth_s[]' class='form-control'></td> <td><input type='text' name='qty_youth_m[]' class='form-control'></td> <td><input type='text' name='qty_youth_l[]' class='form-control'></td> <td><input type='text' name='qty_youth_xl[]' class='form-control'></td> <td><input type='text' class='form-control' name='qty_adult_xs[]'></td> <td><input type='text' name='qty_adult_s[]' class='form-control'></td> <td><input type='text' name='qty_adult_m[]' class='form-control'></td> <td><input type='text' class='form-control' name='qty_adult_l[]'></td> <td><input type='text' name='qty_adult_xl[]' class='form-control'></td> <td><input type='text' name='qty_adult_2xl[]' class='form-control'></td> <td><input type='text' name='qty_adult_3xl[]' class='form-control'></td> <td><input type='text' name='qty_adult_4xl[]' class='form-control'></td> <td><input type='text' class='form-control' name='qty_adult_5xl[]'></td> <td><input type='text' class='form-control' name='qty_adult_6xl[]'></td> <td class='deleterow'><i class='fa fa-remove'></i></td> </tr>"
}

jQuery('#datetimepicker1').datetimepicker({
	format: 'MM-DD-YYYY'
});

jQuery('#datetimepicker2').datetimepicker({
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

function changeDesc(line_no){
    jQuery.ajax({
        'url' : ajaxUrl + 'ajax-desc-brands/' +jQuery('#order-desc-'+line_no).val(),
        'type' : 'POST',
        'success' : function(brands){
                    var order_brand = jQuery('#order-brand-'+line_no);
                    var brand_id    = 0;
                    order_brand.empty();
                    jQuery.each(jQuery.parseJSON(brands), function(key,brands){    
                        if(key == 0)
                            changeBrand(line_no,brands.id); //also change the colors dropdown
                        order_brand.append('<option value="'+brands.id+'">'+brands.brand+'</option>')
                    });
        }
    });

}

function changeBrand(line_no, brand_id=0){

    if( brand_id == 0 ){
        brand_id = jQuery('#order-brand-'+line_no).val();
    }

    jQuery.ajax({
        'url' : ajaxUrl + 'ajax-brand-styles/' + brand_id,
        'type' : 'POST',
        'success' : function(styles){
                    var order_style = jQuery('#order-style-'+line_no);
                    var style_id    = 0;
                    order_style.empty();
                    jQuery.each(jQuery.parseJSON(styles), function(key,styles){    
                        if(key == 0)
                            changeStyle(line_no,styles.id); //also change the colors dropdown
                        order_style.append('<option value="'+styles.id+'">'+styles.styles+'</option>')
                    });
        }
    });

  
}

function changeStyle(line_no,style_id=0){
    removeOptionUnavailable();
    if( style_id == 0 ){
        style_id = jQuery('#order-style-'+line_no).val();
    }

    jQuery.ajax({
        'url' : ajaxUrl + 'ajax-style-colors/' + style_id,
        'type' : 'POST',
        'success' : function(colors){
                    var order_color = jQuery('#order-color-'+line_no);
                    order_color.empty();
                    
                    colors = jQuery.parseJSON(colors);
                    if(colors == 0){
                        optionUnavailable("Color");
                        order_color.hide();
                    }
                    else{
                    order_color.show();    
                    jQuery.each(colors, function(key,color){                       
                        order_color.append('<option value="'+color.id+'">'+color.color+'</option>')
                    });
                    order_color.append('<option value="0">Other</option>')  
                    }
        }
    });
}

function changeColor(line_no){   
    if(jQuery('#order-color-'+line_no).val() == '0'){    
        jQuery('#order-color-'+line_no).after('<input type="text" class="form-control" name="color[]" placeholder="Enter a color" >');
        jQuery('#order-color-'+line_no).remove();
    }    
}

function removeOptionUnavailable(){
    
    if(!$('.option-unavailable').hasClass("hidden"))
         $('.option-unavailable').addClass('hidden');

    $('button[name=order_placed]').prop('disabled',false);    
}

function optionUnavailable(param){
    $('button[name=order_placed]').attr('disabled','disabled');
    $('#unavailable-param').text(param);
    $('.option-unavailable').removeClass('hidden');
}

jQuery('#for_event').on("change",function(){
    if(jQuery(this).val() == 0 )
        jQuery('.event-detail').hide();
    else
        jQuery('.event-detail').show();

})

jQuery(function(){
    jQuery('#order-form').on("submit",function(e){
        jQuery('.hidden').remove();
        return true;
    })
})


