<?php

namespace App\Http\Requests;

use App\Models\Booking;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class BookingStoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required|date_format:d-m-Y|after:now',
            'persons' => 'required|numeric|min:1',
            'table_code' => 'required|numeric|min:1',
            'client_name' => 'required|string|max:64'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'date' => 'date',
            'persons' => 'number of persons',
            'table_code' => 'table code',
            'client_name' => 'customer name'
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $tableCode = request()->get('table_code');
            $table = Table::where('code', $tableCode)->first();

            if ($table === null) {
                $validator->errors()->add('table', "Table with code {$tableCode} does not exist");
                return;
            }

            $persons = request()->get('persons');

            if ($table->min_capacity > $persons) {
                $validator->errors()->add('persons', "The number of persons must be greater than or equal to {$table->min_capacity}");
                return;
            }

            if ($table->max_capacity < $persons) {
                $validator->errors()->add('persons', "The number of persons must be less than or equal to {$table->min_capacity}");
                return;
            }

            $requestDate = request()->get('date');
            $date = Carbon::createFromFormat('d-m-Y', $requestDate)->format('Y-m-d');

            $booking = Booking::where('date', $date)
                ->where('table_id', $table->id)
                ->first();

            if ($booking !== null) {
                $validator->errors()->add('busy', "The table {$tableCode} is not available for {$requestDate}");
                return;
            }
        });
    }
}
