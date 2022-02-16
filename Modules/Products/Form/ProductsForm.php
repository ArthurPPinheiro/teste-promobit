<?php namespace Modules\Products\Form;

use Kris\LaravelFormBuilder\Form;
use Modules\Tags\Entities\Tag;

class ProductsForm extends Form
{
    public function buildForm()
    {
        $tagsList = Tag::all();
        $selectedTags  = null;

        $tags = array();
        foreach ($tagsList as $tag) {
            $tags[$tag->id] = $tag->name;
        }

        if($this->model){
            if($this->model->tags){
                foreach ($this->model->tags as $tag) {
                    $selectedTags[] = $tag->id;
                }
            }
        }

        $this
            ->add('name', 'text', ['label' => 'Name', 'maxlength' => 50, 'required' => true])
            ->add('tags', 'choice', [
                'choices' => $tags,
                'selected' => $selectedTags,
                'multiple' => true,
                'expanded' => true
            ]);
    }
}
