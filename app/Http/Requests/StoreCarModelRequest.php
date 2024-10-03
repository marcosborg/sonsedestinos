<?php

namespace App\Http\Requests;

use App\Models\CarModel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCarModelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('car_model_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'brand_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
