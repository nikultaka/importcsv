<html>

<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/csvimport.css') }}" rel="stylesheet">
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-2">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" aria-current="page" href="{{ route('order.insert.form') }}">Add Order</a>
                    <a class="nav-link active" href="{{ route('csv.insert.form') }}">CSV Insert</a>
                    <a class="nav-link" href="{{ route('order.list') }}">Order List</a>
                </div>
            </div>
        </div>
    </nav>
</head>

<body onload="resetFileInput()">
    <div>
        <div id="alertDiv" class="alert" role="alert" style="width:96%;font-size: 10px"></div>
    </div>
    <div class="login-page">
        <div class="form">
            <form id="csvForm" onsubmit="return false" autocomplete="off" method="POST" enctype="multipart/form-data"
                class="register-form">
                @csrf
                <input id="csvInput" type="file" name="csv_file" accept=".csv" required>
                <button onclick="importCSV()" type="submit">Import CSV</button>
            </form>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/csvimport.js') }}"></script>
</html>
