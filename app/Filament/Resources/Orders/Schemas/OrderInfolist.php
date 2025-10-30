<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Order;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.phone_number')
                    ->label('Phone Number')
                    ->translateLabel(),
                    // ->numeric(),
                TextEntry::make('status')
                    ->translateLabel()
                    ->badge(),
                TextEntry::make('mutable_until')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('subtotal')
                    ->translateLabel()
                    ->numeric(),
                TextEntry::make('total_discount')
                    ->label('Total Discount')
                    ->translateLabel()
                    ->numeric(),
                TextEntry::make('total')
                    ->translateLabel()
                    ->numeric(),
                TextEntry::make('total_paid')
                    ->label('Total Paid')
                    ->translateLabel()
                    ->numeric(),
                TextEntry::make('deleted_at')
                    ->translateLabel()
                    ->dateTime()
                    ->visible(fn (Order $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->translateLabel()
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->translateLabel()
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('type')
                    ->label('توسط')
                    ->badge(),
            ]);
    }
}
