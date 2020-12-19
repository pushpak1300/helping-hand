<?php namespace Tests\Repositories;

use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TransactionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TransactionRepository
     */
    protected $transactionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->transactionRepo = \App::make(TransactionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_transaction()
    {
        $transaction = Transaction::factory()->make()->toArray();

        $createdTransaction = $this->transactionRepo->create($transaction);

        $createdTransaction = $createdTransaction->toArray();
        $this->assertArrayHasKey('id', $createdTransaction);
        $this->assertNotNull($createdTransaction['id'], 'Created Transaction must have id specified');
        $this->assertNotNull(Transaction::find($createdTransaction['id']), 'Transaction with given id must be in DB');
        $this->assertModelData($transaction, $createdTransaction);
    }

    /**
     * @test read
     */
    public function test_read_transaction()
    {
        $transaction = Transaction::factory()->create();

        $dbTransaction = $this->transactionRepo->find($transaction->id);

        $dbTransaction = $dbTransaction->toArray();
        $this->assertModelData($transaction->toArray(), $dbTransaction);
    }

    /**
     * @test update
     */
    public function test_update_transaction()
    {
        $transaction = Transaction::factory()->create();
        $fakeTransaction = Transaction::factory()->make()->toArray();

        $updatedTransaction = $this->transactionRepo->update($fakeTransaction, $transaction->id);

        $this->assertModelData($fakeTransaction, $updatedTransaction->toArray());
        $dbTransaction = $this->transactionRepo->find($transaction->id);
        $this->assertModelData($fakeTransaction, $dbTransaction->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_transaction()
    {
        $transaction = Transaction::factory()->create();

        $resp = $this->transactionRepo->delete($transaction->id);

        $this->assertTrue($resp);
        $this->assertNull(Transaction::find($transaction->id), 'Transaction should not exist in DB');
    }
}
