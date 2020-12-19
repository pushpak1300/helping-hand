<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Receiver;

class ReceiverApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_receiver()
    {
        $receiver = Receiver::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/receivers', $receiver
        );

        $this->assertApiResponse($receiver);
    }

    /**
     * @test
     */
    public function test_read_receiver()
    {
        $receiver = Receiver::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/receivers/'.$receiver->id
        );

        $this->assertApiResponse($receiver->toArray());
    }

    /**
     * @test
     */
    public function test_update_receiver()
    {
        $receiver = Receiver::factory()->create();
        $editedReceiver = Receiver::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/receivers/'.$receiver->id,
            $editedReceiver
        );

        $this->assertApiResponse($editedReceiver);
    }

    /**
     * @test
     */
    public function test_delete_receiver()
    {
        $receiver = Receiver::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/receivers/'.$receiver->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/receivers/'.$receiver->id
        );

        $this->response->assertStatus(404);
    }
}
