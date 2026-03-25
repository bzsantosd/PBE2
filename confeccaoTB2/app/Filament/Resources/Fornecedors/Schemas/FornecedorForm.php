<?php

namespace App\Filament\Resources\Fornecedors\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FornecedorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome_fantasia')
                    ->required(),
                TextInput::make('razao_social'),
                TextInput::make('cnpj')
                    ->required(),
                TextInput::make('inscricao_estadual'),
                TextInput::make('endereco'),
                TextInput::make('telefone')
                    ->tel()
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
            ]);
    }
}
