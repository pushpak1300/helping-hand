<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateReceiverAPIRequest;
use App\Http\Requests\Api\UpdateReceiverAPIRequest;
use App\Models\Receiver;
use App\Repositories\ReceiverRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\Dealings;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Response;
use Illuminate\Support\Str;

/**
 * Class ReceiverController
 * @package App\Http\Controllers\Api
 */

class ReceiverAPIController extends AppBaseController
{
    /** @var  ReceiverRepository */
    private $receiverRepository;

    public function __construct(ReceiverRepository $receiverRepo)
    {
        $this->receiverRepository = $receiverRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/receivers",
     *      summary="Get a listing of the Receivers.",
     *      tags={"Receiver"},
     *      description="Get all Receivers",
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
     *                  @SWG\Items(ref="#/definitions/Receiver")
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
        $receivers = $this->receiverRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($receivers->toArray(), 'Receivers retrieved successfully');
    }

    /**
     * @param CreateReceiverAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/receivers",
     *      summary="Store a newly created Receiver in storage",
     *      tags={"Receiver"},
     *      description="Store Receiver",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Receiver that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Receiver")
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
     *                  ref="#/definitions/Receiver"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(Request $request)
    {
        if ($request->user()->isUser()) {
            return $this->sendError('Unauthorised', 401);
        }
        $input = $request->all();
        $user = User::create([
            'name' => $input['name'],
            'mobile' => Str::random(4),
            'password' => Hash::make('paswsword'),
            'role' => 'reciever'
        ]);
        $receiver = Receiver::Create([
            'age' => $input['age'],
            'merchants_by' => Merchant::where('user_id', $request->user()->id)->first()->id,
            'user_id' => $user->id
        ]);
        $data = $receiver->toArray();
        $data['pin'] = $user->mobile;
        $data['wallet'] = $user->balance;
        return $this->sendResponse($data, 'Receiver saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/receivers/{id}",
     *      summary="Display the specified Receiver",
     *      tags={"Receiver"},
     *      description="Get Receiver",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Receiver",
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
     *                  ref="#/definitions/Receiver"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id, Request $request)
    {
        /** @var Receiver $receiver */
        $receiver = Receiver::where('user_id', $id)->first();

        if (empty($receiver)) {
            return $this->sendError('Receiver not found');
        }
        if ($request->user()->isUser()) {
            return $this->sendResponse($receiver->toArray(), 'Receiver retrieved successfully');
        }
        $data = $receiver->toArray();
        $data['wallet'] = $receiver->user->balance;
        return $this->sendResponse($data, 'Receiver retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateReceiverAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/receivers/{id}",
     *      summary="Update the specified Receiver in storage",
     *      tags={"Receiver"},
     *      description="Update Receiver",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Receiver",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Receiver that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Receiver")
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
     *                  ref="#/definitions/Receiver"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function add($id, Request $request)
    {
        $amount = $request->amount;
        /** @var User $user */
        $user = User::find($id);
        if (empty($user)) {
            return $this->sendError('Receiver not found');
        }
        if ($request->user()->isUser()) {

            $user->deposit($amount);
            Dealings::create([
                'reciever_id' => $user->id,
                'user_or_merchant_id' => $request->user()->id,
                'amount' => $amount,
                'type' => 'donation'
            ]);
            return $this->sendResponse(true, 'Money donated Sucessfully');
        }
        if ($user->balance < $amount) {
            return $this->sendError('Insuffiecient Balance', 200);
        }
        $user->withdraw($amount);
        Dealings::create([
            'reciever_id' => $user->id,
            'user_or_merchant_id' => $request->user()->id,
            'amount' => $amount,
            'type' => 'order'
        ]);
        return $this->sendResponse($user->toArray(), 'Money withdraw Sucessfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/receivers/{id}",
     *      summary="Remove the specified Receiver from storage",
     *      tags={"Receiver"},
     *      description="Delete Receiver",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Receiver",
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
        /** @var Receiver $receiver */
        $receiver = $this->receiverRepository->find($id);

        if (empty($receiver)) {
            return $this->sendError('Receiver not found');
        }

        $receiver->delete();

        return $this->sendSuccess('Receiver deleted successfully');
    }
}
