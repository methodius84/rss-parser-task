<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\LogMessage
 *
 * @property int $id
 * @property string $timestamp
 * @property string $method Request Method
 * @property string $url request url
 * @property int $response_code response code
 * @property mixed|null $response_body response body
 * @property int $request_time request time in ms
 * @method static \Illuminate\Database\Eloquent\Builder|LogMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LogMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LogMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|LogMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogMessage whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogMessage whereRequestTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogMessage whereResponseBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogMessage whereResponseCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogMessage whereTimestamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogMessage whereUrl($value)
 * @mixin \Eloquent
 */
class LogMessage extends Model
{
    use HasFactory;
    public $table = 'logs';
    public $timestamps = false;

    protected $guarded = [];
}
