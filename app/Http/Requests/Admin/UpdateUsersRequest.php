<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsersRequest extends FormRequest
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
            'email' => 'required|email',
            'name' => 'required|string',
            'roles' => 'required',
            'password' => 'required|min:6|confirmed',
            'avatar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
    }
}
