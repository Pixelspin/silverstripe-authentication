<div class="block">
	<div class="container">
		<h1>$Title</h1>
        $Content
		<h2>Members</h2>
        <% if $PaginatedMembers %>
			<ul>
                <% loop $PaginatedMembers %>
					<li><a href="$ProfileLink">$Name</a></li>
                <% end_loop %>
			</ul>
            <% if $PaginatedMembers.MoreThanOnePage %>
				<div class="toolbar">
					<div class="btn-group">
                        <% if $PaginatedMembers.NotFirstPage %>
							<a href="$PaginatedMembers.PrevLink<% if $Top.ExtraGetVar %>$Top.ExtraGetVar<% end_if %>"
							   class="btn btn-light">Previous</a>
                        <% else %>
							<span class="btn btn-light disabled">Previous</span>
                        <% end_if %>
                        <% loop $PaginatedMembers.PaginationSummary(4) %>
                            <% if $CurrentBool %>
								<span class="btn btn-light active">$PageNum</span>
                            <% else %>
                                <% if $Link %>
									<a href="$Link<% if $Top.ExtraGetVar %>$Top.ExtraGetVar<% end_if %>"
									   class="btn btn-light">$PageNum</a>
                                <% else %>
									<span class="btn btn-light active">...</span>
                                <% end_if %>
                            <% end_if %>
                        <% end_loop %>
                        <% if $PaginatedMembers.NotLastPage %>
							<a href="$PaginatedMembers.NextLink<% if $Top.ExtraGetVar %>$Top.ExtraGetVar<% end_if %>"
							   class="btn btn-light">Next</a>
                        <% else %>
							<span class="btn btn-light disabled">Next</span>
                        <% end_if %>
					</div>
				</div>
            <% end_if %>
        <% else %>
			<p>There are no members yet</p>
        <% end_if %>
	</div>
</div>