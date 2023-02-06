<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Image
 *
 * @property int $id
 * @property string $image_path
 * @property string $article_id
 * @property-read \App\Models\Article|null $article
 * @method static Builder|Image newModelQuery()
 * @method static Builder|Image newQuery()
 * @method static Builder|Image query()
 * @method static Builder|Image whereArticleId($value)
 * @method static Builder|Image whereId($value)
 * @method static Builder|Image whereImagePath($value)
 * @mixin \Eloquent
 */
class Image extends Model
{
    use HasFactory;

    public $table = 'images';
    public $timestamps = false;

    protected $guarded = [];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
