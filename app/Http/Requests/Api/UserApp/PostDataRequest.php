<?php

namespace App\Http\Requests\Api\UserApp;

use Illuminate\Foundation\Http\FormRequest;

class PostDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
//        return auth('api')->check();
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'files' => 'required|array|min:1|max:5'
        ];
    }
    public function messages(): array
    {
        return [
            'files.required' => 'The Files Data is Required',
            'files.array' => 'Invalid Data Type',
            'files.min' => 'The Minimum Number of Files is 1 File',
            'files.max' => 'The Maximum Number of Files is 5 Files'
        ];
    }
}
