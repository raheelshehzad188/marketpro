<?php

namespace App\PaymentGateways;

/**
 * Manual Swish Payment Gateway
 * 
 * This is a manual payment gateway for Swish payments.
 * No API integration required - customer sends payment manually via Swish.
 */
class ManualSwishGateway
{
    /**
     * Get the gateway identifier
     */
    public static function getIdentifier(): string
    {
        return 'swish';
    }

    /**
     * Get the gateway display name
     */
    public static function getDisplayName(): string
    {
        return 'Swish';
    }

    /**
     * Check if gateway is enabled
     */
    public static function isEnabled(): bool
    {
        return get_setting('swish_enabled', 0) == 1;
    }

    /**
     * Get Swish number from admin settings
     */
    public static function getSwishNumber(): string
    {
        return get_setting('swish_number', '0709425194');
    }

    /**
     * Process the payment (for manual gateways, this just returns success)
     */
    public static function processPayment($order, $data): array
    {
        return [
            'success' => true,
            'message' => 'Order created successfully. Please complete Swish payment.',
            'order_id' => $order->id
        ];
    }

    /**
     * Get required fields for this gateway (none for Swish)
     */
    public static function getRequiredFields($customerType): array
    {
        return [];
    }
}

