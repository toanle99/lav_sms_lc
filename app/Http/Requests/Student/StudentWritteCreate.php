<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\Qs;

class StudentWritteCreate extends FormRequest
{

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
            // 'student_record_id' => 'required', 
            'date_at' => 'required|string', 
            'session_time' => 'required', 
            'reason' => 'required|string|min:6|max:150',
        ];
    } 
     
}
