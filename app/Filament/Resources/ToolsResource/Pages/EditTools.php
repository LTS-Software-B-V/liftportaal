<?php

namespace App\Filament\Resources\ToolsResource\Pages;

use App\Filament\Resources\ToolsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\Action;
class EditTools extends EditRecord
{
    protected static string $resource = ToolsResource::class;
    protected static ?string $title = 'Gereedschap - Wijzigen';
    protected function getHeaderActions(): array
    {
        return [

            Action::make('back')
            ->url(route('filament.admin.resources.tools.index'))
            ->label('Afbreken') 
            ->link()
            ->color('gray'),
            Actions\DeleteAction::make(),
        ];
    }


    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }


    public function getRelationManagers(): array
    {
        return [];
    }


    public function getHeading(): string
    {
        return $this->getRecord()->name;
    }
}
