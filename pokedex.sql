DROP TABLE IF EXISTS EvolvesInto;
DROP TABLE IF EXISTS has_a;
DROP TABLE IF EXISTS Mega_Item;
DROP TABLE IF EXISTS ofType;
DROP TABLE IF EXISTS WeakAgainst;
DROP TABLE IF EXISTS is_of;
DROP TABLE IF EXISTS has;
DROP TABLE IF EXISTS Mega_Evolution;
DROP TABLE IF EXISTS Evo_Item;
DROP TABLE IF EXISTS Status_Item;
DROP TABLE IF EXISTS p_uses;
DROP TABLE IF EXISTS P_Type;
DROP TABLE IF EXISTS P_Stats;
DROP TABLE IF EXISTS Item;
DROP TABLE IF EXISTS Pokemon;
DROP TABLE IF EXISTS Species;

-- Species table
CREATE TABLE Species (
	ID						INT,
	SpName				VARCHAR(255),
	Ability1			VARCHAR(255),
	Ability2 			VARCHAR(255),
	HiddenAbility	VARCHAR(255),
	PRIMARY KEY (ID)
);
-- GRANT SELECT ON Species TO PUBLIC;

-- Pokemon table
CREATE TABLE Pokemon (
	ID					INT,
	Nickname		VARCHAR(255),
	Gender			VARCHAR(20),
	TimeCaught		DATE,
	OwnedID			INT,
	PRIMARY KEY (OwnedID),
	FOREIGN KEY (ID) REFERENCES SPECIES
);
-- GRANT ALL PRIVILEGES ON Pokemon TO PUBLIC;

-- EvolvesInto table
CREATE TABLE EvolvesInto (
	SpID1			INT,
	SpID2			INT,
	PRIMARY KEY (SpID1, SpID2)
);
-- GRANT ALL PRIVILEGES ON EvolvesInto TO PUBLIC;

-- P_Type table
CREATE TABLE P_Type (
	P_TypeName			VARCHAR(20),
	PRIMARY KEY (P_TypeName)
);
-- GRANT ALL PRIVILEGES ON P_Type TO PUBLIC;

-- P_Stats table
CREATE TABLE P_Stats (
	ID				INT,
	HP				INT,
	Atk				INT,
	Def				INT,
	Spatk			INT,
	Spdef			INT,
	Speed			INT,
	PRIMARY KEY (ID)
);
-- GRANT ALL PRIVILEGES ON P_Stats TO PUBLIC;

-- Item table
CREATE TABLE Item (
	ItemName			VARCHAR(255),
	Quantity			INT,
	PRIMARY KEY (ItemName)
);
-- GRANT ALL PRIVILEGES ON Item TO PUBLIC;

-- Evo_Item table
CREATE TABLE Evo_Item (
	ItemName		VARCHAR(255),
	Usage			VARCHAR(255),
	FOREIGN KEY (ItemName) REFERENCES Item
);
-- GRANT ALL PRIVILEGES ON Evo_Item TO PUBLIC;

-- Status Item table
CREATE TABLE Status_Item (
	ItemName			VARCHAR(255),
	Status				VARCHAR(255),
	FOREIGN KEY (ItemName) REFERENCES Item
);
-- GRANT ALL PRIVILEGES ON Status_Item TO PUBLIC;

-- Mega_Evolution table
CREATE TABLE Mega_Evolution (
	ID					INT,
	MeName			VARCHAR(255),
	SpName			VARCHAR(255),
	Mega_Stone			VARCHAR(255),
	PRIMARY KEY (MeName),
	FOREIGN KEY (ID) REFERENCES Species
);
-- GRANT ALL PRIVILEGES ON Mega_Evolution TO PUBLIC;

-- Mega_Item table
CREATE TABLE Mega_Item (
	Mega_Stone		VARCHAR(255),
	MeName				VARCHAR(255),
	PRIMARY KEY (MeName),
	FOREIGN KEY (MeName) REFERENCES Mega_Evolution ON DELETE CASCADE
);
-- GRANT ALL PRIVILEGES ON Mega_Item TO PUBLIC;

-- has table
CREATE TABLE has (
	ID				INT,
	PRIMARY KEY (ID),
	FOREIGN KEY (ID) REFERENCES Species
);
-- GRANT ALL PRIVILEGES ON has TO PUBLIC;

-- is of table
CREATE TABLE is_of (
	OwnedID		INT,
	ID						INT,
	PRIMARY KEY (OwnedID, ID),
	FOREIGN KEY (OwnedID) REFERENCES Pokemon,
	FOREIGN KEY (ID) REFERENCES Species
);
-- GRANT ALL PRIVILEGES ON is_of TO PUBLIC;

-- ofType table
CREATE TABLE ofType (
	ID					INT,
	Type1			VARCHAR(255),
	Type2 		VARCHAR(255),
	PRIMARY KEY (ID),
	FOREIGN KEY (ID) REFERENCES Species,
	FOREIGN KEY (Type1) REFERENCES P_Type,
	FOREIGN KEY (Type2) REFERENCES P_Type
);
-- GRANT ALL PRIVILEGES ON ofType TO PUBLIC;

-- WeakAgainst table
CREATE TABLE WeakAgainst (
	Type1_TypeName		VARCHAR(255),
	Type2_TypeName		VARCHAR(255),
	FOREIGN KEY (Type1_TypeName) REFERENCES P_Type(P_TypeName),
	FOREIGN KEY (Type2_TypeName) REFERENCES P_Type(P_TypeName)
);
-- GRANT ALL PRIVILEGES ON WeakAgainst TO PUBLIC;


-- p_uses table
CREATE TABLE p_uses (
	OwnedID				INT,
	ItemName			VARCHAR(255),
	PRIMARY KEY (OwnedID),
	FOREIGN KEY (OwnedID) REFERENCES Pokemon,
	FOREIGN KEY (ItemName) REFERENCES Item
);
-- GRANT ALL PRIVILEGES ON p_uses TO PUBLIC;

-- has_a table
CREATE TABLE has_a (
	MeName			VARCHAR(255),
	ID					INT,
	PRIMARY KEY (MeName),
	FOREIGN KEY (MeName) REFERENCES Mega_Evolution,
	FOREIGN KEY (ID) REFERENCES Species
);
-- GRANT ALL PRIVILEGES ON has_a TO PUBLIC;

-- insert into species table
BULK INSERT Species FROM './species.csv' WITH (FIRSTROW = 2, FIELDTERMINATOR ',', ROWTERMINATOR '\n', TABLOCK)


-- insert into Pokemon table
INSERT INTO Pokemon VALUES (65, 'Alakazam', 'male', CURRENT_DATE, 0);
INSERT INTO Pokemon VALUES (52, 'Meowth', 'female', CURRENT_DATE, 1);
INSERT INTO Pokemon VALUES (54, 'Psyduck', 'male', CURRENT_DATE, 2);


-- insert into Mega_Evolution table
INSERT INTO Mega_Evolution VALUES (3,'Mega Venusaur','Venusaur','Venusaurite');
INSERT INTO Mega_Evolution VALUES (6,'Mega Charizard X','Charizard','Charizardite X');
INSERT INTO Mega_Evolution VALUES (6,'Mega Charizard Y','Charizard','Charizardite Y');
INSERT INTO Mega_Evolution VALUES (9,'Mega Blastoise','Blastoise','Blastoisinite');
INSERT INTO Mega_Evolution VALUES (15,'Mega Beedrill','Beedrill','Beedrillite');
INSERT INTO Mega_Evolution VALUES (18,'Mega Pidgeot','Pidgeot','Pidgeotite');
INSERT INTO Mega_Evolution VALUES (65,'Mega Alakazam','Alakazam','Alakazite');


-- insert into P_TypeName
INSERT INTO P_Type VALUES ('Normal');
INSERT INTO P_Type VALUES ('Fire');
INSERT INTO P_Type VALUES ('Water');
INSERT INTO P_Type VALUES ('Grass');
INSERT INTO P_Type VALUES ('Electric');
INSERT INTO P_Type VALUES ('Ice');
INSERT INTO P_Type VALUES ('Fighting');
INSERT INTO P_Type VALUES ('Poison');
INSERT INTO P_Type VALUES ('Ground');
INSERT INTO P_Type VALUES ('Flying');
INSERT INTO P_Type VALUES ('Psychic');
INSERT INTO P_Type VALUES ('Bug');
INSERT INTO P_Type VALUES ('Rock');
INSERT INTO P_Type VALUES ('Ghost');
INSERT INTO P_Type VALUES ('Dark');
INSERT INTO P_Type VALUES ('Dragon');
INSERT INTO P_Type VALUES ('Steel');
INSERT INTO P_Type VALUES ('Fairy');


-- insert into P_P_Stats table
BULK INSERT P_Stats FROM './stats.csv' WITH (FIRSTROW = 2, FIELDTERMINATOR ',', ROWTERMINATOR '\n', TABLOCK)


-- insert into ofType
BULK INSERT ofType FROM './ofType.csv' WITH (FIRSTROW = 2, FIELDTERMINATOR ',', ROWTERMINATOR '\n', TABLOCK)


-- insert WeakAgainst table
INSERT INTO WeakAgainst VALUES ('Normal', 'Rock');
INSERT INTO WeakAgainst VALUES ('Normal', 'Ghost');
INSERT INTO WeakAgainst VALUES ('Normal', 'Steel');
INSERT INTO WeakAgainst VALUES ('Normal', 'Fighting');
INSERT INTO WeakAgainst VALUES ('Fighting', 'Flying');
INSERT INTO WeakAgainst VALUES ('Fighting', 'Poison');
INSERT INTO WeakAgainst VALUES ('Fighting', 'Psychic');
INSERT INTO WeakAgainst VALUES ('Fighting', 'Bug');
INSERT INTO WeakAgainst VALUES ('Fighting', 'Ghost');
INSERT INTO WeakAgainst VALUES ('Fighting', 'Fairy');
INSERT INTO WeakAgainst VALUES ('Flying', 'Rock');
INSERT INTO WeakAgainst VALUES ('Flying', 'Steel');
INSERT INTO WeakAgainst VALUES ('Flying', 'Electric');
INSERT INTO WeakAgainst VALUES ('Flying', 'Ice');
INSERT INTO WeakAgainst VALUES ('Poison', 'Poison');
INSERT INTO WeakAgainst VALUES ('Poison', 'Ground');
INSERT INTO WeakAgainst VALUES ('Poison', 'Rock');
INSERT INTO WeakAgainst VALUES ('Poison', 'Ghost');
INSERT INTO WeakAgainst VALUES ('Poison', 'Steel');
INSERT INTO WeakAgainst VALUES ('Poison', 'Psychic');
INSERT INTO WeakAgainst VALUES ('Ground', 'Flying');
INSERT INTO WeakAgainst VALUES ('Ground', 'Bug');
INSERT INTO WeakAgainst VALUES ('Ground', 'Grass');
INSERT INTO WeakAgainst VALUES ('Ground', 'Water');
INSERT INTO WeakAgainst VALUES ('Ground', 'Ice');
INSERT INTO WeakAgainst VALUES ('Rock', 'Fighting');
INSERT INTO WeakAgainst VALUES ('Rock', 'Ground');
INSERT INTO WeakAgainst VALUES ('Rock', 'Steel');
INSERT INTO WeakAgainst VALUES ('Rock', 'Water');
INSERT INTO WeakAgainst VALUES ('Rock', 'Grass');
INSERT INTO WeakAgainst VALUES ('Bug', 'Fighting');
INSERT INTO WeakAgainst VALUES ('Bug', 'Flying');
INSERT INTO WeakAgainst VALUES ('Bug', 'Poison');
INSERT INTO WeakAgainst VALUES ('Bug', 'Ghost');
INSERT INTO WeakAgainst VALUES ('Bug', 'Steel');
INSERT INTO WeakAgainst VALUES ('Bug', 'Fire');
INSERT INTO WeakAgainst VALUES ('Bug', 'Fairy');
INSERT INTO WeakAgainst VALUES ('Bug', 'Rock');
INSERT INTO WeakAgainst VALUES ('Ghost', 'Normal');
INSERT INTO WeakAgainst VALUES ('Ghost', 'Dark');
INSERT INTO WeakAgainst VALUES ('Ghost', 'Ghost');
INSERT INTO WeakAgainst VALUES ('Steel', 'Steel');
INSERT INTO WeakAgainst VALUES ('Steel', 'Fire');
INSERT INTO WeakAgainst VALUES ('Steel', 'Water');
INSERT INTO WeakAgainst VALUES ('Steel', 'Electric');
INSERT INTO WeakAgainst VALUES ('Steel', 'Fighting');
INSERT INTO WeakAgainst VALUES ('Steel', 'Ground');
INSERT INTO WeakAgainst VALUES ('Fire', 'Rock');
INSERT INTO WeakAgainst VALUES ('Fire', 'Fire');
INSERT INTO WeakAgainst VALUES ('Fire', 'Water');
INSERT INTO WeakAgainst VALUES ('Fire', 'Dragon');
INSERT INTO WeakAgainst VALUES ('Fire', 'Ground');
INSERT INTO WeakAgainst VALUES ('Water', 'Water');
INSERT INTO WeakAgainst VALUES ('Water', 'Grass');
INSERT INTO WeakAgainst VALUES ('Water', 'Dragon');
INSERT INTO WeakAgainst VALUES ('Water', 'Electric');
INSERT INTO WeakAgainst VALUES ('Grass', 'Flying');
INSERT INTO WeakAgainst VALUES ('Grass', 'Poison');
INSERT INTO WeakAgainst VALUES ('Grass', 'Bug');
INSERT INTO WeakAgainst VALUES ('Grass', 'Steel');
INSERT INTO WeakAgainst VALUES ('Grass', 'Fire');
INSERT INTO WeakAgainst VALUES ('Grass', 'Grass');
INSERT INTO WeakAgainst VALUES ('Grass', 'Dragon');
INSERT INTO WeakAgainst VALUES ('Grass', 'Ice');
INSERT INTO WeakAgainst VALUES ('Electric', 'Ground');
INSERT INTO WeakAgainst VALUES ('Electric', 'Grass');
INSERT INTO WeakAgainst VALUES ('Electric', 'Electric');
INSERT INTO WeakAgainst VALUES ('Electric', 'Dragon');
INSERT INTO WeakAgainst VALUES ('Psychic', 'Steel');
INSERT INTO WeakAgainst VALUES ('Psychic', 'Psychic');
INSERT INTO WeakAgainst VALUES ('Psychic', 'Dark');
INSERT INTO WeakAgainst VALUES ('Psychic', 'Bug');
INSERT INTO WeakAgainst VALUES ('Psychic', 'Ghost');
INSERT INTO WeakAgainst VALUES ('Ice', 'Steel');
INSERT INTO WeakAgainst VALUES ('Ice', 'Fire');
INSERT INTO WeakAgainst VALUES ('Ice', 'Water');
INSERT INTO WeakAgainst VALUES ('Ice', 'Ice');
INSERT INTO WeakAgainst VALUES ('Ice', 'Fighting');
INSERT INTO WeakAgainst VALUES ('Ice', 'Rock');
INSERT INTO WeakAgainst VALUES ('Dragon', 'Steel');
INSERT INTO WeakAgainst VALUES ('Dragon', 'Fairy');
INSERT INTO WeakAgainst VALUES ('Dragon', 'Dragon');
INSERT INTO WeakAgainst VALUES ('Dragon', 'Ice');
INSERT INTO WeakAgainst VALUES ('Fairy', 'Poison');
INSERT INTO WeakAgainst VALUES ('Fairy', 'Steel');
INSERT INTO WeakAgainst VALUES ('Fairy', 'Fire');
INSERT INTO WeakAgainst VALUES ('Dark', 'Fighting');
INSERT INTO WeakAgainst VALUES ('Dark', 'Dark');
INSERT INTO WeakAgainst VALUES ('Dark', 'Fairy');
INSERT INTO WeakAgainst VALUES ('Dark', 'Bug');

-- insert EvolvesInto table
BULK INSERT EvolvesInto FROM './EvolvesInto.csv' WITH (FIRSTROW = 2, FIELDTERMINATOR ',', ROWTERMINATOR '\n', TABLOCK)


-- insert into Item Table
INSERT INTO Item VALUES('Amulet Coin', 1);
INSERT INTO Item VALUES('Red Orb', 1);
INSERT INTO Item VALUES('Blue Orb', 1);
INSERT INTO Item VALUES('Draco Plate', 1);
INSERT INTO Item VALUES('Dread Plate', 1);
INSERT INTO Item VALUES('Earth Plate', 1);
INSERT INTO Item VALUES('Fist Plate', 1);
INSERT INTO Item VALUES('Flame Plate', 1);
INSERT INTO Item VALUES('Icicle Plate', 1);
INSERT INTO Item VALUES('Insect Plate', 1);
INSERT INTO Item VALUES('Iron Plate', 1);
INSERT INTO Item VALUES('Meadow Plate', 1);
INSERT INTO Item VALUES('Mind Plate', 1);
INSERT INTO Item VALUES('Pixie Plate', 1);
INSERT INTO Item VALUES('Sky Plate', 1);
INSERT INTO Item VALUES('Splash Plate', 1);
INSERT INTO Item VALUES('Spooky Plate', 1);
INSERT INTO Item VALUES('Stone Plate', 1);
INSERT INTO Item VALUES('Toxic Plate', 1);
INSERT INTO Item VALUES('Zap Plate', 1);
INSERT INTO Item VALUES('Power Anklet', 1);
INSERT INTO Item VALUES('Power Band', 1);
INSERT INTO Item VALUES('Power Lens', 1);
INSERT INTO Item VALUES('Power Belt', 1);
INSERT INTO Item VALUES('Power Bracer', 1);
INSERT INTO Item VALUES('Power Weight', 1);
INSERT INTO Item VALUES ('Sun Stone', 1);
INSERT INTO Item VALUES ('Moon Stone', 1);
INSERT INTO Item VALUES ('Fire Stone', 1);
INSERT INTO Item VALUES ('Dawn Stone', 1);
INSERT INTO Item VALUES ('Shiny Stone', 1);
INSERT INTO Item VALUES ('Dusk Stone', 1);
INSERT INTO Item VALUES ('Ice Stone', 1);
INSERT INTO Item VALUES ('Leaf Stone', 1);
INSERT INTO Item VALUES ('Thunder Stone', 1);
INSERT INTO Item VALUES ('Water Stone', 1);
INSERT INTO Item VALUES ('Alakazite', 1);
INSERT INTO Item VALUES ('Beedrillite', 1);
INSERT INTO Item VALUES ('Blastoisinite', 1);
INSERT INTO Item VALUES ('Charizardite X', 1);
INSERT INTO Item VALUES ('Charizardite Y', 1);
INSERT INTO Item VALUES ('Pidgeotite', 1);
INSERT INTO Item VALUES ('Venusaurite', 1);
INSERT INTO Item VALUES ('Deep Sea Scale', 1);
INSERT INTO Item VALUES ('Deep Sea Tooth', 1);
INSERT INTO Item VALUES ('Dragon Scale', 1);
INSERT INTO Item VALUES ('Dubious Disc', 1);
INSERT INTO Item VALUES ('Kings Rock', 1);
INSERT INTO Item VALUES ('Metal Coat', 1);
INSERT INTO Item VALUES ('Oval Stone', 1);
INSERT INTO Item VALUES ('Prism Scale', 1);
INSERT INTO Item VALUES ('Protector', 1);
INSERT INTO Item VALUES ('Razor Claw', 1);
INSERT INTO Item VALUES ('Razor Fang', 1);
INSERT INTO Item VALUES ('Reaper Cloth', 1);
INSERT INTO Item VALUES ('Satchet', 1);
INSERT INTO Item VALUES ('Upgrade', 1);
INSERT INTO Item VALUES ('Whipped Dream', 1);
INSERT INTO Item VALUES('Antidote', 1);
INSERT INTO Item VALUES('Burn Heal', 1);
INSERT INTO Item VALUES('Elixir', 1);
INSERT INTO Item VALUES('Ether', 1);
INSERT INTO Item VALUES('Full Heal', 1);
INSERT INTO Item VALUES('Full Restore', 1);
INSERT INTO Item VALUES('Hyper Potion', 1);
INSERT INTO Item VALUES('Ice Heal', 1);
INSERT INTO Item VALUES('Max Elixir', 1);
INSERT INTO Item VALUES('Max Ether', 1);
INSERT INTO Item VALUES('Max Revive', 1);
INSERT INTO Item VALUES('Moomoo Milk', 1);
INSERT INTO Item VALUES('Paralyze Heal', 1);
INSERT INTO Item VALUES('Potion', 1);
INSERT INTO Item VALUES('Revive', 1);
INSERT INTO Item VALUES('Super Potion', 1);
INSERT INTO Item VALUES('Cheri Berry', 1);
INSERT INTO Item VALUES('Chesto Berry', 1);
INSERT INTO Item VALUES('Pecha Berry', 1);
INSERT INTO Item VALUES('Rawst Berry', 1);
INSERT INTO Item VALUES('Aspear Berry', 1);
INSERT INTO Item VALUES('Leppa Berry', 1);
INSERT INTO Item VALUES('Oran Berry', 1);
INSERT INTO Item VALUES('Persim Berry', 1);
INSERT INTO Item VALUES('Lum Berry', 1);
INSERT INTO Item VALUES('Sitrus Berry', 1);
INSERT INTO Item VALUES('X Attack', 1);
INSERT INTO Item VALUES('X Defense', 1);
INSERT INTO Item VALUES('X Sp. Atk', 1);
INSERT INTO Item VALUES('X Sp. Def', 1);
INSERT INTO Item VALUES('X Speed', 1);
INSERT INTO Item VALUES('X Accuracy', 1);
INSERT INTO Item VALUES('Dire Hit', 1);
INSERT INTO Item VALUES('Guard Spec', 1);


-- insert into Evo_Item Table
INSERT INTO Evo_Item VALUES ('Sun Stone', 'Bag');
INSERT INTO Evo_Item VALUES ('Moon Stone', 'Bag');
INSERT INTO Evo_Item VALUES ('Fire Stone', 'Bag');
INSERT INTO Evo_Item VALUES ('Dawn Stone', 'Bag');
INSERT INTO Evo_Item VALUES ('Shiny Stone', 'Bag');
INSERT INTO Evo_Item VALUES ('Dusk Stone', 'Bag');
INSERT INTO Evo_Item VALUES ('Ice Stone', 'Bag');
INSERT INTO Evo_Item VALUES ('Leaf Stone', 'Bag');
INSERT INTO Evo_Item VALUES ('Thunder Stone', 'Bag');
INSERT INTO Evo_Item VALUES ('Water Stone', 'Bag');
INSERT INTO Evo_Item VALUES ('Alakazite', 'Held');
INSERT INTO Evo_Item VALUES ('Beedrillite', 'Held');
INSERT INTO Evo_Item VALUES ('Blastoisinite', 'Held');
INSERT INTO Evo_Item VALUES ('Charizardite X', 'Held');
INSERT INTO Evo_Item VALUES ('Charizardite Y', 'Held');
INSERT INTO Evo_Item VALUES ('Pidgeotite', 'Held');
INSERT INTO Evo_Item VALUES ('Venusaurite', 'Held');
INSERT INTO Evo_Item VALUES ('Deep Sea Scale', 'Held');
INSERT INTO Evo_Item VALUES ('Deep Sea Tooth', 'Held');
INSERT INTO Evo_Item VALUES ('Dragon Scale', 'Held');
INSERT INTO Evo_Item VALUES ('Dubious Disc', 'Held');
INSERT INTO Evo_Item VALUES ('Kings Rock', 'Held');
INSERT INTO Evo_Item VALUES ('Metal Coat', 'Held');
INSERT INTO Evo_Item VALUES ('Oval Stone', 'Held');
INSERT INTO Evo_Item VALUES ('Prism Scale', 'Held');
INSERT INTO Evo_Item VALUES ('Protector', 'Held');
INSERT INTO Evo_Item VALUES ('Razor Claw', 'Held');
INSERT INTO Evo_Item VALUES ('Razor Fang', 'Held');
INSERT INTO Evo_Item VALUES ('Reaper Cloth', 'Held');
INSERT INTO Evo_Item VALUES ('Satchet', 'Held');
INSERT INTO Evo_Item VALUES ('Upgrade', 'Held');
INSERT INTO Evo_Item VALUES ('Whipped Dream', 'Held');

-- insert into Status_Item table
INSERT INTO Status_Item VALUES('Antidote', 'Poison');
INSERT INTO Status_Item VALUES('Burn Heal', 'Burn');
INSERT INTO Status_Item VALUES('Elixir', 'PP');
INSERT INTO Status_Item VALUES('Ether', 'PP');
INSERT INTO Status_Item VALUES('Full Heal', 'Statuses');
INSERT INTO Status_Item VALUES('Full Restore', 'HP, Statuses');
INSERT INTO Status_Item VALUES('Hyper Potion', 'HP');
INSERT INTO Status_Item VALUES('Ice Heal', 'Freeze');
INSERT INTO Status_Item VALUES('Max Elixir', 'PP');
INSERT INTO Status_Item VALUES('Max Ether', 'PP');
INSERT INTO Status_Item VALUES('Max Revive', 'Fainted, HP');
INSERT INTO Status_Item VALUES('Moomoo Milk', 'HP');
INSERT INTO Status_Item VALUES('Paralyze Heal', 'Paralysis');
INSERT INTO Status_Item VALUES('Potion', 'HP');
INSERT INTO Status_Item VALUES('Revive', 'Fainted');
INSERT INTO Status_Item VALUES('Super Potion', 'HP');
INSERT INTO Status_Item VALUES('Cheri Berry', 'Paralysis');
INSERT INTO Status_Item VALUES('Chesto Berry', 'Sleep');
INSERT INTO Status_Item VALUES('Pecha Berry', 'Poison');
INSERT INTO Status_Item VALUES('Rawst Berry', 'Burn');
INSERT INTO Status_Item VALUES('Aspear Berry', 'Freeze');
INSERT INTO Status_Item VALUES('Leppa Berry', 'PP');
INSERT INTO Status_Item VALUES('Oran Berry', 'HP');
INSERT INTO Status_Item VALUES('Persim Berry', 'Confusion');
INSERT INTO Status_Item VALUES('Lum Berry', 'Statuses');
INSERT INTO Status_Item VALUES('Sitrus Berry', 'HP');
INSERT INTO Status_Item VALUES('X Attack', 'Attack');
INSERT INTO Status_Item VALUES('X Defense', 'Defense');
INSERT INTO Status_Item VALUES('X Sp. Atk', 'Sp. Attack');
INSERT INTO Status_Item VALUES('X Sp. Def', 'Sp. Defense');
INSERT INTO Status_Item VALUES('X Speed', 'Speed');
INSERT INTO Status_Item VALUES('X Accuracy', 'Accuracy');
INSERT INTO Status_Item VALUES('Dire Hit', 'Critical Hit');
INSERT INTO Status_Item VALUES('Guard Spec', 'Status Reduction');

-- insert into uses Table
INSERT INTO p_uses VALUES (0, 'Moomoo Milk');
INSERT INTO p_uses VALUES (1, 'Oran Berry');
INSERT INTO p_uses VALUES (2, 'Amulet Coin');


-- insert into Mega_Item Table
INSERT INTO Mega_Item VALUES('Alakazite', 'Mega Alakazam');
INSERT INTO Mega_Item VALUES('Beedrillite', 'Mega Beedrill');
INSERT INTO Mega_Item VALUES('Blastoisinite', 'Mega Blastoise');
INSERT INTO Mega_Item VALUES('Charizardite X', 'Mega Charizard X');
INSERT INTO Mega_Item VALUES('Charizardite Y', 'Mega Charizard Y');
INSERT INTO Mega_Item VALUES('Pidgeotite', 'Mega Pidgeot');
INSERT INTO Mega_Item VALUES('Venusaurite', 'Mega Venusaur');

-- insert into has_a table
INSERT INTO has_a VALUES('Mega Venusaur', 3);
INSERT INTO has_a VALUES('Mega Charizard X', 6);
INSERT INTO has_a VALUES('Mega Charizard Y', 6);
INSERT INTO has_a VALUES('Mega Blastoise', 9);
INSERT INTO has_a VALUES('Mega Alakazam', 65);
INSERT INTO has_a VALUES('Mega Beedrill', 15);
INSERT INTO has_a VALUES('Mega Pidgeot', 18);