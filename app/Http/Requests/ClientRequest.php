<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
        if(request()->isMethod('post')){
            $emailRule = ['required','email','unique:users'];
        }else if(request()->isMethod('put')){
            $emailRule = 'required';
        }
        return [
            'name' => 'required',
            'email' => [$emailRule],
            'phone' => 'required|size:10',
            'password' => 'required',
            'adress' => 'required'
        ];
    }
}
