<div class="horizontal-items">
	<nav class="item-end">
		<ul class="nav body-sm mb-xs">
			<% if $CurrentUser %>
				<li><a href="$AccountPage.Link">$CurrentUser.Name</a></li>
				<li><a href="$LogoutLink">Logout</a></li>
			<% else %>
				<li><a href="$RegistrationPage.Link">Register</a></li>
				<li><a href="$LoginLink">Login</a></li>
			<% end_if %>
		</ul>
	</nav>
</div>