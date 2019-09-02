<h2>Feedbacks </h2>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Feedbacks</li>
    </ol>
    </nav>

<div class="card">
    <div class="card-header">
        <i class="fa fa-filter"></i> Filter
    </div>
    
        <div class="form-row card-content">
            <div class="form-group col-md-12">
                <input type="text" class="form-control" placeholder="Search..." name = "filter_keyword" value='<?php if(isset($_GET["filter_keyword"])) { echo $_GET["filter_keyword"]; } ?>'>
            </div>
            &nbsp;<button type="submit" class="btn btn-primary" id="button-filter-feedbacks">
               <i class="fa fa-filter"></i> Filter
            </button>
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            <i class="fa fa-list"></i> Feedback List
        </div>
        
        <div class="card-content" style="overflow: auto;">
            <table class="table table-borderless table-hover" id="user_list_table">
                <!-- <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Net ID</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead> -->
                <tbody>
                <?php 
                    if(isset($feedbacks) && !empty($feedbacks)) {
                        foreach($feedbacks as $key => $feedback) {
                ?>
                    <tr>
                        
                        <td style="width: 14%;"><strong><?php echo $feedback["name"]; ?></strong></td>
                        <td>
                            <strong><?php echo $feedback["subject"]; ?></strong>
                            <br/>
                            <?php echo $feedback["message"]; ?>
                            <br/>
                            <?php echo $feedback["date_added"]; ?>
                        </td>
         
                        <!-- <td><?php echo $feedback["status"] == "1" ? "Enabled" : "Disabled"; ?></td> -->
                        <!-- <td class="text-center">
                            <a href="<?php echo base_url(); ?>admin/user/details/<?php echo $user["id"]; ?>"  class="btn btn-info" data-toggle="tooltip" data-placement="top" title="View user details, posts and comments"> 
                                <i class="fa fa-eye"></i>
                            </a>
                            <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Contact" onclick="load_contact_form(<?php echo $user['id']; ?>,  '<?php echo $user['firstname']. ' ' .$user['lastname'] ; ?>')">
                                <i class="fa fa-envelope"></i>
                            </button>
                            
                        </td> -->
                    </tr>

                <?php
                        }
                    } else {
                        echo "<tr><td colspan='7'>No message found</td></tr>";
                    } 
                ?>
                </tbody>
            </table>

            </div>
        </div>
    </div>
</div>
