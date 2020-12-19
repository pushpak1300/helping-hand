<?php namespace Tests\Repositories;

use App\Models\Merchant;
use App\Repositories\MerchantRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MerchantRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MerchantRepository
     */
    protected $merchantRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->merchantRepo = \App::make(MerchantRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_merchant()
    {
        $merchant = Merchant::factory()->make()->toArray();

        $createdMerchant = $this->merchantRepo->create($merchant);

        $createdMerchant = $createdMerchant->toArray();
        $this->assertArrayHasKey('id', $createdMerchant);
        $this->assertNotNull($createdMerchant['id'], 'Created Merchant must have id specified');
        $this->assertNotNull(Merchant::find($createdMerchant['id']), 'Merchant with given id must be in DB');
        $this->assertModelData($merchant, $createdMerchant);
    }

    /**
     * @test read
     */
    public function test_read_merchant()
    {
        $merchant = Merchant::factory()->create();

        $dbMerchant = $this->merchantRepo->find($merchant->id);

        $dbMerchant = $dbMerchant->toArray();
        $this->assertModelData($merchant->toArray(), $dbMerchant);
    }

    /**
     * @test update
     */
    public function test_update_merchant()
    {
        $merchant = Merchant::factory()->create();
        $fakeMerchant = Merchant::factory()->make()->toArray();

        $updatedMerchant = $this->merchantRepo->update($fakeMerchant, $merchant->id);

        $this->assertModelData($fakeMerchant, $updatedMerchant->toArray());
        $dbMerchant = $this->merchantRepo->find($merchant->id);
        $this->assertModelData($fakeMerchant, $dbMerchant->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_merchant()
    {
        $merchant = Merchant::factory()->create();

        $resp = $this->merchantRepo->delete($merchant->id);

        $this->assertTrue($resp);
        $this->assertNull(Merchant::find($merchant->id), 'Merchant should not exist in DB');
    }
}
