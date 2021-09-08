<?php
  
  namespace App\Http\Requests;
  
  use Illuminate\Foundation\Http\FormRequest;
  
  class UpdateContact extends FormRequest
  {
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      return [
        'first_name' => 'sometimes|string',
        'last_name' => 'sometimes|string',
        'phone' => 'sometimes|string',
        'lead_source' => 'sometimes|string'
      ];
    }
  }
