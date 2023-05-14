<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    public function rules()
    {
        return [
            'mark' => 'nullable|integer|min:60|max:100',
        ];
    }
}
