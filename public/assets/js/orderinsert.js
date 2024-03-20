function insertOrder() {
    var formData = new FormData($("#orderForm")[0]);
    var baseUrl = window.location.origin;
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        },
    });

    $.ajax({
        url: baseUrl + "/api/insert-order",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $("html, body").animate({ scrollTop: 0 }, "slow");
            if (response.success === true) {
                $("#alertDiv").addClass("alert-success");
            } else {
                $("#alertDiv").addClass("alert-danger");
            }
            $("#alertDiv").html(response.message).show();
            $("#orderForm")[0].reset();
            setTimeout(function () {
                $("#alertDiv").html("").hide();
            }, 3000);
        },
        error: function (response) {
            $("html, body").animate({ scrollTop: 0 }, "slow");
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
    $("#orderForm")[0].reset();
}
