<td>
<select class="form-control" name="desc[]"  id="order-desc-{{i}}"  onchange="changeDesc({{i}})">
    {% for descr in desc %}                         
            <option value="{{ descr['id'] }}">{{ descr['desc'] }}</option>
    {% endfor %}
</select>
</td>
<td>
<select class="form-control" name="brand[]" id="order-brand-{{i}}" onchange="changeBrand({{i}})">                  
    {% for brand in brands %}                         
            <option value="{{ brand['id'] }}">{{ brand['brand'] }}</option>
    {% endfor %}
</select>
</td>
<td>
<select class="form-control" name="style[]" id="order-style-{{i}}" onchange="changeStyle({{i}})">
    {% for style in styles %}                         
            <option value="{{ style['id'] }}">{{ style['styles'] }}</option>
    {% endfor %}                                 
</select>
</td>
<td>
<select class="form-control" name="color[]" id="order-color-{{i}}">
    {% for color in colors %}                         
            <option value="{{ color['id'] }}">{{ color['color'] }}</option>
    {% endfor %}   
</select>
</td>
{% if categoryType == 'PI' %}
<td><input type="text" class="form-control" name="total_pieces[]"></td>
{% else %}
{% include 'partials/create-order-sizes.php' %}
{% endif %}
<td class="deleterow"><i class="fa fa-remove"></i></td>