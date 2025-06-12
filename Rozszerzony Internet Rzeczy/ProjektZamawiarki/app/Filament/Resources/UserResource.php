<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Components\{TextInput, DateTimePicker, PasswordInput};
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\DateTimeColumn;
use App\Filament\Resources\UserResource\Pages\{CreateUser, EditUser, ListUsers};

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Users';
    protected static ?string $pluralLabel = 'Users';
    protected static ?string $slug = 'users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->required()
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                PasswordInput::make('password')
                    ->required()
                    ->hiddenOn('edit'),

                DateTimePicker::make('email_verified_at')
                    ->label('Email Verified At')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable(),
                TextColumn::make('email_verified_at')->formatStateUsing( 
                    fn ($state) => $state ? $state->format('Y-m-d H:i:s') : 'Not Verified'
                )->sortable(),
                TextColumn::make('created_at')->formatStateUsing(
                    fn ($state) => $state->format('Y-m-d H:i:s')
                )->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
