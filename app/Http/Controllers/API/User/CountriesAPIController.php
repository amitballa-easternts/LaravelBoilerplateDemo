<?php

namespace App\Http\Controllers\API\User;

use App\Exports\User\CountriesExport;
use App\Http\Resources\DataTrueResource;
use App\Imports\User\CountriesImport;
use App\Models\User;
use App\Models\User\Country;
use App\Http\Requests\User\CountriesRequest;
use App\Http\Resources\User\CountriesCollection;
use App\Http\Resources\User\CountriesResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

/*
 |--------------------------------------------------------------------------
 | Countries Controller
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

class CountriesAPIController extends Controller
{
    /**
     * list Countires
     * @param Request $request
     * @return CountriesCollection
     */

    public function index(Request $request)
    {
        $query = User::commonFunctionMethod(Country::class, $request);
        return new CountriesCollection(CountriesResource::collection($query), CountriesResource::class);
    }

    /**
     * Add Country
     * @param CountriesRequest $request
     * @return CountriesResource
     */

    public function store(CountriesRequest $request)
    {
        new CountriesResource(Country::create($request->all()));
        return response()->json(['success' => config('constants.messages.success')]);
    }

    /**
     * Country Detail
     * @param Country $country
     * @return CountriesResource
     */

    public function show(Country $country)
    {
        return new CountriesResource($country->load([]));
    }

    /**
     * Update Country
     * @param CountriesRequest $request
     * @param Country $country
     * @return CountriesResource
     */

    public function update(CountriesRequest $request, Country $country)
    {
        //
        $country->update($request->all());

        return new CountriesResource($country);
    }

    /**
     * Delete Country
     *
     * @param Request $request
     * @param Country $country
     * @return DataTrueResource
     * @throws \Exception
     */

    public function destroy(Request $request, Country $country)
    {
        $country->delete();
        return new DataTrueResource($country);
    }

    /**
     * Delete Country multiple
     * @param Request $request
     * @return DataTrueResource
     */

    public function deleteAll(Request $request)
    {
        return Country::deleteAll($request);
    }

    /**
     * Export Country Data
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */

    public function export(Request $request)
    {
        return Excel::download(new CountriesExport($request), 'country.csv');
    }

    /**
     * Import bulk
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function importBulk(Request $request)
    {
        return User::importBulk($request, new CountriesImport(), config('constants.models.country_model'), config('constants.import_dir_path.country_dir_path'));
    }
}
