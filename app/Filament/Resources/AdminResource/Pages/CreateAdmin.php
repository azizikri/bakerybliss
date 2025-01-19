<?php

namespace App\Filament\Resources\AdminResource\Pages;

use App\Models\User;
use Filament\Actions;
use App\Filament\Resources\AdminResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAdmin extends CreateRecord
{
    protected static string $resource = AdminResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['role'] = User::ROLE_ADMIN;

        return $data;
    }
}
