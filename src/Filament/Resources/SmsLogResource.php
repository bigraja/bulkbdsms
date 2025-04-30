<?php

namespace Bigraja\BulkBDSms\Filament\Resources;

use Bigraja\BulkBDSms\Models\SmsLog;
use Filament\Resources\Resource;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Tables\Table;
use Filament\Tables;

class SmsLogResource extends Resource
{
    protected static ?string $model = SmsLog::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'SMS';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('to')->label('To'),
                Tables\Columns\TextColumn::make('message')->limit(50)->label('Message'),
                Tables\Columns\TextColumn::make('status')->label('Status'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRecords::route('/'),
        ];
    }
}
