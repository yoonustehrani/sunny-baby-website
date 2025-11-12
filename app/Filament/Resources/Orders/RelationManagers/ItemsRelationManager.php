<?php

namespace App\Filament\Resources\Orders\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('product.title')->label('Product')->translateLabel()
                    ->getStateUsing(fn(Model $record) => $record->product->parent_id ? $record->product->parent->title . ' | ' . $record->product->variant_title: $record->product->title),
                TextColumn::make('unit_price')
                    ->translateLabel()
                    ->sortable()
                    ->getStateUsing(fn(Model $record) => format_price($record->unit_price)),
                TextColumn::make('unit_discount')->label('تحفیف واحد')
                    ->sortable()
                    ->getStateUsing(fn(Model $record) => format_price($record->unit_discount)),
                TextColumn::make('quantity')->translateLabel()->sortable(),
                TextColumn::make('total')->translateLabel()
                    ->getStateUsing(fn(Model $record) => format_price($record->total)),
                TextColumn::make('created_at')->translateLabel()
            ])
            // ->filters([
            //     //
            // ])
            // ->headerActions([
            //     CreateAction::make(),
            //     AssociateAction::make(),
            // ])
            // ->recordActions([
            //     EditAction::make(),
            //     DissociateAction::make(),
            //     DeleteAction::make(),
            // ])
            // ->toolbarActions([
            //     BulkActionGroup::make([
            //         DissociateBulkAction::make(),
            //         DeleteBulkAction::make(),
            //     ]),
            // ])
            ->paginated(false);
    }
}
