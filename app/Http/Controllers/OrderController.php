<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Address;
use League\Csv\Reader;
use Exception;
use DataTables;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function importCsv(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv,txt',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $file = $request->file('csv_file');

        try {
            // Read CSV file
            $reader = Reader::createFromPath($file->getPathname(), 'r');
            $reader->setHeaderOffset(0);
            $records = $reader->getRecords();

            $recordsarray = iterator_to_array($records);
            $amazonOrderIds = array_column($recordsarray, 'Amazon Order Id');
            $duplicateOrders = [];

            // Retrieve existing orders with these Amazon Order IDs in bulk
            $existingOrders = Order::whereIn('amazon_order_id', $amazonOrderIds)->pluck('amazon_order_id')->toArray();
            foreach ($records as $record) {

                if (array_filter($record) !== []) {
                    if (in_array($record['Amazon Order Id'], $existingOrders)) {
                        $duplicateOrders[] = $record['Amazon Order Id'];
                    } else {
                        Order::create([
                            'amazon_order_id' => $record['Amazon Order Id'],
                            'merchant_order_id' => $record['Merchant Order Id'],
                            'shipment_id' => $record['Shipment ID'],
                            'shipment_item_id' => $record['Shipment Item Id'],
                            'amazon_order_item_id' => $record['Amazon Order Item Id'],
                            'merchant_order_item_id' => $record['Merchant Order Item Id'],
                            'purchase_date' => $record['Purchase Date'],
                            'payments_date' => $record['Payments Date'],
                            'shipment_date' => $record['Shipment Date'],
                            'reporting_date' => $record['Reporting Date'],
                            'buyer_email' => $record['Buyer Email'],
                            'buyer_name' => $record['Buyer Name'],
                            'buyer_phone_number' => $record['Buyer Phone Number'],
                            'merchant_sku' => $record['Merchant SKU'],
                            'title' => $record['Title'],
                            'shipped_quantity' => $record['Shipped Quantity'],
                            'currency' => $record['Currency'],
                            'item_price' => $record['Item Price'],
                            'item_tax' => $record['Item Tax'],
                            'shipping_price' => $record['Shipping Price'],
                            'shipping_tax' => $record['Shipping Tax'],
                            'gift_wrap_price' => $record['Gift Wrap Price'],
                            'gift_wrap_tax' => $record['Gift Wrap Tax'],
                            'ship_service_level' => $record['Ship Service Level'],
                            'recipient_name' => $record['Recipient Name'],
                            'shipping_address_1' => $record['Shipping Address 1'],
                            'shipping_address_2' => $record['Shipping Address 2'],
                            'shipping_address_3' => $record['Shipping Address 3'],
                            'shipping_city' => $record['Shipping City'],
                            'shipping_state' => $record['Shipping State'],
                            'shipping_postal_code' => $record['Shipping Postal Code'],
                            'shipping_country_code' => $record['Shipping Country Code'],
                            'shipping_phone_number' => $record['Shipping Phone Number'],
                            'billing_address_1' => $record['Billing Address 1'],
                            'billing_address_2' => $record['Billing Address 2'],
                            'billing_address_3' => $record['Billing Address 3'],
                            'billing_city' => $record['Billing City'],
                            'billing_state' => $record['Billing State'],
                            'bill_postal_code' => $record['bill-postal-code'],
                            'bill_country' => $record['bill-country'],
                            'item_promo_discount' => $record['Item Promo Discount'],
                            'shipment_promo_discount' => $record['Shipment Promo Discount'],
                            'carrier' => $record['Carrier'],
                            'tracking_number' => $record['Tracking Number'],
                            'estimated_arrival_date' => $record['Estimated Arrival Date'],
                            'fc' => $record['FC'],
                            'fulfillment_channel' => $record['Fulfillment Channel'],
                            'sales_channel' => $record['Sales Channel'],
                            'Address_verified' => '',
                            'is_view' => 0,
                        ]);
                    }
                }
            }

            if (!empty($duplicateOrders)) {
                return response()->json([
                    'success' => false,
                    'message' => "Duplicate amazon_order_ids found: " . implode(', ', $duplicateOrders),
                ], 200);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => "CSV file imported successfully",
                ], 201);
            }
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'message' => "CSV file NOT imported, Something Went Wrong!",
            ], 200);
        }
    }

    public function insertOrder(Request $request)
    {
        $req = $request->post();
        $data = array();
        $valueFound = false;

        // Check if the amazon_order_id already exists
        if (isset($req['amazon_order_id'])) {
            $existingOrder = Order::where('amazon_order_id', $req['amazon_order_id'])->first();
            if ($existingOrder) {
                return response()->json([
                    'success' => false,
                    'message' => "Duplicate amazon_order_id found.",
                ], 200);
            }
        }

        foreach ($req as $key => $value) {
            if (isset($value)) {
                $valueFound = true;
            }
            $data[$key] = isset($value) ? $value : null;
        }

        if (!$valueFound) {
            return response()->json([
                'success' => false,
                'message' => "No value found in the request.",
            ], 200);
        }
        $data['Address_verified'] =  null;
        $data['is_view'] =  0;

        $inser_order = Order::create($data);
        if ($inser_order) {

            return response()->json([
                'success' => true,
                'message' => "Order Insert successfully",
                'data' => $data
            ], 201);
        } else {

            return response()->json([
                'success' => false,
                'message' => "Order NOT Inserted, Something Went Wrong!",
            ], 200);
        }
    }

    public function searchOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'searchData' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $Data = $request->searchData;
        $existingOrders = Order::where('amazon_order_id', 'like', "%$Data%")
            ->orWhere('merchant_order_id', 'like', "%$Data%")
            ->orWhere('shipment_id', 'like', "%$Data%")
            ->orWhere('shipment_item_id', 'like', "%$Data%")
            ->orWhere('amazon_order_item_id', 'like', "%$Data%")
            ->orWhere('merchant_order_item_id', 'like', "%$Data%")
            ->orWhere('purchase_date', 'like', "%$Data%")
            ->orWhere('buyer_email', 'like', "%$Data%")
            ->orWhere('buyer_name', 'like', "%$Data%")
            ->orWhere('buyer_phone_number', 'like', "%$Data%")
            ->orWhere('tracking_number', 'like', "%$Data%")
            ->get();

        return DataTables::of($existingOrders)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $action = '<button id="actionBtn" style="width:120px !important;" class="btn" data-toggle="modal" onclick="viewOrder()" data-oid="' . $row->id . '">view Details</button>';
                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function orderDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'orderId' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $orderId = $request->orderId;
            $order = Order::find($orderId)->toArray();

            return response()->json([
                'success' => true,
                'message' => "Order Details get successfully",
                'data' => $order,
            ], 201);
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'message' => "Something Went Wrong!",
            ], 200);
        }
    }

    public function getOrderById(Request $request, $order_id)
    {

        $order = Order::where('amazon_order_id', $order_id)->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => "invalid_order",
            ], 200);
        }

        if ($order['is_view'] === 1) {
            return response()->json([
                'success' => false,
                'message' => "old_order",
            ], 200);
        }

        return response()->json([
            'success' => true,
            'message' => "new_order",
        ], 201);
    }

    public function enterAddress(Request $request, $order_id)
    {

        try {
            $order = Order::where('amazon_order_id', $order_id)->first();

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => "invalid_order",
                ], 200);
            }

            if ($order['is_view'] === 1) {
                return response()->json([
                    'success' => false,
                    'message' => "old_order",
                ], 200);
            }

            $validator = Validator::make($request->all(), [
                'city' => 'required',
                'state' => 'required',
                'zipcode' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        // Normalize the zipcode by removing hyphens
                        $normalizedZip = str_replace('-', '', $value);

                        // Check if the normalized zipcode matches either 5-digit or 9-digit format
                        if (!preg_match('/^\d{5}(\d{4})?$/', $normalizedZip)) {
                            $fail('The ' . $attribute . ' is invalid.');
                        }
                    },
                ],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $shippingCity = $order->shipping_city;

            $city = $request->city;
            $state = $request->state;
            $zipcode = $request->zipcode;
            $shipping_address_1 = isset($request->shipping_address_1) ? $request->shipping_address_1 : null;
            $shipping_address_2 = isset($request->shipping_address_2) ? $request->shipping_address_2 : null;


            // address verification
            $shippingCity = strtolower($shippingCity);
            $city = strtolower($city);

            $addressVerified = ($shippingCity === $city) ? 'yes' : 'no';

            $order->Address_verified = $addressVerified;
            $order->is_view = 1;
            $order->save();

            // save address in new table
            $data['shipping_address_1'] =  $shipping_address_1;
            $data['shipping_address_2'] =  $shipping_address_2;
            $data['order_id'] =  $order_id;
            $data['city'] =  $city;
            $data['state'] =  $state;
            $data['zipcode'] =  $zipcode;

            $inser_address = Address::create($data);

            return response()->json([
                'success' => true,
                'message' => "address_saved",
                'addressVerified' => $addressVerified,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "somethig went wrong, Please try after sometime !",
            ], 200);
        }
    }
}
