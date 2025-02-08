<?php

namespace App\Repositories\Tvcode;

use App\Models\TvCode;
use App\Repositories\Tvcode\Interfaces\TvCodeRepositoryInterface;

class TvCodeRepository implements TvCodeRepositoryInterface
{
    public function findByCode($code)
    {
        return TvCode::where('code', $code)->firstOrFail();
    }

    public function activateCode(TvCode $tvCode)
    {
        return $tvCode->update(['active' => true]);
    }

    public function findValidCode($credentials)
    {
        return TvCode::where($credentials)
            ->where('expires_at', '>', now())
            ->where('active', true)
            ->first();
    }

    public function deleteCode(TvCode $tvCode)
    {
        $tvCode->delete();
    }
}