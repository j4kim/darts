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

    public array $gameParticipants;
    public array $tournamentParticipants;

    public static function find($id): Game
    {
        $sql = "SELECT * FROM games WHERE id=$id";
        $stmt = DB::pdo()->query($sql, PDO::FETCH_CLASS, self::class);
        return $stmt->fetch();
    }

    public function tournament(): Tournament
    {
        return new Tournament($this->tournament_id);
    }

    public function update(array $data)
    {
        DB::pdo()->prepare(
            "UPDATE games SET date=?, notes=? WHERE id=?"
        )->execute([$data["date"], $data["notes"], $this->id]);

        DB::pdo()->exec("DELETE FROM game_participants WHERE game_id=$this->id");
        $ranks = @$data["ranks"] ?? [];
        foreach ($ranks as $user_id => $rank) {
            if (!$rank) continue;
            DB::pdo()->prepare(
                "INSERT INTO game_participants (game_id, user_id, `rank`) VALUES (?, ?, ?)"
            )->execute([$this->id, $user_id, $rank]);
        }

        $this->tournament()->updateScores();
    }

    public static function create(int $tournamentId): int
    {
        $stmt = DB::pdo()->prepare(
            "INSERT INTO games (tournament_id, date) VALUES (?, NOW())"
        );
        $stmt->execute([$tournamentId]);
        return DB::pdo()->lastInsertId();
    }

    public function delete()
    {
        DB::pdo()->prepare("DELETE FROM games WHERE id=?")->execute([$this->id]);
        $this->tournament()->updateScores();
    }

    public function dateTime(): DateTime
    {
        return new DateTime($this->date);
    }

    public function formattedDate(): string
    {
        return $this->dateTime()->format("d.m.Y");
    }

    public function getGameParticipants()
    {
        return DB::get("SELECT * FROM game_participants WHERE game_id=$this->id");
    }

    public function loadParticipants()
    {
        $this->gameParticipants = self::getGameParticipants();
        $this->tournamentParticipants = array_map(
            function ($participant) {
                $participant->rank = $this->getUserRank($participant->user_id);
                return $participant;
            },
            Tournament::getParticipants($this->tournament_id)
        );
    }

    public function getUserRank(int $userId): ?int
    {
        $filtered = array_values(array_filter(
            $this->gameParticipants,
            fn ($p) => $p->user_id == $userId
        ));
        return @$filtered[0]->rank;
    }
}
