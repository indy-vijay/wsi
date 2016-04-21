
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
                        <li><a href="{{httpBasePath}}dashboard">Dashboard </a></li>
                        <li><a href="{{httpBasePath}}previous-orders">Previous Orders</a></li>
                        <li><a href="{{httpBasePath}}create-order">Create New Order</a></li>
                        <li><a href="{{httpBasePath}}create-reorder">Create Reorder</a></li>
                        <li><a href="{{httpBasePath}}logout">Logout</a></li>
                    </ul>
                </div>
            </div>
            <hr>

            <form class="form-horizontal" method="post" id="order-form" action="{{httpBasePath}}create-order-step-2-submit">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Step 2: Select Item</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 voffset3">
                                <a onclick="moveUploadedArtworks()" href="#" class="btn btn-default" data-toggle="modal" data-target="#myModal">Upload Artwork</a>

                            </div>
                         
                            <div class="col-md-8 ">
                                <div class="row">
                            {% if thumbImagePath %}
                                 <img src="{{ thumbImagePath }}" width="50" height="50" />
                            {% endif %}
    
                            {% for placementKey,placement in placements %}
                            
                             <div class="col-md-2 artwork-preview pull-right">
                                <button rel="{{ placementKey }}" type="button" class="pull-left artwork-remove close artwork-preview-{{ placementKey }}" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <span class="artwork-preview-{{ placementKey }}">{{ placementPosition[placement] }}</span>
                                <br>
                       
                                <img class="artwork-preview-{{ placementKey }}" src="{{httpBasePath}}{{ artworkThumbPath }}{{fileNames[placementKey]}}" alt=""  width="50" height="50"/>
                             </div>

                            {% endfor %}
                            
                            <div id="artwork-uploaded">
                             {% for key,file in fileNames %}
                                <input class="artwork-preview-{{key}}" type="hidden" name="fileNameWithPath[]" value="{{ file|e }}">
                            {% endfor %}
                            {% for key,file in placements %}
                                <input class="artwork-preview-{{key}}" type="hidden" name="placementUploaded[]" value="{{ file|e }}">
                            {% endfor %}
                            </div>
                             </div>
                            <input type="hidden" name="token" value="{{token}}">  
                            <input type="hidden" id="categoryType" value="{{categoryType}}">
                            </div>
                            <div class="col-md-1">
                            </div>
                        </div>
                    </div>
                </div>                    

                <h4>Order Information</h4>
                <div class="row voffset3">
                    <div class="col-md-12">

                        <div class="row">
                            <div class="col-md-4">
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
                                            {% for key,val in deliveryType %}
                                                <option value="{{key}}">{{val}}</option>
                                            {% endfor %}                                
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
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
                                        <select class="form-control" name="for_event" id="for_event">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group event-detail">
                                    <label for="" class="col-md-4 control-label">Event Name</label>
                                    <div class="col-md-8">
                                        <input type="text" name="event_name" class="form-control">
                                    </div>                                 
                                </div>
                                <div class="form-group event-detail">
                                    <label for="" class="col-md-4 control-label">Event Date</label>
                                        <div class="col-md-8">
                                            <div class="input-group date" id="datetimepicker2">
                                                <input type="text"class="form-control" name="event_date" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">  
                                 <label for="" class="col-md-4 control-label">Order Notes</label>   
                                    <div class="col-md-8">
                                        <textarea name="order_notes" class="form-control"></textarea>
                                    </div>    
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
                
                <div class="row hidden-sm hidden-xs voffset5">
                {% if categoryType != 'PI' %}
                    <div class="col-md-3 col-md-offset-3">
                        <p class="text-center">Youth Size</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-center">Adult Size</p>
                    </div>
                {% endif %}
                </div>
                
                <div class="table-responsive" id="order-lines">

                    <table class="table order-table">
                        <thead>
                            <tr>
                                <th width="6%">Desc</th>
                                <th width="6%">Brand</th>
                                <th width="6%">Style #</th>
                                <th width="6%">Color</th>
                                {% if categoryType == 'PI' %}
                                <th width="5%">Quantity</th>      
                                {% else %}                                
                                    {% include 'partials/create-order-size-headings.php' %}
                                {% endif %}
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        {% for i in 0..25 %}
                            <tr id="line_no_{{i}}" {%if i != 0 %} class="hidden" {%endif%}>
                               {% include 'partials/order-line-items.php' %}
                            </tr>
                        {% endfor %}
                        </tbody>
                    </table>
                </div>
                <input type="hidden" id="current_order_line" value="1">
                <button class="btn btn-link addnewrow" type="button"><i class="fa fa-plus"></i> Add New</button>

                <p class="text-right">
                    <button type="submit" class="btn btn-default" id="order_place_btn" name="order_placed" value="1">place order</button>
                </p>

            </form>
        </div>
    </div>
</main>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Upload Artwork</h4>
            </div>
             <form  class="form-horizontal" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 upload-artwork">
                       
                            <div class="form-group upload-artwork-row" id="upload-artwork-row">
                                <label for="" class="col-md-2 control-label">Image:</label>
                               
                                
                                
                                <div class="col-md-2">
                                    <div class="fileUpload btn btn-primary" style="position: relative;overflow: hidden;margin: 10px;">
                                        <span>Upload</span>
                                      
                                        <input name="artwork_image[]" type="file" class="upload" style=" position: absolute;top: 0;right: 0;margin: 0;padding: 0;font-size: 20px;cursor: pointer;opacity: 0;filter: alpha(opacity=0);" />
                                    </div>
                                   
                                </div>
                          
                                <label for="" class="col-md-2 control-label">Placement:</label>
                                <div class="col-md-3" style=" vertical-align: middle;">
                                    
                  
                                    <select name="placement[]" class="form-control">
                                         {% for file in orderCategoryPlacement %}
                                             {% for key,value in file %}
                                             <option value="{{ key|e }}">{{ value|e }}</option>
                                             {% endfor %}
                                         {% endfor %}
                                       
                                    </select>
                                </div>

                                <div class=" col-md-2">
                                     <img class="image_preview" style="width:50%;height:auto;" src="" alt="" />
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="upload-artwork-row-close close" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                  
                            </div>
                             <button class="btn btn-link addnewimage" type="button"><i class="fa fa-plus"></i> Add New</button>
                            <div class="form-group">
                                <div class="col-md-offset-10 col-md-2">
                                <button type="submit" class="btn btn-default" >Upload</button>
                                </div>   
                            </div>
                        
                    </div>
                </div>
                
            </div>
            
            <div class="modal-footer">
               
            </div>
        </div>
        </form>
    </div>
</div>

{%endblock%}