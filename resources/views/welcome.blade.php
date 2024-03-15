<html>

<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .login-page {
            width: 360px;
            padding: 8% 0 0;
            margin: auto;
        }

        .form {
            position: relative;
            z-index: 1;
            background: #FFFFFF;
            max-width: 360px;
            margin: 0 auto 100px;
            padding: 45px;
            text-align: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }

        .form input {
            font-family: "Roboto", sans-serif;
            outline: 0;
            background: #f2f2f2;
            width: 100%;
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
            width: 100%;
            border: 0;
            padding: 15px;
            color: #FFFFFF;
            font-size: 14px;
            -webkit-transition: all 0.3 ease;
            transition: all 0.3 ease;
            cursor: pointer;
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
    </style>
</head>

<body onload="resetFileInput()">
    <div class="login-page">
        <a class="link" href="{{ route('order.insert.form') }}"><i style="padding: 0px 5px;"
                class="fa fa-plus-circle"></i>Add Order Manually</a>
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
<script>
    function importCSV() {
        var formData = new FormData($('#csvForm')[0]);
        var baseUrl = window.location.origin;
        console.log('formData:', formData)
        console.log('BASE_URL:', baseUrl);
        $.ajax({
            url: baseUrl + '/api/import-csv',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                if (response.success === true) {
                    Toast.fire({
                        icon: "success",
                        title: response.message
                    });
                } else {
                    Toast.fire({
                        icon: "error",
                        title: response.message
                    });
                }
                $('#csvForm')[0].reset();
                $('#csvInput').val('');
            },
            error: function(response) {
                Toast.fire({
                    icon: "error",
                    title: "something went wrong, please try after sometimes!"
                });
            }
        });
    }

    function resetFileInput() {
        $('#csvForm')[0].reset();
        $('#csvInput').val('');
    }
</script>

</html>
