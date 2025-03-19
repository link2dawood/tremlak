<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table   = 'currency';
    public $timestamps = false;
    protected $guarded = [];
    protected $appends = ['org_symbol'];


    public static function code_to_symbol($code)
    {
        return self::getAll()->firstWhere('code', $code)->symbol;
    }

    public function getOrgSymbolAttribute()
    {
        $symbol = $this->attributes['symbol'];
        return $symbol;
    }
}
