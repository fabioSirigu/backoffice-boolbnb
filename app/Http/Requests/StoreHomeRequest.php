<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHomeRequest extends FormRequest
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
            'title' => 'required|unique:homes,title',
            'slug' => 'max:255',
            'rooms' => 'required|min:1',
            'beds' => 'required|max:1|max:25',
            'bathrooms' => 'required|max:1|max:255',
            'square_meters' => 'required|min:1',
            'address' => 'required|min:5|max:255',
            'latitude' => 'required|min:1|max:100',
            'longitude' => 'required|min:1|max:100',
            'cover_image' => 'required|image',
            'visible' => 'required'
        ];
    }
}
