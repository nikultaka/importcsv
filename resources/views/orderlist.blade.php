<html>

<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/orderlist.css') }}" rel="stylesheet">
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-2">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" aria-current="page" href="{{ route('order.insert.form') }}">Add Order</a>
                    <a class="nav-link" href="{{ route('csv.insert.form') }}">CSV Insert</a>
                    <a class="nav-link active" href="{{ route('order.list') }}">Order List</a>
                </div>
            </div>
        </div>
    </nav>
</head>

<body onload="resetFileInput()">


    <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModal"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="orderDetailsContent"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div id="alertDiv" class="alert" role="alert" style="width:96%;font-size: 10px"></div>
    </div>
    <div class="login-page">

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
                </tbody>
            </table>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/orderlist.js') }}"></script>

</html>
