{% extends 'layout.html' %}
 {% block content %}
  <script type='text/javascript' src='{{customIncludePath}}js/common.js'></script>
  <script type='text/javascript' src='{{includePath}}js/jquery.validate.js'></script>
	<div class="col-md-9">

	<form class="form-horizontal" id="login-form" action="{{httpBasePath}}login/submit" method="post"  novalidate="novalidate">
		{%  if message %}
			<b>{{ message }}</b>
		{% endif %}
		<div class="row">

			<div class="col-md-6">

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

			<div class="col-sm-offset-2 col-sm-10">

				<button  class="btn btn-default">Submit</button>

				<a href="/forgot-password" class="btn btn-link">Forgot Password</a>

			</div>

		</div>
	<input type="hidden" name="token" value="{{token}}">
	</form>

</div>
 {% endblock %}