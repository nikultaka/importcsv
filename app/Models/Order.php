<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'orders';
    protected $fillable = [
        'amazon_order_id',
        'merchant_order_id',
        'shipment_id',
        'shipment_item_id',
        'amazon_order_item_id',
        'merchant_order_item_id',
        'purchase_date',
        'payments_date',
        'shipment_date',
        'reporting_date',
        'buyer_email',
        'buyer_name',
        'buyer_phone_number',
        'merchant_sku',
        'title',
        'shipped_quantity',
        'currency',
        'item_price',
        'item_tax',
        'shipping_price',
        'shipping_tax',
        'gift_wrap_price',
        'gift_wrap_tax',
        'ship_service_level',
        'recipient_name',
        'shipping_address_1',
        'shipping_address_2',
        'shipping_address_3',
        'shipping_city',
        'shipping_state',
        'shipping_postal_code',
        'shipping_country_code',
        'shipping_phone_number',
        'billing_address_1',
        'billing_address_2',
        'billing_address_3',
        'billing_city',
        'billing_state',
        'billing_postal_code',
        'billing_country',
        'item_promo_discount',
        'shipment_promo_discount',
        'carrier',
        'tracking_number',
        'estimated_arrival_date',
        'fc',
        'fulfillment_channel',
        'sales_channel',
    ];
}
