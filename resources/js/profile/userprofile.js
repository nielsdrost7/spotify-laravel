$("#showProfileForm").submit(function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find("#btnPrEditSave");
    loadingButton.button("loading");
    $.ajax({
        url: usersUrl + "profile-update",
        type: "post",
        data: new FormData($(this)[0]),
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                $("#UserProfileModal").modal("hide");
                location.reload();
            }
        },
        error: function (result) {
            manageAjaxErrors(result, "showProfileValidationErrorsBox");
        },
        complete: function () {
            loadingButton.button("reset");
        },
    });
});

$("#UserProfileModal").on("hidden.bs.modal", function () {
    resetModalForm("#showProfileForm", "#showProfileValidationErrorsBox");
});

// open edit user profile model
$(document).on("click", ".edit-profile", function (event) {
    let userId = $(event.currentTarget).data("id");
    renderProfileData(usersUrl + userId + "/edit");
});

window.renderProfileData = function (usersUrl) {
    $.ajax({
        url: usersUrl,
        type: "GET",
        success: function (result) {
            if (result.success) {
                let user = result.data;
                $("#pfUserId").val(user.id);
                $("#pfName").val(user.name);
                $("#pfEmail").val(user.email);
                $("#pfPhone").val(user.phone);
                $("#edit_preview_photo").attr("src", user.image_path);
                $("#UserProfileModal").modal("show");
            }
        },
        //error: function (result) {
        //    manageAjaxErrors(result, "showProfileValidationErrorsBox");
        //},
        //complete: function () {
        //    loadingButton.button("reset");
        //},
    });
};
