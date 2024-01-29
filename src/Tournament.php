<?php

namespace J4kim\Darts;

use PDO;

class Tournament
{
    public int $id;
    public array $games = [];
    public array $participants = [];

    const GETLASTID = "SELECT id FROM tournaments ORDER BY id DESC LIMIT 1";
    const GETGAMES = "SELECT * FROM games WHERE tournament_id=? ORDER BY date DESC";
    const GETPARTICIPANTS = "SELECT u.username,
                                    u.id as user_id,
                                    tp.score,
                                    tp.played,
                                    tp.wins,
                                    tp.score / tp.played as score_per_game
                             FROM tournament_participants as tp
                             INNER JOIN users as u on tp.user_id = u.id
                             WHERE tp.tournament_id=?
                             ORDER BY score DESC, score_per_game DESC, wins DESC";

    public function __construct(int $id)
    {
        $this->id = $id;
        $stmt = DB::pdo()->prepare(self::GETGAMES);
        $stmt->execute([$id]);
        $this->games = $stmt->fetchAll(PDO::FETCH_CLASS, Game::class);
        $this->participants = self::getParticipants($this->id);
    }

    public static function getLastId()
    {
        return DB::one(self::GETLASTID);
    }

    public static function getParticipants(int $id)
    {
        return DB::get(self::GETPARTICIPANTS, [$id]);
    }

    public static function addParticipant(int $id, string $username)
    {
        $user_id = DB::one(
            "SELECT id FROM users WHERE username=?", [$username]
        );
        if (!$user_id) {
            DB::pdo()
                ->prepare("INSERT INTO users (username) VALUES (?)")
                ->execute([$username]);
            $user_id = DB::pdo()->lastInsertId();
        }
        DB::pdo()
            ->prepare("INSERT INTO tournament_participants (tournament_id, user_id) VALUES (?, ?)")
            ->execute([$id, $user_id]);
    }
}