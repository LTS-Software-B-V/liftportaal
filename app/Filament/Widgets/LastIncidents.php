<?php

namespace App\Filament\Widgets;

use App\Models\ObjectIncident;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Support\Enums\Alignment;
class LastIncidents extends BaseWidget
{
 
    protected static ?int $sort = 2;
    protected static ?string $heading = "Nieuwste storingen";
    protected ?string $description = 'An overview of some analytics.';
    protected int | string | array $columnSpan = '6';
    public function table(Table $table): Table
    {
        return $table
            ->query(ObjectIncident::orderby('created_at','desc')->limit(10))
            ->columns([
                Tables\Columns\TextColumn::make("report_date_time")
                    ->label("Gemeld op ")
                    ->sortable()
                    ->date('d-m-Y H:i')
                    ->wrap() ,

                Tables\Columns\TextColumn::make("description")
                    ->label("Omschrijving")
                    ->sortable()
                    ->wrap() ,

                Tables\Columns\TextColumn::make("status_id")
                    ->label("Status")
                    ->sortable()
                    ->badge() ,

                Tables\Columns\TextColumn::make("type_id")
                    ->label("Type")
                    ->badge(),
            ])
            ->recordUrl(function (ObjectIncident $record) {
                return "admin/objects/" .
                    $record->elevator_id .
                    "?activeRelationManager=1";
            })
            ->paginated(false);
    }
}
