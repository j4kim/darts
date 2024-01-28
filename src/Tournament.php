<?php

namespace J4kim\Darts;

class Tournament
{
    public int $id;
    public array $games = [];

    const GETLAST = "SELECT id FROM tournaments ORDER BY id DESC LIMIT 1";
    const GETBYID = "SELECT * FROM games WHERE tournament_id=? ORDER BY date DESC";

    public function __construct(int $id)
    {
        $this->id = $id;
        $this->games = DB::all(self::GETBYID, [$this->id]);
    }

    public static function getLastId()
    {
        return DB::one(self::GETLAST);
    }
}