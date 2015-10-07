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
                        <li><a href="dashboard">Dashboard</a></li>
                        <li><a href="previous-orders.php">Previous Orders</a></li>
                        <li><a href="create-order">Create New Order</a></li>
                        <li><a href="create-reorder.php">Create Reorder</a></li>
                        <li><a href="cart.php">Cart</a></li>
                    </ul>
                </div>
            </div>
            <hr>

            <form class="form-horizontal" method="post" action="">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Step 2: Select Item</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-5 voffset3">
                                <a href="#" class="btn btn-default" data-toggle="modal" data-target="#myModal">Upload Artwork</a>

                            </div>
                            <div class="col-md-1 col-md-offset-6">
                                <img src="{{ customIncludePath }}img/client-a.jpg" width="50" height="50" />
                            </div>
                        </div>
                    </div>
                </div>                    

                <h4>Order Information</h4>
                <div class="row voffset3">
                    <div class="col-md-8">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label">Type:</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" value="{{ categoryName }}" disabled>
                                        <input type="hidden" name="category" value="{{categoryType}}">
                                        <input type="hidden" name="type" value="NEW">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label">Delivery Type:</label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="delivery_type">
                                            <option value="LD">Local delivery</option>
                                            <option value="WC">Will Call/Pick Up</option>
                                            <option value="S">Shipping</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label">In Hands Date:</label>
                                    <div class="col-md-8">
                                        <div class="input-group date" id="datetimepicker1">
                                            <input type="text" class="form-control" name="in_hands_date" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label">Is this for an event?</label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="for_event">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
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
                                <th width="6%">Desc</th>
                                <th width="6%">Brand</th>
                                <th width="6%">Style #</th>
                                <th width="6%">Color</th>
                                <th width="5%">XS</th>
                                <th width="5%">S</th>
                                <th width="5%">M</th>
                                <th width="5%">L</th>
                                <th width="5%">XL</th>
                                <th width="5%">XS</th>
                                <th width="5%">S</th>
                                <th width="5%">M</th>
                                <th width="5%">L</th>
                                <th width="5%">XL</th>
                                <th width="5%">2XL</th>
                                <th width="5%">3XL</th>
                                <th width="5%">4XL</th>
                                <th width="5%">5XL</th>
                                <th width="5%">6XL</th>
                                <th width="5%"></th>
                            </tr>
                        </thead>

                            <tr>
                                <td>
                                    <select class="form-control" name="desc[]">
                                        <option value="Polo">Polo</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="brand[]">
                                        <option value="Gilden">Gilden</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="style[]">
                                        <option value="A1234">A1234</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="color[]">
                                        <option value="Black">Black</option>
                                    </select>
                                </td>
                    
                                <td><input type="text" class="form-control" name="qty_youth_xs[]"></td>
                                <td><input type="text" class="form-control" name="qty_youth_s[]"></td>
                                <td><input type="text" class="form-control" name="qty_youth_m[]"></td>
                                <td><input type="text" class="form-control" name="qty_youth_l[]"></td>
                                <td><input type="text" class="form-control" name="qty_youth_xl[]"></td>
                                <td><input type="text" class="form-control" name="qty_adult_xs[]"></td>
                                <td><input type="text" class="form-control" name="qty_adult_s[]"></td>
                                <td><input type="text" class="form-control" name="qty_adult_m[]"></td>
                                <td><input type="text" class="form-control" name="qty_adult_l[]"></td>
                                <td><input type="text" class="form-control" name="qty_adult_xl[]"></td>
                                <td><input type="text" class="form-control" name="qty_adult_2xl[]"></td>
                                <td><input type="text" class="form-control" name="qty_adult_3xl[]"></td>
                                <td><input type="text" class="form-control" name="qty_adult_4xl[]"></td>
                                <td><input type="text" class="form-control" name="qty_adult_5xl[]"></td>
                                <td><input type="text" class="form-control" name="qty_adult_6xl[]"></td>
                                <td class="deleterow"><i class="fa fa-remove"></i></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <input type="hidden" name="token" value="{{token}}">
                <input type="hidden" name="fileNameWithPath" value="{{fileNameWithPath}}">
                <button class="btn btn-link addnewrow" type="button"><i class="fa fa-plus"></i> Add New</button>

                <p class="text-right">
                    <button type="submit" class="btn btn-default" name="order_placed" value="1">place order</button>
                </p>

            </form>
        </div>
    </div>
</main>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Upload Artwork</h4>
            </div>
             <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                       
                            <div class="form-group">
                                <label for="" class="col-md-4 control-label">Type:</label>
                                <div class="col-md-8">
                                    <input type="file" name="artwork" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-md-4 control-label">Placement:</label>
                                <div class="col-md-8">
                                    <select class="form-control">
                                        <option value="">Front</option>
                                        <option value="">Back</option>
                                        <option value="">Left Chest</option>
                                        <option value="">Right Chest</option>
                                        <option value="">Left Sleeve</option>
                                        <option value="">Right Sleeve</option>
                                    </select>
                                </div>
                            </div>
                        
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default" onClick="">Submit</button>
            </div>
        </div>
        </form>
    </div>
</div>
{%endblock%}