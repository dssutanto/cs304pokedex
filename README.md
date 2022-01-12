<h1>Introduction</h1>
![ERD diagram](./Pokedex_ERD.drawio.png?raw=true)
<p>This Pokédex clone was my term project for CS 304: "Introduction to Databases" originally using an <strong>OracleSQL</strong> database to simulate a Pokédex. As of January 2022 the Pokédex uses <strong>MySQL</strong>."
<h1>Setting up the database</h1>
<p>Clone this repository to your desktop and enter the details of your development server of choice to <code>credentials.php</code> making sure beforehand your server can run MySQL. Import <code>pokedex.sql</code> to your MySQL database and execute <code>index.php</code>.</p>
<h1>Using the Pokédex</h1>
![Pokédex in action](./55adcf9bb05ef238b106d2123156b23c.gif?raw=true)
<p>Run the application in your web browser to access the Pokédex GUI. From here you can view and filter the database or manipulate your own collection of Pokédex by "catching", "renaming" or "releasing" them. Changes to this collection set will persist until the development server is terminated. You can also see the changes to your collection for yourself by checking the "Pokemon" table from your administrator view.</p>
<h1>Future plans</h1>
<p>I intend to further develop this application by containerizing it and scripting one-click deployment options to cloud servers like AWS or Azure. In the longer term I may also migrate the project to Laravel or a similar framework for a more structured application architecture.</p>