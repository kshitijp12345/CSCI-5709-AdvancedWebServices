    
<h2>Posts Management</h2>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Posts</li>
    </ol>
    </nav>

<div class="card">
    <div class="card-header">
        <i class="fa fa-filter"></i> Filter
    </div>
    <div class = "card-content">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Title</label>
                <input type="text" class="form-control" name="filter_keyword" value="<?php if(isset($_GET["filter_keyword"])) { echo $_GET["filter_keyword"]; } ?>" placeholder = "Search by Post Title" >
            </div>
            <div class="form-group col-md-4">
                <label>Author</label>
                <input type="text" class="form-control" name="filter_author" value="<?php if(isset($_GET["filter_author"])) { echo $_GET["filter_author"]; } ?>" placeholder = "Search by author" >
            </div>
            <div class="form-group col-md-4">
                <label>Spam</label>
                <select class="custom-select" name="filter_spam">
                    <?php if(isset($_GET["filter_spam"])) {?> 
                         <option value="<?php echo $_GET["filter_spam"]; ?>">
                            <?php echo ($_GET["filter_spam"] == "1" ? "Yes" : "No"); ?> 
                        </option> 
                     <?php } ?>
                     <option value="">Choose</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <button class="btn btn-primary" id="button-filter-posts">
                    <i class="fa fa-filter"></i> Filter
                </button>  
        </div>
    </div>
</div>


<div class="card">
    <div class="card-header">
        <i class="fa fa-list"></i> Posts List
    </div>
    
    <div class="card-content" style="overflow: auto;">
        <table class="table " >
            <thead>
                <tr>
                    <th>S/N</th>
                    <th style="width: 52%">Post</th>
                    <th style="width: 14%">Author</th>
                    <th style="width: 8%">Status</th>
                    <th style="width: 15%">Date</th>
                    <th style="width: 12%" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                if(isset($posts) && !empty($posts)) {
                    foreach($posts as $key => $post) {
            ?>
                <tr>
                    <td>
                        <?php echo $key +1; ?>
                    </td>
                    <td class="text-left"><?php echo $post["post_title"]; ?></td>
                    <td><a href="<?php echo base_url(); ?>admin/user/details/<?php echo $post['user_id']; ?>"><?php echo $post['firstname']. ' ' . $post['lastname']; ?></a></td>
                    <td><?php  if($post["is_spam"] == 1) { echo "Spam"; } else { echo "Not Spam"; } ?></td>
                    <td>
                        <?php 
                            $date = date_create($post["date_created"]);
                            echo date_format($date, 'Y-m-d g:i a'); 
                        ?>
                    </td>
                    <td class="text-center">
                        <a href="<?php echo base_url(); ?>admin/post/details/<?php echo $post['post_id']; ?>" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="View post details and comments">
                            <i class="fa fa-eye"></i>
                        </a>
                    </td>
                </tr>
                <?php
                        }
                    } else {
                        echo "<tr><td colspan='5'>No post found</td></tr>";
                    } 
                ?>
            </tbody>
        </table>

    </div>
</div>
