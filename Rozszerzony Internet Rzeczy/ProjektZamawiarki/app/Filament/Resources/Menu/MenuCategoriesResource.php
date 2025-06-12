<?php

namespace App\Filament\Resources\Menu;

use App\Filament\Resources\Menu\MenuCategoriesResource\Pages;
use App\Filament\Resources\Menu\MenuCategoriesResource\RelationManagers;
use App\Models\Menu\MenuCategories;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MenuCategoriesResource extends Resource
{
    protected static ?string $model = MenuCategories::class;

    protected static ?string $navigationIcon = 'fas-layer-group';

    protected static ?string $navigationLabel = 'Kategorie menu';
    protected static ?string $pluralLabel = 'Kategorie menu';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('menuCategorySlug')
                    ->label('Skrót kategorii')
                    ->required()
                    ->unique(ignoreRecord: true),

                TextInput::make('menuCategoryName')
                    ->label('Nazwa kategorii')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('menuCategoryId')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('menuCategorySlug')
                    ->label('Skrót'),

                TextColumn::make('menuCategoryName')
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
            ->defaultSort('menuCategoryId', 'desc');
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
            'index' => Pages\ListMenuCategories::route('/'),
            'create' => Pages\CreateMenuCategories::route('/create'),
            'edit' => Pages\EditMenuCategories::route('/{record}/edit'),
        ];
    }
}
