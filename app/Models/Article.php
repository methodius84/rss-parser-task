<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Article
 *
 * @property string $guid GUID из RSS rbc.ru
 * @property string $title Название статьи
 * @property string $text Краткое описание
 * @property string $publish_date Дата и время публикации
 * @property string|null $author Автор статьи
 * @property string|null $picture ссылка/путь на изображение
 * @method static \Illuminate\Database\Eloquent\Builder|Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereGuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article wherePublishDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereTitle($value)
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Image> $images
 * @property-read int|null $images_count
 * @mixin \Eloquent
 */
class Article extends Model
{
    use HasFactory;

    public $table = 'articles';
    protected $primaryKey = 'guid';

    protected $keyType = 'string';

    public $timestamps = false;
    public $guarded = [];

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
}
