<div class="row main">
	<div class="col-lg-8 col-xs-12 col-md-8 section">
		<?php if(isset($selected_category) && !empty($selected_category)) { ?>
			<h4 class="selected_tab_title"><?php echo $selected_category; ?></h4>
		<?php } else { ?>
			<h4 class="selected_tab_title">Recent Topics</h4>
		<?php } ?>
		<label class="float-right" style="color:#28a745; margin-right:10px;"><?php echo $this->session->flashdata('message'); ?></label>

		<ul class="nav nav-tabs">
			<li class="nav-item active">
				<a class="nav-link active" href="#tab-recent_topics" data-toggle="tab" aria-expanded="true">Recent Topics</a>
			</li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="tab-recent_topics">
				<?php if(!empty($this->session->flashdata('msg'))) { ?>
					<div class="alert alert-success fade" id="successPost" role="alert">
						<?php echo $this->session->flashdata('msg') ?>
					</div>
				<?php } ?>
				<?php if(!empty($this->session->flashdata('error'))) { ?>
					<div class="alert alert-danger fade"  role="alert">
						<?php echo $this->session->flashdata('error') ?>
					</div>
				<?php } ?>
				<!-- Checks if result data array is empty or not-->
				<?php
				if(empty($result))
				echo "No Post has been created yet...";
				if(isset($result)){
					foreach ($result as $allpost) { ?>
						<div class="card">
							<div class="card-header"><i class="material-icons">person  </i><?php echo $allpost->firstname; ?> <?php echo $allpost->lastname; ?></div>
							<div class="card-body">
								<input type="hidden" value="<?php echo $allpost->post_id; ?>" id="postId<?php echo $allpost->post_id; ?>">
								<input type="hidden" value="<?php echo $allpost->user_id; ?>" id="userId<?php echo $allpost->post_id; ?>">
								<h5 class="card-title"><?php echo $allpost->post_title; ?></h5>
								<p class="card-text mb-3"><?php echo $allpost->post_content; ?></p>
								<span style="color: black"><i class="fa fa-clock-o"></i> <?php echo $allpost->date_created; ?></span>
							<a id="Abuse-<?php echo $allpost->post_id;?>" data-toggle="modal" data-target="#reportAbuseModal<?php echo $allpost->post_id;?>" href="" class="float-right hover2">Report  <i class="material-icons" style="vertical-align: top">report</i></a>
							</div>
							<div class="card-footer text-muted">
								<p style="margin-bottom: 0rem">
									<?php echo $allpost->hashtags; ?></p>
								</div>
								<div class="card-footer" style="background-color: #ffffff">
									<div class="row">
										<div class="col-md-5 col-xs-12 col-sm-12 text-center"  style="height:20px;" >
											<h5 id="upvoteHeader-<?php echo $allpost->post_id;?>" class="hover upvoteClass">Upvote&nbsp;</h5>
											<i class="material-icons" style="vertical-align: top; margin-top: -32px;margin-left: 90px;" >thumb_up</i>
										</div>
										<div class="col-md-1 col-xs-12 col-sm-12">
											<label class="" id="upvoteLabel<?php echo $allpost->post_id;?>" style="margin-left:-95px;font-size: large;" ><?php echo $allpost->upvote;?></label>
										</div>
										<div class="col-md-5 col-xs-12 col-sm-12 text-center"  style="height:20px;">
											<h5  id="downvoteHeader-<?php echo $allpost->post_id;?>" class="hover2 downvoteClass">Downvote</h5>
											<i class="material-icons" style="vertical-align: top; margin-top: -32px;margin-left: 120px;">thumb_down</i>
										</div>
										<div class="col-md-1 col-xs-12 col-sm-12">
											<label id="downvoteLabel<?php echo $allpost->post_id;?>" style="margin-left:-80px;font-size: large;"><?php echo $allpost->downvote;?></label>
										</div>
									</div>
								</div>
								<div class="card-footer" style="background-color: #ffffff">
									<div class="row">
										<div class="col-md-7 col-xs-2 col-sm-12 ">
											<textarea rows='1' name="<?php echo $allpost->post_id;?>" maxlength="500" class="autoExpand" placeholder='Add your comments here...'></textarea>
										</div>
										<div class="col-md-3 col-xs-2 col-sm-12 ">
											<button  class="btn btn-outline-success addCommentsToDatabase changeText button btn btn-outline-success my-2 my-sm-0" type="button" name="commentsButton<?php echo $allpost->post_id;?>" id="<?php echo $allpost->post_id;?>"  >Add Comment</button>
											<input type="hidden" name="<?php echo $allpost->post_id;?>"  value="0"/>
										</div>
										<div class="col-md-2 col-xs-2 col-sm-12 " style="margin-top: 5px; margin-left: -10px; font-size: small; color: #6c757d!important;">
											<a id="id-<?php echo $allpost->post_id;?>" class="allCommentsClass"  style="color:#007bff!important; float:left; cursor: pointer;">
												All comments
											</a>
										</div>
									</div>
									<div class="row" style="background-color: rgba(0,0,0,.03);border-top: 1px solid rgba(0,0,0,.125);">
										<div class="col-md-12 col-xs-2 col-sm-12">
											<div class="alert alert-danger show error_message_div" id="error_message_div<?php echo $allpost->post_id;?>" style="display: none;">
												<span id="error_message_span<?php echo $allpost->post_id;?>"></span>
											</div>
											<div  id="display_comment<?php echo $allpost->post_id;?>"></div>
										</div>
									</div>
								</div>
							</div>
							<!-- Modal for creating report form-->
							<div class="modal fade" id="reportAbuseModal<?php echo $allpost->post_id;?>" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" >Report Abuse</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form class="report_abuse_contact_form" action="<?php echo base_url()?>index.php/Comments/reportAbuse" method="post">
												<div class="alert alert-success modalSuccess" role="alert" style="display:none"></div>
												<div class="form-group">
													<input type="text" class="form-control" placeholder="Name" name="name" value = "<?php echo $name; ?>" required readonly>
													<small  class="form-text text-danger"></small>
												</div>
												<div class="form-group">
													<input type="text" class="form-control" placeholder="Email-id" name="emailID" value="<?php echo $this->session->email; ?>" required readonly>
													<small  class="form-text text-danger"></small>
													<input type="hidden" name="hiddenPostId" id="hiddenPostId-<?php echo $allpost->post_id;?>"value="<?php echo $allpost->post_id;?>">
												</div>
												<div class="form-group">
													<textarea  rows="5" name="reportAbuse"  placeholder="Enter Abuse Information here..." style="width:100%; max-width:100%;" required></textarea>
													<small class="form-text text-danger"></small>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													<input type="submit"  value="submit" class="btn btn-primary" >
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						<?php }
					} ?>
				</div>
			</div>
		</div>
		<aside class="col-lg-4 col-xs-12 col-md-8  section">
			<div class="card categories" style="width: 100%;">
				<div class="card-header btn-secondary">
					<i class="fa fa-list"></i> Categories
				</div>
				<div class="card-body">

					<ul class="list-group borderless-group">
						<?php
							if(isset($categories) && !empty($categories)) {
								foreach($categories as $key => $category) {
						?>

						<li class="list-group-item d-flex justify-content-between align-items-center">
							<a href="<?php echo base_url().'post/'.$category["name"]; ?>" >
						
							<?php echo $category["name"]; ?> </a>
								<span class="badge badge-secondary badge-pill"><?php echo $category["count"]; ?></span>

						</li>
						<?php }} ?>
					</ul>
				</div>
			</div>
		</aside>
	</div>
