<?php

namespace App\Http\Requests;


use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * GetS the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=> ['required', 'string',  'max:200'],
            'email'=> ['required','string',  'max:200', ],
            'password'=> ['required', 'confirmed'],
        ];
    }
}
