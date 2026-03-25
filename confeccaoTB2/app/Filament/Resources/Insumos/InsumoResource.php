<?php

namespace App\Filament\Resources\Insumos;

use App\Filament\Resources\Insumos\Pages\CreateInsumo;
use App\Filament\Resources\Insumos\Pages\EditInsumo;
use App\Filament\Resources\Insumos\Pages\ListInsumos;
use App\Filament\Resources\Insumos\Pages\ViewInsumo;
use App\Filament\Resources\Insumos\Schemas\InsumoForm;
use App\Filament\Resources\Insumos\Schemas\InsumoInfolist;
use App\Filament\Resources\Insumos\Tables\InsumosTable;
use App\Models\Insumo;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;

class InsumoResource extends Resource
{
    protected static ?string $model = Insumo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Insumo';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('nome')
                ->required()
                ->label('Nome do Insumo'),
            
            Select::make('unidade_medida')
                ->options([
                    'kg' => 'Quilograma',
                    'un' => 'Unidade',
                    'l' => 'Litro',
                    'm' => 'Metro',
                ])
                ->required()
                ->label('Unidade de Medida'),

            TextInput::make('preco_custo')
                ->numeric()
                ->prefix('R$')
                ->label('Preço de Custo'),

            TextInput::make('estoque')
                ->numeric()
                ->label('Estoque Mínimo'),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return InsumoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('nome')->searchable()->sortable(),
            TextColumn::make('unidade_medida')->label('U.M.'),
            TextColumn::make('preco_custo')
                ->money('BRL')
                ->label('Custo'),
            TextColumn::make('estoque') 
                ->label('Estoque')
                ->badge()
                ->color(fn ($state, $record) => $state <= $record->estoque_minimo ? 'danger' : 'success'),
        ]) ->recordActions([
                ViewAction::make(),
                EditAction::make(),
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
            'index' => ListInsumos::route('/'),
            'create' => CreateInsumo::route('/create'),
            'view' => ViewInsumo::route('/{record}'),
            'edit' => EditInsumo::route('/{record}/edit'),
        ];
    }
}
