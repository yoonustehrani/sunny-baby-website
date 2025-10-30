<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
               TextColumn::make('user.phone_number')
                    ->translateLabel(),
                TextColumn::make('status')
                    ->translateLabel()
                    ->badge()
                    ->searchable(),
                CheckboxColumn::make('mutable_until')
                    ->label('سبد خرید')
                    ->disabled()
                    ->getStateUsing(fn(Model $record) => ! is_null($record->mutable_until)),
                TextColumn::make('subtotal')
                    ->translateLabel()
                    ->getStateUsing(fn(Model $record) => format_price($record->subtotal))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('total_discount')
                    ->label('Total Discount')
                    ->translateLabel()
                    ->getStateUsing(fn(Model $record) => format_price($record->total_discount))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('total')
                    ->translateLabel()
                    ->getStateUsing(fn(Model $record) => format_price($record->total))
                    ->sortable(),
                TextColumn::make('total_paid')
                    ->label('Total Paid')
                    ->translateLabel()
                    ->getStateUsing(fn(Model $record) => format_price($record->total_paid))
                    ->sortable(),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('type')
                    ->label('توسط')
                    ->translateLabel()
                    ->badge()
                    ->searchable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                // EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
