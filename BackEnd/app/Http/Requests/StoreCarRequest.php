<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required',
            'price' =>  'required',
            'currentFipePrice' => 'max:30',
            'image' => 'nullable',
            'carFuel' => 'required',
            'hasAirBag' =>  'required',
            'hasInsurance' => 'required',
            'licensePlate' =>  'required'
        ];
    }
}
