<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateTransactionAPIRequest;
use App\Http\Requests\Api\UpdateTransactionAPIRequest;
use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TransactionController
 * @package App\Http\Controllers\Api
 */

class TransactionAPIController extends AppBaseController
{
    /** @var  TransactionRepository */
    private $transactionRepository;

    public function __construct(TransactionRepository $transactionRepo)
    {
        $this->transactionRepository = $transactionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/transactions",
     *      summary="Get a listing of the Transactions.",
     *      tags={"Transaction"},
     *      description="Get all Transactions",
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
     *                  @SWG\Items(ref="#/definitions/Transaction")
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
        $transactions = $this->transactionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($transactions->toArray(), 'Transactions retrieved successfully');
    }

    /**
     * @param CreateTransactionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/transactions",
     *      summary="Store a newly created Transaction in storage",
     *      tags={"Transaction"},
     *      description="Store Transaction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Transaction")
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
     *                  ref="#/definitions/Transaction"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTransactionAPIRequest $request)
    {
        $input = $request->all();

        $transaction = $this->transactionRepository->create($input);

        return $this->sendResponse($transaction->toArray(), 'Transaction saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/transactions/{id}",
     *      summary="Display the specified Transaction",
     *      tags={"Transaction"},
     *      description="Get Transaction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Transaction",
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
     *                  ref="#/definitions/Transaction"
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
        /** @var Transaction $transaction */
        $transaction = $this->transactionRepository->find($id);

        if (empty($transaction)) {
            return $this->sendError('Transaction not found');
        }

        return $this->sendResponse($transaction->toArray(), 'Transaction retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTransactionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/transactions/{id}",
     *      summary="Update the specified Transaction in storage",
     *      tags={"Transaction"},
     *      description="Update Transaction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Transaction",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Transaction that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Transaction")
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
     *                  ref="#/definitions/Transaction"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTransactionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Transaction $transaction */
        $transaction = $this->transactionRepository->find($id);

        if (empty($transaction)) {
            return $this->sendError('Transaction not found');
        }

        $transaction = $this->transactionRepository->update($input, $id);

        return $this->sendResponse($transaction->toArray(), 'Transaction updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/transactions/{id}",
     *      summary="Remove the specified Transaction from storage",
     *      tags={"Transaction"},
     *      description="Delete Transaction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Transaction",
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
        /** @var Transaction $transaction */
        $transaction = $this->transactionRepository->find($id);

        if (empty($transaction)) {
            return $this->sendError('Transaction not found');
        }

        $transaction->delete();

        return $this->sendSuccess('Transaction deleted successfully');
    }
}
