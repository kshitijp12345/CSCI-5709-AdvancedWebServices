

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

                        <div class="alert alert-danger alert-dismissible fade show message_container" role="alert"  style="display: none;">
                            <span id="contact_modal_message"></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <?php echo form_open('#', 'id="contact_user_form"'); ?>
                            <div class="form-group">
                                <span id="recipient_name">To: Mark Olof</span>
                                <input name="receiver_id" type="text" id="receiver_id" hidden>
                            </div>
                            <div class="form-group">
                                <label>Subject</label>
                                <input type="text" class="form-control" placeholder="Enter Subject" name="subject">
                                <small id="subject_warning" class="form-text text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label>Message</label><br/>
                                <textarea id="message" name="message" rows="4" cols="50"></textarea>
                                <small id="message_warning" class="form-text text-danger"></small>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="validate_form()" id="btn_send">Send</button>
                        </div>
                </div>
            </div>
        </div>

        <footer>
            <div class="row">
                <div class="col-lg-12 col-xs-12 col-sm-12 ">&copy; Copyrights 2019, Dalhousie University</div>
            </div>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/admin/custom.js"></script>
        <script>
            $('#button-filter-posts').on('click', function() {
                url = '';

                var filter_keyword = $('input[name=\'filter_keyword\']').val();

                if (filter_keyword) {
                    url += '&filter_keyword=' + encodeURIComponent(filter_keyword);
                }

                var filter_author = $('input[name=\'filter_author\']').val();
                if (filter_author) {
                    url += '&filter_author=' + encodeURIComponent(filter_author);
                }
                
                var filter_spam = $('select[name=\'filter_spam\']').val();

                if (filter_spam) {
                    url += '&filter_spam=' + encodeURIComponent(filter_spam);
                }
                location = '<?php echo base_url(); ?>admin/post?' + url;
            });


            $('#button-filter-users').on('click', function() {
                url = '';

                var filter_name = $('input[name=\'filter_name\']').val();

                if (filter_name) {
                    url += '&filter_name=' + encodeURIComponent(filter_name);
                }

                var filter_net_id = $('input[name=\'filter_net_id\']').val();
                if (filter_net_id !== '') {
                    url += '&filter_net_id=' + encodeURIComponent(filter_net_id);
                }

                var filter_status = $('select[name=\'filter_status\']').val();
                if (filter_status) {
                    url += '&filter_status=' + encodeURIComponent(filter_status);
                }
                location = '<?php echo base_url(); ?>admin/user?' + url;
            });

            $('#button-filter-feedbacks').on('click', function() {
                url = '';

                var filter_keyword = $('input[name=\'filter_keyword\']').val();
                if (filter_keyword) {
                    url += '&filter_keyword=' + encodeURIComponent(filter_keyword);
                }
                location = '<?php echo base_url(); ?>admin/feedback?' + url;
            });
            var post = {
                'update_status': function(post_id) { 

                    var delete_confirmation = confirm("Are you sure you want to update the status?");
                    if (delete_confirmation == true) {

                        var current_status =  $("input[name=current_status]").val();
                        var status_update = $("select[name=status_update]").val();

                        /** Provides Cross-Site Request Forgery (CSRF) protection. */
                        var csrf_token_name = "<?php echo $this->security->get_csrf_token_name();?>";
                        var csrf_hash = "<?php echo $this->security->get_csrf_hash();?>";

                        $.ajax({
                            url: '<?php echo base_url(); ?>admin/post/update_status',
                            type: 'post',
                            data: 'post_id=' + post_id + '&spam_status=' + status_update + '&' + csrf_token_name + '=' + csrf_hash,
                            dataType: 'json',
                            beforeSend: function() {
                                $("#progress_indicator").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                            },
                            success: function(json) {
                                if(json.success) {
                                    $("input[name=status_update]").hide();
                                    $("input[name=current_status]").val(status_update);
                                    $("#status_update_view").hide();
                                    $("#status_view").show();
                                    $('#status').html(status_update == 1 ? "Spam" : "Not Spam");
                                    $("#progress_indicator").html("");
                                    $("#success-alert").show();
                                    $("#success-alert").delay(1000).slideUp(1000);
                                } else {
                                    alert(json.message);
                                    $("#progress_indicator").html("");
                                }
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                var jsonResponse = JSON.parse(xhr.responseText);
                                if(jsonResponse) {
                                    alert(jsonResponse.message)
                                } else {
                                    alert(xhr.responseText);
                                }
                                $("#progress_indicator").html("");
                            }
                        });
                    } else {
                        $("#status_update_view").hide();
                        $("#status_view").show();
                    }
                },


                'show_status_update' : function() {
                    var current_status =  $("input[name=current_status]").val();
                    var option = $('<option></option>').attr("value", current_status == 1 ? "0" : "1").text(current_status == 1 ? "Set as not spam" : "Set as spam");
                    $("select[name=status_update]").empty().append('<option value=""></option>').append(option);

                    $("#status_update_view").show();
                }
            }


            var user = {

                /** Ajax request function to update user status  */
                'update_status': function(user_id, name) {  

                var delete_confirmation = confirm("Are you sure you want to update " + name + " status?");

                if (delete_confirmation == true) {

                    var status_update = $("select[name=status_update]").val();

                    /** Provides Cross-Site Request Forgery (CSRF) protection. */
                    var csrf_token_name = "<?php echo $this->security->get_csrf_token_name();?>";
                    var csrf_hash = "<?php echo $this->security->get_csrf_hash();?>";

                    $.ajax({
                        url: '<?php echo base_url(); ?>admin/user/update_status',
                        type: 'post',
                        data: 'user_id=' + user_id + '&status=' + status_update + '&' + csrf_token_name + '=' + csrf_hash,
                        dataType: 'json',
                        beforeSend: function() {
                            $("#progress_indicator").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                        },
                        success: function(json) {
                            if(json.success) {
                                $("input[name=status_update]").hide();
                                $("input[name=current_status]").val(status_update);
                                $("#status_update_view").hide();
                                $("#status_view").show();
                                $('#status').html(status_update == 1 ? "Enabled" : "Disabled");
                                $("#progress_indicator").html("");
                                $("#success-alert").show();
                                $("#success-alert").delay(1000).slideUp(1000);
                            } else {
                                alert(json.message);
                                $("#progress_indicator").html("");
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            var jsonResponse = JSON.parse(xhr.responseText);
                            if(jsonResponse) {
                                alert(jsonResponse.message)
                            } else {
                                alert(xhr.responseText);
                            }
                            $("#progress_indicator").html("");
                        }
                    });
                }
                },


                /** Function displays edit status select form  */
                'show_status_update' : function() {
                    var current_status =  $("input[name=current_status]").val();
                    var option = $('<option></option>').attr("value", current_status == 1 ? "0" : "1").text(current_status == 1 ? "Disable User" : "Enable User");
                    $("select[name=status_update]").empty().append('<option value=""></option>').append(option);

                    $("#status_update_view").show();
                },

                /** Ajax request function to post the data from contact from  */
                'contact': function() {
                    $.ajax({
                        url: '<?php echo base_url(); ?>admin/user/contact',
                        type: 'post',
                        data: $("#contact_user_form").serialize(),
                        contentType: "application/x-www-form-urlencoded",
                        dataType: 'json',
                        beforeSend: function() {
                            $("#btn_send").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                        },
                        success: function(json) {
                            $("input[name=subject]").val("");
                            $("#message").val("");
                            $("#btn_send").html("Send");
                            $("#contact_modal_message").html(json.message);
                            $(".message_container").show();
                            $(".message_container").removeClass("alert-danger").addClass("alert-success");
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            var jsonResponse = JSON.parse(xhr.responseText);
                            $("#contact_modal_message").html(jsonResponse.message);
                            $(".message_container").show();
                            $("#btn_send").html("Send");
                        }
                    });
                }
            }

        </script>
         
    </body>
</html>
