<h1>Introduction</h1>
<p><img src="./Pokedex_ERD.drawio.png?raw=true" alt="Project ERD diagram"/></p>
<p>This was my term project for CS 304: "Introduction to Databases". This project consists of a PHP file and SQL database. The project was deployed to a server on the Oracle Cloud service made available for use by UBC students.</p>
<h1>Usage</h1>
<h2>Setting up the database</h2>
<p>This project <em>must</em> be run in an Oracle environment. As <code>project.php</code> makes queries of data stored inside <code>pokedex.sql</code>, ensure that you have imported this file to a live Oracle server that you've permission to access. Then update the data in <code>credentials.php</code>.</p>
<h2>Executing the project</h2>
<p>Open your computer's command terminal and <code>cd</code> to this project's directory/where <code>project.php</code> is stored. Enter <code>php -S localhost:8000/project.php</code> to execute the project.</p>
<p><img src="./55adcf9bb05ef238b106d2123156b23c.gif?raw=true" alt="The Pokédex in action"/><p>
<p>On successful execution your terminal will inform you that the development server for <code>localhost:8000/project.php</code> has started. Open this address in your web browser and you will be able to access the data in <code>pokedex.sql</code> through the GUI which appears. From here you can view the Pokémon in the world. Make sure to click "Reset tables" on startup. Filter the Pokémon by name, ID, types, and abilities and compare them to other Pokémon. Or catch as many Pokémon as you like and similarly sort and organize through your collection as you please. When you have finished press <code>ctrl + C </code> into your command terminal to end the development server.</p>
