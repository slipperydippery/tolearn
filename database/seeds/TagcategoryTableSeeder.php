<?php

use App\Tagcategory;
use Illuminate\Database\Seeder;

class TagcategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag_cat_subject = new Tagcategory();
        $tag_cat_subject->name = 'Subject';
        $tag_cat_subject->description = 'Subject matter tags';
        $tag_cat_subject->save();

        $tag_cat_questiontype = new Tagcategory();
        $tag_cat_questiontype->name = 'Question type';
        $tag_cat_questiontype->description = 'What type of question is it?';
        $tag_cat_questiontype->save();
    }
}
