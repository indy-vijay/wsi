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
                        <li><a href="index.php">Dashboard</a></li>
                        <li><a href="previous-orders.php">Previous Orders</a></li>
                        <li><a href="create-new-order.php">Create New Order</a></li>
                        <li><a href="create-reorder.php">Create Reorder</a></li>
                        <li><a href="cart.php">Cart</a></li>
                    </ul>
                </div>
            </div>
            <hr>

            <div class="btn-section">

                <a href="create-new-order.php" class="btn btn-default">create new order</a>
                <a href="create-reorder.php" class="btn btn-default">create reorder</a>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">my profile <span><a href="update-information.php">Update Information</a></span></h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Hiren Patel, Blackstorm, Inc</strong><br/>
                                        850 Hampshire Road<br/>
                                        Westlake Vilage, CA 91361
                                    </address>
                                </div>
                                <div class="col-md-6">
                                    <dl class="dl-horizontal">
                                      <dt>Email:</dt>
                                      <dd>hiren@blackstorm.net</dd>
                                      <dt>Phone:</dt>
                                      <dd>(661) 304-2515</dd>
                                      <dt>Cell:</dt>
                                      <dd>(661) 123-4567</dd>
                                      <dt>Fax:</dt>
                                      <dd>(661) 456-7890</dd>
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
                                <tr>
                                    <td>1234</td>
                                    <td>In Print</td>
                                    <td><a href="order-details.php">Details</a></td>
                                </tr>
                                <tr>
                                    <td>5234</td>
                                    <td>Pending Artwork</td>
                                    <td><a href="order-details.php">Details</a></td>
                                </tr>
                                <tr>
                                    <td>2135</td>
                                    <td>Shipped</td>
                                    <td><a href="order-details.php">Details</a></td>
                                </tr>
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