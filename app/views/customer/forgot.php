{% extends 'layout.html' %}
 {% block content %}
<div class="col-md-9">

	<div class="page_title">
		Forgot Password
	</div>



  {%  if showSuccessMessage %}
	<b>An email has been sent to your account</b>  	
  {% else %}
  		{%  if showErrorMessage %}
  			<b>Sorry! we couldn't find your email. Try again</b>
  		{% endif %}
	<p>To request your password please fill out the form below:</p>



	<form class="form-horizontal" method="post" action="">

		<div class="row">

			<div class="col-md-6">

				<div class="form-group">

					<label for="" class="col-md-4 control-label">Email Address</label>

					<div class="col-md-8">

						<input type="email" class="form-control" name="email">

					</div>

				</div>

			</div>

		</div>



		<div class="form-group">

			<div class="col-sm-offset-2 col-sm-10">

				<button type="submit" class="btn btn-default">Submit</button>

			</div>

		</div>
	<input type="hidden" name="token" value="{{token}}">
	</form>

</div>
{% endif %}
 {% endblock %}