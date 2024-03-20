<html>

<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
        .login-page {
            width: 80%;
            padding: 8% 0 0;
            margin: auto;
        }

        .form {
            position: relative;
            z-index: 1;
            background: #FFFFFF;
            margin: 0 auto 100px;
            padding: 45px;
            text-align: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }

        .form input {
            font-family: "Roboto", sans-serif;
            outline: 0;
            background: #f2f2f2;
            width: 25%;
            border: 0;
            margin: 0 0 15px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .form button {
            font-family: "Roboto", sans-serif;
            text-transform: uppercase;
            outline: 0;
            background: #4CAF50;
            border: 0;
            padding: 0;
            color: #FFFFFF;
            font-size: 14px;
            -webkit-transition: all 0.3 ease;
            transition: all 0.3 ease;
            cursor: pointer;
            width: 15% !important;
            margin: 0;
            height: 50px;
        }

        .form button:hover,
        .form button:active,
        .form button:focus {
            background: #43A047;
        }

        .form .message {
            margin: 15px 0 0;
            color: #b3b3b3;
            font-size: 12px;
        }

        .form .message a {
            color: #4CAF50;
            text-decoration: none;
        }

        .container {
            position: relative;
            z-index: 1;
            max-width: 300px;
            margin: 0 auto;
        }

        .container:before,
        .container:after {
            content: "";
            display: block;
            clear: both;
        }

        .container .info {
            margin: 50px auto;
            text-align: center;
        }

        .container .info h1 {
            margin: 0 0 15px;
            padding: 0;
            font-size: 36px;
            font-weight: 300;
            color: #1a1a1a;
        }

        .container .info span {
            color: #4d4d4d;
            font-size: 12px;
        }

        .container .info span a {
            color: #000000;
            text-decoration: none;
        }

        .container .info span .fa {
            color: #EF3B3A;
        }

        body {
            background: #76b852;
            /* fallback for old browsers */
            background: rgb(141, 194, 111);
            background: linear-gradient(90deg, rgba(141, 194, 111, 1) 0%, rgba(118, 184, 82, 1) 50%);
            font-family: "Roboto", sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .link {
            display: inline-block;
            color: #f2f2f2;
            padding: 10px 10px;
            border: 1px solid;
            margin: 10px 0px
        }

        .alert {
            display: flex;
            justify-content: center;
            margin: auto;
            width: 50%;
        }

        .searchdiv {
            display: flex;
            justify-content: end;
        }

        .searchspan {
            color: #43A047;
            font-size: 35px;
            font-weight: 600;
            position: absolute;
            right: left;
            left: 45px;
        }
    </style>
</head>

<body onload="resetFileInput()">
    <div>
        <div id="alertDiv" class="alert" role="alert" style="width:96%;font-size: 10px"></div>
    </div>
    <div class="login-page">
        <a class="link" href="{{ route('order.insert.form') }}"><i style="padding: 0px 5px;"
                class="fa fa-plus-circle"></i>Add Order Manually</a>
        <div class="form">

            <div class="searchdiv" style="padding: 0px 0px 25px 0px;">
                <span class="searchspan">Search Order</span>
                <input type="text" id="searchInput" placeholder="Search..." required>
                <button class="searchbtn" onclick="searchOrder()" type="submit">Search</button>
            </div>

            <table id="dataTable" class="table table-sm">
                <thead>
                    <tr>
                        <th>amazon_order_id</th>
                        <th>shipment_id</th>
                        <th>shipment_item_id</th>
                        <th>tracking_number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be loaded here dynamically -->
                </tbody>
            </table>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    function searchOrder() {
        var searchData = $('#searchInput').val();
        var baseUrl = window.location.origin;
        $('#dataTable').DataTable({
            processing: true,
            "bDestroy": true,
            "bAutoWidth": false,
            serverSide: true,
            "dom": '<"top"l<"float-right"f>>rt<"bottom"ip>',
            "ajax": {
                type: 'POST',
                url: baseUrl + '/api/search-order',
                data: {
                    'searchData': searchData
                },
            },
            columns: [{
                    data: 'amazon_order_id',
                    name: 'amazon_order_id'
                },
                {
                    data: 'shipment_id',
                    name: 'shipment_id'
                },
                {
                    data: 'shipment_item_id',
                    name: 'shipment_item_id'
                },
                {
                    data: 'tracking_number',
                    name: 'tracking_number'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]

        });




        // var searchData = $('#searchInput').val();
        // var baseUrl = window.location.origin;
        // $.ajax({
        //     url: baseUrl + '/api/search-order',
        //     type: 'POST',
        //     data: { 'searchData': searchData },
        //     success: function(response) {
        //         if (response.success === true) {
        //             $("#alertDiv").addClass("alert-success");
        //         } else {
        //             $("#alertDiv").addClass("alert-danger");
        //         }
        //         $("#alertDiv").html(response.message).show();
        //         $('#csvInput').val('');
        //         setTimeout(function() {
        //             $("#alertDiv").html('').hide();
        //         }, 3000);
        //     },
        //     error: function(response) {
        //         $("#alertDiv").addClass("alert-danger");
        //         $("#alertDiv").html('something went wrong, please try after sometimes').show();
        //         setTimeout(function() {
        //             $("#alertDiv").html('').hide();
        //         }, 3000);
        //     }
        // });
    }

    function resetFileInput() {
        $('#csvInput').val('');
    }
</script>

</html>
