<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Enums\OrderStatus;
use App\Enums\OrderType;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Enums\FiltersLayout;
use Illuminate\Database\Eloquent\Collection;


class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->rowIndex() // <-- built-in Filament helper
                    ->label('#')
                    ->getStateUsing(fn ($record, $rowLoop) => $rowLoop->iteration),
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
                SelectFilter::make('status')->translateLabel()->options(OrderStatus::class),
                SelectFilter::make('type')->label('توسط')->options(OrderType::class),
                TrashedFilter::make()
            ], layout: FiltersLayout::AboveContent)
            ->recordActions([
                ViewAction::make(),
                Action::make('Invoice')->translateLabel()
                    ->url(fn(Model $record) => route('label.single', ['order' => $record->getKey()]))
                    ->button()
                    ->openUrlInNewTab()
                    ->hidden(fn(Model $record) => !in_array($record->status, [OrderStatus::PACKAGED, OrderStatus::PROCESSING]))
                // EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
                BulkAction::make('Group Invoice')->label('پرینت گروهی فاکتور')
                    ->action(fn (Collection $records, \Livewire\Component $livewire) => $livewire->redirect(
                        route('label.bulk', ['orders' => implode(
                            ',', $records->map(fn($r) => $r->getKey())->toArray()
                        )])
                    ))
                    // ->requiresConfirmation()
                    // ->action(fn (Collection $records) => $records->each->forceDelete()),
            ]);
    }
}
