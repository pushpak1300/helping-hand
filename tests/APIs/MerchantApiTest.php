<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Merchant;

class MerchantApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_merchant()
    {
        $merchant = Merchant::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/merchants', $merchant
        );

        $this->assertApiResponse($merchant);
    }

    /**
     * @test
     */
    public function test_read_merchant()
    {
        $merchant = Merchant::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/merchants/'.$merchant->id
        );

        $this->assertApiResponse($merchant->toArray());
    }

    /**
     * @test
     */
    public function test_update_merchant()
    {
        $merchant = Merchant::factory()->create();
        $editedMerchant = Merchant::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/merchants/'.$merchant->id,
            $editedMerchant
        );

        $this->assertApiResponse($editedMerchant);
    }

    /**
     * @test
     */
    public function test_delete_merchant()
    {
        $merchant = Merchant::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/merchants/'.$merchant->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/merchants/'.$merchant->id
        );

        $this->response->assertStatus(404);
    }
}
