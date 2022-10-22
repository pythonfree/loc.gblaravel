<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resources extends Model
{
    use HasFactory;

    const TABLE_NAME = 'resources';

    protected $fillable = [
        'link',
    ];

    /**
     * @return string[]
     */
    public static function rules(): array
    {
        $resourcesTableName = (new Resources())->getTable();
        return [
            'link' => "required|min:5||unique:{$resourcesTableName},link",
        ];
    }

    /**
     * @return string[]
     */
    public static function attributesName(): array
    {
        return [
            'link' => '"Ссылка на RSS"',
        ];
    }

}
