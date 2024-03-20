<html>

<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="{{ asset('assets/css/orderinsert.css') }}" rel="stylesheet">
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-2">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="{{ route('order.insert.form') }}">Add Order</a>
                    <a class="nav-link" href="{{ route('csv.insert.form') }}">CSV Insert</a>
                    <a class="nav-link" href="{{ route('order.list') }}">Order List</a>
                </div>
            </div>
        </div>
    </nav>
</head>

<body onload="resetFileInput()">
    <div id="alertDiv" class="alert" role="alert"></div>
    <div id="alertContainer"></div>
    <div class="login-page">
        <h3 class="heading">INSERT ORDER DETAILS</h3>
        <div class="form">
            <form id="orderForm" onsubmit="return false" autocomplete="off" method="POST"
                enctype="multipart/form-data">
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
                        <button type="submit" onclick="insertOrder()" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/orderinsert.js') }}"></script>
</html>
