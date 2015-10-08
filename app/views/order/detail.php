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
                        <li><a href="previous-orders.php">Previous Orders</a></li>
                        <li><a href="{{httpBasePath}}create-order">Create New Order</a></li>
                        <li><a href="create-reorder.php">Create Reorder</a></li>
                        <li><a href="cart.php">Cart</a></li>
                    </ul>
                </div>
            </div>
            <hr>
            <form class="form-horizontal">

                <div class="panel panel-default">
                
                    <div class="panel-body">
                        <ul class="list-inline no-margin">
                            <li><strong>Artwork</strong></li>
                            <li><img src="img/client-a.jpg" width="75" height="75"></li>
                            <li><img src="img/client-e.jpg" width="75" height="75"></li>
                            <li><img src="img/client-d.jpg" width="75" height="75"></li>
                        </ul>
                    </div>
                </div>                    

                <h4>Order Information</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Date Ordered:</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" value="08/08/15" disabled>
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
                                <div class="input-group date" id="datetimepicker1">
                                    <input type="text" class="form-control"  value="{{ order['in_hands_date']}}" disabled/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
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
                    <div class="col-md-3 col-md-offset-3">
                        <p class="text-center">Youth Size</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-center">Adult Size</p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table order-table">
                        <thead>
                            <tr>
                                <th>Desc</th>
                                <th>Brand</th>
                                <th>Style #</th>
                                <th>Color</th>
                                <th>XS</th>
                                <th>S</th>
                                <th>M</th>
                                <th>L</th>
                                <th>XL</th>
                                <th>XS</th>
                                <th>S</th>
                                <th>M</th>
                                <th>L</th>
                                <th>XL</th>
                                <th>2XL</th>
                                <th>3XL</th>
                                <th>4XL</th>
                                <th>5XL</th>
                                <th>6XL</th>
                            </tr>
                        </thead>

                        <tbody>
                            {% for order_line in order_lines %}
                            <tr>
                                <td>{{ order_line['desc'] }}</td>
                                <td>{{ order_line['brand'] }}</td>
                                <td>{{ order_line['style'] }}</td>
                                <td>{{ order_line['color'] }}</td>
                                <td>{{ order_line['qty_youth_xs'] }}</td>
                                <td>{{ order_line['qty_youth_s'] }}</td>
                                <td>{{ order_line['qty_youth_m'] }}</td>
                                <td>{{ order_line['qty_youth_l'] }}</td>
                                <td>{{ order_line['qty_youth_xl'] }}</td>
                                <td>{{ order_line['qty_adult_xs'] }}</td>
                                <td>{{ order_line['qty_adult_s'] }}</td>
                                <td>{{ order_line['qty_adult_m'] }}</td>
                                <td>{{ order_line['qty_adult_l'] }}</td>
                                <td>{{ order_line['qty_adult_xl'] }}</td>
                                <td>{{ order_line['qty_adult_2xl'] }}</td>
                                <td>{{ order_line['qty_adult_3xl'] }}</td>
                                <td>{{ order_line['qty_adult_4xl'] }}</td>
                                <td>{{ order_line['qty_adult_5xl'] }}</td>
                                <td>{{ order_line['qty_adult_6xl'] }}</td>
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