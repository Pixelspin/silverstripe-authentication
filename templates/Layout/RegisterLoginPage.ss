<div class="block">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>Register</h2>
				<a href="$RegistrationPage.Link" class="btn">Register</a>
			</div>
			<div class="col-md-6">
				<h2>Login</h2>
				<strong>Login with:</strong>
                <% if $SocialAuthenticationOptions %>
					<ul>
                        <% loop $SocialAuthenticationOptions %>
							<li><a href="$Link">$Title</a></li>
                        <% end_loop %>
					</ul>
                <% end_if %>
                $LoginForm
			</div>
		</div>
	</div>
</div>