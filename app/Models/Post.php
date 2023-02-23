<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'picture',
        'description',
        'publish_date',
        'category_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
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

}
