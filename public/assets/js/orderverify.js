function verifyAddress() {
    var formData = new FormData($("#csvForm")[0]);
    var baseUrl = window.location.origin;
    console.log("formData:", formData);
    console.log("BASE_URL:", baseUrl);
    $.ajax({
        url: baseUrl + "/api/import-csv",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.success === true) {
                $("#alertDiv").addClass("alert-success");
            } else {
                $("#alertDiv").addClass("alert-danger");
            }
            $("#alertDiv").html(response.message).show();
            $("#csvForm")[0].reset();
            $("#csvInput").val("");
            setTimeout(function () {
                $("#alertDiv").html("").hide();
            }, 3000);
        },
        error: function (response) {
            $("#alertDiv").addClass("alert-danger");
            $("#alertDiv")
                .html("something went wrong, please try after sometimes")
                .show();
            setTimeout(function () {
                $("#alertDiv").html("").hide();
            }, 3000);
        },
    });
}

function resetFileInput() {
    $("#csvForm")[0].reset();
    $("#csvInput").val("");
}
