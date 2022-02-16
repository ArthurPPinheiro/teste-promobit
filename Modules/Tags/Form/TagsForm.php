<?php namespace Modules\Tags\Form;

use Kris\LaravelFormBuilder\Form;

class TagsForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', ['label' => 'Name', 'maxlength' => 50, 'required' => true]);
    }
}
