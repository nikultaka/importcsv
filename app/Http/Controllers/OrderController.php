<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Order;
use League\Csv\Reader;
use Exception;
use Illuminate\Support\Facades\Redirect;
class OrderController extends Controller
{
    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');

        try { 
            // Read CSV file
            $reader = Reader::createFromPath($file->getPathname(), 'r');
            $reader->setHeaderOffset(0);
            $records = $reader->getRecords();
            foreach ($records as $record) {
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
                ]);
            }


            return response()->json([
                'success' => true,
                'message' => "CSV file imported successfully",
                // 'data' => $currentUser_email
            ], 201);
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
    
}
