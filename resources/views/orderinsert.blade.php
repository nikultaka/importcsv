<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        .login-page {
            width: 100%;
            padding: 8% 0 0;
            margin: auto;
        }

        .form {
            position: relative;
            z-index: 1;
            background: #FFFFFF;
            max-width: 95%;
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

        .heading {
            display: flex;
            justify-content: center;
            padding: 10px 10px;
            color: #f2f2f2;
            font-size: 50px;
            font-weight: 600;
            font-family: serif;
        }

        .hidden {
            display: none;
        }
    </style>
</head>


<body onload="resetFileInput()">

    <div class="login-page">
        @if (isset($success))
            <div id="alertMessage" class="alert alert-success">
                {{ $success }}
            </div>
        @elseif(isset($error))
            <div id="alertMessage" class="alert alert-danger">
                {{ $error }}
            </div>
        @else
            <div id="alertMessage"></div>
        @endif
        <a class="link" href="{{ route('csv.insert.form') }}"><i style="padding: 0px 5px;"
            class="fa fa-plus-circle"></i>CSV Import</a>
        <h3 class="heading">INSERT ORDER DETAILS</h3>
        <div class="form">
            <form id="orderForm" action="{{ route('insert.order') }}" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="amazon_order_id">Amazon Order ID:</label>
                            <input type="text" class="form-control" id="amazon_order_id" name="amazon_order_id">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="merchant_order_id">Merchant Order ID:</label>
                            <input type="text" class="form-control" id="merchant_order_id" name="merchant_order_id">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="shipment_id">Shipment ID:</label>
                            <input type="text" class="form-control" id="shipment_id" name="shipment_id">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="shipment_item_id">Shipment Item ID:</label>
                            <input type="text" class="form-control" id="shipment_item_id" name="shipment_item_id">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="amazon_order_item_id">Amazon Order Item ID:</label>
                            <input type="text" class="form-control" id="amazon_order_item_id"
                                name="amazon_order_item_id">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="merchant_order_item_id">Merchant Order Item ID:</label>
                            <input type="text" class="form-control" id="merchant_order_item_id"
                                name="merchant_order_item_id">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="purchase_date">Purchase Date:</label>
                            <input type="text" class="form-control" id="purchase_date" name="purchase_date">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="payments_date">Payments Date:</label>
                            <input type="text" class="form-control" id="payments_date" name="payments_date">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="shipment_date">Shipment Date:</label>
                            <input type="text" class="form-control" id="shipment_date" name="shipment_date">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="reporting_date">Reporting Date:</label>
                            <input type="text" class="form-control" id="reporting_date" name="reporting_date">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="buyer_email">Buyer Email:</label>
                            <input type="text" class="form-control" id="buyer_email" name="buyer_email">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="buyer_name">Buyer Name:</label>
                            <input type="text" class="form-control" id="buyer_name" name="buyer_name">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="buyer_phone_number">Buyer Phone Number:</label>
                            <input type="text" class="form-control" id="buyer_phone_number"
                                name="buyer_phone_number">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="merchant_sku">Merchant SKU:</label>
                            <input type="text" class="form-control" id="merchant_sku" name="merchant_sku">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="shipped_quantity">Shipped Quantity:</label>
                            <input type="text" class="form-control" id="shipped_quantity"
                                name="shipped_quantity">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="currency">Currency:</label>
                            <input type="text" class="form-control" id="currency" name="currency">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="item_price">Item Price:</label>
                            <input type="text" class="form-control" id="item_price" name="item_price">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="item_tax">Item Tax:</label>
                            <input type="text" class="form-control" id="item_tax" name="item_tax">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="shipping_price">Shipping Price:</label>
                            <input type="text" class="form-control" id="shipping_price" name="shipping_price">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="shipping_tax">Shipping Tax:</label>
                            <input type="text" class="form-control" id="shipping_tax" name="shipping_tax">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="gift_wrap_price">Gift Wrap Price:</label>
                            <input type="text" class="form-control" id="gift_wrap_price" name="gift_wrap_price">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="gift_wrap_tax">Gift Wrap Tax:</label>
                            <input type="text" class="form-control" id="gift_wrap_tax" name="gift_wrap_tax">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="ship_service_level">Ship Service Level:</label>
                            <input type="text" class="form-control" id="ship_service_level"
                                name="ship_service_level">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="recipient_name">Recipient Name:</label>
                            <input type="text" class="form-control" id="recipient_name" name="recipient_name">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="shipping_address_1">Shipping Address 1:</label>
                            <input type="text" class="form-control" id="shipping_address_1"
                                name="shipping_address_1">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="shipping_address_2">Shipping Address 2:</label>
                            <input type="text" class="form-control" id="shipping_address_2"
                                name="shipping_address_2">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="shipping_address_3">Shipping Address 3:</label>
                            <input type="text" class="form-control" id="shipping_address_3"
                                name="shipping_address_3">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="shipping_city">Shipping City:</label>
                            <input type="text" class="form-control" id="shipping_city" name="shipping_city">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="shipping_state">Shipping State:</label>
                            <input type="text" class="form-control" id="shipping_state" name="shipping_state">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="shipping_postal_code">Shipping Postal Code:</label>
                            <input type="text" class="form-control" id="shipping_postal_code"
                                name="shipping_postal_code">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="shipping_country_code">Shipping Country Code:</label>
                            <input type="text" class="form-control" id="shipping_country_code"
                                name="shipping_country_code">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="shipping_phone_number">Shipping Phone Number:</label>
                            <input type="text" class="form-control" id="shipping_phone_number"
                                name="shipping_phone_number">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="billing_address_1">Billing Address 1:</label>
                            <input type="text" class="form-control" id="billing_address_1"
                                name="billing_address_1">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="billing_address_2">Billing Address 2:</label>
                            <input type="text" class="form-control" id="billing_address_2"
                                name="billing_address_2">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="billing_address_3">Billing Address 3:</label>
                            <input type="text" class="form-control" id="billing_address_3"
                                name="billing_address_3">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="billing_city">Billing City:</label>
                            <input type="text" class="form-control" id="billing_city" name="billing_city">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="billing_state">Billing State:</label>
                            <input type="text" class="form-control" id="billing_state" name="billing_state">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="bill_postal_code">Bill Postal Code:</label>
                            <input type="text" class="form-control" id="bill_postal_code"
                                name="bill_postal_code">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="bill_country">Bill Country:</label>
                            <input type="text" class="form-control" id="bill_country" name="bill_country">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="item_promo_discount">Item Promo Discount:</label>
                            <input type="text" class="form-control" id="item_promo_discount"
                                name="item_promo_discount">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="shipment_promo_discount">Shipment Promo Discount:</label>
                            <input type="text" class="form-control" id="shipment_promo_discount"
                                name="shipment_promo_discount">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="carrier">Carrier:</label>
                            <input type="text" class="form-control" id="carrier" name="carrier">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tracking_number">Tracking Number:</label>
                            <input type="text" class="form-control" id="tracking_number" name="tracking_number">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="estimated_arrival_date">Estimated Arrival Date:</label>
                            <input type="text" class="form-control" id="estimated_arrival_date"
                                name="estimated_arrival_date">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="fc">FC:</label>
                            <input type="text" class="form-control" id="fc" name="fc">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="fulfillment_channel">Fulfillment Channel:</label>
                            <input type="text" class="form-control" id="fulfillment_channel"
                                name="fulfillment_channel">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sales_channel">Sales Channel:</label>
                            <input type="text" class="form-control" id="sales_channel" name="sales_channel">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>


        </div>
    </div>
</body>

<script>
    function resetFileInput() {
        document.getElementById('orderForm').reset();
    }

    setTimeout(function() {
        document.getElementById('alertMessage').style.display = 'none';
    }, 3000);
</script>

</html>
