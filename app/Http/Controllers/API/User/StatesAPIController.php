<?php

namespace App\Http\Controllers\API\User;

use App\Exports\User\StatesExport;
use App\Http\Resources\DataTrueResource;
use App\Imports\User\StatesImport;
use App\Models\User;
use App\Models\User\State;
use App\Http\Requests\User\StatesRequest;
use App\Http\Resources\User\StatesCollection;
use App\Http\Resources\User\StatesResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

/*
   |--------------------------------------------------------------------------
   | States Controller
   |--------------------------------------------------------------------------
   |
   | This controller handles the Roles of
       index,
       show,
       store,
       update,
       destroy,
       export and
       importBulk Methods.
   |
   */

class StatesAPIController extends Controller
{
    /**
     * List States
     * @param Request $request
     * @return StatesCollection
     */

    public function index(Request $request)
    {
        //return $request;
        //return $query = State::All();
        $query = User::commonFunctionMethod(State::class, $request);
        return new StatesCollection(StatesResource::collection($query), StatesResource::class);
    }

    /**
     * Add State
     * @param StatesRequest $request
     * @return StatesResource
     */

    public function store(StatesRequest $request)
    {
        //dd($request->all());
        return new StatesResource(State::create($request->all()));
    }

    /**
     * States Detail
     * @param State $state
     * @return StatesResource
     */

    public function show(State $state)
    {
        return new StatesResource($state->load([]));
    }

    /**
     * Update State
     * @param StatesRequest $request
     * @param State $state
     * @return StatesResource
     */

    public function update(StatesRequest $request, State $state)
    {
        $state->update($request->all());

        return new StatesResource($state);
    }

    /**
     * Delete State
     *
     * @param Request $request
     * @param State $state
     * @return DataTrueResource
     * @throws \Exception
     */

    public function destroy(Request $request, State $state)
    {
        $state->delete();

        return new DataTrueResource($state);
    }

    /**
     * Delete State multiple
     * @param Request $request
     * @return DataTrueResource
     */

    public function deleteAll(Request $request)
    {
        return State::deleteAll($request);
    }

    /**
     * Export States Data
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */

    public function export(Request $request)
    {
        return Excel::download(new StatesExport($request), 'state.csv');
    }
    /**
     * Import bulk
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function importBulk(Request $request)
    {
        return User::importBulk($request, new StatesImport(), config('constants.models.state_model'), config('constants.import_dir_path.state_dir_path'));
    }
}
