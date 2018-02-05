<?php

namespace App\Http\Requests;

use App\Supplier;
use Illuminate\Foundation\Http\FormRequest;
use Route;

class SupplierRequest extends FormRequest
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
                        'name' => 'required|max:191|unique:suppliers',
                    ];
                }
            case 'PATCH':
                {
                    $supplier_id = Route::current()->parameters['supplier'];
                    $supplier = Supplier::findOrFail($supplier_id);
                    return [
                        'name' => 'required|max:191|unique:suppliers,name,' . $supplier->id,
                    ];
                }
            default:break;
        }
    }
}
