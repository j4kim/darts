insert into users
    (username, password)
values
    ('Hug', md5('sandwich')),
    ('Xa', md5('sandwich')),
    ('Jojo', md5('sandwich')),
    ('Dom', md5('sandwich'));


insert into tournaments values ();

insert into tournament_participants
    (tournament_id, user_id)
values
    (1, 1),
    (1, 2),
    (1, 3),
    (1, 4);

insert into games
    (tournament_id, date)
values
    (1, '2024-01-20 14:00:00'),
    (1, '2024-01-20 15:00:00'),
    (1, '2024-01-20 16:00:00');

insert into game_participants
    (game_id, user_id, `rank`)
values
    (1, 2, 1),
    (1, 3, 2),
    (1, 1, 3),
    (2, 1, 1),
    (2, 3, 2),
    (2, 2, 3),
    (3, 1, 1),
    (3, 2, 2),
    (3, 3, 3);
