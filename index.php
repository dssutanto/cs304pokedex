<html>

<head>
  <title>Pokedex</title>
  <link href="https://fonts.googleapis.com/css?family=Rajdhani:300,400,600,800|Roboto:400,600" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', Arial;
      font-size: 12px;
      font-weight: '400';
      padding: 20px 30px;
      position: relative;
      line-height: 100%;
      background: #fff;
    }

    #wrapper {
      position: relative;
      width: 100vw - 60px;
      padding: 0px 30px;
    }

    h1 {
      text-align: left;
      font-family: 'Rajdhani', Arial;
      text-transform: uppercase;
      font-weight: 800;
      letter-spacing: 2px;
      font-size: 50px;
      margin-bottom: 5px;
      padding-bottom: 5px;
      margin-top: 0px;
      border-bottom: 2px solid #333;
      line-height: 100%;
    }

    h2 {
      font-family: 'Rajdhani', Arial;
      text-transform: uppercase;
      font-weight: 600;
      background: #333;
      padding: 10px 0px 10px 20px;
      color: #fff;
      letter-spacing: 1px;
      clip-path: polygon(0% 0, 100% 0%, 97% 100%, 0% 100%);
    }

    h4 {
      margin: 5px 0px;
      font-family: 'Rajdhani', Arial;
      text-transform: uppercase;
      font-weight: 600;
      font-size: 16px;
      letter-spacing: 1px;
    }

    input[type=submit],
    input[type=reset],
    input[type=button] {
      background: #444;
      font-size: 16px;
      padding: 3px 8px;
      color: #fff;
      font-family: 'Rajdhani', Arial;
      font-weight: 600;
      text-transform: uppercase;
      border: none;
      transition: all 0.3s ease-in-out;
      border: 2px solid #fff;
      letter-spacing: 1px;
    }

    input[type=submit]:hover,
    input[type=reset]:hover,
    input[type=button]:hover {
      background: #BA1200;
    }

    input[type=text] {
      padding: 10px, 20px;
      font-family: 'Roboto', Arial;
      font-weight: 400;
      border: 1px solid #ccc;
    }

    footer {
      font-size: 10px;
      text-align: center;
      width: 100%;
      line-height: 100%;
      position: absolute;
      bottom: 0px;
      padding-top: 20px;
      margin: 0px;
    }

    .inline {
      display: flex;
      align-items: center;
      flex-wrap: wrap;
    }

    .inline form {
      margin: 2px;
    }

    .typefilter input {
      font-size: 16px;
      padding: 3px 8px;
      letter-spacing: 1px;
      text-shadow: 1px 1px 0px rgba(0, 0, 0, 0.5);
    }

    .typefilter input[type=submit]:hover,
    input[type=reset]:hover,
    input[type=button]:hover {
      border: 2px solid #222;
    }

    form {
      margin: 3px;
    }

    .left {
      width: 34%;
      height: 100%;
      position: absolute;
      top: 0px;
      left: 0px;
    }

    .right {
      width: 64%;
      height: 100%;
      position: absolute;
      top: 0px;
      right: 0;
      font-size: 16px;
    }

    .right table {
      font-size: 20px;
    }

    .right th {
      background-color: #333;
      color: #fff;
    }

    .right th:hover {
      background-color: #BA1200;
    }

    .right tr:hover {
      background-color: #ccc;
    }

    .right td,
    .right th {
      padding: 8px;
    }
    
  </style>
</head>

<body>
  <div id="wrapper">
    <div class="left">
      <h1>CS304 POKEMON DATABASE</h1>
      <!-- <h2>Database settings</h2> -->

      <!-- <p>If you wish to reset the table press on the reset button. If this is the first time you're running this page, you MUST use reset</p>

      <div class="inline">
        <form method="POST" action="index.php">
          <input type="hidden" id="resetTablesRequest" name="resetTablesRequest">
          <input type="submit" value="Reset Tables" name="reset">
        </form> -->

      <!-- <form method="GET" action="index.php"> -->
        <!-- <input type="hidden" id="connectRequest" name="connectRequest"> -->
        <!-- <input type="submit" value="Retry connection" name="connect"> -->
      <!-- </form> -->

      <!-- <form method="GET" action="index.php">
        <input type="hidden" id="disconnectRequest" name="disconnectRequest">
        <input type="submit" value="Disconnect" name="disconnect">
      </form> -->

      <h2>Pokedex Queries</h2>

      <h4>Filter By Type</h4>
      <div class="inline typefilter">

        <!-- filter by type -->

        <form method="GET" action="index.php">
          <input type="hidden" id="getNormalPokemon" name="getNormalPokemon">
          <input type="submit" value="Normal" name="getNormal" style="background:#D9CF9B;">
        </form>

        <form method="GET" action="index.php">
          <input type="hidden" id="getGrassPokemon" name="getGrassPokemon">
          <input type="submit" value="Grass" name="getGrass" style="background:#51BE5D;">
        </form>

        <form method="GET" action="index.php">
          <input type="hidden" id="getFirePokemon" name="getFirePokemon">
          <input type="submit" value="Fire" name="getFire" style="background:#EE6600;">
        </form>

        <form method="GET" action="index.php">
          <input type="hidden" id="getWaterPokemon" name="getWaterPokemon">
          <input type="submit" value="Water" name="getWater" style="background:#4C95E9;">
        </form>

        <form method="GET" action="index.php">
          <input type="hidden" id="getGroundPokemon" name="getGroundPokemon">
          <input type="submit" value="Ground" name="getGround" style="background:#857156;">
        </form>

        <form method="GET" action="index.php">
          <input type="hidden" id="getFlyingPokemon" name="getFlyingPokemon">
          <input type="submit" value="Flying" name="getFlying" style="background:#D6C8EF;">
        </form>

        <form method="GET" action="index.php">
          <input type="hidden" id="getPoisonPokemon" name="getPoisonPokemon">
          <input type="submit" value="Poison" name="getPoison" style="background:#66479F;">
        </form>

        <form method="GET" action="index.php">
          <input type="hidden" id="getFightingPokemon" name="getFightingPokemon">
          <input type="submit" value="Fighting" name="getFighting" style="background:#CA2C2C;">
        </form>

        <form method="GET" action="index.php">
          <input type="hidden" id="getBugPokemon" name="getBugPokemon">
          <input type="submit" value="Bug" name="getBug" style="background:#71EE56;">
        </form>

        <form method="GET" action="index.php">
          <input type="hidden" id="getElectricPokemon" name="getElectricPokemon">
          <input type="submit" value="Electric" name="getElectric" style="background:#E3D236;">
        </form>

        <form method="GET" action="index.php">
          <input type="hidden" id="getPsychicPokemon" name="getPsychicPokemon">
          <input type="submit" value="Psychic" name="getPsychic" style="background:#F6BCF6;">
        </form>

        <form method="GET" action="index.php">
          <input type="hidden" id="getFairyPokemon" name="getFairyPokemon">
          <input type="submit" value="Fairy" name="getFairy" style="background:#F6BCBC;">
        </form>
      </div>

      <h4>Other Queries</h4>
      <div class="inline">
        <form method="POST" action="index.php">
          <input type="hidden" id="searchPokemonRequest" name="searchPokemonRequest">
          <input type="submit" value="Search Pokemon by Name" name="searchSubmit">
          <input type="text" name="pname" placeholder="Enter species name of Pokemon">
        </form>
      </div>

      <div class="inline">
        <form method="POST" action="index.php">
          <input type="hidden" id="searchIDRequest" name="searchIDRequest">
          <input type="submit" value="Search Pokemon by ID" name="searchIDSubmit">
          <input type="text" name="pid" placeholder="Enter id number of Pokemon">
        </form>

        <form method="POST" action="index.php">
          <input type="hidden" id="showPokemonNotWeakAgainstRequest" name="showPokemonNotWeakAgainstRequest">
          <input type="submit" value="All Pokemon that are not weak to this type" name="showPokemonNotWeakAgainstSubmit">
          <input type="text" name="numTypes" placeholder="Enter type">
        </form>

        <form method="GET" action="index.php">
          <input type="hidden" id="displayMegaEvolutions" name="displayMegaEvolutionsRequest">
          <input type="submit" value="Display Mega Evolutions" name="displayMegaEvolutions">
        </form>

        <form method="GET" action="index.php">
          <input type="hidden" id="displayEvolutions" name="displayEvolutionsRequest">
          <input type="submit" value="Display Evolutions" name="displayEvolutions">
        </form>
      </div>

      <h2>Manage Your Pokemon</h2>

      <div class="inline">

        <!-- generate pokemon -->
        <form method="POST" action="index.php">
          <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
          <!-- Number: <input type="text" name="insNo"> <br /><br />
            Name: <input type="text" name="insName"> <br /><br /> -->

          <input type="submit" value="Generate Pokemon" name="insertSubmit">
        </form>

        <!-- display pokemon -->
        <form method="GET" action="index.php">
          <input type="hidden" id="displayPokemon" name="displayPokemonRequest">
          <input type="submit" value="Display Pokemon" name="displayPokemon">
        </form>

        <!-- show pokemon stats -->
        <form method="GET" action="index.php">
          <input type="hidden" id="statPokemon" name="statPokemonRequest">
          <input type="submit" value="Show Pokemon Stats" name="statPokemon">
        </form>
      </div>

      <!-- show pokemon -->
      <form method="POST" action="index.php">
        <input type="hidden" id="showPokemonRequest" name="showPokemonRequest">
        <input type="submit" value="Show Pokemon" name="showSubmit">
        <input type="text" name="spid" placeholder="Enter OwnedID of Pokemon to Check">
      </form>

      <!-- sort by -->
      <form method="POST" action="index.php">
        <input type="hidden" id="sortPokemonRequest" name="sortPokemonRequest">
        <label for="sortBy">Sort by</label>
        <select id="sortBy" name="sortBy">
          <option id="spid" value="spid">Species ID</option>
          <option id="nickname" value="nickname">Nickname</option>
          <option id="date" value="date">Day caught</option>
          <option id="hp" value="hp">HP</option>
          <option id="atk" value="atk">Attack</option>
          <option id="def" value="def">Defence</option>
          <option id="spatk" value="spatk">Special attack</option>
          <option id="spdef" value="spdef">Special defence</option>
          <option id="speed" value="speed">Speed</option>
        </select>
        <label for="order">from</label>
        <select id="order" name="order">
          <option id="asc" value="asc">Smallest to biggest</option>
          <option id="desc" value="desc">Biggest to smallest</option>
        </select>
        <input type="submit" value="Sort" name="sortPokemon">
      </form>

      <!-- group by -->
      <form method="POST" action="index.php">
        <input type="hidden" id="groupPokemonRequest" name="groupPokemonRequest">
        <label for="groupBy">See aggregates for</label>
        <select id="groupBy" name="groupBy">
          <option id="spid" value="spid">Species</option>
          <option id="date" value="date">Days caught</option>
          <option id="gender" value="gender">Gender</option>
        </select>
        <label for="having">with at least</label>
        <input type="number" id="having" name="having" value="1" min="1" max="99">
        <label>Pokemon</label>
        <input type="submit" value="View" name="groupPokemon">
      </form>

      <form method="GET" action="index.php">
        <input type="hidden" id="aggrPokemonRequest" name="aggrPokemonRequest">
        <label>Get the most common gender by Pokemon ID</label>
        <input type="submit" value="Show" name="aggrPokemon">
      </form>

      <!-- release pokemon -->
      <form method="POST" action="index.php">
        <input type="hidden" id="releasePokemonRequest" name="releasePokemonRequest">
        <input type="submit" value="Release Pokemon" name="releaseSubmit">
        <input type="text" name="ridID" placeholder="Enter OwnedID of Pokemon to Release">
      </form>

      <!-- change pokemon nickname -->
      <form method="POST" action="index.php">
        <input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
        <input type="submit" value="Change Pokemon Nickname" name="updateSubmit">
        <input type="text" name="nidID" placeholder="Enter OwnedID of Pokemon">
        <input type="text" name="newName" placeholder="Enter new nickname for Pokemon">
      </form>

      <!-- check Weakness -->
      <form method="POST" action="index.php">
        <input type="hidden" id="checkWeaknessRequest" name="checkWeaknessRequest">
        <input type="submit" value="Check Weaknesses" name="checkWeakSubmit">
        <input type="text" name="cwid" placeholder="Enter OwnedID of Pokemon">
      </form>
    </div>
    <div class="right">
      <h2>Results</h2>
      <?php
      include 'project.php';
      global $db;
      $db = connectToDB();

      // if ($db instanceof mysqli) {
      //   echo "Connection successful";
      // }

      // HANDLE ALL POST ROUTES
      // A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
      function handlePOSTRequest()
      {
        global $db;
        if ($db instanceof mysqli) {
          /* if (array_key_exists('resetTablesRequest', $_POST)) {
              handleResetRequest($db);
            } else */
          if (array_key_exists('updateQueryRequest', $_POST)) {
            handleUpdateRequest($db, $_POST['nidID'], $_POST['newName']);
          } else if (array_key_exists('insertQueryRequest', $_POST)) {
            handleInsertRequest($db);
          } else if (array_key_exists('releasePokemonRequest', $_POST)) {
            releasePokemon($db, $_POST['ridID']);
          } else if (array_key_exists('searchPokemonRequest', $_POST)) {
            searchPokemon($db, $_POST['pname']);
          } else if (array_key_exists('searchIDRequest', $_POST)) {
            searchID($db, $_POST['pid']);
          } else if (array_key_exists('checkWeaknessRequest', $_POST)) {
            checkWeak($db, $_POST['cwid']);
          } else if (array_key_exists('showPokemonRequest', $_POST)) {
            showThisPokemon($db, $_POST['spid']);
          } else if (array_key_exists('sortPokemonRequest', $_POST)) {
            sortPokemonBy($db, $_POST['sortBy'], $_POST['order']);
          } else if (array_key_exists('groupPokemonRequest', $_POST)) {
            groupPokemonBy($db, $_POST['groupBy'], $_POST['having']);
          } else if (array_key_exists('showPokemonNotWeakAgainstRequest', $_POST)) {
            showPokemonNotWeakAgainst($db, $_POST['numTypes']);
          } else echo "Invalid request";
        } else echo "Connection error";
      }

      // HANDLE ALL GET ROUTES
      // A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
      function handleGETRequest()
      {
        global $db;
        if ($db instanceof mysqli) {
          if (array_key_exists('displayPokemon', $_GET)) {
            displayPokemon($db);
          } else if (array_key_exists('statPokemon', $_GET)) {
            showStats($db);
          } else if (array_key_exists('aggrPokemon', $_GET)) {
            aggregateStats($db);
          } else if (array_key_exists('getNormal', $_GET)) {
            getElem($db, "Normal");
          } else if (array_key_exists('getGrass', $_GET)) {
            getElem($db, "Grass");
          } else if (array_key_exists('getFire', $_GET)) {
            getElem($db, "Fire");
          } else if (array_key_exists('getWater', $_GET)) {
            getElem($db, "Water");
          } else if (array_key_exists('getGround', $_GET)) {
            getElem($db, "Ground");
          } else if (array_key_exists('getFlying', $_GET)) {
            getElem($db, "Flying");
          } else if (array_key_exists('getPoison', $_GET)) {
            getElem($db, "Poison");
          } else if (array_key_exists('getFighting', $_GET)) {
            getElem($db, "Fighting");
          } else if (array_key_exists('getBug', $_GET)) {
            getElem($db, "Bug");
          } else if (array_key_exists('getElectric', $_GET)) {
            getElem($db, "Electric");
          } else if (array_key_exists('getPsychic', $_GET)) {
            getElem($db, "Psychic");
          } else if (array_key_exists('getFairy', $_GET)) {
            getElem($db, "Fairy");
          } else if (array_key_exists('displayMegaEvolutions', $_GET)) {
            displayMegaEvolutions($db);
          } else if (array_key_exists('displayEvolutions', $_GET)) {
            displayEvolutions($db);
          } else if (array_key_exists('disconnect', $_GET)) {
            disconnectFromDB($db);
          }
        } else echo "Connection error";
      }

      if (
        /* isset($_POST['reset']) || */
        isset($_POST['updateSubmit']) || isset($_POST['insertSubmit']) || isset($_POST['releaseSubmit']) || isset($_POST['searchSubmit']) ||
        isset($_POST['searchIDSubmit']) || isset($_POST['checkWeakSubmit']) || isset($_POST['showSubmit']) || isset($_POST['sortPokemon']) || isset($_POST['groupPokemon']) ||
        isset($_POST['showPokemonNotWeakAgainstSubmit'])
      ) {
        handlePOSTRequest();
      } else if (
        isset($_GET['showTupleRequest']) || isset($_GET['displayPokemonRequest']) || isset($_GET['statPokemonRequest']) ||
        isset($_GET['displayEvolutionsRequest']) || isset($_GET['displayMegaEvolutionsRequest']) || isset($_GET['aggrPokemonRequest']) || isset($_GET['getNormalPokemon']) ||
        isset($_GET['getGrassPokemon']) || isset($_GET['getFirePokemon']) || isset($_GET['getWaterPokemon']) || isset($_GET['getGroundPokemon']) || isset($_GET['getFlyingPokemon']) ||
        isset($_GET['getPoisonPokemon']) || isset($_GET['getFightingPokemon']) || isset($_GET['getBugPokemon']) || isset($_GET['getElectricPokemon']) ||
        isset($_GET['getPsychicPokemon']) || isset($_GET['getFairyPokemon']) || isset($_GET['disconnectRequest'])
      ) {
        handleGETRequest();
      }
      ?>
    </div>
  </div>
</body>

</html>