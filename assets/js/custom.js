
function load_contact_form(receiver_id, recipient_name) {
    $("#recipient_name").html("To: " + recipient_name);
    $("input[name=receiver_id]").val(receiver_id);
    $('#contactModal').modal('show');
}

function load_edit_post_form(post_id, category, title, description, hashtag) {
    $("#editPostModal").modal("show");
    $("#current_category").html(category)
    $("#current_category").val(category)
    $("input[name=postTitle]").val(title);
    $("textarea[name=postText]").val(description);
    $("input[name=postHashtag]").val(hashtag);
    $("input[name=postId]").val(post_id);
}


var common = {
    'cancel_status_update': function() {
        $("#status_update_view").hide();
        $("#status_view").show();
    }
}
