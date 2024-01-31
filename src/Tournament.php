<?php

namespace J4kim\Darts;

use PDO;

class Tournament
{
    public int $id;
    public array $games = [];
    public array $participants = [];

    const GETALL = "SELECT t.id,
                           (select count(*) from games g where g.tournament_id = t.id) as games_count
                    FROM tournaments t
                    ORDER BY id DESC";

    const GETGAMES = "SELECT * FROM games WHERE tournament_id=? ORDER BY date DESC";
    const GETGAMESCOUNT = "SELECT count(*) FROM games WHERE tournament_id=?";
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
        $this->games = self::getGames($id);
        $this->participants = self::getParticipants($id);
    }

    public static function all()
    {
        return DB::get(self::GETALL);
    }

    public static function create(): int
    {
        DB::pdo()->exec("INSERT INTO tournaments VALUES ()");
        return DB::pdo()->lastInsertId();
    }

    public static function delete(int $id)
    {
        return DB::pdo()->exec("DELETE FROM tournaments WHERE id=$id");
    }

    public static function getGames(int $id)
    {
        $stmt = DB::pdo()->prepare(self::GETGAMES);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, Game::class);
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

    public static function removeParticipant(int $id, int $userId)
    {
        DB::pdo()
            ->prepare("DELETE FROM tournament_participants WHERE tournament_id=? AND user_id=?")
            ->execute([$id, $userId]);
    }

    public function getScoreByRank(int $rank): int
    {
        return [
            1 => 10,
            2 => 6,
            3 => 3,
            4 => 1,
            5 => 0,
        ][min($rank, 5)];
    }

    public function resetParticipantsScores()
    {
        foreach ($this->participants as $participant) {
            $participant->score = 0;
            $participant->played = 0;
            $participant->wins = 0;
        }
    }

    public function computeParticipantsScoreForGame(Game $game)
    {
        $gpById = [];
        foreach ($game->getGameParticipants() as $gp) {
            $gpById[$gp->user_id] = $gp;
        }
        foreach ($this->participants as $participant) {
            $gp = @$gpById[$participant->user_id];
            if (!$gp) continue;
            $participant->score += $this->getScoreByRank($gp->rank);
            $participant->played++;
            if ($gp->rank == 1) {
                $participant->wins++;
            }
        }

    }

    public function updateParticipantsScore()
    {
        $stmt = DB::pdo()->prepare(
            "UPDATE tournament_participants
             SET score=?, played=?, wins=?
             WHERE tournament_id=? AND user_id=?"
        );
        foreach ($this->participants as $participant) {
            $stmt->execute([
                $participant->score,
                $participant->played,
                $participant->wins,
                $this->id,
                $participant->user_id,
            ]);
        }
    }

    public function updateScores()
    {
        $this->resetParticipantsScores();
        foreach($this->games as $game) {
            $this->computeParticipantsScoreForGame($game);
        }
        $this->updateParticipantsScore();
    }
}