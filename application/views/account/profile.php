<h2 class="page-title">Profile</h2>
<div class="row main">
    <div class="col-lg-8 col-xs-12 col-md-8 section">

         <?php echo form_open(base_url() .'post/deletePost', 'id="delete_action"'); ?>
        <button type="submit" class="btn btn-danger pull-right" id="group-delete" data-toggle="tooltip" data-placement="top" title="Group Delete">
            <i class="fa fa-trash-o"></i>
        </button>

        <ul class="nav nav-pills profile-pills">
            <li class="nav-item active">
            <a class="nav-link active" href="#tab-topics" data-toggle="tab" aria-expanded="true">My Posts</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#tab-activities" data-toggle="tab" aria-expanded="false">Recent Activites</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#tab-replies" data-toggle="tab" aria-expanded="false">My Replies</a>
            </li>
        </ul>

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
                
        <div class="tab-content">
            <div class="tab-pane active" id="tab-topics">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">
                                <input type="checkbox" onclick="$('input[name*=\'is_selected\']').prop('checked', this.checked);">
                            </th>
                            <th scope="col">Title</th>
                            <th scope="col">Date Added</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(empty($result))
                            echo "No Post has been created yet...";
                            if(isset($result)){
                                foreach ($result as $allpost) { ?>
                                    <tr>
                                        <th scope="row">
                                            <input type="checkbox" name="selected_posts[]" value="<?php echo $allpost->post_id; ?>">
                                        </th>
                                        <td><?php echo $allpost->post_title; ?></td>
                                        <td><?php echo $allpost->date_created; ?></td>
                                        <td>
                                            <?php
                                                    if($allpost->is_spam == 1) {
                                                    echo "Is Spam";
                                                } else {
                                                    echo "Not Spam";
                                                }
                                            ?>
                                        </td>
                                        <td>     
                                            <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Edit" onclick="load_edit_post_form(<?php echo $allpost->post_id; ?>, '<?php echo $allpost->categories; ?>', '<?php echo $allpost->post_title; ?>', '<?php echo $allpost->post_content; ?>', '<?php echo $allpost->hashtags; ?>')">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>

                            <?php }  } ?>
                    </tbody>
                </table>
            </div>


            <div class="tab-pane" id="tab-activities">

                <table class="table">
                    <tbody>
                        <?php
                            if(empty($activities))
                                echo "No activity yet...";
                                if(isset($activities)){
                                    foreach ($activities as $activity) { ?>
                                        <tr>
                                            <td>
                                                <?php echo '<strong>' . $activity->firstname . ' '. $activity->lastname .'</strong> said '. $activity->comment .' on '. $activity->post_title ; ?>
                                                <br><?php 
                                                        $date = date_create($activity->date_added);
                                                        echo date_format($date, 'Y-m-d g:i a'); 
                                                    ?>
                                            </td>
                                        </tr>
                            <?php }  } ?>
                    </tbody>
                </table>




            </div>
            <div class="tab-pane" id="tab-replies">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">
                                <input  type="checkbox" onclick="$('input[name*=\'is_selected\']').prop('checked', this.checked);" >
                            </th>
                            <th scope="col">Title</th>
                            <th scope="col">Date Added</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(empty($user_comments))
                                echo "You haven't posted any Comment yet...";
                                if(isset($user_comments)){
                                    foreach ($user_comments as $comment) { ?>
                                        <tr>
                                            <th scope="row">
                                                <input type="checkbox" name="selected_comments[]" value="<?php echo $comment->comment_id; ?>">
                                            </th>
                                            <td><?php echo $comment->comment; ?></td>
                                            <td><?php echo $comment->date_added; ?></td>
                                            <td>     
                                                <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Edit" >
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                            </td>
                                        </tr>
                            <?php }  } ?>
                    </tbody>
                </table>
                    
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>

    <aside class="col-lg-4 col-xs-12 col-md-8  section" style="margin-top: 10px !important;">

        <div class="card" style="width: 100%;">
            <div class="card-body">
                <div>
                    <h5 class="card-title float-left" > <i class="fa fa-user" style="height: 30px"></i>&nbsp; <?php echo $name; ?></h5>

                    <table style="width:70%; margin-right: 150px;" >
                        <tr class="text-center">
                            <td>Topics</td>
                            <td>Comment</td>
                            <!-- <td>Views</td> -->
                        </tr>
                        <tr class="text-center" style="color: black;">
                            <td><?php echo sizeof($result); ?></td>
                            <td><?php echo $comment_count; ?></td>
                            <!-- <td>36</td> -->
                        </tr>
                    </table>

                </div>
                <div class="clearfix"></div>
                <hr>

                <ul class="nav flex-column side-menu">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">My Activity</a>
                    </li>
                    <li class="nav-item">
                            <a class="nav-link" href="#">Edit Account</a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                </ul>

            </div>
        </div>
    </aside>

</div>






<div class="modal fade" id="editPostModal" tabindex="-1" role="dialog" aria-labelledby="editPostModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- values from the form are sent to the controller on clicking submit button -->
            <?php echo form_open(base_url() .'post/editPost', 'id="edit_post_form"'); ?>
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
                                <option value="" selected id="current_category">Choose...</option>
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
                        <label for="editPostTitle">Title*</label>
                        <input type="text" class="form-control" name="postTitle" id="editPostTitle" placeholder="What is it about?" maxlength="60" required>
                    </div>
                </div>
                <div class="row row-mb">
                    <div class="col-md-12">
                        <label for="editPostText">Description*</label>
                        <textarea name="postText" id="editPostText" class="form-control" maxlength="260" placeholder="Can you explain it further.." required></textarea>
                        <small class="form-text text-muted">Please do not add hashtags here.</small>
                    </div>
                </div>
                <div class="row row-mb-1">
                    <div class="col-md-12">
                        <label for="editPostText">Hashtag</label>
                        <input type="text" name="postHashtag" id="editPostText" class="form-control" placeholder="Go with a current trend or start a new one.." maxlength="30">
                        <small class="form-text text-muted">Please enter keywords, saperated by comma sign. Do not add hash.</small>
                    </div>
                </div>
                <input type="text" name="postId" class="form-control" hidden>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <div class="text-center">
                    <button type="submit" name="editPostSubmit" class="btn btn-success">Update</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>