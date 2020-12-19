<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateMerchantAPIRequest;
use App\Http\Requests\Api\UpdateMerchantAPIRequest;
use App\Models\Merchant;
use App\Repositories\MerchantRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MerchantController
 * @package App\Http\Controllers\Api
 */

class MerchantAPIController extends AppBaseController
{
    /** @var  MerchantRepository */
    private $merchantRepository;

    public function __construct(MerchantRepository $merchantRepo)
    {
        $this->merchantRepository = $merchantRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/merchants",
     *      summary="Get a listing of the Merchants.",
     *      tags={"Merchant"},
     *      description="Get all Merchants",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Merchant")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $merchants = $this->merchantRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($merchants->toArray(), 'Merchants retrieved successfully');
    }

    /**
     * @param CreateMerchantAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/merchants",
     *      summary="Store a newly created Merchant in storage",
     *      tags={"Merchant"},
     *      description="Store Merchant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Merchant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Merchant")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Merchant"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMerchantAPIRequest $request)
    {
        $input = $request->all();

        $merchant = $this->merchantRepository->create($input);

        return $this->sendResponse($merchant->toArray(), 'Merchant saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/merchants/{id}",
     *      summary="Display the specified Merchant",
     *      tags={"Merchant"},
     *      description="Get Merchant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Merchant",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Merchant"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Merchant $merchant */
        $merchant = $this->merchantRepository->find($id);

        if (empty($merchant)) {
            return $this->sendError('Merchant not found');
        }

        return $this->sendResponse($merchant->toArray(), 'Merchant retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMerchantAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/merchants/{id}",
     *      summary="Update the specified Merchant in storage",
     *      tags={"Merchant"},
     *      description="Update Merchant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Merchant",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Merchant that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Merchant")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Merchant"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMerchantAPIRequest $request)
    {
        $input = $request->all();

        /** @var Merchant $merchant */
        $merchant = $this->merchantRepository->find($id);

        if (empty($merchant)) {
            return $this->sendError('Merchant not found');
        }

        $merchant = $this->merchantRepository->update($input, $id);

        return $this->sendResponse($merchant->toArray(), 'Merchant updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/merchants/{id}",
     *      summary="Remove the specified Merchant from storage",
     *      tags={"Merchant"},
     *      description="Delete Merchant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Merchant",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Merchant $merchant */
        $merchant = $this->merchantRepository->find($id);

        if (empty($merchant)) {
            return $this->sendError('Merchant not found');
        }

        $merchant->delete();

        return $this->sendSuccess('Merchant deleted successfully');
    }
}
