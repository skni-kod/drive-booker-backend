<?php

namespace App\Http\Requests;

use App\ValueObjects\CreateNewCourse;
use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'start_date' => 'required|date',
            'id_school' => 'required|integer|exists:schools,id'
        ];
    }

    public function getCourse(): CreateNewCourse
    {
        return new CreateNewCourse(
            $this->get('start_date'),
            $this->get('id_school')
        );
    }
}
