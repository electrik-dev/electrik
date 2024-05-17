<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Stripe\Stripe;
use Stripe\Product as StripeProduct;
use Stripe\Price as StripePrice;
use App\Models\StripeProduct as StripeProductModel;
use App\Models\Plan;

class SyncStripeData extends Command
{
    protected $signature = 'electrik:stripe:sync';
    protected $description = 'Synchronize Stripe products and plans with the local database.';

    public function __construct() {
        parent::__construct();
    }

    public function handle()
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        // Sync Products
        $this->info('Synchronizing products...');
        $stripeProducts = StripeProduct::all(["active" => true]);
        foreach ($stripeProducts->autoPagingIterator() as $stripeProduct) {
            StripeProductModel::updateOrCreate(
                ['stripe_product_id' => $stripeProduct->id],
                [
                    'name' => $stripeProduct->name,
                    'description' => $stripeProduct->description ?? '',
                ]
            );
        }

        // Sync Plans (Prices)
        $this->info('Synchronizing plans...');
        $stripePrices = StripePrice::all(["active" => true]);
        foreach ($stripePrices->autoPagingIterator() as $stripePrice) {
            $plan = Plan::updateOrCreate(
                ['stripe_plan_id' => $stripePrice->id],
                [
                    'product_id' => StripeProductModel::where('stripe_product_id', $stripePrice->product)->first()->id,
                    'name' => $stripePrice->nickname,
                    'price' => $stripePrice->unit_amount,
                    'currency' => $stripePrice->currency,
                    'interval' => $stripePrice->recurring->interval,
                ]
            );
        }

        $this->info('Stripe data synchronized successfully.');
    }
}
