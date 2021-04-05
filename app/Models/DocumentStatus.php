<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class DocumentStatus extends Model
{
    use HasFactory;

    const STATUS_PENDING = '1';

    protected $fillable = ['name', 'title'];

    public $timestamps  = false;

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    /**
     * @return Collection
     */
    public static function getStatusNames() :Collection
    {
        return collect([
            self::STATUS_PENDING => Str::snake('pending'),
        ]);
    }
}
