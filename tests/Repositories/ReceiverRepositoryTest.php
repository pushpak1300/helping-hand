<?php namespace Tests\Repositories;

use App\Models\Receiver;
use App\Repositories\ReceiverRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ReceiverRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ReceiverRepository
     */
    protected $receiverRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->receiverRepo = \App::make(ReceiverRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_receiver()
    {
        $receiver = Receiver::factory()->make()->toArray();

        $createdReceiver = $this->receiverRepo->create($receiver);

        $createdReceiver = $createdReceiver->toArray();
        $this->assertArrayHasKey('id', $createdReceiver);
        $this->assertNotNull($createdReceiver['id'], 'Created Receiver must have id specified');
        $this->assertNotNull(Receiver::find($createdReceiver['id']), 'Receiver with given id must be in DB');
        $this->assertModelData($receiver, $createdReceiver);
    }

    /**
     * @test read
     */
    public function test_read_receiver()
    {
        $receiver = Receiver::factory()->create();

        $dbReceiver = $this->receiverRepo->find($receiver->id);

        $dbReceiver = $dbReceiver->toArray();
        $this->assertModelData($receiver->toArray(), $dbReceiver);
    }

    /**
     * @test update
     */
    public function test_update_receiver()
    {
        $receiver = Receiver::factory()->create();
        $fakeReceiver = Receiver::factory()->make()->toArray();

        $updatedReceiver = $this->receiverRepo->update($fakeReceiver, $receiver->id);

        $this->assertModelData($fakeReceiver, $updatedReceiver->toArray());
        $dbReceiver = $this->receiverRepo->find($receiver->id);
        $this->assertModelData($fakeReceiver, $dbReceiver->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_receiver()
    {
        $receiver = Receiver::factory()->create();

        $resp = $this->receiverRepo->delete($receiver->id);

        $this->assertTrue($resp);
        $this->assertNull(Receiver::find($receiver->id), 'Receiver should not exist in DB');
    }
}
