DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255),
    PRIMARY KEY (id),
    UNIQUE (username)
);

DROP TABLE IF EXISTS tournaments;
CREATE TABLE tournaments (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id)
);

DROP TABLE IF EXISTS tournament_participants;
CREATE TABLE tournament_participants (
    tournament_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    score INT UNSIGNED NOT NULL DEFAULT 0,
    played INT UNSIGNED NOT NULL DEFAULT 0,
    wins INT UNSIGNED NOT NULL DEFAULT 0,
    FOREIGN KEY (tournament_id) REFERENCES tournaments(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE (tournament_id, user_id)
);

DROP TABLE IF EXISTS games;
CREATE TABLE games (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    tournament_id INT UNSIGNED NOT NULL,
    date DATETIME NOT NULL,
    notes TEXT,
    FOREIGN KEY (tournament_id) REFERENCES tournaments(id),
    PRIMARY KEY (id)
);

DROP TABLE IF EXISTS game_participants;
CREATE TABLE game_participants (
    game_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    `rank` INT UNSIGNED,
    FOREIGN KEY (game_id) REFERENCES games(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE (game_id, user_id)
);
