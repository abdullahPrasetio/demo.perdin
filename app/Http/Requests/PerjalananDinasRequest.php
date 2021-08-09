<?php

namespace App\Http\Requests;

use Illuminate\Http\Request as BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class PerjalananDinasRequest extends BaseRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'user_id'=>'integer|required',
            'lokasi_berangkat'=>'integer|required',
            'lokasi_tujuan'=>'integer|required',
            'tanggal_berangkat'=>'date|required',
            'tanggal_pulang'=>'date|required',
            'tujuan_perdin'=>'string|required',
        ];
    }
}
