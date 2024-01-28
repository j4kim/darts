<?php

namespace J4kim\Darts;

class Game
{
    public static function find($id)
    {
        return DB::fetch("SELECT * FROM games WHERE id=$id");
    }

    public static function update($id, $column, $value)
    {
        $stmt = DB::pdo()->prepare("UPDATE games SET $column=? WHERE id=?");
        return $stmt->execute([$value, $id]);
    }
}