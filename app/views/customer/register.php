{% extends 'layout.html' %}
 {% block content %}
 <script type='text/javascript' src='{{customIncludePath}}js/common.js'></script>
 <script type='text/javascript' src='{{includePath}}js/jquery.validate.js'></script>
 <!---<script type='text/javascript' src='{{includePath}}css/screen.css'></script>-->

	<div class="col-md-9">

    <div class="page_title">

        Register

    </div>
       
	 <form class="form-horizontal" id="user-register" method="post" action="{{httpBasePath}}register/submit">
        <h3>Primary Address</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">First Name</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="first_name">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Last Name</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="last_name">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Email Address</label>
                    <div class="col-md-8">
                        <input type="email" class="form-control" name="email">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Alternate Email</label>
                    <div class="col-md-8">
                        <input type="email" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Phone Number</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="home_phone">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Cell Phone</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="mobile">
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Fax Number</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="fax">
                    </div>
                </div>


                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Company</label>
                    <div class="col-md-8">
                        <input type="text" name="company_name" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Address</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="address_1">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">City</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="city">
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
                                <option value="{{ state['state_abbr'] }}" >{{ state['state_name'] }}</option>
                            {% endfor %}
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Zip</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="zip">
                    </div>
                </div>
            </div>
        </div>

      <!--   <h3>Shipping Address</h3>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">First Name</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Last Name</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Address</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">City</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">State</label>
                    <div class="col-md-8">
                        <select class="form-control">
                            <option value="">Alabama</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Zip</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Phone Number</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Cell Phone</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
 -->
        <input type="hidden" name="token" value="{{token}}">

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button class="btn btn-default" >Register</button>
            </div>
        </div>
    </form>
	</div>
 {% endblock %}