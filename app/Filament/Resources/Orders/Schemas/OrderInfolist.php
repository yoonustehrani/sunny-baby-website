<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Order;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('سفارش')
                    ->translateLabel()
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
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
                    ]),
                // Section::make('جزئیات سفارش')
                //     ->columnSpanFull()
                //     ->schema([
                //         RepeatableEntry::make('items')
                //             ->label('Order items')
                //             ->translateLabel()
                //             ->schema([
                //                 TextEntry::make('product.title')->label('Product'),
                //                 TextEntry::make('unit_price')
                //                     ->translateLabel()
                //                     ->getStateUsing(fn(Model $record) => format_price($record->unit_price)),
                //                 TextEntry::make('quantity')->translateLabel(),
                //             ])
                //             ->columns(3),
                //     ]),
            ]);
    }
}
