<?php

namespace App\Http\Requests\UserManagement\Menu;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;

class UpdateRequest extends FormRequest
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
        return [
            'menu_name' => ['required', Rule::unique('menus', 'menu_name')->ignore($this->id, 'id')],
            'route' => ['required', Rule::unique('menus', 'route')
                ->where(
                    function (Builder $query) {
                        $query->where('id', '<>', $this->id)
                            ->where('route', '<>', '#');
                    }
                )],
            'parent_menu_id' => ['nullable', 'integer', Rule::exists('menus', 'id')],
        ];
    }
}
