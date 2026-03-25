<?php

namespace App\Filament\Resources\Estoques;

use App\Filament\Resources\Estoques\Pages\CreateEstoque;
use App\Filament\Resources\Estoques\Pages\EditEstoque;
use App\Filament\Resources\Estoques\Pages\ListEstoques;
use App\Filament\Resources\Estoques\Pages\ViewEstoque;
use App\Filament\Resources\Estoques\Schemas\EstoqueForm;
use App\Filament\Resources\Estoques\Schemas\EstoqueInfolist;
use App\Filament\Resources\Estoques\Tables\EstoquesTable;
use App\Models\Estoque;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;

class EstoqueResource extends Resource
{
    protected static ?string $model = Estoque::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Estoques';

    public static function form(Schema $schema): Schema
    {
        // return EstoqueForm::configure($schema);return $schema
        return $schema
                ->schema([
                    Select::make('produto_id')
                        ->relationship('produto', 'nome') // Assume que o model Produto tem a coluna 'nome'
                        ->required()
                        ->searchable()
                        ->preload(),

                    TextInput::make('quantidade')
                        ->numeric()
                        ->default(0)
                        ->required()
                        ->label('Quantidade em Estoque'),

                    TextInput::make('localizacao')
                        ->label('Localização / Prateleira')
                        ->placeholder('Ex: Corredor A, Prateleira 2')
                        ->maxLength(255),
                ])->columns(2);
       
}

    public static function infolist(Schema $schema): Schema
    {
        return EstoqueInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        // return EstoquesTable::configure($table);
    return $table
        ->columns([
            TextColumn::make('produto.nome')
                ->label('Produto')
                ->sortable()
                ->searchable(),

            TextColumn::make('quantidade')
                ->label('Qtd. Disponível')
                ->sortable()
                ->badge()
                ->color(fn (int $state): string => match (true) {
                    $state <= 5 => 'danger',
                    $state <= 20 => 'warning',
                    default => 'success',
                }),

            TextColumn::make('localizacao')
                ->label('Localização')
                ->placeholder('Não definida')
                ->searchable(),

            TextColumn::make('updated_at')
                ->label('Última Atualização')
                ->dateTime('d/m/Y H:i')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])->recordActions([
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
            'index' => ListEstoques::route('/'),
            'create' => CreateEstoque::route('/create'),
            'view' => ViewEstoque::route('/{record}'),
            'edit' => EditEstoque::route('/{record}/edit'),
        ];
    }
}
