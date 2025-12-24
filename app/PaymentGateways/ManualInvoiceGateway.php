<?php

namespace App\PaymentGateways;

/**
 * Manual Invoice Payment Gateway
 * 
 * This is a manual payment gateway for invoice-based orders.
 * No API integration required - order is created and payment is handled manually.
 */
class ManualInvoiceGateway
{
    /**
     * Get the gateway identifier
     */
    public static function getIdentifier(): string
    {
        return 'invoice';
    }

    /**
     * Get the gateway display name
     */
    public static function getDisplayName(): string
    {
        return 'Invoice';
    }

    /**
     * Check if gateway is enabled
     */
    public static function isEnabled(): bool
    {
        return get_setting('invoice_enabled', 0) == 1;
    }

    /**
     * Process the payment (for manual gateways, this just returns success)
     */
    public static function processPayment($order, $data): array
    {
        return [
            'success' => true,
            'message' => 'Order created successfully. Invoice will be sent.',
            'order_id' => $order->id
        ];
    }

    /**
     * Get required fields for this gateway
     */
    public static function getRequiredFields($customerType): array
    {
        if ($customerType === 'private') {
            return ['personal_number'];
        } elseif ($customerType === 'company') {
            return ['vat_number'];
        }
        return [];
    }
}

