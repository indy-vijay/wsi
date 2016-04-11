{% extends 'dashboard/dashboard_layout.html' %}
{% block content %}
<main>
    <div class="container">
        <div class="wrap">
            <div class="row">
                <div class="col-md-4">
                    <h1 class="page-header">order details</h1>
                </div>
                <div class="col-md-8">
                    <ul class="list-inline dashboard-nav">
                        <li><a href="{{httpBasePath}}dashboard">Dashboard</a></li>
                        <li><a href="{{httpBasePath}}previous-orders">Previous Orders</a></li>
                        <li><a href="{{httpBasePath}}create-order">Create New Order</a></li>
                        <li><a href="{{httpBasePath}}create-reorder">Create Reorder</a></li>
                        <li><a href="{{httpBasePath}}logout">Logout</a></li>
                    </ul>
                </div>
            </div>
            <hr>
            <form class="form-horizontal">

                <div class="panel panel-default">
                
                    <div class="panel-body">
                            <strong>Artwork</strong>
                          {% for placementKey,placement in placements %}
                            
                             <div class="col-md-2 artwork-preview pull-right">
                                <span class="artwork-preview-{{ placementKey }}">{{ placementPosition[placement] }}</span>
                                <br>
                       
                                <img class="artwork-preview-{{ placementKey }}" src="{{httpBasePath}}{{ artworkThumbPath }}{{fileNames[placementKey]}}" alt=""  width="50" height="50"/>
                             </div>
                          {% endfor %}
                    </div>
                </div>                    

                <h4>Order Information</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Date Ordered:</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" value="{{ order['created_at'] | date('m-d-Y') }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Type:</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" value="{{ order['category'] }}" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Delivery Type:</label>
                            <div class="col-md-8">
                                <select class="form-control" disabled>                                
                                    <option value="">{{ order['delivery_type'] }}</option>              
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">In Hands Date:</label>
                            <div class="col-md-8">
                               <!--  <div class="input-group date" id="datetimepicker1"> -->
                                    <input type="text" class="form-control" {% if order['in_hands_date'] %}  value="{{ order['in_hands_date']|date('m-d-Y')}}" {% endif %} disabled/>
                               <!--      <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span> -->
                                <!-- </div> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Is this for an event?</label>
                            <div class="col-md-8">
                                <select class="form-control" disabled>
                                    <option value="">Yes</option>
                                    <option value="">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row hidden-sm hidden-xs voffset5">
                 {% if(category_code != 'PI')%}
                    <div class="col-md-3 col-md-offset-3">
                        <p class="text-center">Youth Size</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-center">Adult Size</p>
                    </div>
                  {% endif %}
                </div>
                <div class="table-responsive">
                    <table class="table order-table">
                        <thead>
                            <tr>
                                <th>Desc</th>
                                <th>Brand</th>
                                <th>Style #</th>
                                <th>Color</th>
                            {% if(category_code == 'PI')%}
                                <th>Quantity</th>
                            {% else %}
                               {% include 'partials/create-order-size-headings.php' %}
                            {% endif %}
                            </tr>
                        </thead>

                        <tbody>
                            {% for order_line in order_lines %}
                            <tr>
                                <td>{{ order_line['desc'] }}</td>
                                <td>{{ order_line['brand'] }}</td>
                                <td>{{ order_line['style'] }}</td>
                                <td>{{ order_line['color'] }}</td>
                                {% if(category_code == 'PI')%}
                                 <td>{{ order_line['total_pieces'] }}</td>
                                {% else %}
                                 {% include 'partials/create-order-sizes.php'%}
                                {% endif %}                          
                            </tr> 
                        {% endfor %}  
                        </tbody>
                    </table>
                </div>
            </form>

        </div>
    </div>
</main>
{%endblock%}