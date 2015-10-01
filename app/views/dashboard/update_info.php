{% extends 'dashboard/dashboard_layout.html' %}
{% block content %}
<main>
    <div class="container">
        <div class="wrap">
            <div class="row">
                <div class="col-md-4">
                    <h1 class="page-header">update information</h1>
                </div>
                <div class="col-md-8">
                    <ul class="list-inline dashboard-nav">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li><a href="previous-orders.php">Previous Orders</a></li>
                        <li><a href="create-new-order.php">Create New Order</a></li>
                        <li><a href="create-reorder.php">Create Reorder</a></li>
                        <li><a href="cart.php">Cart</a></li>
                    </ul>
                </div>
            </div>
            <hr>

            <form class="form-horizontal" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">First Name</label>
                            <div class="col-md-8">
                                <input class="form-control" name="first_name" value="{{ customer['first_name'] }}" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Last Name</label>
                            <div class="col-md-8">
                                <input class="form-control" name="last_name" value="{{ customer['last_name'] }}" type="text">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Email Address</label>
                            <div class="col-md-8">
                                <input class="form-control" name="email" value="{{ communication['email'] }}" type="email">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Alternate Email</label>
                            <div class="col-md-8">
                                <input class="form-control" name="email_alternate" value="{{ communication['email_alternate'] }}" type="email">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Phone Number</label>
                            <div class="col-md-8">
                                <input class="form-control" name="home_phone" value="{{ communication['home_phone'] }}" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Cell Phone</label>
                            <div class="col-md-8">
                                <input class="form-control" name="mobile" value="{{ communication['mobile'] }}" type="text">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Fax Number</label>
                            <div class="col-md-8">
                                <input class="form-control" name="fax" value="{{ communication['fax'] }}" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Company</label>
                            <div class="col-md-8">
                                <input class="form-control" name="company_name" value="{{ customer['company_name'] }}" type="text">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Address</label>
                            <div class="col-md-8">
                                <input class="form-control" name="address_1" value="{{ address['address_1'] }}" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">City</label>
                            <div class="col-md-8">
                                <input class="form-control" name="city" value="{{ address['city'] }}" type="text">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">State</label>
                            <div class="col-md-8">
                                <select class="form-control" name="state">
                                {% for state in states  %}
                                    <option value="{{ state['state_abbr'] }}"  {% if address['state'] == state['state_abbr']%} selected="selected"{% endif %}>{{ state['state_name'] }}</option>
                                {% endfor %}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Zip</label>
                            <div class="col-md-8">
                                <input class="form-control" name="zip" value="{{ address['zip'] }}" type="text">
                            </div>
                        </div>
                    </div>
                </div>

                
                <input type="hidden" name="token" value="{{token}}">
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
{% endblock %}