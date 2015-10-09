{% extends 'dashboard/dashboard_layout.html' %}
{% block content %}
<main>
    <div class="container">
        <div class="wrap">
            <div class="row">
                <div class="col-md-4">
                    <h1 class="page-header">order confirmed</h1>
                </div>
                <div class="col-md-8">
                    <ul class="list-inline dashboard-nav">
                        <li><a href="{{httpBasePath}}dashboard">Dashboard</a></li>
                        <li><a href="{{httpBasePath}}previous-orders">Previous Orders</a></li>
                        <li><a href="{{httpBasePath}}create-order">Create New Order</a></li>
                        <li><a href="{{httpBasePath}}create-reorder">Create Reorder</a></li>
                    </ul>
                </div>
            </div>
            <hr>

            <h4 class="text-center">Thank You!</h4>
            <p class="text-center">Vivamus posuere, quam sed tincidunt ultricies, elit nibh iaculis enim,<br/>nec sagittis elit elit at leo. Suspendisse auctor a lacus vel porttitor.</p>

        </div>
    </div>
</main>
{%endblock%}