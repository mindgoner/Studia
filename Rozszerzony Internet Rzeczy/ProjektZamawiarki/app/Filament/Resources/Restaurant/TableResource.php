<?php

namespace App\Filament\Resources\Restaurant;

use App\Filament\Resources\Restaurant\TableResource\Pages;
use App\Filament\Resources\Restaurant\TableResource\RelationManagers;
use App\Models\Restaurant\Table as ZTable;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TableResource extends Resource
{
    protected static ?string $model = ZTable::class;

    protected static ?string $navigationIcon = 'fas-chair';

    protected static ?string $navigationLabel = 'Stoły';
    protected static ?string $pluralLabel = 'Stoły';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('tableSlug')
                    ->label('Unikalny skrót stołu')
                    ->required()
                    ->unique(ignoreRecord: true),

                TextInput::make('tableName')
                    ->label('Nazwa stołu')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tableId')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('tableSlug')
                    ->label('Skrót'),

                TextColumn::make('tableName')
                    ->label('Nazwa'),

                TextColumn::make('created_at')
                    ->label('Utworzono')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('tableId', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTables::route('/'),
            'create' => Pages\CreateTable::route('/create'),
            'edit' => Pages\EditTable::route('/{record}/edit'),
        ];
    }
}
