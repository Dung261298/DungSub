<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlideRequest extends FormRequest
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
            'link' => 'required',
            'url_img' => 'required',
            'display_order' => 'required|numeric|',
        ];
    }
    public function messages()
    {
        return [
           'link.required' => 'Please Enter Information.',
            'url_img.required' => 'Please Enter Information.',
            'display_order.required' => 'Please Enter Information.',
            'display_order.numeric' => 'Enter only numbers.'
        ];
    }
}