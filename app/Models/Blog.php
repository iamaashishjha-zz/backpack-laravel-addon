<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use Spatie\Translatable\HasTranslations;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class Blog extends Model
{
    use CrudTrait;


    // public $translatable = ['name'];

    use HasFactory;

    use HasSlug;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'blogs';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    // public function sluggable()
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'slug_or_title',
    //         ],
    //     ];
    // }

    // // The slug is created automatically from the "name" field if no slug exists.
    // public function getSlugOrTitleAttribute()
    // {
    //     if ($this->slug != '') {
    //         return $this->slug;
    //     }

    //     return $this->slug;

    //     // return Str::slug($this->slug, '-');
    // }

    // public static function boot()
    // {
    //     parent::boot();
    //     static::deleted(function ($obj) {
    //         Storage::disk('public_folder')->delete($obj->image);
    //     });
    // }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    // public function getSlugWithLink()
    // {
    //     return '<a href="' . url($this->slug) . '" target="_blank">' . $this->slug . '</a>';
    // }

    public function getSlugWithLink()
    {
        return '<a href="' . $this->slug . '">' . $this->slug . '</a>';
    }

    // public function getSlugWithLink()
    // {
    //     return $this->slug;
    // }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function blogCategory()
    {
        # code...
        return $this->belongsTo(BlogCategory::class);
    }

    public function blogTags()
    {
        # code...
        return $this->belongsToMany(BlogTag::class);
        // return $this->morphToMany(BlogTag::class, 'taggable');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */



    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setImageAttribute($value)
    {
        $attribute_name = "image";
        // or use your own disk, defined in config/filesystems.php
        $disk = config('backpack.base.root_disk_name');
        // destination path relative to the disk above
        $destination_path = "public/images/blogs";
        // if the image was erased
        if ($value == null) {
            // delete the image from disk
            Storage::disk($disk)->delete($this->{$attribute_name});
            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }
        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image')) {
            // 0. Make the image
            $image = Image::make($value)->encode('jpg', 90);
            // 1. Generate a filename.
            $filename = md5($value . time()) . '.jpg';
            // 2. Store the image on disk.
            Storage::disk($disk)->put($destination_path . '/' . $filename, $image->stream());
            // 3. Delete the previous image, if there was one.
            Storage::disk($disk)->delete($this->{$attribute_name});
            // 4. Save the public path to the database
            // but first, remove "public/" from the path, since we're pointing to it
            // from the root folder; that way, what gets saved in the db
            // is the public URL (everything that comes after the domain name)
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name] = $public_destination_path . '/' . $filename;
        }
    }

    public function setSlugAttribute($value)
    {
        // $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value, '-');
    }
}
