<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wordfind extends Model
{
    public function game()
    {
        return $this->morphOne(\App\Models\Game::class, 'gameable');
    }

    public function words()
    {
        return $this->morphMany(\App\Models\Word::class, 'wordeable');
    }
}
