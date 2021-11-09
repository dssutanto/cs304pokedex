DROP TABLE EvolvesInto;
DROP TABLE has_a;
DROP TABLE Mega_Item;
DROP TABLE ofType;
DROP TABLE WeakAgainst;
DROP TABLE is_of;
DROP TABLE has;
DROP TABLE Mega_Evolution;
DROP TABLE Evo_Item;
DROP TABLE Status_Item;
DROP TABLE p_uses;
DROP TABLE P_Type;
DROP TABLE P_Stats;
DROP TABLE Item;
DROP TABLE Pokemon;
DROP TABLE Species;

-- Species table
CREATE TABLE Species (
	ID						INT,
	SpName				VARCHAR(255),
	Ability1			VARCHAR(255),
	Ability2 			VARCHAR(255),
	HiddenAbility	VARCHAR(255),
	PRIMARY KEY (ID)
);
GRANT SELECT ON Species TO PUBLIC;

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
GRANT ALL PRIVILEGES ON Pokemon TO PUBLIC;

-- EvolvesInto table
CREATE TABLE EvolvesInto (
	SpID1			INT,
	SpID2			INT,
	PRIMARY KEY (SpID1, SpID2)
);
GRANT ALL PRIVILEGES ON EvolvesInto TO PUBLIC;

-- P_Type table
CREATE TABLE P_Type (
	P_TypeName			VARCHAR(20),
	PRIMARY KEY (P_TypeName)
);
GRANT ALL PRIVILEGES ON P_Type TO PUBLIC;

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
GRANT ALL PRIVILEGES ON P_Stats TO PUBLIC;

-- Item table
CREATE TABLE Item (
	ItemName			VARCHAR(255),
	Quantity			INT,
	PRIMARY KEY (ItemName)
);
GRANT ALL PRIVILEGES ON Item TO PUBLIC;

-- Evo_Item table
CREATE TABLE Evo_Item (
	ItemName		VARCHAR(255),
	Usage			VARCHAR(255),
	FOREIGN KEY (ItemName) REFERENCES Item
);
GRANT ALL PRIVILEGES ON Evo_Item TO PUBLIC;

-- Status Item table
CREATE TABLE Status_Item (
	ItemName			VARCHAR(255),
	Status				VARCHAR(255),
	FOREIGN KEY (ItemName) REFERENCES Item
);
GRANT ALL PRIVILEGES ON Status_Item TO PUBLIC;

-- Mega_Evolution table
CREATE TABLE Mega_Evolution (
	ID					INT,
	MeName			VARCHAR(255),
	SpName			VARCHAR(255),
	Mega_Stone			VARCHAR(255),
	PRIMARY KEY (MeName),
	FOREIGN KEY (ID) REFERENCES Species
);
GRANT ALL PRIVILEGES ON Mega_Evolution TO PUBLIC;

-- Mega_Item table
CREATE TABLE Mega_Item (
	Mega_Stone		VARCHAR(255),
	MeName				VARCHAR(255),
	PRIMARY KEY (MeName),
	FOREIGN KEY (MeName) REFERENCES Mega_Evolution ON DELETE CASCADE
);
GRANT ALL PRIVILEGES ON Mega_Item TO PUBLIC;

-- has table
CREATE TABLE has (
	ID				INT,
	PRIMARY KEY (ID),
	FOREIGN KEY (ID) REFERENCES Species
);
GRANT ALL PRIVILEGES ON has TO PUBLIC;

-- is of table
CREATE TABLE is_of (
	OwnedID		INT,
	ID						INT,
	PRIMARY KEY (OwnedID, ID),
	FOREIGN KEY (OwnedID) REFERENCES Pokemon,
	FOREIGN KEY (ID) REFERENCES Species
);
GRANT ALL PRIVILEGES ON is_of TO PUBLIC;

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
GRANT ALL PRIVILEGES ON ofType TO PUBLIC;

-- WeakAgainst table
CREATE TABLE WeakAgainst (
	Type1_TypeName		VARCHAR(255),
	Type2_TypeName		VARCHAR(255),
	FOREIGN KEY (Type1_TypeName) REFERENCES P_Type(P_TypeName),
	FOREIGN KEY (Type2_TypeName) REFERENCES P_Type(P_TypeName)
);
GRANT ALL PRIVILEGES ON WeakAgainst TO PUBLIC;


-- p_uses table
CREATE TABLE p_uses (
	OwnedID				INT,
	ItemName			VARCHAR(255),
	PRIMARY KEY (OwnedID),
	FOREIGN KEY (OwnedID) REFERENCES Pokemon,
	FOREIGN KEY (ItemName) REFERENCES Item
);
GRANT ALL PRIVILEGES ON p_uses TO PUBLIC;

-- has_a table
CREATE TABLE has_a (
	MeName			VARCHAR(255),
	ID					INT,
	PRIMARY KEY (MeName),
	FOREIGN KEY (MeName) REFERENCES Mega_Evolution,
	FOREIGN KEY (ID) REFERENCES Species
);
GRANT ALL PRIVILEGES ON has_a TO PUBLIC;

-- insert into species table
INSERT INTO Species VALUES (1,'Bulbasaur','Overgrow',NULL,'Chrolophyll');
INSERT INTO Species VALUES (2,'Ivysaur','Overgrow',NULL,'Chrolophyll');
INSERT INTO Species VALUES (3,'Venusaur','Overgrow',NULL,'Chrolophyll');
INSERT INTO Species VALUES (4,'Charmander','Blaze',NULL,'Solar Power');
INSERT INTO Species VALUES (5,'Charmeleon','Blaze',NULL,'Solar Power');
INSERT INTO Species VALUES (6,'Charizard','Blaze',NULL,'Solar Power');
INSERT INTO Species VALUES (7,'Squirtle','Torrent',NULL,'Rain Dish');
INSERT INTO Species VALUES (8,'Wartortle','Torrent',NULL,'Rain Dish');
INSERT INTO Species VALUES (9,'Blastoise','Torrent',NULL,'Rain Dish');
INSERT INTO Species VALUES (10,'Caterpie','Shield Dust',NULL,'Run Away');
INSERT INTO Species VALUES (11,'Metapod','Shed Skin',NULL,NULL);
INSERT INTO Species VALUES (12,'Butterfree','Compound Eyes',NULL,'Tinted Lens');
INSERT INTO Species VALUES (13,'Weedle','Shield Dust',NULL,'Run Away');
INSERT INTO Species VALUES (14,'Kakuna','Shed Skin',NULL,NULL);
INSERT INTO Species VALUES (15,'Beedrill','Swarm',NULL,'Sniper');
INSERT INTO Species VALUES (16,'Pidgey','Keen Eye','Tangled Feet','Big Pecks');
INSERT INTO Species VALUES (17,'Pidgeotto','Keen Eye','Tangled Feet','Big Pecks');
INSERT INTO Species VALUES (18,'Pidgeot','Keen Eye','Tangled Feet','Big Pecks');
INSERT INTO Species VALUES (19,'Rattata','Run Away','Guts','Hustle');
INSERT INTO Species VALUES (20,'Raticate','Run Away','Guts','Hustle');
INSERT INTO Species VALUES (21,'Spearow','Keen Eye',NULL,'Sniper');
INSERT INTO Species VALUES (22,'Fearow','Keen Eye',NULL,'Sniper');
INSERT INTO Species VALUES (23,'Ekans','Intimidate','Shed Skin','Unnerve');
INSERT INTO Species VALUES (24,'Arbok','Intimidate','Shed Skin','Unnerve');
INSERT INTO Species VALUES (25,'Pikachu','Static',NULL,'Lightning Rod');
INSERT INTO Species VALUES (26,'Raichu','Static',NULL,'Lightning Rod');
INSERT INTO Species VALUES (27,'Sandshrew','Sand Veil',NULL,'Sand Rush');
INSERT INTO Species VALUES (28,'Sandslash','Snow Cloak',NULL,'Slush Rush');
INSERT INTO Species VALUES (29, 'Nidoran F', 'Poison Point', 'Rivalry', 'Hustle');
INSERT INTO Species VALUES (30,'Nidorina','Poison Point','Rivalry','Hustle');
INSERT INTO Species VALUES (31, 'Nidoqueen', 'Poison Point', 'Rivalry', 'Hustle');
INSERT INTO Species VALUES (32,'Nidoran M','Poison Point','Rivalry','Hustle');
INSERT INTO Species VALUES (33, 'Nidorino', 'Poison Point', 'Rivalry', 'Hustle');
INSERT INTO Species VALUES (34,'Nidoking','Poison Point','Rivalry','Sheer Force');
INSERT INTO Species VALUES (35, 'Clefairy', 'Cute Charm', 'Magic Guard','Friend Guard');
INSERT INTO Species VALUES (36,'Clefable','Cute Charm','Magic Guard','Friend Guard');
INSERT INTO Species VALUES (37,'Vulpix','Flash Fire',NULL,'Drought');
INSERT INTO Species VALUES (38,'Ninetales','Flash Fire',NULL,'Drought');
INSERT INTO Species VALUES (39,'Jigglypuff','Cute Charm','Competitive','Friend Guard');
INSERT INTO Species VALUES (40,'Wigglytuff','Cute Charm','Competitive','Friend Guard');
INSERT INTO Species VALUES (41,'Zubat','Inner Focus',NULL,'Infiltrator');
INSERT INTO Species VALUES (42,'Golbat','Inner Focus',NULL,'Infiltrator');
INSERT INTO Species VALUES (43,'Oddish','Chlorophyll',NULL,'Run Away');
INSERT INTO Species VALUES (44,'Gloom','Chlorophyll',NULL,'Stench');
INSERT INTO Species VALUES (45,'Vileplume','Chlorophyll',NULL,'Effect Spore');
INSERT INTO Species VALUES (46,'Paras','Effect Spore','Dry Skin','Damp');
INSERT INTO Species VALUES (47,'Parasect','Effect Spore','Dry Skin','Damp');
INSERT INTO Species VALUES (48,'Venonat','Compound Eyes','Tinted Lens','Run Away');
INSERT INTO Species VALUES (49,'Venomoth','Shield Dust','Tinted Lens','Wonder Skin');
INSERT INTO Species VALUES (50,'Diglett','Sand Veil','Arena Trap','Sand Force');
INSERT INTO Species VALUES (51,'Dugtrio','Sand Veil','Arena Trap','Sand Force');
INSERT INTO Species VALUES (52,'Meowth','Pickup','Technician','Unnerve');
INSERT INTO Species VALUES (53,'Persian','Limber','Technician','Unnerve');
INSERT INTO Species VALUES (54,'Psyduck','Damp','Cloud Nine','Swift Swim');
INSERT INTO Species VALUES (55,'Golduck','Damp','Cloud Nine','Swift Swim');
INSERT INTO Species VALUES (56,'Mankey','Vital Spilit','Anger Point','Defiant');
INSERT INTO Species VALUES (57,'Primeape','Vital Spilit','Anger Point','Defiant');
INSERT INTO Species VALUES (58,'Growlithe','Intimidate','Flash Fire','Justified');
INSERT INTO Species VALUES (59,'Arcanine','Intimidate','Flash Fire','Justified');
INSERT INTO Species VALUES (60,'Poliwag','Water Absorb','Damp','Swift Swim');
INSERT INTO Species VALUES (61,'Poliwhirl','Water Absorb','Damp','Swift Swim');
INSERT INTO Species VALUES (62,'Poliwrath','Water Absorb','Damp','Swift Swim');
INSERT INTO Species VALUES (63,'Abra','Synchronize','Inner Focus','Magic guard');
INSERT INTO Species VALUES (64,'Kadabra','Synchronize','Inner Focus','Magic guard');
INSERT INTO Species VALUES (65,'Alakazam','Synchronize','Inner Focus','Magic guard');


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
INSERT INTO P_Stats VALUES (1,45,49,49,65,65,45);
INSERT INTO P_Stats VALUES (2,60,62,63,80,80,60);
INSERT INTO P_Stats VALUES (3,80,82,83,100,100,80);
INSERT INTO P_Stats VALUES (4,39,52,43,60,50,65);
INSERT INTO P_Stats VALUES (5,58,64,58,80,65,80);
INSERT INTO P_Stats VALUES (6,78,84,78,109,85,100);
INSERT INTO P_Stats VALUES (7,44,48,65,50,64,43);
INSERT INTO P_Stats VALUES (8,59,63,80,65,80,58);
INSERT INTO P_Stats VALUES (9,79,83,100,85,105,78);
INSERT INTO P_Stats VALUES (10,45,30,35,20,20,45);
INSERT INTO P_Stats VALUES (11,50,20,55,25,25,30);
INSERT INTO P_Stats VALUES (12,60,45,50,90,80,70);
INSERT INTO P_Stats VALUES (13,40,35,30,20,20,50);
INSERT INTO P_Stats VALUES (14,45,25,50,25,25,35);
INSERT INTO P_Stats VALUES (15,65,90,40,45,80,75);
INSERT INTO P_Stats VALUES (16,40,45,40,35,35,56);
INSERT INTO P_Stats VALUES (17,63,60,55,50,50,71);
INSERT INTO P_Stats VALUES (18,83,80,75,70,70,101);
INSERT INTO P_Stats VALUES (19,30,56,35,25,35,72);
INSERT INTO P_Stats VALUES (20,55,81,60,50,70,97);
INSERT INTO P_Stats VALUES (21,40,60,30,31,31,70);
INSERT INTO P_Stats VALUES (22,65,90,65,61,61,100);
INSERT INTO P_Stats VALUES (23,35,60,44,40,54,55);
INSERT INTO P_Stats VALUES (24,60,95,69,65,79,80);
INSERT INTO P_Stats VALUES (25,35,55,40,50,50,90);
INSERT INTO P_Stats VALUES (26,60,90,55,90,80,110);
INSERT INTO P_Stats VALUES (27,50,75,85,20,30,40);
INSERT INTO P_Stats VALUES (28,75,100,110,45,55,65);
INSERT INTO P_Stats VALUES (29,55,47,52,40,40,41);
INSERT INTO P_Stats VALUES (30,70,62,67,55,55,56);
INSERT INTO P_Stats VALUES (31,90,92,87,75,85,76);
INSERT INTO P_Stats VALUES (32,46,57,40,40,40,50);
INSERT INTO P_Stats VALUES (33,61,72,57,55,55,65);
INSERT INTO P_Stats VALUES (34,81,102,77,85,75,85);
INSERT INTO P_Stats VALUES (35,70,45,48,60,65,35);
INSERT INTO P_Stats VALUES (36,95,70,73,95,90,60);
INSERT INTO P_Stats VALUES (37,38,41,40,50,65,65);
INSERT INTO P_Stats VALUES (38,73,76,75,81,100,100);
INSERT INTO P_Stats VALUES (39,115,45,20,45,25,20);
INSERT INTO P_Stats VALUES (40,140,70,45,85,50,45);
INSERT INTO P_Stats VALUES (41,40,45,35,30,40,55);
INSERT INTO P_Stats VALUES (42,75,80,70,65,75,90);
INSERT INTO P_Stats VALUES (43,45,50,55,75,65,30);
INSERT INTO P_Stats VALUES (44,60,65,70,85,75,40);
INSERT INTO P_Stats VALUES (45,75,80,85,110,90,50);
INSERT INTO P_Stats VALUES (46,35,70,55,45,55,25);
INSERT INTO P_Stats VALUES (47,60,95,80,60,80,30);
INSERT INTO P_Stats VALUES (48,60,55,50,40,55,45);
INSERT INTO P_Stats VALUES (49,70,65,60,90,75,90);
INSERT INTO P_Stats VALUES (50,10,55,25,35,45,95);
INSERT INTO P_Stats VALUES (51,35,100,50,50,70,120);
INSERT INTO P_Stats VALUES (52,40,45,35,40,40,90);
INSERT INTO P_Stats VALUES (53,65,70,60,65,65,115);
INSERT INTO P_Stats VALUES (54,50,52,48,65,50,55);
INSERT INTO P_Stats VALUES (55,80,82,78,95,80,85);
INSERT INTO P_Stats VALUES (56,40,80,35,35,45,70);
INSERT INTO P_Stats VALUES (57,65,105,60,60,70,95);
INSERT INTO P_Stats VALUES (58,55,70,45,70,50,60);
INSERT INTO P_Stats VALUES (59,90,110,80,100,80,95);
INSERT INTO P_Stats VALUES (60,40,50,40,40,40,90);
INSERT INTO P_Stats VALUES (61,65,65,65,50,50,90);
INSERT INTO P_Stats VALUES (62,90,95,95,70,90,70);
INSERT INTO P_Stats VALUES (63,25,20,15,105,55,90);
INSERT INTO P_Stats VALUES (64,40,35,30,120,70,105);
INSERT INTO P_Stats VALUES (65,55,50,45,135,95,120);


-- insert into ofType
INSERT INTO ofType VALUES (1,'Grass','Poison');
INSERT INTO ofType VALUES (2,'Grass','Poison');
INSERT INTO ofType VALUES (3,'Grass','Poison');
INSERT INTO ofType VALUES (4,'Fire',NULL);
INSERT INTO ofType VALUES (5,'Fire',NULL);
INSERT INTO ofType VALUES (6,'Fire','Flying');
INSERT INTO ofType VALUES (7,'Water',NULL);
INSERT INTO ofType VALUES (8,'Water',NULL);
INSERT INTO ofType VALUES (9,'Water',NULL);
INSERT INTO ofType VALUES (10,'Bug',NULL);
INSERT INTO ofType VALUES (11,'Bug',NULL);
INSERT INTO ofType VALUES (12,'Bug','Flying');
INSERT INTO ofType VALUES (13,'Bug','Poison');
INSERT INTO ofType VALUES (14,'Bug','Poison');
INSERT INTO ofType VALUES (15,'Bug','Poison');
INSERT INTO ofType VALUES (16,'Normal','Flying');
INSERT INTO ofType VALUES (17,'Normal','Flying');
INSERT INTO ofType VALUES (18,'Normal','Flying');
INSERT INTO ofType VALUES (19,'Normal',NULL);
INSERT INTO ofType VALUES (20,'Normal',NULL);
INSERT INTO ofType VALUES (21,'Normal','Flying');
INSERT INTO ofType VALUES (22,'Normal','Flying');
INSERT INTO ofType VALUES (23,'Poison',NULL);
INSERT INTO ofType VALUES (24,'Poison',NULL);
INSERT INTO ofType VALUES (25,'Electric',NULL);
INSERT INTO ofType VALUES (26,'Electric',NULL);
INSERT INTO ofType VALUES (27,'Ground',NULL);
INSERT INTO ofType VALUES (28,'Ground',NULL);
INSERT INTO ofType VALUES (29,'Poison',NULL);
INSERT INTO ofType VALUES (30,'Poison',NULL);
INSERT INTO ofType VALUES (31,'Poison','Ground');
INSERT INTO ofType VALUES (32,'Poison',NULL);
INSERT INTO ofType VALUES (33,'Poison',NULL);
INSERT INTO ofType VALUES (34,'Poison','Ground');
INSERT INTO ofType VALUES (35,'Fairy',NULL);
INSERT INTO ofType VALUES (36,'Fairy',NULL);
INSERT INTO ofType VALUES (37,'Fire',NULL);
INSERT INTO ofType VALUES (38,'Fire',NULL);
INSERT INTO ofType VALUES (39,'Normal','Fairy');
INSERT INTO ofType VALUES (40,'Normal','Fairy');
INSERT INTO ofType VALUES (41,'Poison','Flying');
INSERT INTO ofType VALUES (42,'Poison','Flying');
INSERT INTO ofType VALUES (43,'Grass','Poison');
INSERT INTO ofType VALUES (44,'Grass','Poison');
INSERT INTO ofType VALUES (45,'Grass','Poison');
INSERT INTO ofType VALUES (46,'Bug','Grass');
INSERT INTO ofType VALUES (47,'Bug','Grass');
INSERT INTO ofType VALUES (48,'Bug','Poison');
INSERT INTO ofType VALUES (49,'Bug','Poison');
INSERT INTO ofType VALUES (50,'Ground',NULL);
INSERT INTO ofType VALUES (51,'Ground',NULL);
INSERT INTO ofType VALUES (52,'Normal',NULL);
INSERT INTO ofType VALUES (53,'Normal',NULL);
INSERT INTO ofType VALUES (54,'Water',NULL);
INSERT INTO ofType VALUES (55,'Water',NULL);
INSERT INTO ofType VALUES (56,'Fighting',NULL);
INSERT INTO ofType VALUES (57,'Fighting',NULL);
INSERT INTO ofType VALUES (58,'Fire',NULL);
INSERT INTO ofType VALUES (59,'Fire',NULL);
INSERT INTO ofType VALUES (60,'Water',NULL);
INSERT INTO ofType VALUES (61,'Water',NULL);
INSERT INTO ofType VALUES (62,'Water','Fighting');
INSERT INTO ofType VALUES (63,'Psychic',NULL);
INSERT INTO ofType VALUES (64,'Psychic',NULL);
INSERT INTO ofType VALUES (65,'Psychic',NULL);


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
INSERT INTO EvolvesInto VALUES (1,2);
INSERT INTO EvolvesInto VALUES (2,3);
INSERT INTO EvolvesInto VALUES (4,5);
INSERT INTO EvolvesInto VALUES (5,6);
INSERT INTO EvolvesInto VALUES (7,8);
INSERT INTO EvolvesInto VALUES (8,9);
INSERT INTO EvolvesInto VALUES (10,11);
INSERT INTO EvolvesInto VALUES (11,12);
INSERT INTO EvolvesInto VALUES (13,14);
INSERT INTO EvolvesInto VALUES (14,15);
INSERT INTO EvolvesInto VALUES (16,17);
INSERT INTO EvolvesInto VALUES (17,18);
INSERT INTO EvolvesInto VALUES (19,20);
INSERT INTO EvolvesInto VALUES (21,22);
INSERT INTO EvolvesInto VALUES (23,24);
INSERT INTO EvolvesInto VALUES (25,26);
INSERT INTO EvolvesInto VALUES (27,28);
INSERT INTO EvolvesInto VALUES (29,30);
INSERT INTO EvolvesInto VALUES (30,31);
INSERT INTO EvolvesInto VALUES (32,33);
INSERT INTO EvolvesInto VALUES (33,34);
INSERT INTO EvolvesInto VALUES (35,36);
INSERT INTO EvolvesInto VALUES (37,38);
INSERT INTO EvolvesInto VALUES (39,40);
INSERT INTO EvolvesInto VALUES (41,42);
INSERT INTO EvolvesInto VALUES (43,44);
INSERT INTO EvolvesInto VALUES (44,45);
INSERT INTO EvolvesInto VALUES (46,47);
INSERT INTO EvolvesInto VALUES (47,48);
INSERT INTO EvolvesInto VALUES (48,49);
INSERT INTO EvolvesInto VALUES (50,51);
INSERT INTO EvolvesInto VALUES (52,53);
INSERT INTO EvolvesInto VALUES (54,55);
INSERT INTO EvolvesInto VALUES (56,57);
INSERT INTO EvolvesInto VALUES (58,59);
INSERT INTO EvolvesInto VALUES (60,61);
INSERT INTO EvolvesInto VALUES (61,62);
INSERT INTO EvolvesInto VALUES (63,64);
INSERT INTO EvolvesInto VALUES (64,65);


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