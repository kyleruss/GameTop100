<div class='list-group-item clearfix ranking_item' data-ng-repeat='ranking_item in ranking_list'>
	<div class='rank_profile col-md-9'>
		<!-- RANK NUMBER -->
		<div class='col-md-2 rank_details'>
			<h5 class='rank_display'>
				1
			</h5>
		</div>

		<!-- SITE DETAILS -->
		<div class='col-md-10 site_details'>
			<!-- SITE IMAGE -->
			<div class='site_profile_image'>

			</div>

			<!-- SITE DESCRIPTION -->
			<div class='site_content'>
				<a href='<% ranking_item.address %>' class='site_link'>
					<% ranking_item.title %>
				</a>

				<div class='site_description'>
					<% ranking_item.description; %>
				</div>
			</div>
		</div>
	</div>

	<div class='vote_details col-md-3'>
		<h3 class='vote_text'>
			<!-- SITE IN VOTES -->
			<span uib-tooltip='Votes in' tooltip-placement='top' class='site_in_group' data-toggle='tooltip' data-placement='bottom' data-title='Site in-votes'>
				<span class='site_in'>5</span> <span class='glyphicon glyphicon-arrow-up'></span>
			</span>

			<!-- SITE OUT VOTES -->
			<span uib-tooltip='Votes out' tooltip-placement='top' class='site_out_group' data-toggle='tooltip' data-placement='bottom' data-title='Site out-votes'>
				<span class='site_out'>10</span> <span class='glyphicon glyphicon-arrow-down'></span>
			</span>

			<!-- SITE COMMENTS -->
			<a uib-tooltip='Site comments' tooltip-placement='top' class='site_comments_group plain_link' data-toggle='tooltip' data-placement='bottom' data-title='Site comments' data-ng-click='toggleCommentContainer($index)'>
				<span class='site_comments'><% ranking_item.comments.length %></span> <span class='glyphicon glyphicon-comment'></span>
			</a>
		</h3>
	</div> 

	<!-- SITE COMMENTS CONTAINER -->
	<div class='site_comments_container col-md-12' uib-collapse='ranking_list.selectedSite != $index'>
		<!-- SITE COMMENTS ALERT -->
		<uib-alert data-ng-if='ranking_item.comment_response.show'
		close='hideCommentAlert(ranking_item)' dismiss-on-timeout='2000'
		type='<% ranking_item.comment_response.status? "success" : "danger" %>'>
			<span class='<% ranking_item.comment_response.status? "glyphicon glyphicon-ok-sign" : "glyphicon glyphicon-remove-sign" %>'></span> 
			<% ranking_item.comment_response.message  %>
		</uib-alert>

		<div class='show_comments_container'>
			<hr>
			<span class='show_comments_msg' data-ng-click='ranking_item.showComments = !ranking_item.showComments'>
				Showing <% ranking_item.comments.length %> comments
			</span>
		</div>
		<div class='row comment_item' data-ng-repeat='comment in ranking_item.comments'>
			<div class='col-md-1'>
				<a href='#' class='comment_writter'><% comment.writter_id %></a>
			</div>

			<div class='col-md-6'>
				<p class='comment_content'><% comment.content %></p>
			</div>

			<div class='col-md-5'>
				<div class='comment_rating_container col-md-6'>
					<div class='col-md-1'>
						<span class='comment_rating'>
							<% (comment.comment_rating > 0? '+' : '') + comment.comment_rating; %>
						</span>
					</div>

					<!-- COMMENT RATING -->
					<div class='comment_rating_controls col-md-3'>
						<!-- COMMENT UPVOTE -->
						<span class='<% comment.user_votes.length > 0? (comment.user_votes[0].isUpvote > 0? "active_control" : "") : "" %> comment_control glyphicon glyphicon-chevron-up comment_control comment_upvote'
						data-ng-click='voteComment("{{ URL::route("postRateComment"); }}", comment, ranking_item, true)'></span>

						<!-- COMMENT DOWNVOTE -->
						<span class='<% comment.user_votes.length > 0? (comment.user_votes[0].isUpvote > 0? "" : "active_control") : "" %> comment_control glyphicon glyphicon-chevron-down comment_control comment_downvote'
						data-ng-click='voteComment("{{ URL::route("postRateComment"); }}", comment, ranking_item, false)'></span>
					</div>
				</div>

				<!-- COMMENT CONTROLS -->
				<div class='comment_controls_container col-md-6'>
					<span data-ng-click='toggleEdit(comment, $index, ranking_item)' class='glyphicon glyphicon-pencil edit_comment_btn comment_control <% comment.isEdit? "active_control" : "" %>'></span>
					<span data-ng-click='removeComment("{{ URL::route("postRemoveComment") }}", comment, ranking_item, $index)' class='glyphicon glyphicon-remove remove_comment_btn comment_control'></span>
					<span class='glyphicon glyphicon-flag report_comment_btn comment_control'></span>
				</div>
			</div>
		</div>

		<br>
		<!-- COMMENT ADD CONTROLS -->
		<div class='comment_add_controls'>
			<div class='input-group'>
				<input data-ng-model='ranking_item.comment_add_field' type='text' class='form-control' placeholder='Enter a comment' />
				<span class='input-group-btn'>
					<button {{ Auth::check()? "" : "disabled" }} class='btn btn-success' data-ng-click='saveComment(ranking_item.selectedComment != null? "{{ URL::route("postEditComment") }}" : "{{ URL::route("postAddSiteComment") }}", ranking_item)'>Save</button>
				</span>
			</div>
		</div>
	</div>
</div>
