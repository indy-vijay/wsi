{% extends 'layout.html' %}
{% block content %}
<script type='text/javascript' src='{{customIncludePath}}js/common.js'></script>
<script type='text/javascript' src='{{includePath}}js/jquery.validate.js'></script>

<style type="text/css">
	.loginform{
		margin-top: 50px;
	}
	.loginform h1 {
		font-size: 20px;
		font-weight: 600;
		margin-bottom: 30px;
		text-transform: uppercase;
		text-align: center;
	}
	.signUp {
    font-size: 15px;
    margin-top: 20px;
}
	.signUp a{
		color: #e2383f;
	}
</style>

<div class="col-md-9 loginform">
	<h1>Login</h1>
	<form class="form-horizontal" id="login-form" action="{{httpBasePath}}login/submit" method="post"  novalidate="novalidate">
		{%  if message %}
		<b>{{ message }}</b>
		{% endif %}
		<div class="row">

			<div class="col-sm-offset-2 col-sm-6">

				<div class="form-group">

					<label for="" class="col-md-4 control-label">Username</label>

					<div class="col-md-8">

						<input type="text" class="form-control" id="username" name="username">

					</div>

				</div>



				<div class="form-group">

					<label for="" class="col-md-4 control-label">Password</label>

					<div class="col-md-8">

						<input type="password" class="form-control" id="password" name="password">

					</div>

				</div>

			</div>

		</div>



		<div class="form-group">

			<div class="col-sm-offset-4 col-sm-8">

				<button  class="btn btn-default">Submit</button>

				<a href="/forgot-password" class="btn btn-link">Forgot Password</a>

	<div class="signUp">
		Not registerd? <a href="/register">Create account</a>
	</div>
			</div>

		</div>
		<input type="hidden" name="token" value="{{token}}">

	</form>
	
	
</div>
{% endblock %}