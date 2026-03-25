<?php

namespace App\Filament\Resources\Fornecedors\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FornecedorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nome_fantasia'),
                TextEntry::make('razao_social')
                    ->placeholder('-'),
                TextEntry::make('cnpj'),
                TextEntry::make('inscricao_estadual')
                    ->placeholder('-'),
                TextEntry::make('endereco')
                    ->placeholder('-'),
                TextEntry::make('telefone'),
                TextEntry::make('email')
                    ->label('Email address')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
