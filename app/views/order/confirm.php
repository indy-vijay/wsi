{% extends 'dashboard/dashboard_layout.html' %}
{% block content %}
<main>
    <div class="container">
        <div class="wrap">
            <div class="row">
                <div class="col-md-4">
                    <h1 class="page-header">confirm order</h1>
                </div>
                <div class="col-md-8">
                    <ul class="list-inline dashboard-nav">
                        <li><a href="{{httpBasePath}}dashboard">Dashboard</a></li>
                        <li><a href="previous-orders.php">Previous Orders</a></li>
                        <li><a href="{{httpBasePath}}create-order">Create New Order</a></li>
                        <li><a href="create-reorder.php">Create Reorder</a></li>                      
                    </ul>
                </div>
            </div>
            <hr>

            <h4>Order Information</h4>
            <div class="row">
                <div class="col-md-4">
                    <dl class="dl-horizontal">
                        <dt>Date Ordered:</dt>
                        <dd>{{ "now"|date("m/d/Y") }}</dd>
                        <dt>In Hands Date:</dt> 
                        <dd>{{ order['in_hands_date']}}</dd>
                    </dl>
                </div>
                <div class="col-md-4">
                    <dl class="dl-horizontal">
                        <dt>Type:</dt>
                        <dd>{{ order['category'] }}</dd>
                        <dt>Delivery Type:</dt>
                        <dd>{{ order['delivery_type'] }}</dd>
                    </dl>
                </div>
            </div>

            <div class="row hidden-sm hidden-xs">
                <div class="col-md-3 col-md-offset-4">
                    <p class="text-center">Youth Size</p>
                </div>
                <div class="col-md-5">
                    <p class="text-center">Adult Size</p>
                </div>
            </div>
            <div class="table-responsive">

                <table class="table order-table">
                    <thead>
                        <tr>
                            <th>Description</th>
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

            <h4>Shipping Information</h4>


            <form class="form-horizontal" method="post" action="{{httpBasePath}}/order-final">
                <div class="row">
                    <div class="col-md-4 col-md-offset-2">
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">First Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{ customer['first_name'] }}" name="first_name" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Email Address</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" value="{{ communication['email'] }}" name="email" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Phone Number</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder=""  name="home_phone" value="{{ communication['home_phone'] }}">
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Last Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{ customer['last_name'] }}" name="last_name" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Alternate Email</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder=""  name="email_alternate" value="{{ communication['email_alternate'] }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Cell Phone</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="" name="mobile" value="{{ communication['mobile'] }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-md-offset-2">
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Fax Number</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="" name="fax" value="{{ communication['fax'] }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Company</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="company_name" value="{{ customer['company_name'] }}" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-md-offset-2">
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Address</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="address_1" value="{{ address['address_1'] }}" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">State</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="state">
                                {% for state in states  %}
                                    <option value="{{ state['state_abbr'] }}"  {% if address['state'] == state['state_abbr']%} selected="selected"{% endif %}>{{ state['state_name'] }}</option>
                                {% endfor %}
                                </select>                               
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">City</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="city" value="{{ address['city'] }}" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Zip</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="zip" value="{{ address['zip'] }}" placeholder="">
                            </div>
                        </div>
                        <p class="text-right"><button type="submit" class="btn btn-default">place order</button></p>

                    </div>
                </div>
                <input type="hidden" name="token" value="{{ token }}">
            </form>


        </div>
    </div>
</main>
{%endblock%}