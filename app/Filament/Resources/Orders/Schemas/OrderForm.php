<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Enums\OrderStatus;
use App\Enums\OrderType;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Select::make('status')
                    ->options(OrderStatus::class)
                    ->required(),
                DateTimePicker::make('mutable_until'),
                TextInput::make('subtotal')
                    ->required()
                    ->numeric(),
                TextInput::make('total_discount')
                    ->required()
                    ->numeric(),
                TextInput::make('total')
                    ->required()
                    ->numeric(),
                TextInput::make('total_paid')
                    ->required()
                    ->numeric()
                    ->default(0),
                Select::make('type')
                    ->options(OrderType::class)
                    ->required(),
            ]);
    }
}
