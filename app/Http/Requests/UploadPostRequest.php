<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Upload Files Request Middleware
 */
final class UploadPostRequest extends FormRequest
{
    /**
     * Just some basic file validation.
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        // since the file ext is txt and the contents are json, let's accept both of them and revalidate them later on
        return [
            'file' => 'required|mimes:json|max:2048'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'file' => 'The given data was invalid.',
        ];
    }
}
