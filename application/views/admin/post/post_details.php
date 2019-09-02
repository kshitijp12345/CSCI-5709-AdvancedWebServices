
<h2>Post Details</h2>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/post">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo $breadcrumb_referral; ?>">Posts</a></li>
        <li class="breadcrumb-item active" aria-current="page">Post Details</li>
    </ol>
</nav>

<div class="card"  >
    <div class="card-header">
         Posts Details
    </div>

    <div class="card-body" >
        <ul class="nav nav-tabs">
            <li class="nav-item active">
                <a class="nav-link active" href="#tab-post_details" data-toggle="tab" aria-expanded="true">Post</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#tab-post_comments" data-toggle="tab" aria-expanded="false"> Comments  </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#tab-post_reports" data-toggle="tab" aria-expanded="false"> Abuse Reports  </a>
            </li>
        </ul>

        <div class="tab-content" style="padding: 10px;">
        <?php if(isset($post_data) && !empty($post_data)) { ?>

            <!-- Post detail tab -->
            <div class="tab-pane active" id="tab-post_details">
                <p class="form-control-plaintext"><?php echo $post_data['post_title']; ?></p>
                <p><?php echo html_entity_decode($post_data['post_content']); ?><a href="https://www.nairaland.com/attachments/9039016_5426812019987219302392683626427435622334464n_jpegd7d53d07561150203914c734a2d2c5fe" ></a></p>
                <p style="font-size: 25px;"><i class="fa fa-thumbs-up" style="color:green"></i><?php echo $post_data['upvote']; ?> &nbsp; | &nbsp; <i class="fa fa-thumbs-down" style="color:red"></i> <?php echo $post_data['downvote']; ?> </p>
                <div>Posted by: <span class="text-dark"><?php echo $post_data['firstname']. ' '.$post_data['lastname']; ?></span></div>
                <p>
                    <?php 
                        $date = date_create($post_data["date_created"]);
                        echo date_format($date, 'Y-m-d g:i a'); 
                    ?>
                </p>
                <div id="status_view">
                    Status: <span class="text-dark" id="status"><?php  if($post_data["is_spam"] == 1) { echo "Spam"; } else { echo "Not Spam"; } ?></span>
                    | <a href="#" onclick="post.show_status_update()">Change Status</a>
                </div>
                <input name="current_status" type="text" value="<?php echo $post_data["is_spam"]; ?>" hidden>
                <input name="post_id" type="text" value="<?php echo $post_data["post_id"]; ?>" hidden>
                <div id="status_update_view" style="display: none;">
                    <select name="status_update" class="form-control col-md-2 col-12" onchange="post.update_status(<?php echo $post_data['post_id']; ?>)"> 
                        <option value="0">Set as spam</option>
                        <option value ="1">Set as not spam</option>
                    </select>
                    <a href="#" onclick="common.cancel_status_update()"><small>Cancel</small></a>
                    <div id="progress_indicator" style="display:none;"></div>
                </div>
                <div class="alert alert-success" id="success-alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>Success! </strong>
                    Post status has been updated
                </div>
            </div>
            <!-- Post detail tab end -->

            <!-- Post comment tab -->
            <div class="tab-pane" id="tab-post_comments">
                <table class="table  table-hover" >
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Comments</th>
                            <th>Posted by</th>
                            <th style="width: 20%;">Submitted On</th>

                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if(isset($post_comments) && !empty($post_comments)) {
                            foreach($post_comments as  $key=>$comment) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $key +1; ?>
                            </td>
                            <td>
                                <?php echo $comment["comment"]; ?>   
                            </td>
                            <td><a href="<?php echo base_url(); ?>admin/user/details/<?php echo $comment['id']; ?> "> <?php echo $comment['firstname']. ' '.$comment['lastname']; ?></a></td>
                            <td>
                                <?php 
                                    $date = date_create($comment["date_added"]);
                                    echo date_format($date, 'Y-m-d g:i a'); 
                                ?>
                            </td>
        
                        </tr>
                        <?php
                                }
                            } else {
                                echo "<tr><td colspan='5'>No comment found</td></tr>";
                            } 
                        ?>
                    </tbody>
                </table>
            </div>
             <!-- Post comment tab end-->

            <!-- Post report messages tab end -->
            <div class="tab-pane" id="tab-post_reports">
                <table class="table  table-hover" >
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Description</th>
                            <th>Posted by</th>
                            <th style="width: 20%;">Submitted On</th>

                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if(isset($post_reported_abuses) && !empty($post_reported_abuses)) {
                            foreach($post_reported_abuses as  $key=>$report) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $key +1; ?>
                            </td>
                            <td>
                                <?php echo $report["abuse_description"]; ?>   
                            </td>
                            <td><a href="<?php echo base_url(); ?>admin/user/details/<?php echo $report['id']; ?> "> <?php echo $report['firstname']. ' '.$report['lastname']; ?></a></td>
                            <td>
                                <?php 
                                    $date = date_create($report["date"]);
                                    echo date_format($date, 'Y-m-d g:i a'); 
                                ?>
                            </td>
        
                        </tr>
                        <?php
                                }
                            } else {
                                echo "<tr><td colspan='5'>No comment found</td></tr>";
                            } 
                        ?>
                    </tbody>
                </table>
            </div>
             <!-- Post report messages tab end-->
        <?php 
            } else {
                echo "Post not found, <a href='/Dalconnect/admin/post'>Click here</a> to view all posts ";
            } 
        ?>
        </div>
    </div> 
</div>

