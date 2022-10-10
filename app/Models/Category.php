<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
    ];

    /**
     * @return HasMany
     */
    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }

    /**
     * @return string[]
     */
    public static function rules(): array
    {
        $categoryTableName = (new Category())->getTable();
        return [
            'title' => "required|min:5||unique:{$categoryTableName},title",
        ];
    }

    /**
     * @return string[]
     */
    public static function attributesName(): array
    {
        return [
            'title' => '"Название категории"',
        ];
    }
}
