<?php

namespace App\Http\Requests\Tickets;

use App\Enums\TicketStatus;
use App\Enums\TicketPriority;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $this->checkStatus();

        return [
            'title' => 'required|string|min:5|max:255',
            'description' => 'required|string|min:10|max:1000',
            'priority' => ['required', Rule::in(TicketPriority::toSelectArray())],
            'status' => ['required', Rule::in(TicketStatus::toSelectArray())],
        ];
    }

    protected function checkStatus(): void
    {
        if ($this->status == 'open') {
            $this->merge(['priority' => 'medium']);
        }
    }
}
