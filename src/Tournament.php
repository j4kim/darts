<?php

namespace J4kim\Darts;

class Tournament
{
    public int $id;
    public array $games = [];
    public array $participants = [];

    const GETLAST = "SELECT id FROM tournaments ORDER BY id DESC LIMIT 1";
    const GETBYID = "SELECT * FROM games WHERE tournament_id=? ORDER BY date DESC";
    const GETPARTICIPANTS = "SELECT u.username
                             FROM tournament_participants as tp
                             INNER JOIN users as u on tp.user_id = u.id
                             WHERE tp.tournament_id=?";

    public function __construct(int $id)
    {
        $this->id = $id;
        $this->games = DB::all(self::GETBYID, [$this->id]);
        $this->participants = DB::all(self::GETPARTICIPANTS, [$this->id]);
    }

    public static function getLastId()
    {
        return DB::one(self::GETLAST);
    }
}