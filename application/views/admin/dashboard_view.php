<div class="container" id="content_wrapper">

<h2>Users</h2>
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
    
    <form class="card-content">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Name</label>
                <input type="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group col-md-4">
                <label>Banner</label>
                <input type="password" class="form-control" placeholder="Banner ID">
            </div>
            <div class="form-group col-md-4">
                <label>User Type</label>
                <select class="custom-select" >
                    <option selected>Select...</option>
                    <option value="1">Student</option>
                    <option value="2">Alumni</option>
                    <option value="3">Faculty</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
    </form>
    </div>


    <div class="card">
        <div class="card-header">
            <i class="fa fa-list"></i> Users List
        </div>
        
        <div class="card-content" style="overflow: auto;">
            <table class="table table-bordered table-hover" >
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" onclick="$('input[name*=\'is_selected\']').prop('checked', this.checked);">
                        </th>
                        <th>Name</th>
                        <th>Banner ID</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="checkbox" name="is_selected">
                        </td>
                        <td>Mark Olof</td>
                        <td>B00123456</td>
                        <td>mark.olof@dal.ca</td>
                        <td>Student</td>
                        <td>Enable</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="View user data and posts">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Block User" onclick="confirm('Are you sure you want to block Mark Olof?')">
                                <i class="fa fa-lock"></i>
                            </button>
                            <span data-toggle="modal" data-target="#contactModal">
                                <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Contact" >
                                    <i class="fa fa-envelope"></i>
                                </button>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" name="is_selected">
                        </td>
                        <td>Mark Olof</td>
                        <td>B00123456</td>
                        <td>mark.olof@dal.ca</td>
                        <td>Student</td>
                        <td>Enable</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="View user data and posts">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Block User" onclick="confirm('Are you sure you want to block Mark Olof?')">
                                <i class="fa fa-lock"></i>
                            </button>
                            <span data-toggle="modal" data-target="#contactModal">
                                <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Contact" >
                                    <i class="fa fa-envelope"></i>
                                </button>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" name="is_selected">
                        </td>
                        <td>Mark Olof</td>
                        <td>B00123456</td>
                        <td>mark.olof@dal.ca</td>
                        <td>Student</td>
                        <td>Enable</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="View user data and posts">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Block User" onclick="confirm('Are you sure you want to block Mark Olof?')">
                                <i class="fa fa-lock"></i>
                            </button>
                            <span data-toggle="modal" data-target="#contactModal">
                                <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Contact" >
                                    <i class="fa fa-envelope"></i>
                                </button>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" name="is_selected">
                        </td>
                        <td>Mark Olof</td>
                        <td>B00123456</td>
                        <td>mark.olof@dal.ca</td>
                        <td>Student</td>
                        <td>Enable</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="View user data and posts">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Block User" onclick="confirm('Are you sure you want to block Mark Olof?')">
                                <i class="fa fa-lock"></i>
                            </button>
                            <span data-toggle="modal" data-target="#contactModal">
                                <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Contact" >
                                    <i class="fa fa-envelope"></i>
                                </button>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" name="is_selected">
                        </td>
                        <td>Mark Olof</td>
                        <td>B00123456</td>
                        <td>mark.olof@dal.ca</td>
                        <td>Student</td>
                        <td>Enable</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="View user data and posts">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Block User" onclick="cart.update(1, 'mark olof')" id="set_status_1">
                              <i class="fa fa-lock"></i> 
                               
                                <!-- <span class="sr-only">Loading...</span> -->
                            </button>
                            <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Contact" >
                              <span data-toggle="modal" data-target="#contactModal">
                                <i class="fa fa-envelope"></i>
                              </span>
                            </button>
                            
                        </td>
                    </tr>
                </tbody>
            </table>

            <nav aria-label="users-pagination">
                <ul class="pagination">
                    <li class="page-item disabled">
                    <span class="page-link">Previous</span>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div></div>

<!-- <div id="container">
  <h1>Welcome to the Dashboard!</h1>
  <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>
  -->



    <!-- Modal -->
    <div class="modal fade " id="contactModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="contactModalLabel">Compose Message</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('#', 'id="contact_user_form"'); ?>
                    <div class="form-group">
                        <label>To: Mark Olof</label>
                    </div>
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" class="form-control" placeholder="Enter Subject" id="subject" name="subject">
                        <small id="subject_warning" class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea id="summernote" name="message" ></textarea>
                        <small id="message_warning" class="form-text text-danger"></small>
                    </div>
                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="button"  value="Send" class="btn btn-primary" onclick="validate_form()">
            </div>
        </div>
        </div>
    </div>

