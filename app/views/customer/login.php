{% extends 'layout.html' %}
 {% block content %}
	<div class="col-md-9">

	<form class="form-horizontal" action="{{httpBasePath}}login/submit" method="post">
		{%  if message %}
			<b>{{ message }}</b>
		{% endif %}
		<div class="row">

			<div class="col-md-6">

				<div class="form-group">

					<label for="" class="col-md-4 control-label">Username</label>

					<div class="col-md-8">

						<input type="text" class="form-control" name="username">

					</div>

				</div>



				<div class="form-group">

					<label for="" class="col-md-4 control-label">Password</label>

					<div class="col-md-8">

						<input type="password" class="form-control" name="password">

					</div>

				</div>

			</div>

		</div>



		<div class="form-group">

			<div class="col-sm-offset-2 col-sm-10">

				<button type="submit" class="btn btn-default">Submit</button>

				<a href="/forgot-password" class="btn btn-link">Forgot Password</a>

			</div>

		</div>
	<input type="hidden" name="token" value="{{token}}">
	</form>

</div>
 {% endblock %}