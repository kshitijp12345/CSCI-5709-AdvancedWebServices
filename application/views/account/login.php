<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
        <title>Dalhousie Connect - Welcome </title>
        
		<meta name="description" content="Dalhousie online forum initiative brings the capabilities of a forum online, rather than the traditional way which members of a society or particular interest need to meet physically to discuss and vote on suggestions/ideas">
		<meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" type="image/png" href="images/favicon.jpg">
        <link type = "text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link type = "text/css" href="<?php echo base_url(); ?>assets/css/login.css" rel="stylesheet">
	</head>
	<body>
        <div class="container-fluid">
            <div class="row wrapper">

                <div class="col-lg-6 col-xs-6 col-sm-6 col-12 welcome-section" >

                    <div class="banner"></div>
                    <div class="overlay"></div>
                    <div class="col-lg-7 col-xs-7 col-sm-12 col-12 tag-line ">
                            <h2>See what's happening in Dalhousie </h2>
                            
                            <div class="tag-line-item">
                                <i class="fa fa-users fa-2x"></i> Meet people with similar interest
                            </div>
                            <div class="tag-line-item">
                                <i class="fa fa-comments fa-2x"></i> Create or join a conversation
                            </div>
                            <div class="tag-line-item">
                                <i class="fa fa-building fa-2x"></i> Learn, build career and grow Dalhousie
                             </div>

                    </div>
                </div>

                <div class="col-lg-6 col-xs-6 col-sm-6 form-section">
                        <img src="<?php echo ASSET_URL; ?>/images/dal-logo.jpg" alt="logo" height ="70"  class="mx-auto d-block"> 
                        <h2 class="text-center">Welcome to DAL Connect!</h2>
                        <p class="text-center" style="margin-bottom: 12px; font-size: 14px;">Please sign in with your Net Id and Password</p>

                        <?php if(isset($error) && !empty($error)) { ?>
                        <div class="alert alert-danger alert-dismissible fade show error_message_container" role="alert" >
                            <span id="error_message"><?php echo $error; ?></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php } ?>

                        <!-- Login Form -->
                        <?php echo form_open(base_url().'account/login', ''); ?>
                        <form id="login_form" method="POST">
                            <div class="form-group">
                                <label>Net ID</label>
                                <input name="id" type="text" class="form-control" placeholder="Enter Net ID" value="BA740503" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input name="password" type="password" class="form-control" placeholder="Password" value ="password" autocomplete="off">
                                <small id="password_warning" class="form-text text-danger"></small>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input">
                                <label class="form-check-label">Remember Me</label>
                            </div><br/>
                            <input value="Sign In" type="submit" class="btn btn-warning form-control" id="login_button">
                            <div id = "progress_indicator"></div>
                        <?php echo form_close(); ?>
                </div>


              <div class="col-lg-12 col-xs-12 col-sm-12 text-center">&copy; Copyrights 2019, Dalhousie University</div>
            </div>
        </div>
		


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {

            // $("#login_form").on('click', '#login_button', function () {
         
            //     var net_id = $('#net_id').val();
            //     var password = $('#password').val();
                
            //     if(net_id == "" && password == "") {
            //         show_error_message("Please enter Net ID and Password");
            //     } else {
            //         //login(net_id, password);
            //     }
            // });


            // function login(net_id, password) {
            //     var csrf_token_name = "<?php echo $this->security->get_csrf_token_name();?>";
            //         var csrf_hash = "<?php echo $this->security->get_csrf_hash();?>";

            //         $.ajax({
            //             url: '<?php echo base_url(); ?>admin/user/update_status',
            //             type: 'post',
            //             data: 'net_id=' + net_id + '&password=' + password + '&' + csrf_token_name + '=' + csrf_hash,
            //             dataType: 'json',
            //             beforeSend: function() {
            //                 $("#progress_indicator").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            //             },
            //             success: function(json) {
            //                 if(json.success) {
            //                    // $("input[name=status_update]").hide();
                             
            //                 } else {
            //                     alert(json.message);
            //                     $("#progress_indicator").html("");
            //                 }
            //             },
            //             error: function(xhr, ajaxOptions, thrownError) {
            //                 var jsonResponse = JSON.parse(xhr.responseText);
            //                 if(jsonResponse) {
            //                     alert(jsonResponse.message)
            //                 } else {
            //                     alert(xhr.responseText);
            //                 }
            //                 //$("#progress_indicator").html("");
            //             }
            //     });
            // }

            function show_error_message(message) {
                $("#error_message").html(message);
                $(".error_message_container").show();
                $("#login_button").blur();
            }

            /* Checks the password length after leaving the password field */
            $("#password").blur(function() {
                if($(this).val().length < 5) {
                    $("#password_warning").html('Password should be more than 5 characters');
                } else {
                    $("#password_warning").html('');
                }
            });
        });
        </script>
	</body>
</html>