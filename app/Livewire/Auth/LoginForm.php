<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\Auth\LoginForm as AuthLoginForm;
use Livewire\Component;

class LoginForm extends Component
{
    public AuthLoginForm $form;

    public function render()    
    {
        return view('livewire.auth.login-form');
    }
}
