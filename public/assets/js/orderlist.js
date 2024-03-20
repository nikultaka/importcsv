function searchOrder() {
    var searchData = $("#searchInput").val();
    var baseUrl = window.location.origin;
    $("#dataTable").DataTable({
        processing: true,
        bDestroy: true,
        bAutoWidth: false,
        serverSide: true,
        dom: '<"top"l<"float-right"f>>rt<"bottom"ip>',
        ajax: {
            type: "POST",
            url: baseUrl + "/api/search-order",
            data: {
                searchData: searchData,
            },
        },
        columns: [
            {
                data: "amazon_order_id",
                name: "amazon_order_id",
            },
            {
                data: "shipment_id",
                name: "shipment_id",
            },
            {
                data: "shipment_item_id",
                name: "shipment_item_id",
            },
            {
                data: "tracking_number",
                name: "tracking_number",
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });
}

function viewOrder() {
    var baseUrl = window.location.origin;
    var orderId = $("#actionBtn").data("oid");

    $.ajax({
        type: "POST",
        url: baseUrl + "/api/order-Details",
        data: {
            orderId: orderId,
        },
        success: function (response) {
            $("html, body").animate({ scrollTop: 0 }, "slow");

            var content = $("#orderDetailsContent");
            var fieldsHtml = "";

            $.each(response.data, function (key, value) {
                fieldsHtml +=
                    "<p><strong>" + key + ":</strong> " + value + "</p>";
            });
            content.html(fieldsHtml);
            $('#orderDetailsModal').modal('show');
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
    $("#searchInput").val("");
}
