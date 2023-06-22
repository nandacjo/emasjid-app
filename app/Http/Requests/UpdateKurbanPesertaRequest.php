<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateKurbanPesertaRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function rules(): array
  {
    return [
      'kurban_id' => [
        'required',
        Rule::exists('kurbans', 'id')->where('masjid_id', auth()->user()->masjid_id),
      ],
      'total_bayar' => 'nullable',
      'tanggal_bayar' => 'nullable',

    ];
  }

  protected function prepareForValidation()
  {
    if ($this->total_bayar != null) {
      $this->merge([
        'total_bayar' => str_replace('.', '', $this->total_bayar)
      ]);
    }
  }
}
