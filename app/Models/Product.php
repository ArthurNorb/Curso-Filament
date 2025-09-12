<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'amount',
        'slug',
        'photo'
    ];

    protected static function booted(): void
    {
        // Esta função é executada antes de CRIAR um novo produto
        static::creating(function (Product $product) {
            // Lógica do slug que já funciona
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }

            // LÓGICA FINAL PARA O PREÇO
            if (isset($product->price) && !is_numeric($product->price)) {
                $price = str_replace('.', '', $product->price);
                $price = str_replace(',', '.', $price);
                $product->price = (float) $price;
            }
        });

        // Esta função é executada antes de ATUALIZAR um produto existente
        static::updating(function (Product $product) {
            // LÓGICA FINAL PARA O PREÇO AO EDITAR
            if (isset($product->price) && !is_numeric($product->price)) {
                $price = str_replace('.', '', $product->price);
                $price = str_replace(',', '.', $price);
                $product->price = (float) $price;
            }
        });
    }
}
