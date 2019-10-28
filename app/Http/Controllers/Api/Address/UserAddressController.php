<?php

namespace App\Http\Controllers\Api\Address;

use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\ModelFilters\UserAddressFilter;
use App\Http\Controllers\Controller;

/**
 * To manage the user address.
 */
class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request [Request data]
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $addresses = UserAddress::filter(
            $request->all(), UserAddressFilter::class
        )->with('addressProof', 'country', 'region', 'city');

        return $this->setData($addresses->lqPaginate())
            ->response();
    }

    /**
     * To validate the address input the client.
     *
     * @param \Illuminate\Http\Request $request [Request data]
     *
     * @return void|
     */
    private function _validate(Request $request)
    {
        $this->validate(
            $request,
            [
                'user_id' => 'required',
                'country' => 'required',
                'region' => 'nullable',
                'city' => 'required',
                'landmark' => 'required|max:255',
                'address_line_1' => 'max:255',
                'address_line_2' => 'max:255',
            ]
        );
    }

    /**
     * To get only address input from request.
     *
     * @param \Illuminate\Http\Request $request [Request data]
     *
     * @return @void|
     */
    private function _getOnlyAddressInput(Request $request)
    {
        $data = $request->only(
            [
                'user_id',
                'landmark',
                'postal_code',
                'address_line_1',
                'address_line_2',
            ]
        );

        $data['country_id'] = $request->country;
        $data['region_id'] = $request->region;
        $data['city_id'] = $request->city;
        $data['address_line_1'] = $data['address_line_1'] ? $data['address_line_1'] : '';
        $data['address_line_2'] = $data['address_line_2'] ? $data['address_line_2'] : '';

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request [Request data]
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->_validate($request);
        $address = UserAddress::create($this->_getOnlyAddressInput($request));
        $address->addressProof()->sync($request->address_proof);
        $this->setData(['address' => $address])
            ->response();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id [Address table primary key]
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $address = UserAddress::findOrFail($id)->load(['country', 'region', 'city', 'addressProof']);

        return $this->setData(['address' => $address])
            ->response();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request [Request data]
     * @param int                      $id      [Primary key]
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $address = UserAddress::findOrFail($id);
        $this->_validate($request);
        $address->update($this->_getOnlyAddressInput($request));
        $address->addressProof()->sync($request->address_proof);

        return $this->setData(['address' => $address])
            ->response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id [Address table primary key]
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = UserAddress::findOrFail($id);
        $address->delete();

        $this->setData(['address' => $address])
            ->response();
    }
}
