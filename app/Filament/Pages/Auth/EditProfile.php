<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Schema;

class EditProfile extends \Filament\Auth\Pages\EditProfile
{

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getFirstnameFormComponent(),
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                $this->getCurrentPasswordFormComponent(),
            ]);
    }

    protected function getFirstnameFormComponent(): Component
    {
        return TextInput::make('firstname')
            ->label(__('filament-panels::auth/pages/edit-profile.form.firstname.label'))
            ->required()
            ->maxLength(255)
            ->autofocus();
    }
}
