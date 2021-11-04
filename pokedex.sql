DROP TABLE Item;
DROP TABLE Evo Item;
DROP TABLE Status_Item;
DROP TABLE uses;
DROP TABLE requires;

-- Item Table
CREATE TABLE Item (
    ItemName:			VARCHAR(20),
    Quantity:			INTEGER,
    PRIMARY KEY (ItemName));

-- Evo Item Table
CREATE TABLE Evo Item (
	ItemName:			VARCHAR(20),
	Use:				VARCHAR(20),
    FOREIGN KEY (ItemName) REFERENCES Item);

-- Status Item Table
CREATE TABLE Status_Item (
	ItemName:			VARCHAR(20),
	Status_Effect:			VARCHAR(20),
FOREIGN KEY (ItemName) REFERENCES Item);

-- uses Table
CREATE TABLE uses (
	TimeCaught:			DATETIME,
	ItemName:			VARCHAR(20),
	PRIMARY KEY (TimeCaught, ItemName),
	FOREIGN KEY (TimeCaught) REFERENCES Pokemon);

-- requires Table
CREATE TABLE requires (
	Mega Stone:			VARCHAR(20),
	MeName:			    VARCHAR(20),
	PRIMARY KEY (Mega Stone, MeName),
	FOREIGN KEY (MeName) REFERENCES Mega Evolution;

-- insert into Evo Item Table
INSERT INTO Evo Item VALUES ('Sun Stone', 'Bag');
INSERT INTO Evo Item VALUES ('Moon Stone', 'Bag');
INSERT INTO Evo Item VALUES ('Fire Stone', 'Bag');
INSERT INTO Evo Item VALUES ('Dawn Stone', 'Bag');
INSERT INTO Evo Item VALUES ('Shiny Stone', 'Bag');
INSERT INTO Evo Item VALUES ('Dusk Stone', 'Bag');
INSERT INTO Evo Item VALUES ('Ice Stone', 'Bag');
INSERT INTO Evo Item VALUES ('Leaf Stone', 'Bag');
INSERT INTO Evo Item VALUES ('Thunder Stone', 'Bag');
INSERT INTO Evo Item VALUES ('Water Stone', 'Bag');
INSERT INTO Evo Item VALUES ('Chipped Pot', 'Bag');
INSERT INTO Evo Item VALUES ('Cracked Pot', 'Bag');
INSERT INTO Evo Item VALUES ('Galarica Cuff', 'Bag');
INSERT INTO Evo Item VALUES ('Galarica Wreath', 'Bag');
INSERT INTO Evo Item VALUES ('Sweet Apple', 'Bag');
INSERT INTO Evo Item VALUES ('Tart Apple', 'Bag');
INSERT INTO Evo Item VALUES ('Abomasite', 'Held');
INSERT INTO Evo Item VALUES ('Absolite', 'Held');
INSERT INTO Evo Item VALUES ('Aerodactylite', 'Held');
INSERT INTO Evo Item VALUES ('Aggronite', 'Held');
INSERT INTO Evo Item VALUES ('Alakazite', 'Held');
INSERT INTO Evo Item VALUES ('Altarianite', 'Held');
INSERT INTO Evo Item VALUES ('Ampharosite', 'Held');
INSERT INTO Evo Item VALUES ('Audinite', 'Held');
INSERT INTO Evo Item VALUES ('Banettite', 'Held');
INSERT INTO Evo Item VALUES ('Beedrillite', 'Held');
INSERT INTO Evo Item VALUES ('Blastoisinite', 'Held');
INSERT INTO Evo Item VALUES ('Blazikenite', 'Held');
INSERT INTO Evo Item VALUES ('Cameruptite', 'Held');
INSERT INTO Evo Item VALUES ('Charizardite X', 'Held');
INSERT INTO Evo Item VALUES ('Charizardite Y', 'Held');
INSERT INTO Evo Item VALUES ('Diancite', 'Held');
INSERT INTO Evo Item VALUES ('Galladite', 'Held');
INSERT INTO Evo Item VALUES ('Garchompite', 'Held');
INSERT INTO Evo Item VALUES ('Gardevoirite', 'Held');
INSERT INTO Evo Item VALUES ('Gengarite', 'Held');
INSERT INTO Evo Item VALUES ('Glalitite', 'Held');
INSERT INTO Evo Item VALUES ('Gyaradosite', 'Held');
INSERT INTO Evo Item VALUES ('Heracronite', 'Held');
INSERT INTO Evo Item VALUES ('Houndoominite', 'Held');
INSERT INTO Evo Item VALUES ('Kangaskhanite', 'Held');
INSERT INTO Evo Item VALUES ('Latiasite', 'Held');
INSERT INTO Evo Item VALUES ('Latiosite', 'Held');
INSERT INTO Evo Item VALUES ('Lopunnite', 'Held');
INSERT INTO Evo Item VALUES ('Lucarionite', 'Held');
INSERT INTO Evo Item VALUES ('Manectite', 'Held');
INSERT INTO Evo Item VALUES ('Mawilite', 'Held');
INSERT INTO Evo Item VALUES ('Medichamite', 'Held');
INSERT INTO Evo Item VALUES ('Metagrossite', 'Held');
INSERT INTO Evo Item VALUES ('Mewtwonite X', 'Held');
INSERT INTO Evo Item VALUES ('Mewtwonite Y', 'Held');
INSERT INTO Evo Item VALUES ('Pidgeotite', 'Held');
INSERT INTO Evo Item VALUES ('Pinsirite	', 'Held');
INSERT INTO Evo Item VALUES ('Sablenite', 'Held');
INSERT INTO Evo Item VALUES ('Salamencite', 'Held');
INSERT INTO Evo Item VALUES ('Sceptilite', 'Held');
INSERT INTO Evo Item VALUES ('Scizorite', 'Held');
INSERT INTO Evo Item VALUES ('Sharpedonite', 'Held');
INSERT INTO Evo Item VALUES ('Slowbronite', 'Held');
INSERT INTO Evo Item VALUES ('Steelixite', 'Held');
INSERT INTO Evo Item VALUES ('Swampertite', 'Held');
INSERT INTO Evo Item VALUES ('Tyranitarite', 'Held');
INSERT INTO Evo Item VALUES ('Venusaurite', 'Held');
INSERT INTO Evo Item VALUES ('Deep Sea Scale', 'Held');
INSERT INTO Evo Item VALUES ('Deep Sea Tooth', 'Held');
INSERT INTO Evo Item VALUES ('Dragon Scale', 'Held');
INSERT INTO Evo Item VALUES ('Dubious Disc', 'Held');
INSERT INTO Evo Item VALUES ('Electirizer', 'Held');
INSERT INTO Evo Item VALUES ('King''s Rock', 'Held');
INSERT INTO Evo Item VALUES ('Magamarizer', 'Held');
INSERT INTO Evo Item VALUES ('Metal Coat', 'Held');
INSERT INTO Evo Item VALUES ('Oval Stone', 'Held');
INSERT INTO Evo Item VALUES ('Prism Scale', 'Held');
INSERT INTO Evo Item VALUES ('Protector', 'Held');
INSERT INTO Evo Item VALUES ('Razor Claw', 'Held');
INSERT INTO Evo Item VALUES ('Razor Fang', 'Held');
INSERT INTO Evo Item VALUES ('Reaper Cloth', 'Held');
INSERT INTO Evo Item VALUES ('Satchet', 'Held');
INSERT INTO Evo Item VALUES ('Upgrade', 'Held');
INSERT INTO Evo Item VALUES ('Whipped Dream', 'Held');

-- insert into Status_Item table
INSERT INTO Status_Item VALUES('Antidote', 'Poison');
INSERT INTO Status_Item VALUES('Burn Heal', 'Burn');
INSERT INTO Status_Item VALUES('Elixir', 'PP');
INSERT INTO Status_Item VALUES('Ether', 'PP');
INSERT INTO Status_Item VALUES('Full Heal', 'Statuses');
INSERT INTO Status_Item VALUES('Full Restore', 'HP & Statuses');
INSERT INTO Status_Item VALUES('Hyper Potion', 'HP');
INSERT INTO Status_Item VALUES('Ice Heal', 'Freeze');
INSERT INTO Status_Item VALUES('Max Elixir', 'PP');
INSERT INTO Status_Item VALUES('Max Ether', 'PP');
INSERT INTO Status_Item VALUES('Max Revive', 'Fainted & HP');
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


-- insert into Item Table
INSERT INTO Item VALUES('Amulet Coin', '1');  
INSERT INTO Item VALUES('Red Orb', '1');
INSERT INTO Item VALUES('Blue Orb', '1');
INSERT INTO Item VALUES('Draco Plate', '1');  
INSERT INTO Item VALUES('Dread Plate', '1');      
INSERT INTO Item VALUES('Earth Plate', '1');  
INSERT INTO Item VALUES('Fist Plate', '1');  
INSERT INTO Item VALUES('Flame Plate', '1');  
INSERT INTO Item VALUES('Icicle Plate', '1');  
INSERT INTO Item VALUES('Insect Plate', '1'); 
INSERT INTO Item VALUES('Iron Plate', '1');  
INSERT INTO Item VALUES('Meadow Plate', '1');   
INSERT INTO Item VALUES('Mind Plate', '1');  
INSERT INTO Item VALUES('Pixie Plate', '1');  
INSERT INTO Item VALUES('Sky Plate', '1');  
INSERT INTO Item VALUES('Splash Plate', '1');  
INSERT INTO Item VALUES('Spooky Plate', '1');  
INSERT INTO Item VALUES('Stone Plate', '1');  
INSERT INTO Item VALUES('Toxic Plate', '1');
INSERT INTO Item VALUES('Zap Plate', '1');  
INSERT INTO Item VALUES('Power Anklet', '1');  
INSERT INTO Item VALUES('Power Band', '1');  
INSERT INTO Item VALUES('Power Lens', '1');  
INSERT INTO Item VALUES('Power Belt', '1');  
INSERT INTO Item VALUES('Power Band', '1');  
INSERT INTO Item VALUES('Power Bracer', '1');  
INSERT INTO Item VALUES('Power Weight', '1');  


-- insert into uses Table
INSERT INTO uses VALUES('2020-01-01 10:10:10', 'Full Heal');  
INSERT INTO uses VALUES('2020-01-01 10:20:10', 'Magmarizer');  
INSERT INTO uses VALUES('2020-01-01 10:30:10', 'Power Band');  
INSERT INTO uses VALUES('2020-01-01 10:40:10', 'Sun Stone');  
INSERT INTO uses VALUES('2020-01-01 10:50:10', 'Pecha Berry');  
INSERT INTO uses VALUES('2020-01-01 11:00:10', 'Oran Berry');  
INSERT INTO uses VALUES('2020-01-01 11:10:10', 'Flame Plate');  

-- insert into requires Table
INSERT INTO requires VALUES('Abomasite', 'Mega Abomasnow');
INSERT INTO requires VALUES('Absolite', 'Mega Absol');
INSERT INTO requires VALUES('Aerodactylite', 'Mega Aerodactyl');
INSERT INTO requires VALUES('Aggronite', 'Mega Aggron');
INSERT INTO requires VALUES('Alakazite', 'Mega Alakazam');
INSERT INTO requires VALUES('Altarianite', 'Mega Altaria');
INSERT INTO requires VALUES('Ampharosite', 'Mega Ampharosite');
INSERT INTO requires VALUES('Audinite', 'Mega Audino');
INSERT INTO requires VALUES('Banettite', 'Mega Banette');
INSERT INTO requires VALUES('Beedrillite', 'Mega Beedrill');
INSERT INTO requires VALUES('Blastoisinite', 'Mega Blastoise');
INSERT INTO requires VALUES('Blazikenite', 'Mega Blaziken');
INSERT INTO requires VALUES('Cameruptite', 'Mega Camerupt');
INSERT INTO requires VALUES('Charizardite X', 'Mega Charizard X');
INSERT INTO requires VALUES('Charizardite Y', 'Mega Charizard Y');
INSERT INTO requires VALUES('Diancite', 'Mega Diancie');
INSERT INTO requires VALUES('Galladite', 'Mega Gallade');
INSERT INTO requires VALUES('Garchompite', 'Mega Garchomp');
INSERT INTO requires VALUES('Gardevoirite', 'Mega Gardevoir');
INSERT INTO requires VALUES('Gengarite', 'Mega Gengar');
INSERT INTO requires VALUES('Glalitite', 'Mega Glalie');
INSERT INTO requires VALUES('Gyaradosite', 'Mega Gyarados');
INSERT INTO requires VALUES('Heracronite', 'Mega Heracross');
INSERT INTO requires VALUES('Houndoominite', 'Mega Houndoom');
INSERT INTO requires VALUES('Kangaskhanite', 'Mega Kangaskhan');
INSERT INTO requires VALUES('Latiasite', 'Mega Latias');
INSERT INTO requires VALUES('Latiosite', 'Mega Latios');
INSERT INTO requires VALUES('Lopunnite', 'Mega Lopunny');
INSERT INTO requires VALUES('Lucarionite', 'Mega Lucarion');
INSERT INTO requires VALUES('Manectite', 'Mega Manectric');
INSERT INTO requires VALUES('Mawilite', 'Mega Mawile');
INSERT INTO requires VALUES('Medichamite', 'Mega Medicham');
INSERT INTO requires VALUES('Metagrossite', 'Mega Metagross');
INSERT INTO requires VALUES('Mewtwonite X', 'Mega Mewtwo X');
INSERT INTO requires VALUES('Mewtwonite Y', 'Mega Mewtwo Y');
INSERT INTO requires VALUES('Pidgeotite', 'Mega Pidgeot');
INSERT INTO requires VALUES('Pinsirite', 'Mega Pinsir');
INSERT INTO requires VALUES('Sablenite', 'Mega Sableye');
INSERT INTO requires VALUES('Salamencite', 'Mega Salamence');
INSERT INTO requires VALUES('Sceptilite', 'Mega Sceptile');
INSERT INTO requires VALUES('Scizorite', 'Mega Scizor');
INSERT INTO requires VALUES('Sharpedonite', 'Mega Sharpedo');
INSERT INTO requires VALUES('Slowbronite', 'Mega Slowbro');
INSERT INTO requires VALUES('Steelixite', 'Mega Steelix');
INSERT INTO requires VALUES('Swampertite', 'Mega Swampert');
INSERT INTO requires VALUES('Tyranitarite', 'Mega Tyranitar');
INSERT INTO requires VALUES('Venusaurite', 'Mega Venusaur');