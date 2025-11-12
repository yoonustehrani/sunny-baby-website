<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Enums\UserRoleType;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->translateLabel(),
                TextInput::make('phone_number')
                    ->label(__('Phone Number'))
                    ->tel()
                    ->required(),
                // DateTimePicker::make('phone_number_verified_at'),
                TextInput::make('email')
                    ->label('Email')
                    ->translateLabel()
                    ->email(),
                // DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->translateLabel()
                    ->password(),
                TextInput::make('credit')
                    ->translateLabel()
                    ->required()
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    // ->numeric()
                    ->default(0),
                Select::make('role_type')
                    ->translateLabel()
                    ->options(UserRoleType::class)
                    ->default('CU')
                    ->required(),
            ]);
    }
}
