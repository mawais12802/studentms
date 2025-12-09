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

class SchoolClassResource extends Resource
{
    protected static ?string $model = SchoolClass::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';
    protected static ?string $navigationGroup = 'School Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->required()
                ->unique(ignoreRecord: true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('id'),
            Tables\Columns\TextColumn::make('name'),
            Tables\Columns\TextColumn::make('students_count')
                ->counts('students')
                ->label('Total Students'),
            Tables\Columns\TextColumn::make('created_at')->date(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            SchoolClassResource\RelationManagers\StudentsRelationManager::class,
        ];
    }
}
