<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the ping endpoint returns pong.
     */
    public function test_ping_endpoint_returns_pong(): void
    {
        $response = $this->get('/api/ping');

        $response->assertStatus(200);
        $response->assertJson(['message' => 'pong']);
    }

    /**
     * Test that customers endpoint returns empty array initially.
     */
    public function test_customers_endpoint_returns_empty_array_initially(): void
    {
        $response = $this->get('/api/customers');

        $response->assertStatus(200);
        $response->assertJson([]);
    }

    /**
     * Test that we can create a customer successfully.
     */
    public function test_can_create_customer(): void
    {
        $customerData = [
            'name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com'
        ];

        $response = $this->postJson('/api/customers', $customerData);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id',
            'name',
            'last_name',
            'email',
            'created_at',
            'updated_at'
        ]);

        // Verify the customer was saved
        $this->assertDatabaseHas('customers', [
            'name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com'
        ]);
    }

    /**
     * Test that customer creation requires all fields.
     */
    public function test_customer_creation_validation(): void
    {
        // Test missing name
        $response = $this->postJson('/api/customers', [
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com'
        ]);
        $response->assertStatus(422);

        // Test missing last_name
        $response = $this->postJson('/api/customers', [
            'name' => 'John',
            'email' => 'john.doe@example.com'
        ]);
        $response->assertStatus(422);

        // Test missing email
        $response = $this->postJson('/api/customers', [
            'name' => 'John',
            'last_name' => 'Doe'
        ]);
        $response->assertStatus(422);
    }

    /**
     * Test that customers endpoint returns created customers.
     */
    public function test_customers_endpoint_returns_created_customers(): void
    {
        // Create a customer first
        $customerData = [
            'name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane.smith@example.com'
        ];

        $this->postJson('/api/customers', $customerData);

        // Now get all customers
        $response = $this->get('/api/customers');

        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $response->assertJsonFragment([
            'name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane.smith@example.com'
        ]);
    }
}