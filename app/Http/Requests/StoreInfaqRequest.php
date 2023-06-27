<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInfaqRequest extends FormRequest
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
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
   */
  public function rules(): array
  {
    return [
      'sumber' => 'required',
      'atas_nama' => 'nullable',
      'satuan' => 'required',
      'jenis' => 'required',
      'jumlah' => 'required|numeric',
    ];
  }

  public function prepareForValidation(): void
  {
    $this->merge([
      'jumlah' => str_replace('.', '', $this->jumlah),
    ]);
  }
}
