<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupingKategoriBahan extends Model
{
    use HasFactory, HasUuids;

    protected $table = "grouping_kategori_bahan";

    protected $guarded = [''];

    protected $keyType = "string";

    public $primaryKey = "id";

    public $timestamps = false;

    public function getKategori()
    {
        return $this->belongsTo(KategoriBahan::class, 'kategoriBahanId');
    }
    public function getBahan()
    {
        return $this->belongsTo(Bahan::class, 'bahanId');
    }
}
