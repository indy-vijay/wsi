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
                        <li><a href="{{httpBasePath}}dashboard">Dashboard </a></li>
                        <li><a href="{{httpBasePath}}previous-orders">Previous Orders</a></li>
                        <li><a href="{{httpBasePath}}create-order">Create New Order</a></li>
                        <li><a href="{{httpBasePath}}create-reorder">Create Reorder</a></li>       
                        <li><a href="{{httpBasePath}}logout">Logout</a></li>               
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

                        <dd>
                        {% if order['in_hands_date'] %}
                          {{ order['in_hands_date']|date("m/d/Y")}}
                        {% endif %}
                        </dd>
                        <dt>Order Notes:</dt>
                        <dd>{{ order['order_notes']}}</dd>
                        {% if order['for_event'] == 1 %}
                            <dt>Event Name:</dt>
                            <dd>{{ order['event_name'] }}</dd>
                            <dt>Event Date:</dt>
                            <dd>{{ order['event_date'] }}</dd>
                        {% endif %}
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
            {% if(category_code != 'PI')%}
                <div class="col-md-3 col-md-offset-4">
                    <p class="text-center">Youth Size</p>
                </div>
                <div class="col-md-5">
                    <p class="text-center">Adult Size</p>
                </div>
            {% endif%}
            </div>
            <div class="table-responsive">

                <table class="table order-table">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Brand</th>
                            <th>Style #</th>
                            <th>Color</th>
                            {% if(category_code == 'PI')%}
                                <th>Quantity</th> 
                            {% else %}
                                {% include 'partials/confirm-order-sizes-heading.php' %}
                            {% endif%}
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
                                {% include 'partials/confirm-order-sizes.php' %}
                             {% endif%}  
                            </tr> 
                        {% endfor %}                                            
                    </tbody>
                </table>
            </div>

            <!-- <h4>Shipping Information</h4> -->


            <form class="form-horizontal" method="post" action="{{httpBasePath}}/order-final">
                <div class="row">
                    <!-- <div class="col-md-4 col-md-offset-2">
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
                        </div> -->
                        <p class="text-right">
                            <a href="{{httpBasePath}}dashboard"  class="btn btn-default">Cancel Order</a>
                            <button type="submit" class="btn btn-default">place order</button>
                        </p>

                    <!-- </div> -->
                </div>
                <input type="hidden" name="token" value="{{ token }}">
            </form>
        

        </div>
    </div>
</main>
{%endblock%}