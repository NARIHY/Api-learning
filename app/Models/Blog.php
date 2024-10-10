<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ApiResource]
class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'contenu'];
}
