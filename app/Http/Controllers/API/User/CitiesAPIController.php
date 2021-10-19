<?php

namespace App\Http\Controllers\API\User;

use App\Exports\User\CitiesExport;
use App\Http\Resources\DataTrueResource;
use App\Imports\User\CitiesImport;
use App\Models\User;
use App\Models\User\City;
use App\Http\Requests\User\CitiesRequest;
use App\Http\Resources\User\CitiesCollection;
use App\Http\Resources\User\CitiesResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

/*
   |--------------------------------------------------------------------------
   | Cities Controller
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

class CitiesAPIController extends Controller
{
    /**
     * list Cities
     * @param Request $request
     * @return CitiesCollection
     */

    public function index(Request $request)
    {
        $query = User::commonFunctionMethod(City::class, $request);
        return new CitiesCollection(CitiesResource::collection($query), CitiesResource::class);
    }

    /**
     * add City
     * @param CitiesRequest $request
     * @return CitiesResource
     */

    public function store(CitiesRequest $request)
    {
        new CitiesResource(City::create($request->all()));
        return response()->json(['success' => config('constants.messages.success')]);
    }

    /**
     * City Detail
     * @param City $city
     * @return CitiesResource
     */

    public function show(City $city)
    {
        return new CitiesResource($city->load([]));
    }

    /**
     * Update City
     * @param CitiesRequest $request
     * @param City $city
     * @return CitiesResource
     */

    public function update(CitiesRequest $request, City $city)
    {
        $city->update($request->all());
        return new CitiesResource($city);
    }

    /**
     * Delete City
     *
     * @param Request $request
     * @param City $city
     * @return DataTrueResource
     * @throws \Exception
     */

    public function destroy(Request $request, City $city)
    {
        $city->delete();

        return new DataTrueResource($city);
    }

    /**
     * Delete City multiple
     * @param Request $request
     * @return DataTrueResource
     */

    public function deleteAll(Request $request)
    {
        return City::deleteAll($request);
    }

    /**
     * Export City Data
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */

    public function export(Request $request)
    {
        return Excel::download(new CitiesExport($request), 'city.csv');
    }

    /**
     * Import bulk
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function importBulk(Request $request)
    {
        return User::importBulk($request, new CitiesImport(), config('constants.models.city_model'), config('constants.import_dir_path.city_dir_path'));
    }
}
