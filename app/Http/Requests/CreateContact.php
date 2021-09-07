<?php
    
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateContact extends FormRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstName' => 'sometimes|string',
            'email' => 'sometimes|email|unique:mysql.contact',
            'phone' => 'sometimes|string',
            'leadSource' => 'sometimes|string',
            'salesforce_external_id' => 'sometimes|string'
        ];
    }
}
