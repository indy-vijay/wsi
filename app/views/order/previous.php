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
                        <li><a href="{{httpBasePath}}logout">Logout</a></li>  
                    </ul>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">previous orders</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Date Orders</th>
                                        <th>View Order</th>
                                    </tr>
                                </thead>
                                <tbody>
                                {% for customerOrder in customerOrders  %}
                                   <tr>
                                    <td>{{ customerOrder['order_id']}}</td>
                                    <td>{{ customerOrder['created_at']|date("m/d/Y") }}</td>
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