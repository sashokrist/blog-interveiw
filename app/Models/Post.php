<?php

namespace App\Models;

use App\Traits\HasLikes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class Post extends Model implements Likeable
{
    use HasFactory, HasLikes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'picture',
        'description',
        'publish_date',
        'category_id',
        'user_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    /**
     * @param $request
     * @return mixed
     */
    public function uploadPicture($request)
    {
        $input = $request->all();
        if ($image = $request->file('picture')) {
            $imageName = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('images'), $imageName);
            $input['picture'] = $imageName;
        }
        return $input;
    }

    /**
     * @param $request
     * @return void
     */
    public function updatePost($request)
    {
        $input = $request->all();
        if ($image = $request->file('picture')) {
            $imageName = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('images'), $imageName);
            $input['picture'] = $imageName;
        } else {
            unset($input['picture']);
        }
        $this->update($input);
    }

    /**
     * @throws \JsonException
     */
    public static function redisFindOrFail($id)
    {
        if ($post = Redis::get('post:' . $id)) {
            Redis::expire('post:' . $id, 60 * 60 * 2);
            $post = json_decode($post, true, 512, JSON_THROW_ON_ERROR);
            return new Post($post);
        }

        $post = self::findOrFail($id);
        Redis::setex('post:' . $id, 60 * 60 * 2, json_encode($post, JSON_THROW_ON_ERROR));
        return $post;
    }

}
