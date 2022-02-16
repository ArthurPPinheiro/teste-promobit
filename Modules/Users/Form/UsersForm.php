<?php namespace Modules\Users\Form;

use Kris\LaravelFormBuilder\Form;

class UsersForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', ['label' => 'Name'])
            ->add('email', 'text', ['label' => 'Email']);

        if($this->model->id){
            $this
                ->add('old_password', 'password',  ['label' => 'Old Password'])
                ->add('new_password', 'password',  ['label' => 'New Password'])
                ->add('password_confirmation', 'password',  ['label' => 'New Password Confirmation']);

        }else{
            $this
                ->add('password', 'password',  ['label' => 'Password'])
                ->add('password_confirmation', 'password',  ['label' => 'Password Confirmation']);
        }

    }
}
