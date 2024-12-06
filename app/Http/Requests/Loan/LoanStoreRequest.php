<?php

namespace App\Http\Requests\Loan;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoanStoreRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'book_id' => 'required|integer|exists:books,id',
            'end_at' => [
                'required',
                'date',
                function (string $attribute, ?string $value, Closure $fail): void {
                    $borrowDate = Carbon::now();
                    $returnDate = Carbon::parse($value);
                    if ($returnDate->lte($borrowDate)) {
                        $fail('Ngày trả phải là một ngày trong tương lai, sau ngày mượn.');
                    }
                }
            ],
        ];
    }

    /**
     * Get the validation error messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'user_id.required' => 'Vui lòng chọn người mượn.',
            'user_id.exists' => 'Người dùng này không tồn tại trong hệ thống.',
            'book_id.required' => 'Vui lòng chọn sách.',
            'book_id.exists' => 'Sách này không tồn tại trong hệ thống.',
            'end_at.required' => 'Vui lòng chọn ngày trả.',
            'end_at.date' => 'Ngày trả phải là một định dạng ngày hợp lệ.',
        ];
    }
}
