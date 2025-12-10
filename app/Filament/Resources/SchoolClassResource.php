<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolClassResource\Pages;
use App\Filament\Resources\SchoolClassResource\RelationManagers;
use App\Models\SchoolClass;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;


class SchoolClassResource extends Resource
{
    protected static ?string $model = SchoolClass::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Class Details')
                ->schema([
                    // 🌟 ADD FIELD FOR CLASS NAME 🌟
                    TextInput::make('name')
                        ->label('Class Name')
                        ->required()
                        ->maxLength(255),

                    // 🌟 ADD FIELD FOR CAPACITY (optional, but good practice) 🌟
                    TextInput::make('capacity')
                        ->numeric()
                        ->label('Max Capacity')
                        ->default(30)
                        ->minValue(1),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('Class ID'),
                Tables\Columns\TextColumn::make('name')->label('Class Name'),
                Tables\Columns\TextColumn::make('students_count')
                ->counts('students')
                ->label('Total Students'),
                Tables\Columns\TextColumn::make('created_at')->date(),
                Tables\Columns\TextColumn::make('students_count')
                ->label('Total Students')
                ->getStateUsing(function ($record) {
                return $record->students()->where('user_id', auth()->id())->count();
                })

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListSchoolClasses::route('/'),
            'create' => Pages\CreateSchoolClass::route('/create'),
            'view' => Pages\ViewSchoolClass::route('/{record}'),
            'edit' => Pages\EditSchoolClass::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }

}
