<?php

namespace App\Filament\Resources\Fornecedors;

use App\Filament\Resources\Fornecedors\Pages\CreateFornecedor;
use App\Filament\Resources\Fornecedors\Pages\EditFornecedor;
use App\Filament\Resources\Fornecedors\Pages\ListFornecedors;
use App\Filament\Resources\Fornecedors\Pages\ViewFornecedor;
use App\Filament\Resources\Fornecedors\Schemas\FornecedorForm;
use App\Filament\Resources\Fornecedors\Schemas\FornecedorInfolist;
use App\Filament\Resources\Fornecedors\Tables\FornecedorsTable;
use App\Models\Fornecedor;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Support\RawJs;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;

class FornecedorResource extends Resource
{
    protected static ?string $model = Fornecedor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Fornecedores';

    public static function form(Schema $schema): Schema
    {
        // return FornecedorForm::configure($schema);
        return $schema 
        ->schema([
            TextInput::make('nome_fantasia')->label('Nome Fantasia'),
            TextInput::make('razao_social')->required()->label('Razão Social'),
            TextInput::make('inscricao_estadual')->required()->label('Inscrição Estadual'),
            TextInput::make('endereco')->label('Endereco address'),
            TextInput::make('email')->email()->label('E-mail'),
            TextInput::make('Telefone')->required()->tel()->label('Telefone/Zap')->mask('(99)99999-9999'),
            TextInput::make('cnpj')->required()->label('CNPJ')->mask('99.999.999/9999-99'),
            ]);
    }
    

    public static function infolist(Schema $schema): Schema
    {
        return FornecedorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        // return FornecedorsTable::configure($table);
        return $table->columns([
            TextColumn::make('nome_fantasia')->searchable(),
            TextColumn::make('razao_social')->searchable(),
            TextColumn::make('inscricao_estadual')->searchable(),
            TextColumn::make('endereco')->searchable(),
            TextColumn::make('email')->searchable(),
            TextColumn::make('telefone'),
            TextColumn::make('documento'),
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
            'index' => ListFornecedors::route('/'),
            'create' => CreateFornecedor::route('/create'),
            'view' => ViewFornecedor::route('/{record}'),
            'edit' => EditFornecedor::route('/{record}/edit'),
        ];
    }
}
