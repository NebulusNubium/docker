DROP DATABASE IF EXISTS pokeworld;

CREATE DATABASE pokeworld;
USE pokeworld;
CREATE TABLE villes (
  id   INT AUTO_INCREMENT PRIMARY KEY,
  nom  VARCHAR(50) NOT NULL
);

CREATE TABLE dresseurs (
  id        INT AUTO_INCREMENT PRIMARY KEY,
  nom       VARCHAR(50),
  age       INT,
  ville_id  INT,
  FOREIGN KEY (ville_id) REFERENCES villes(id)
);

CREATE TABLE pokemons (
  id           INT PRIMARY KEY,
  nom          VARCHAR(50),
  puissance    INT,
  dresseur_id  INT,
  FOREIGN KEY (dresseur_id) REFERENCES dresseurs(id)
);

CREATE TABLE types (
  id   INT AUTO_INCREMENT PRIMARY KEY,
  nom  VARCHAR(30)
);

CREATE TABLE pokemon_types (
  id INT AUTO_INCREMENT PRIMARY KEY,
  pokemon_id INT,
  type_id INT,
  FOREIGN KEY (type_id) REFERENCES types(id),
  FOREIGN KEY (pokemon_id) REFERENCES pokemons(id)
);

INSERT INTO villes (id, nom) VALUES
  (1, 'Kanto'),
  (2, 'Kalos'),
  (3, 'Alola'),
  (4, 'Sinnoh');

INSERT INTO dresseurs (id, nom, age, ville_id) VALUES
  (1, 'Victor',   26, 1),
  (2, 'Christy',  18, 2),
  (3, 'Dianthéa', 32, 3),
  (4, 'Cathy',    48, 1),
  (5, 'Matis',    16, 3),
  (6, 'Flo',      32, 4);

INSERT INTO pokemons (id, nom, puissance, dresseur_id) VALUES
  (1,  'Tentacool', 45, 1),
  (2,  'Galar',     49, 1),
  (3,  'Lucario',   55, 2),
  (4,  'Steelix',   53, 2),
  (5,  'Pikachu',   40, 2),
  (6,  'Elektor',   65, 3),
  (7,  'Pikachu',   40, 4),
  (8,  'Tentacool', 45, 4),
  (9,  'Magikarp',   1, 4),
  (10, 'Papilusion',35, 5),
  (11, 'Lucario',   55, 5),
  (12, 'Galar',     49, 6),
  (13, 'Rondoudou', 34, 6),
  (14, 'Togepi',    20, 6);

INSERT INTO types (id, nom) VALUES
  (1, 'eau'),
  (2, 'poison'),
  (3, 'fée'),
  (4, 'combat'),
  (5, 'acier'),
  (6, 'sol'),
  (7, 'électrique'),
  (8, 'vol'),
  (9, 'insecte'),
  (10, 'normal');


  
INSERT INTO pokemon_types (pokemon_id, type_id) VALUES
  -- Victor’s team
  (1, 1), (1, 2),    -- Tentacool: eau, poison
  (2, 2), (2, 3),    -- Galar: poison, fée

  -- Christy’s team
  (3, 4), (3, 5),    -- Lucario: combat, acier
  (4, 6), (4, 5),    -- Steelix: sol, acier
  (5, 7),            -- Pikachu: électrique

  -- Dianthéa’s team
  (6, 8), (6, 7),    -- Elektor: vol, électrique

  -- Cathy’s team
  (7, 7),            -- Pikachu: électrique
  (8, 1), (8, 2),    -- Tentacool: eau, poison
  (9, 1),            -- Magikarp: eau

  -- Matis’s team
  (10, 8), (10, 9),  -- Papilusion: vol, insecte
  (11, 4), (11, 5),  -- Lucario: combat, acier

  -- Flo’s team
  (12, 2), (12, 3),  -- Galar: poison, fée
  (13, 10),(13, 3),  -- Rondoudou: normal, fée
  (14, 3);           -- Togepi: fée


-- exo 1--
  UPDATE dresseurs 
SET dresseurs.nom = 'Gros Nul'
WHERE dresseurs.nom = 'Matis';
--exo2--
SELECT pokemons.nom, pokemons.puissance FROM pokemons;

--exo 3--
SELECT dresseurs.nom, dresseurs.age, villes.nom AS 'ville' FROM dresseurs
INNER JOIN villes ON
dresseurs.ville_id = villes.id

WHERE dresseurs.age < 40 AND dresseurs.age > 18 AND villes.nom != 'Alola';

--exo 4--
SELECT DISTINCT pokemons.nom AS "pokemons", types.nom AS "Types"  FROM pokemons
INNER JOIN pokemon_types ON
pokemons.id = pokemon_types.pokemon_id
INNER JOIN types ON
pokemon_types.type_id = types.id

WHERE types.nom = "fée";

--exo 5-- 
SELECT DISTINCT dresseurs.nom AS "Equipe", SUM(pokemons.puissance) AS "Puissance" FROM dresseurs 
INNER JOIN pokemons ON
pokemons.dresseur_id = dresseurs.id
GROUP BY dresseurs.nom

--exo 6--
SELECT pokemons.nom AS "Pokemon", GROUP_CONCAT(DISTINCT dresseurs.nom) AS "Dresseur", GROUP_CONCAT(DISTINCT types.nom) AS "Types" FROM dresseurs
INNER JOIN pokemons ON
pokemons.dresseur_id = dresseurs.id

INNER JOIN pokemon_types ON
pokemon_types.pokemon_id = pokemons.id

INNER JOIN types ON
types.id = pokemon_types.type_id

GROUP BY pokemons.nom
--exo 7--
SELECT dresseurs.nom AS "Dresseur", SUM(pokemons.puissance) AS "Total Puissance Electrique" FROM dresseurs
INNER JOIN pokemons ON
pokemons.dresseur_id = dresseurs.id

INNER JOIN pokemon_types ON
pokemon_types.pokemon_id = pokemons.id

INNER JOIN types ON
types.id = pokemon_types.type_id
WHERE types.nom = "électrique"
GROUP BY dresseurs.nom





-- marche mais lucky--
-- SELECT dresseurs.nom AS "Dresseur", pokemons.puissance AS "Total Puissance Electrique", types.nom AS "type" FROM dresseurs
-- INNER JOIN pokemons ON
-- pokemons.dresseur_id = dresseurs.id

-- INNER JOIN pokemon_types ON
-- pokemon_types.pokemon_id = pokemons.id

-- INNER JOIN types ON
-- types.id = pokemon_types.type_id
-- HAVING types.nom = "électrique"