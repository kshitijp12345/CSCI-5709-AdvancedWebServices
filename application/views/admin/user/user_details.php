
<h2>User Details</h2>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo $breadcrumb_referral; ?>">Users</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $user_data["firstname"] . ' ' .$user_data["lastname"]; ?> </li>
    </ol>
</nav>

<div class="card"  >
    <div class="card-header">
        User Details
    </div>

    <div class="card-body" >
        
        <ul class="nav nav-tabs">
            <li class="nav-item active">
                <a class="nav-link active" href="#tab-user_details" data-toggle="tab" aria-expanded="true">User Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#tab-user_posts" data-toggle="tab" aria-expanded="false">User Posts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#tab-user_comments" data-toggle="tab" aria-expanded="false"> User Comments</a>
            </li>
        </ul>

        <div class="tab-content" style="padding: 10px;">
            <?php if(isset($user_data) && !empty($user_data)) { ?>
            <div class="tab-pane active" id="tab-user_details">
                <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10 form-control-plaintext">
                            <?php echo $user_data['firstname']. ' ' . $user_data['lastname']; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10 form-control-plaintext">
                        <?php echo $user_data['email']; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Net Id</label>
                    <div class="col-sm-10 form-control-plaintext">
                        <?php echo $user_data['net_id']; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10 form-control-plaintext">
                        <span id="status"><?php 
                            if($user_data['status'] == 1) { echo "Enabled"; } else { echo "Disabled"; }
                        ?></span>
                        | <a href="#" onclick="user.show_status_update()">Change Status</a>

                        <input name="current_status" type="text" value="<?php echo $user_data["status"]; ?>" hidden>
                        <input name="post_id" type="text" value="<?php echo $user_data["id"]; ?>" hidden>
                        <div id="status_update_view" style="display: none;">
                            <select name="status_update" class="form-control col-md-2 col-12" onchange="user.update_status(<?php echo $user_data['id']; ?>, '<?php echo $user_data['firstname']. ' ' .$user_data['lastname']; ?>')"> 

                            </select>
                            <a href="#" onclick="common.cancel_status_update()"><small>Cancel</small></a>
                            <div id="progress_indicator" style="display:none;"></div>
                        </div>
                    </div>
                </div>
                <div class="alert alert-success" id="success-alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>Success! </strong>
                    User status has been updated
                </div>

                <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Contact" onclick="load_contact_form(<?php echo $user_data['id']; ?>, '<?php echo $user_data['firstname']. ' ' .$user_data['lastname'] ; ?>' )">
                    <i class="fa fa-envelope"></i> Contact <?php echo $user_data['firstname']; ?>
                </button>

            </div>
            <div class="tab-pane" id="tab-user_posts">
                <table class="table  table-hover" >
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Posts</th>
                            <th>Upvote</th>
                            <th>Downvote</th>
                            <th style="width: 20%;">Submitted On</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if(isset($user_posts) && !empty($user_posts)) {
                            foreach($user_posts as $key=> $post) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $key +1; ?>
                            </td>
                            <td>
                                <strong><?php echo $post["post_title"]; ?><br/></strong>
                                
                                <?php 
                                    $content = $post["post_content"];
                                    $content = preg_replace("/<img[^>]+\>/i", "(image) ", $content);   
                                    $content = strlen($content) >= 200 ? substr($content, 0, 199) . '...'  : 
                                    $content;
                                    echo $content;
                                ?>
                            </td>
                            <td class="text-center"><?php echo $post["upvote"]; ?> </td>
                            <td class="text-center"><?php echo $post["downvote"]; ?> </td>
                            <td>
                                <?php 
                                    $date = date_create($post["date_created"]);
                                    echo date_format($date, 'Y-m-d g:i a'); 
                                ?>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo base_url(); ?>admin/post/details/<?php echo $post['post_id']; ?>" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="View post data and comments">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                            }
                        } else {
                            echo "<tr><td colspan='5'>No post found for ". $user_data['firstname']. " "  . $user_data['lastname'] . "</td></tr>";
                        } 
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="tab-user_comments">
                <table class="table  table-hover" >
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Comment</th>
                            <th style="width: 20%;">Submitted On</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if(isset($user_comments) && !empty($user_comments)) {
                            foreach($user_comments as $key => $comment) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $key +1; ?>
                            </td>
                            <td>
                                <?php echo $comment['comment']; ?>
                            </td>
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
                            echo "<tr><td colspan='5'>No comment found for ". $user_data['firstname']. " "  . $user_data['lastname'] . "</td></tr>";
                        } 
                    ?>
                    </tbody>
                </table>
            </div>
        <?php 
            } else {
                echo "User not found, click on users menu to view all users";
            } 
        ?>
            
        </div>
    </div> 
</div>

