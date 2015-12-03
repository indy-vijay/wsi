{% extends 'dashboard/dashboard_layout.html' %}
{% block content %}
<main>
    <div class="container">
        <div class="wrap">
            <div class="row">
                <div class="col-md-4">
                    <h1 class="page-header">create order</h1>
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

            <h5><strong>Step 1: Type of Order</strong></h5>

            <p class="text-center">What type of products are you ordering?</p>

            <div class="row voffset5">
                <div class="col-md-2 col-md-offset-3">
                    <div class="create-order-cta">
                        <a href="create-order?type=sp">
                            <img src="{{ customIncludePath }}img/screen-printing.jpg" alt="screen printing" class="img-responsive" />
                            <span>{{ orderCategories['SP'] }}</span>
                        </a>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="create-order-cta">
                        <a href="create-order?type=e">
                            <img src="{{ customIncludePath }}img/embroidery.jpg" alt="embroidery" class="img-responsive" />
                            <span>{{ orderCategories['E'] }}</span>
                        </a>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="create-order-cta">
                        <a href="create-order?type=pi">
                            <img src="{{ customIncludePath }}img/promotional.jpg" alt="promotional" class="img-responsive" />
                            <span>{{ orderCategories['PI'] }}</span>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
{% endblock %}
