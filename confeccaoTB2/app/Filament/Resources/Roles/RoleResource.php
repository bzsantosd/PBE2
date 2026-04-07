<?php

namespace App\Filament\Resources\Roles;

use App\Filament\Resources\Roles\Pages\CreateRole;
use App\Filament\Resources\Roles\Pages\EditRole;
use App\Filament\Resources\Roles\Pages\ListRoles;
use App\Filament\Resources\Roles\Pages\ViewRole;
use App\Filament\Resources\Roles\Schemas\RoleForm;
use App\Filament\Resources\Roles\Schemas\RoleInfolist;
use App\Filament\Resources\Roles\Tables\RolesTable;
// use App\Models\Role;
use Spatie\Permission\Models\Role;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    // public static function canAccess(): bool
    // {
    //     return auth()->user()?->hasRole('Admin') ?? false;
    // }

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Painel Cargos'; // Ajustado para contexto de Roles

    protected static ?string $modelLabel = 'Criar Cargo';

    protected static ?string $pluralModelLabel = 'Cargos';

     protected static string|UnitEnum|null $navigationGroup = 'Administração';

    

    protected static ?string $recordTitleAttribute = 'Cargos e Funções';

    public static function form(Schema $schema): Schema
    {
        // return RoleForm::configure($schema);
         return $schema
        ->schema([
            \Filament\Forms\Components\TextInput::make('name')
            ->label('Cargo')
            ->required()
            ->unique(ignoreRecord:true)
            ->maxLength(255),
            

            \Filament\Forms\Components\Select::make('permissions')
            ->label('Permissões de Acesso')
            ->multiple()
            ->relationship('permissions','name')
            ->preload()
            ->columnSpanFull(),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RoleInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        // return RolesTable::configure($table);
        return $table
        ->columns([
            \Filament\Tables\Columns\TextColumn::make('name')
            ->label('Nome da Permissão')
            ->searchable()
            ->sortable(),

            \Filament\Tables\Columns\TextColumn::make('guard_name')
            ->label('Nivel da Permissão')
            ->searchable(),

            \Filament\Tables\Columns\TextColumn::make('created_at')
            ->label('Criada em')
            ->dateTime('d/m/Y')
            ->sortable(),
        ])

        ->recordActions([
             \Filament\Actions\EditAction::make(),
              \Filament\Actions\ViewAction::make(),
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
            'index' => ListRoles::route('/'),
            'create' => CreateRole::route('/create'),
            'view' => ViewRole::route('/{record}'),
            'edit' => EditRole::route('/{record}/edit'),
        ];
    }
}
