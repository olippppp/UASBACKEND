<?php

namespace App\Rules;

use App\Models\Meja;
use Illuminate\Contracts\Validation\Rule;
use App\Models\User;

class UniqueKodeMejaForUpdate implements Rule
{
    protected $mejaId;

    public function __construct($mejaId)
    {
        $this->mejaId = $mejaId;
    }

    public function passes($attribute, $value)
    {
        // Check if the kode meja is unique except for the current meja
        return Meja::where('kode', $value)
                   ->where('id', '!=', $this->mejaId)
                   ->doesntExist();
    }

    public function message()
    {
        return 'Kode meja sudah dipakai.';
    }
}
