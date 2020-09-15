<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SortTickets extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sort-by' => 'sometimes|in:created_at,due_date',
            'order-by' => 'sometimes|in:asc,desc',
            'per-page' => 'sometimes|in:6,12,18'
        ];
    }
}
