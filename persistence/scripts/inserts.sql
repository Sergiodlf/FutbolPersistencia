USE futbol_persistencia;

INSERT INTO
    teams (name, stadium)
VALUES
    ('Real Madrid', 'Santiago Bernabéu'),
    ('FC Barcelona', 'Spotify Camp Nou'),
    ('Atlético de Madrid', 'Cívitas Metropolitano'),
    ('Sevilla FC', 'Ramón Sánchez-Pizjuán'),
    ('Valencia CF', 'Mestalla'),
    ('Real Betis', 'Benito Villamarín');

INSERT INTO
    matches (
        team_home_id,
        team_away_id,
        jornada,
        result,
        stadium
    )
VALUES
    -- Jornada 1
    (1, 2, 1, '1', 'Santiago Bernabéu'),
    (3, 4, 1, 'X', 'Cívitas Metropolitano'),
    (5, 6, 1, '2', 'Mestalla'),
    -- Jornada 2
    (2, 3, 2, '1', 'Spotify Camp Nou'),
    (4, 5, 2, '2', 'Ramón Sánchez-Pizjuán'),
    (6, 1, 2, 'X', 'Benito Villamarín'),
    -- Jornada 3
    (1, 3, 3, '1', 'Santiago Bernabéu'),
    (2, 5, 3, 'X', 'Spotify Camp Nou'),
    (4, 6, 3, '2', 'Ramón Sánchez-Pizjuán');