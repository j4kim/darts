<?php

namespace J4kim\Darts;

class Game
{
    public static function find($id)
    {
        return DB::fetch("SELECT * FROM games WHERE id=$id");
    }

    public static function update(int $id, array $data)
    {
        $stmt = DB::pdo()->prepare(
            "UPDATE games SET date=?, notes=? WHERE id=?"
        );
        return $stmt->execute([$data["date"], $data["notes"], $id]);
    }

    public static function create(int $tournamentId): int
    {
        $stmt = DB::pdo()->prepare(
            "INSERT INTO games (tournament_id, date) VALUES (?, NOW())"
        );
        $stmt->execute([$tournamentId]);
        return DB::pdo()->lastInsertId();
    }
}