<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory, HasUuids;

    protected $table = "kategori";

    protected $guarded = [''];

    public $primaryKey = "id";

    protected $keyType = "string";

    public $autoIncrement = false;
}
