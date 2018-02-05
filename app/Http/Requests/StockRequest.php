<?php

namespace App\Http\Requests;

use App\Stock;
use Illuminate\Foundation\Http\FormRequest;
use Route;

class StockRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                {
                    return [
                        'product_id' => 'required|numeric',
                        'supplier_id' => 'required|numeric',
                        'initial_quantity' => 'required|numeric',
                        'serial_number' => 'unique:stocks',
                        'unit_price' => 'required|numeric',
                        'purchased_date' => 'required',
                        'remarks' => 'max:191',
                    ];
                }
            case 'PATCH':
                {
                    $stock_id = Route::current()->parameters['stock'];
                    $stock = Stock::findOrFail($stock_id);
                    return [
                        'product_id' => 'required|numeric',
                        'supplier_id' => 'required|numeric',
                        'initial_quantity' => 'required|numeric',
                        'serial_number' => 'unique:stocks,serial_number,' . $stock->id,
                        'unit_price' => 'required|numeric',
                        'purchased_date' => 'required',
                        'remarks' => 'max:191',
                    ];
                }
            default:break;
        }
    }
}
