<?php

namespace Tests\Feature;

use App\Listeners\SendEmailJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreMethodCreatesOrderAndQueuesEmailNotification()
    {
        Queue::fake();
        $requestData = [
            'email' => 'markza9822@gmail.com',
            'telephone' => '1234567890',
            'shipping_address' => 'Shipping Address',
            'billing_address' => 'Billing Address',
            'price_summary' => 100.00,
            'total_amount' => 100.00,
            'status' => 'wait_confirmed',
            'detailed_orders' => [
                [
                    'id_product' => 1,
                    'product_name' => 'Product 1',
                    'product_price' => 50.00,
                ],
                [
                    'id_product' => 2,
                    'product_name' => 'Product 2',
                    'product_price' => 50.00,
                ],
            ],
        ];

        $response = $this->json('POST', '/public/orders/create', $requestData);
        $response->assertStatus(200)->assertJson(['message' => 'order created successfully']);
        $this->assertDatabaseHas('main_orders', ['email' => 'markza9822@gmail.com']);
        $this->assertDatabaseHas('detailed_orders', ['product_name' => 'Product 1']);
        $this->assertDatabaseHas('detailed_orders', ['product_name' => 'Product 2']);

        Queue::assertPushed(SendEmailJob::class);
    }
}
