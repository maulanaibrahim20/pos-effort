<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupingSatuanBahan extends Model
{
    use HasFactory, HasUuids;

    protected $table = "grouping_satuan_bahan";

    protected $guarded = [''];

    protected $keyType = "string";

    public $primaryKey = "id";

    public $timestamps = false;

    public function getSatuanBahan()
    {
        return $this->belongsTo(SatuanBahan::class, 'satuanBahanId');
    }

    public function getBahan()
    {
        return $this->belongsTo(Bahan::class, 'bahanId');
    }
}
