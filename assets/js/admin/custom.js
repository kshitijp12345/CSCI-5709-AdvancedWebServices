/* Form validation - validates on click of submit */
function validate_form() {
    var subject = $("input[name=subject]").val();
    var message = $("#message").val();

    if(subject == "") {
        $("#subject_warning").html('Enter a subject');
    }
    if(message == "") {
        $("#message_warning").html('Compose a message');
    }

    if(subject != "" && message != "") {
        user.contact();
    }

}


function load_contact_form(receiver_id, recipient_name) {
    $("#recipient_name").html("To: " + recipient_name);
    $("input[name=receiver_id]").val(receiver_id);
    $('#contactModal').modal('show');
}


var common = {
    'cancel_status_update': function() {
        $("#status_update_view").hide();
        $("#status_view").show();
    }
}

