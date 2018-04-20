<?php

use App\Tag;
use App\Tagcategory;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag_cat_subject = Tagcategory::where('name', 'Subject')->first();
        $tag_cat_questiontype = Tagcategory::where('name', 'Question type')->first();

    	$tag_php = new Tag();
    	$tag_php->name = 'php';
    	$tag_php->description = 'php related question';
    	$tag_php->save();
        $tag_cat_subject->tags()->save($tag_php);

    	$tag_js = new Tag();
    	$tag_js->name = 'js';
    	$tag_js->description = 'Javascript related question';
    	$tag_js->save();
        $tag_cat_subject->tags()->save($tag_js);

    	$tag_vue = new Tag();
    	$tag_vue->name = 'vue';
    	$tag_vue->description = 'Vue related question';
    	$tag_vue->save();
        $tag_cat_subject->tags()->save($tag_vue);

    	$tag_laravel = new Tag();
    	$tag_laravel->name = 'laravel';
    	$tag_laravel->description = 'Laravel related question';
    	$tag_laravel->save();
        $tag_cat_subject->tags()->save($tag_laravel);
    }
}
