<?php

namespace App\Repositories\Tvcode\Interfaces;

use App\Models\TvCode;

interface TvCodeRepositoryInterface
{
    public function findByCode($code);
    public function activateCode(TvCode $tvCode);
    public function findValidCode($credentials);
    public function deleteCode(TvCode $tvCode);
}