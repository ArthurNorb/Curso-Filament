<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
    
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $price = $data['price'];
        $price = str_replace('.', '', $price);
        $price = str_replace(',', '.', $price);
        $data['price'] = (float) $price;

        return $data;
    }
}
