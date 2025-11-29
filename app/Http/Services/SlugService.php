<?php

namespace App\Http\Services;
use Cocur\Slugify\Slugify;

class SlugService
{
    private $slugify;
    public $table;
    public $model;

    public function __construct($model) {
        $this->slugify = new Slugify();
        $modelName = $model; 
        $fullModelName = "App\\Models\\" . $modelName;
        $this->model = new $fullModelName();
    }
    public function generateUniqueSlug($text, $excludeId = null) {
        $slug = $this->slugify->slugify($text);
        $originalSlug = $slug;
        $counter = 1;
        
        while ($this->model->isSlugExists($slug, $excludeId)) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        return $slug;
    }
}