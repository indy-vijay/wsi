{% extends 'dashboard/dashboard_layout.html' %}
{% block content %}
<main>
    <div class="container">
        <div class="wrap">
            <div class="row">
                <div class="col-md-4">
                    <h1 class="page-header">dashboard</h1>
                </div>
                <div class="col-md-8">
                    <ul class="list-inline dashboard-nav">
                        <li><a href="{{httpBasePath}}dashboard">Dashboard</a></li>
                        <li><a href="{{httpBasePath}}previous-orders">Previous Orders</a></li>
                        <li><a href="{{httpBasePath}}create-order">Create New Order</a></li>
                        <li><a href="{{httpBasePath}}create-reorder">Create Reorder</a></li>
                        <!-- <li><a href="cart.php">Cart</a></li> -->
                    </ul>
                </div>
            </div>
            <hr>

            <div class="btn-section">

                <a href="create-order" class="btn btn-default">create new order</a>
                <a href="create-reorder" class="btn btn-default">create reorder</a>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">my profile <span><a href="update-info">Update Information</a></span></h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>{{ customer['first_name'] }} {{ customer['last_name'] }},  {{ customer['company_name'] }}</strong><br/>
                                        {{ address['address_1'] }}<br/>
                                        {% if address['address_2']%}
                                          {{ address['address_2'] }}<br/>
                                        {% endif %}
                                         {{ address['city']}}, {{ address['state'] }} {{ address['zip'] }}
                                    </address>
                                </div>
                                <div class="col-md-6">
                                    <dl class="dl-horizontal">
                                      <dt>Email:</dt>
                                      <dd>{{ communication['email'] }}</dd>
                                      <dt>Phone:</dt>
                                      <dd>{{ communication['home_phone'] }}</dd>
                                      <dt>Cell:</dt>
                                      <dd>{{ communication['mobile'] }}</dd>
                                      <dt>Fax:</dt>
                                      <dd>{{ communication['fax'] }}</dd>
                                  </dl>
                              </div>
                          </div>
                      </div>
                  </div>  
                  
                  <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">current orders</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Current Status</th>
                                    <th>View Order</th>
                                </tr>
                            </thead>
                            <tbody>
                               {% for customerOrder in customerOrders  %}
                                <tr>
                                    <td>{{ customerOrder['order_id']}}</td>
                                    <td>{{ orderStatuses[customerOrder['status']] }}</td>
                                    <td><a href="{{httpBasePath}}order-detail/{{customerOrder['order_id']}}">Details</a></td>
                                </tr>
                             
                               {% endfor %}
                            </tbody>
                        </table>
                    </div>
                </div>                    
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">support</h3>
                    </div>
                    <div class="panel-body">
                        <h5><strong>Need help with you order?</strong></h5>
                        <p>Fusce orci nisi, mattis nec sodales eu, lobortis vel tortor. Duis a elit libero. Pellentesque lacinia lectus ipsum, ac pharetra risus suscipit sed. Ut eget nibh mauris.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
{% endblock %}