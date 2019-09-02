<h2>Users Management</h2>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Users</li>
    </ol>
    </nav>

<div class="card">
    <div class="card-header">
        <i class="fa fa-filter"></i> Filter
    </div>
    
        <div class="form-row card-content">
            <div class="form-group col-md-4">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Name" name = "filter_name" value='<?php if(isset($_GET["filter_name"])) { echo $_GET["filter_name"]; } ?>'>
            </div>
            <div class="form-group col-md-4">
                <label>Net Id</label>
                <input type="text" class="form-control" placeholder="Net ID" name="filter_net_id"  value='<?php if(isset($_GET["filter_net_id"])) { echo $_GET["filter_net_id"]; } ?>'>
            </div>
            <div class="form-group col-md-4">
                <label>Status</label>
                <select class="custom-select" name="filter_status">
                    <?php if(isset($_GET["filter_status"])) {?> 
                         <option value="<?php echo $_GET["filter_status"]; ?>">
                            <?php echo ($_GET["filter_status"] == "1" ? "Enabled" : "Disabled"); ?> 
                        </option> 
                     <?php }  ?>
                    <option value="">Choose</option>
                    <option value="1">Enabled</option>
                    <option value="0">Disabled</option>
                </select>
            </div>
            &nbsp;<button type="submit" class="btn btn-primary" id="button-filter-users">
               <i class="fa fa-filter"></i> Filter
            </button>

        </div>
    </div>


    <div class="card">
        <div class="card-header">
            <i class="fa fa-list"></i> Users List
        </div>
        
        <div class="card-content" style="overflow: auto;">
            <table class="table table-bordered table-hover" id="user_list_table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Net ID</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    if(isset($users) && !empty($users)) {
                        foreach($users as $key => $user) {
                ?>
                    <tr>
                        <td>
                            <?php echo $key +1; ?>
                        </td>
                        <td><?php echo $user["firstname"] . " " . $user["lastname"]; ?></td>
                        <td><?php echo $user["net_id"]; ?></td>
                        <td><?php echo $user["email"]; ?></td>
                        <td>
                            <?php 
                                if($user["type"] == "1") {
                                    echo "Student";
                                } else if($user["type"] == "2")  {
                                    echo "Alumni";
                                } else {
                                    echo "Staff";
                                }
                            ?>
                        </td>
                        <td><?php echo $user["status"] == "1" ? "Enabled" : "Disabled"; ?></td>
                        <td class="text-center">
                            <a href="<?php echo base_url(); ?>admin/user/details/<?php echo $user["id"]; ?>"  class="btn btn-info" data-toggle="tooltip" data-placement="top" title="View user details, posts and comments"> 
                                <i class="fa fa-eye"></i>
                            </a>
                            <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Contact" onclick="load_contact_form(<?php echo $user['id']; ?>,  '<?php echo $user['firstname']. ' ' .$user['lastname'] ; ?>')">
                                <i class="fa fa-envelope"></i>
                            </button>
                            
                        </td>
                    </tr>

                <?php
                        }
                    } else {
                        echo "<tr><td colspan='7'>No user found</td></tr>";
                    } 
                ?>
                </tbody>
            </table>

            </div>
        </div>
    </div>
</div>
