<?php

namespace J4kim\Darts;

use DateTime;
use PDO;

class Game
{
    public int $id;
    public int $tournament_id;
    public string $date;
    public ?string $notes;

    public static function find($id): Game
    {
        $sql = "SELECT * FROM games WHERE id=$id";
        $stmt = DB::pdo()->query($sql, PDO::FETCH_CLASS, self::class);
        return $stmt->fetch();
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

    public static function delete(int $id)
    {
        return DB::pdo()->prepare("DELETE FROM games WHERE id=?")->execute([$id]);
    }

    public function dateTime(): DateTime
    {
        return new DateTime($this->date);
    }

    public function formattedDate(): string
    {
        return $this->dateTime()->format("d.m.Y");
    }

    public function participants(): array
    {
        return DB::get("SELECT * FROM game_participants WHERE game_id=$this->id");
    }
}