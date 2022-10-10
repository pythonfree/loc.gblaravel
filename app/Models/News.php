<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
        'is_private',
        'category_id',
        'image'
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return string[]
     */
    public static function rules(): array
    {
        $categoryTableName  = (new Category())->getTable();
        return [
            'title' => 'required|min:5',
            'text' => 'required|min:5',
            'category_id' => "required|exists:{$categoryTableName},id",
            'is_private' => 'in:0,1',
            'image' => 'image|max:1000',
        ];
    }

    /**
     * @return string[]
     */
    public static function attributesName(): array
    {
        return [
            'title' => '"Заголовок новости"',
            'text' => '"Текст новости"',
            'category_id' => '"ID Категории"',
            'image' => '"Изображение"',
        ];
    }
}
