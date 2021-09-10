require("@coreui/coreui");
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$(document).ajaxError(function (event, xhr, settings) {
    if (xhr.status == 401) {
        location.replace(loginUrl);
    }
});

$.extend($.fn.dataTable.defaults, {
    paging: true,
    info: true,
    ordering: true,
    autoWidth: false,
    pageLength: 10,
    language: {
        search: "",
        sSearch: "Search",
        sProcessing: "",
    },
});

window.printErrorMessage = function (selector, errorResult) {
    $(selector).show().html("");
    $(selector).text(errorResult.responseJSON.message);
};

window.resetModalForm = function (formId, validationBox) {
    $(formId)[0].reset();
    $(validationBox).hide();
};

window.manageAjaxErrors = function (
    data,
    errorDivId = "editValidationErrorsBox"
) {
    if (data.status == 404) {
        $.toast({
            heading: "Error",
            text: data.responseJSON.message,
            showHideTransition: "fade",
            icon: "error",
            position: "top-right",
        });
    } else {
        printErrorMessage("#" + errorDivId, data);
    }
};

$(document).on("keydown", function (e) {
    if (e.keyCode === 27) {
        $(".modal").modal("hide");
    }
});

window.displaySuccessMessage = function (message) {
    $.toast({
        heading: "Success",
        text: message,
        showHideTransition: "slide",
        icon: "success",
        position: "top-right",
    });
};

$(function () {
    $(".dataTables_length").css("padding-top", "6px");
    $(".dataTables_info").css("padding-top", "24px");
});

$.extend($.fn.dataTable.defaults, {
    drawCallback: function (settings) {
        let thisTableId = settings.sTableId;
        if (settings.fnRecordsDisplay() > settings._iDisplayLength) {
            $("#" + thisTableId + "_paginate").show();
        } else {
            $("#" + thisTableId + "_paginate").hide();
        }
    },
});

$(function () {
    $(".modal").on("shown.bs.modal", function () {
        $(this).find("input:text").first().focus();
    });
});

window.getItemFromLocalStorage = function (item) {
    return localStorage.getItem(item + "_" + loggedInUserId);
};
