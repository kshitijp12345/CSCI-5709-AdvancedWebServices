	<footer>
		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-xs-2 col-sm-3">
					<a href="<?php echo base_url();?>post">Home</a>
				</div>
				<div class="col-lg-2 col-xs-2 col-sm-3">
					Categories
				</div>
				<div class="col-lg-2 col-xs-2 col-sm-3">
					Help
				</div>
				<div class="col-lg-2 col-xs-2 col-sm-3">
					Terms and Conditions
				</div>
				<div class="col-lg-2 col-xs-2 col-sm-3">
					Privacy Policy
				</div>
				<div class="col-lg-2 col-xs-2 col-sm-3">
					<a href="<?php echo base_url(); ?>contactform"> Contact </a>
				</div>
			</div>
			<hr>
			<div class="row copyrights">
				<div class="col-lg-12 col-xs-12 col-sm-12 ">&copy; Copyrights 2019, Dalhousie University</div>
			</div>
		</div>
	</footer>
	
	<!-- Modal for creating post form-->
	<div class="modal fade" id="createPostModal" tabindex="-1" role="dialog" aria-labelledby="createPostModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<!-- values from the form are sent to the controller on clicking submit button -->
				<?php echo form_open(base_url() .'post/createPost'); ?>
				<!-- <form id="createPost" action="<?php echo base_url();?>index.php/createPostController/createPost" method="post" > -->
				<div class="modal-header">
					<h5 class="modal-title" id="createPostModalLabel">Create Post</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row row-mb">
						<div class="col-md-12">
							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<label class="input-group-text" for="categorySelect">Categories*</label>
								</div>
								<select class="custom-select" name="categorySelect" id="categorySelect" required>
									<option value="" selected>Choose...</option>
								<?php 
									if(isset($categories) && !empty($categories)) {
										foreach($categories as $key => $category) {
								?>
									<option value="<?php echo $category["name"]; ?>"><?php echo $category["name"]; ?></option>
								<?php } }?>
								</select>
							</div>
						</div>
					</div>
					<div class="row row-mb">
						<div class="col-md-12">
							<label for="postTitle">Title*</label>
							<input type="text" class="form-control" name="postTitle" id="postTitle" placeholder="What is it about?" maxlength="60" required>
						</div>
					</div>
					<div class="row row-mb">
						<div class="col-md-12">
							<label for="postText">Description*</label>
							<textarea id="postText" name="postText" class="form-control" maxlength="260" placeholder="Can you explain it further.." required></textarea>
							<small class="form-text text-muted">Please do not add hashtags here.</small>
						</div>
					</div>
					<div class="row row-mb-1">
						<div class="col-md-12">
							<label for="postText">Hashtag</label>
							<input type="text" name="postHashtag" id="postHashtag" class="form-control" placeholder="Go with a current trend or start a new one.." maxlength="30">
							<small class="form-text text-muted">Please enter keywords, saperated by comma sign. Do not add hash.</small>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<div class="text-center">
						<button type="submit" id="postSubmit" name="postSubmit" class="btn btn-success">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/custom.js" ></script>
	<script>
		$(document).ready(function(){
			$(".nav-tabs li").click(function(){
				$(".selected_tab_title").html($(this).text());
			});


			$("#successPost").fadeTo(2000, 500).slideUp(500, function(){
				$("#successPost").slideUp(500);
			});


			$(".profile-pills li").click(function(){
				var selectedItem = $(this).text().trim();
				if(selectedItem == "My Posts") {
					$("#delete_action").attr('action', '<?php echo base_url() ?>post/deletePost');
					$("#group-delete").show();
				} else if (selectedItem == "My Replies") {
					$("#delete_action").attr('action', '<?php echo base_url() ?>comments/delete');
					$("#group-delete").show();
				} else {
					$("#group-delete").hide();
				}
			});

		});
		$('.report_abuse_contact_form').submit(function(event) {
			event.preventDefault();
			var form_data = $(this).serialize();
			$.ajax({ //Process the form using $.ajax()
				type 		: 'POST', //Method type
				url 		: '<?php echo base_url() ?>index.php/Comments/reportAbuse', //Your form processing file url
				data    :form_data,
				//dataType 	: 'json',
				success 	: function(data) {
					$('.report_abuse_contact_form')[0].reset();
					$(".modalSuccess").show();
					$(".modalSuccess").text("Abuse Reported Successfully");

				}
			});
		});

		$(document).on('click', '.addCommentsToDatabase', function(){
			var post_id = $(this).attr("id");
			var parent_id=$('input[name="' + post_id + '"]').val();
			var postComment=$('textarea[name="' + post_id + '"]').val();
			var comment_error_message="Comments cannot be blank";
			var reply_error_message="Reply cannot be blank";
			if($('textarea[name="' + post_id + '"]').val()  == ""){
				if($("#"+post_id).text() == "Add reply"){
					show_error_message(reply_error_message,post_id);
				}else{
					show_error_message(comment_error_message,post_id);
				}
			} else{

				$.ajax({ //Process the form using $.ajax()
					url : '<?php echo base_url()?>Comments/insertData', //Your form processing file url
					type : 'post', //Method type
					data: 'postComment=' + postComment + '&parent_id=' + parent_id + '&post_id' + '=' + post_id,
					dataType 	: 'json',
					success 	: function(data) {
						load_comments(post_id);
					},
					error: function(xhr, ajaxOptions, thrownError){
					}
				});//Ajax function
			}
		});

		$(document).on('click', '.reply', function(){
			var comment_id = $(this).attr("id");
			var post_id= $(this).attr("name");
			var post_id_button="commentsButton"+post_id;
			$('input[name="' + post_id + '"]').val(comment_id);
			$('textarea[name="' + post_id + '"]').focus();
			$('textarea[name="' + post_id + '"]').val('');
			$('textarea[name="' + post_id + '"]').attr("placeholder", "Add reply here...");
			$('button[name="' + post_id_button + '"]').text('Add reply');
		});
		$(document).on('click', '.upvoteClass', function(){
			var labelValue="";
			var upvote_id=$(this).attr("id");
			var post_id_String=upvote_id.split("-");
			var post_id=post_id_String[1]
			var upvoteLabel="upvoteLabel"+post_id;
			var downvoteLabel="downvoteLabel"+post_id;
			if ($('label[id="' + upvoteLabel + '"]').is(':empty')){
				labelValue=0;
			}else{
				labelValue=$('label[id="' + upvoteLabel + '"]').text();
			}
			$.ajax({
				type 		: 'POST',
				url 		: '<?php echo base_url()?>index.php/Comments/upvotePost',
				data    : {"post_id":post_id,"labelValue":labelValue},
				dataType 	: 'json',
				success 	: function(data) {
					var upvoteCount=data['vote_count'];
					var downvoteCount=data['downvoteCount'];
					$('label[id="' + downvoteLabel + '"]').text(downvoteCount);
					$('label[id="' + upvoteLabel + '"]').text(upvoteCount);
					$('h5[id="' + upvote_id + '"]').text("Upvoted");
					$('h5[id="' + upvote_id + '"]').css({"margin-left":"-25px"});

					//$("#upvoteHeader").text("Upvoted");
					//$("#upvoteHeader").css({"margin-left":"-25px"});
				},
				async:false
			});
		});

		$(document).on('click', '.downvoteClass', function(){
			var labelValue="";
			var downvote_id=$(this).attr("id")
			var post_id_String=downvote_id.split("-");
			var post_id=post_id_String[1]
			var downvoteLabel="downvoteLabel"+post_id;
			var upvoteLabel="upvoteLabel"+post_id;
			if ($('label[id="' + downvoteLabel + '"]').is(':empty')){
				labelValue=0;
			}else{
				labelValue=$('label[id="' + downvoteLabel + '"]').text();
			}
			$.ajax({
				type 		: 'POST',
				url 		: '<?php echo base_url()?>index.php/Comments/downvotePost',
				data    : {"post_id":post_id,"labelValue":labelValue},
				dataType 	: 'json',
				success 	: function(data) {
					var downvoteCount=data['vote_count'];
					var upvoteCount=data['upvote_count'];
					$('label[id="' + upvoteLabel + '"]').text(upvoteCount);
					$('label[id="' + downvoteLabel + '"]').text(downvoteCount);
					$('h5[id="' + downvote_id + '"]').text("Downvoted");
					$('h5[id="' + downvote_id + '"]').css({"margin-left":"-25px"});
				},
				async:false
			});
		});
		function show_error_message(message,post_id) {
			var error_message_span_id="error_message_span"+post_id;
			var error_message_div ="error_message_div"+post_id;
			$('span[id="' + error_message_span_id + '"]').html(message);
			$('div[id="' + error_message_div + '"]').show();
			$('span[id="' + error_message_span_id + '"]').focus();
		}
		$(document).on('click', '.allCommentsClass', function(){
			var id= $(this).attr('id');
			post_id_string=id.split("-");
			var post_id=post_id_string[1];
			load_comments(post_id);
		});
		function load_comments(post_id){
			var defaultParentId=0;
			var divisionID="display_comment"+post_id;
			var post_id_button="commentsButton"+post_id;
			$.ajax({
				type :'POST',
				url   :'<?php echo base_url() ?>index.php/Comments/load_comments_from_database',
				data    : {"post_id":post_id},
				success : function(data){
					$('div[id="' + divisionID + '"]').html(data);
					$('textarea[name="' + post_id + '"]').val('');
					$('button[name="' + post_id_button + '"]').text('Add Comment');
					$('textarea[name="' + post_id + '"]').attr("placeholder", "Add your comments here...");
				},
				error: function(xhr, ajaxOptions, thrownError){
				}
			});
		}
		/*------------------------------------------------
		/	 							RESIZE TEXT AREA DYNAMICALLY
		/---------------------------------------------------
		*/
		//This code dynamically autosizes the text area . The scroll height is ajusted
		//dynamically to improve readability.
		// References: Textarea auto-expand", CodePen, 2019. [Online]. Available: https://codepen.io/vsync/pen/czgrf. [Accessed: 23- Mar- 2019].
		// The code was modified for adjusting text area of 3 rows and also auto resize the scroll height.
		$(document)
		.one('focus.autoExpand', 'textarea.autoExpand', function(){
			this.baseScrollHeight = this.scrollHeight;
		})
		.on('input.autoExpand', 'textarea.autoExpand', function(){
			var minRows = 0;
			this.rows = minRows;
			rows = Math.ceil((this.scrollHeight - this.baseScrollHeight) / 24);
			this.rows =  rows;
		});
	</script>
	</body>
</html>
