<?php

namespace App\Filament\Resources\Produtos;

use App\Filament\Resources\Produtos\Pages\CreateProduto;
use App\Filament\Resources\Produtos\Pages\EditProduto;
use App\Filament\Resources\Produtos\Pages\ListProdutos;
use App\Filament\Resources\Produtos\Pages\ViewProduto;
use App\Filament\Resources\Produtos\Schemas\ProdutoForm;
use App\Filament\Resources\Produtos\Schemas\ProdutoInfolist;
use App\Filament\Resources\Produtos\Tables\ProdutosTable;
use App\Models\Produto;
use BackedEnum;
use UnitEnum;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;



class ProdutoResource extends Resource
{
    protected static ?string $model = Produto::class;

     protected static ?int $navigationSort = 3;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|UnitEnum|null $navigationGroup = 'Estoque';

    protected static ?string $recordTitleAttribute = 'Produto';

    public static function form(Schema $schema): Schema
    {
       
        return $schema->schema([
            TextInput::make('nome')
                ->required()
                ->maxLength(255),
            TextInput::make('referencia')
                ->label('Referência/SKU')
                ->unique(ignoreRecord: true),
            TextInput::make('preco_venda')
                ->numeric()
                ->prefix('R$')
                ->label('Preço de Venda'),
            TextInput::make('estoque')
                ->integer()
                ->default(0)
                ->label('Estoque Atual'),
        ]);
        
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProdutoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('referencia')
                ->label('Ref.')
                ->searchable(),
            TextColumn::make('nome')
                ->searchable()
                ->sortable(),
            TextColumn::make('preco_venda')
                ->money('BRL')
                ->label('Preço'),
            TextColumn::make('estoque')
                ->sortable()
                ->alignCenter(),
        ])->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ]);
    }

  
    public static function getPages(): array
    {
        return [
            'index' => ListProdutos::route('/'),
            'create' => CreateProduto::route('/create'),
            'view' => ViewProduto::route('/{record}'),
            'edit' => EditProduto::route('/{record}/edit'),
        ];
    }
}
