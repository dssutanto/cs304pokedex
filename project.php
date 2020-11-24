<!-- The script assumes you already have a server set up
  All OCI commands are commands to the Oracle libraries
  To get the file to work, you must place it somewhere where your
  Apache server can run it, and you must rename it to have a ".php"
  extension.  You must also change the username and password on the
  OCILogon below to be your ORACLE username and password -->

<html>

<head>
  <title>Pokedex</title>
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', Arial;
      font-weight: '400';
      padding: 0px;
      margin: 0px;
      position: relative;
      line-height: 100%;
    }

    #wrapper {
      position: relative;
      margin: 30px 30px;
      font-size: 15px;
    }

    h1 {
      text-align: center;
    }

    h2 {}

    h4 {
      margin: 5px 0px;
    }

    input[type=submit],
    input[type=reset],
    input[type=button] {
      background: #444;
      font-size: 12px;
      padding: 3px 8px;
      color: #fff;
      font-family: 'Poppins', Arial;
      font-weight: 600;
      text-transform: uppercase;
      border: none;
      transition: all 0.3s ease-in-out;
      border: 3px solid #fff;
    }

    input[type=submit]:hover,
    input[type=reset]:hover,
    input[type=button]:hover {
      border: 3px solid #222;
    }

    input[type=text] {
      padding: 10px, 20px;
      font-family: 'Poppins', Arial;
      font-weight: 400;
      border: 1px solid #ccc;
    }

    footer {
      font-size: 10px;
      text-align: center;
      width: 100%;
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
      font-size: 12px;
      padding: 3px 8px;
    }

    form {
      margin: 3px;
    }
  </style>
</head>

<body>
  <div id="wrapper">
    <h1>CS304 POKEMON DATABASE</h1>

    <h2>General</h2>
    <p>If you wish to reset the table press on the reset button. If this is the first time you're running this page, you MUST use reset</p>

    <div class="inline">

      <form method="POST" action="project.php">
        <!-- if you want another page to load after the button is clicked, you have to specify that page in the action parameter -->
        <input type="hidden" id="resetTablesRequest" name="resetTablesRequest">
        <input type="submit" value="Reset Tables" name="reset">
      </form>

      <!-- count tuples -->
      <form method="GET" action="project.php">
        <input type="hidden" id="countTupleRequest" name="countTupleRequest">
        <input type="submit" value="Count Tuples In Tables" name="countTuples">
      </form>
    </div>

    <h2>Pokedex Queries</h2>
    <!-- count tuples -->
    <h4>Filter By Type</h4>
    <div class="inline typefilter">

      <!-- filter by type -->

      <form method="GET" action="project.php">
        <input type="hidden" id="getNormalPokemon" name="getNormalPokemon">
        <input type="submit" value="Normal" name="getNormal" style="background:#D9CF9B;">
      </form>

      <form method="GET" action="project.php">
        <input type="hidden" id="getGrassPokemon" name="getGrassPokemon">
        <input type="submit" value="Grass" name="getGrass" style="background:#51BE5D;">
      </form>

      <form method="GET" action="project.php">
        <input type="hidden" id="getFirePokemon" name="getFirePokemon">
        <input type="submit" value="Fire" name="getFire" style="background:#EE6600;">
      </form>

      <form method="GET" action="project.php">
        <input type="hidden" id="getWaterPokemon" name="getWaterPokemon">
        <input type="submit" value="Water" name="getWater" style="background:#4C95E9;">
      </form>

      <form method="GET" action="project.php">
        <input type="hidden" id="getGroundPokemon" name="getGroundPokemon">
        <input type="submit" value="Ground" name="getGround" style="background:#857156;">
      </form>

      <form method="GET" action="project.php">
        <input type="hidden" id="getFlyingPokemon" name="getFlyingPokemon">
        <input type="submit" value="Flying" name="getFlying" style="background:#D6C8EF;">
      </form>

      <form method="GET" action="project.php">
        <input type="hidden" id="getPoisonPokemon" name="getPoisonPokemon">
        <input type="submit" value="Poison" name="getPoison" style="background:#66479F;">
      </form>

      <form method="GET" action="project.php">
        <input type="hidden" id="getFightingPokemon" name="getFightingPokemon">
        <input type="submit" value="Fighting" name="getFighting" style="background:#CA2C2C;">
      </form>

      <form method="GET" action="project.php">
        <input type="hidden" id="getBugPokemon" name="getBugPokemon">
        <input type="submit" value="Bug" name="getBug" style="background:#71EE56;">
      </form>

      <form method="GET" action="project.php">
        <input type="hidden" id="getElectricPokemon" name="getElectricPokemon">
        <input type="submit" value="Electric" name="getElectric" style="background:#E3D236;">
      </form>

      <form method="GET" action="project.php">
        <input type="hidden" id="getPsychicPokemon" name="getPsychicPokemon">
        <input type="submit" value="Psychic" name="getPsychic" style="background:#F6BCF6;">
      </form>

      <form method="GET" action="project.php">
        <input type="hidden" id="getFairyPokemon" name="getFairyPokemon">
        <input type="submit" value="Fairy" name="getFairy" style="background:#F6BCBC;">
      </form>

    </div>

    <h4>Other Queries</h4>
    <div class="inline">
      <form method="POST" action="project.php">
        <input type="hidden" id="searchPokemonRequest" name="searchPokemonRequest">
        <input type="submit" value="Search Pokemon by Name" name="searchSubmit">
        <input type="text" name="pname" placeholder="Enter species name of Pokemon">
      </form>
    </div>

    <div class="inline">
      <form method="POST" action="project.php">
        <input type="hidden" id="searchIDRequest" name="searchIDRequest">
        <input type="submit" value="Search Pokemon by ID" name="searchIDSubmit">
        <input type="text" name="pid" placeholder="Enter id number of Pokemon">
      </form>
    </div>

    <h2>Manage Your Pokemon</h2>
    <div class="inline">

      <!-- generate pokemon -->
      <form method="POST" action="project.php">
        <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
        <!-- Number: <input type="text" name="insNo"> <br /><br />
            Name: <input type="text" name="insName"> <br /><br /> -->

        <input type="submit" value="Generate Pokemon" name="insertSubmit">
      </form>

      <!-- display pokemon -->
      <form method="GET" action="project.php">
        <input type="hidden" id="displayPokemon" name="displayPokemonRequest">
        <input type="submit" value="Display Pokemon" name="displayPokemon">
      </form>
    </div>

    <form method="POST" action="project.php">
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

    <form method="POST" action="project.php">
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

    <form method="GET" action="project.php">
      <input type="hidden" id="aggrPokemonRequest" name="aggrPokemonRequest">
      <label>Get the most common gender by Pokemon</label>
      <input type="submit" value="Show" name="aggrPokemon">
    </form>

    <!-- release pokemon -->
    <form method="POST" action="project.php">
      <input type="hidden" id="releasePokemonRequest" name="releasePokemonRequest">
      <input type="submit" value="Release Pokemon" name="releaseSubmit">
      <input type="text" name="ridID" placeholder="Enter OwnedID of Pokemon to Release">
    </form>

    <!-- change pokemon nickname -->
    <form method="POST" action="project.php">
      <input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
      <input type="submit" value="Change Pokemon Nickname" name="updateSubmit">
      <input type="text" name="nidID" placeholder="Enter OwnedID of Pokemon">
      <input type="text" name="newName" placeholder="Enter new nickname for Pokemon">
    </form>

    <!-- check Weakness -->
    <form method="POST" action="project.php">
      <input type="hidden" id="checkWeaknessRequest" name="checkWeaknessRequest">
      <input type="submit" value="Check Weaknesses" name="checkWeakSubmit">
      <input type="text" name="cwid" placeholder="Enter OwnedID of Pokemon">
    </form>

    <hr />

    <?php
    $ownedID = 0;
    $success = True; //keep track of errors so it redirects the page only if there are no errors
    $db_conn = NULL; // edit the login credentials in connectToDB()
    $show_debug_alert_messages = False; // set to True if you want alerts to show you which methods are being triggered (see how it is used in debugAlertMessage())

    function debugAlertMessage($message)
    {
      global $show_debug_alert_messages;

      if ($show_debug_alert_messages) {
        echo "<script type='text/javascript'>alert('" . $message . "');</script>";
      }
    }

    function executePlainSQL($cmdstr)
    { //takes a plain (no bound variables) SQL command and executes it
      //echo "<br>running ".$cmdstr."<br>";
      global $db_conn, $success;

      $statement = OCIParse($db_conn, $cmdstr);
      //There are a set of comments at the end of the file that describe some of the OCI specific functions and how they work

      if (!$statement) {
        echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
        $e = OCI_Error($db_conn); // For OCIParse errors pass the connection handle
        echo htmlentities($e['message']);
        $success = False;
      }

      $r = OCIExecute($statement, OCI_DEFAULT);
      if (!$r) {
        echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
        $e = oci_error($statement); // For OCIExecute errors pass the statementhandle
        echo htmlentities($e['message']);
        $success = False;
      }

      return $statement;
    }

    function executeBoundSQL($cmdstr, $list)
    {
      /* Sometimes the same statement will be executed several times with different values for the variables involved in the query.
		In this case you don't need to create the statement several times. Bound variables cause a statement to only be
		parsed once and you can reuse the statement. This is also very useful in protecting against SQL injection.
		See the sample code below for how this function is used */

      global $db_conn, $success;
      $statement = OCIParse($db_conn, $cmdstr);

      if (!$statement) {
        echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
        $e = OCI_Error($db_conn);
        echo htmlentities($e['message']);
        $success = False;
      }

      foreach ($list as $tuple) {
        foreach ($tuple as $bind => $val) {
          //echo $val;
          //echo "<br>".$bind."<br>";
          OCIBindByName($statement, $bind, $val);
          unset($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype
        }

        $r = OCIExecute($statement, OCI_DEFAULT);
        if (!$r) {
          echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
          $e = OCI_Error($statement); // For OCIExecute errors, pass the statementhandle
          echo htmlentities($e['message']);
          echo "<br>";
          $success = False;
        }
      }
    }

    function connectToDB()
    {
      global $db_conn;

      // Your username is ora_(CWL_ID) and the password is a(student number). For example,
      // ora_platypus is the username and a12345678 is the password.
      $db_conn = OCILogon("ora_kfoong", "a58380510", "dbhost.students.cs.ubc.ca:1522/stu");

      if ($db_conn) {
        debugAlertMessage("Database is Connected");
        return true;
      } else {
        debugAlertMessage("Cannot connect to Database");
        $e = OCI_Error(); // For OCILogon errors pass no handle
        echo htmlentities($e['message']);
        return false;
      }
    }

    function disconnectFromDB()
    {
      global $db_conn;

      debugAlertMessage("Disconnect from Database");
      OCILogoff($db_conn);
    }

    function handleResetRequest()
    {
      global $db_conn;
      // Drop old tables
      echo ("Resetting...");
      executePlainSQL("DROP TABLE p_uses");
      executePlainSQL("DROP TABLE is_of");
      executePlainSQL("DROP TABLE Pokemon");
      $ownedID = 0;

      echo ("Clearing tables...");
      executePlainSQL("CREATE TABLE Pokemon (
            	ID					INT,
            	Nickname		VARCHAR(255),
            	Gender			VARCHAR(20),
            	TimeCaught		DATE,
            	OwnedID			INT,
            	PRIMARY KEY (OwnedID),
            	FOREIGN KEY (ID) REFERENCES SPECIES
            )");
      executePlainSQL("CREATE TABLE is_of (
            	OwnedID	     	INT,
            	ID						INT,
            	PRIMARY KEY (OwnedID, ID),
            	FOREIGN KEY (OwnedID) REFERENCES Pokemon,
            	FOREIGN KEY (ID) REFERENCES Species
            )");
      executePlainSQL("CREATE TABLE p_uses (
            	OwnedID		    INT,
            	ItemName			VARCHAR(20),
            	PRIMARY KEY (OwnedID, ItemName),
            	FOREIGN KEY (OwnedID) REFERENCES Pokemon
            )");
      // executePlainSQL("DELETE FROM Pokemon");
      // executePlainSQL("DELETE FROM is_of");
      // executePlainSQL("DELETE FROM p_uses");
      echo ("Done!");
      // executePlainSQL("CREATE TABLE statTable (hp int, attack int, spAttack int, defence int, spDefence int, speed int, increase varchar(30), decrease varchar(30))");
      OCICommit($db_conn);
    }

    function handleInsertRequest()
    {
      global $db_conn;

      //Getting the values from user and insert data into the table
      // $tuple = array (
      //     ":bind1" => $_POST['insNo'],
      //     ":bind2" => $_POST['insName']
      // );

      // $alltuples = array (
      //     $tuple
      // );
      //
      $rgen = 'agender';
      $rnum = rand(0, 10) % 2;
      if ($rnum == 0) {
        $rgen = 'male';
      } else {
        $rgen = 'female';
      }
      $randomSpid = executePlainSQL("SELECT id FROM (SELECT id FROM Species ORDER BY DBMS_RANDOM.RANDOM) WHERE ROWNUM = 1");
      $randomSpidResult = OCI_Fetch_Array($randomSpid, OCI_BOTH);
      $randomSpname = executePlainSQL("SELECT SpName FROM Species WHERE id = $randomSpidResult[0]");
      $randomSpnameResult = OCI_Fetch_Array($randomSpname, OCI_BOTH);

      $resultSp = executePlainSQL("SELECT Count(*) FROM Pokemon");
      $row = oci_fetch_row($resultSp);
      $newPokemon = executePlainSQL("INSERT INTO Pokemon VALUES ($randomSpidResult[0],'$randomSpnameResult[0]' , '$rgen', CURRENT_DATE, $row[0])");


      //  $sql = "SELECT id FROM (SELECT id FROM Species ORDER BY DBMS_RANDOM.RANDOM) WHERE ROWNUM = 1";
      // //$rdm = random_int(0,65);
      // //$sql = "SELECT id FROM Species WHERE id=$rdm";
      // $sql_n = "SELECT SpName FROM Species WHERE id=$sql";
      // $stid = oci_parse($db_conn, $sql_n);
      // oci_execute($stid);
      // $nrows = oci_fetch_all($stid, $res);
      // //echo "$nrows fetched<br>";
      // //var_dump($res);
      // $pid = $res['id'];
      echo "You caught a " . $randomSpnameResult[0] . "!";

      OCICommit($db_conn);
    }

    // update nickname -- buggy rn
    function handleUpdateRequest()
    {
      global $db_conn;

      $nid = $_POST['nidID'];
      $new_name = $_POST['newName'];

      if (isset($_POST['nidID']) && is_numeric($nid)) {
        if (isset($_POST['newName'])) {
          $npoke = executePlainSQL("SELECT Nickname, OwnedID FROM Pokemon WHERE OwnedID='" . $nid . "'");
          if (($row = oci_fetch_row($npoke)) != false) {
            $res = executePlainSQL("UPDATE Pokemon SET Nickname='" . $new_name . "' WHERE OwnedID=$row[1]");
            echo $row[0] . "'s nickname was updated to " . $new_name . ".";
          } else {
            echo "Nickname was not specified, no changes were made.";
          }
        } else {
          echo "Invalid OwnedID, no changes were made.";
        }
      }

      OCICommit($db_conn);
    }

    // count tuples in Pokemon and Species tables
    function handleCountRequest()
    {
      global $db_conn;

      $resultSp = executePlainSQL("SELECT Count(*) FROM Species");
      if (($row = oci_fetch_row($resultSp)) != false) {
        echo "<br> The number of tuples in Pokedex: " . $row[0] . "<br>";
      }

      $resultPm = executePlainSQL("SELECT Count(*) FROM Pokemon ORDER BY OwnedID ASC");
      if (($row = oci_fetch_row($resultPm)) != false) {
        echo "<br> The number of tuples in Your Pokemon Table: " . $row[0] . "<br>";
      }
      OCICommit($db_conn);
    }

    // general function for filtering through Pokedex
    function getElem($elem)
    {
      global $db_conn;
      echo "<table style='border-collapse:separate;border-spacing:20px 0px;'><tr><th>Species ID</th><th>Species</th><th>Type 1</th><th>Type 2</th></tr>";
      $res = executePlainSQL("SELECT S.ID, S.SpName, O.Type1, O.Type2 FROM Species S, ofType O WHERE S.ID=O.ID AND (O.Type1='$elem' OR O.Type2='$elem')");
      while (($row = oci_fetch_row($res)) != false) {
        echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td>";
        if ($row[3] != NULL) {
          echo "<td>" . $row[3] . "</td>";
        }
        echo "</tr>";
      }
      echo "</table>";
      OCICommit($db_conn);
    }

    // displays all caught Pokemon
    function displayPokemon()
    {
      global $db_conn;

      $res = executePlainSQL("SELECT * FROM Pokemon");
      echo "<table style='border-collapse:separate;border-spacing:20px 0px;'><tr><th>Species ID</th><th>Nickname</th><th>Gender</th><th>Time Caught</th><th>Owned ID</th></tr>";
      while (($row = oci_fetch_row($res)) != false) {
        echo "<tr>
              <td>" . $row[0] . "</td>
              <td>" . $row[1] . "</td>
              <td> " . $row[2] . "</td>
              <td>" . $row[3] . ".</td>
              <td>" . $row[4] . "</td>
            </tr>";
      }
      echo "</table>";
      OCICommit($db_conn);
    }

    // deletes a pokemon from the Pokemon table given a valid OwnedID is provided
    function releasePokemon()
    {
      global $db_conn;

      $rid = $_POST['ridID'];
      if (isset($_POST['ridID']) && is_numeric($rid)) {
        $rpoke = executePlainSQL("SELECT Nickname, OwnedID FROM Pokemon WHERE OwnedID='" . $rid . "'");
        if (($row = oci_fetch_row($rpoke)) != false) {
          $res = executePlainSQL("DELETE FROM Pokemon WHERE OwnedID=$row[1]");
          echo $row[0] . " was released.";
        } else {
          echo "Invalid OwnedID. No pokemon was released.";
        }
      } else {
        echo "No OwnedID was selected or improper input. No pokemon was released.";
      }

      OCICommit($db_conn);
    }

    // seach pokemon by name
    function searchPokemon()
    {
      global $db_conn;

      $pname = $_POST['pname'];
      if (isset($_POST['pname'])) {
        $psearch = executePlainSQL("SELECT * FROM Species S, ofType O WHERE S.ID=O.ID AND S.SpName='" . $pname . "' ");
        echo "<table style='border-collapse:separate;border-spacing:20px 0px;'><tr><th>Species ID</th><th>Species</th><th>Ability 1</th><th>Ability 2</th><th>Hidden Ability</th><th>Type 1</th><th>Type 2</th></tr>";
        while (($row = oci_fetch_row($psearch)) != false) {
          echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4]
            . "</td><td>" . $row[6] . "</td><td>" . $row[7] . "</tr>";
        }
        echo "</table>";
      }

      OCICommit($db_conn);
    }

    // search pokemon by id
    function searchID()
    {
      global $db_conn;

      $pid = $_POST['pid'];
      if (isset($_POST['pid'])) {
        $psearch = executePlainSQL("SELECT * FROM Species S, ofType O WHERE S.ID=O.ID AND S.ID='" . $pid . "' ");
        echo "<table style='border-collapse:separate;border-spacing:20px 0px;'><tr><th>Species ID</th><th>Species</th><th>Ability 1</th><th>Ability 2</th><th>Hidden Ability</th><th>Type 1</th><th>Type 2</th></tr>";
        while (($row = oci_fetch_row($psearch)) != false) {
          echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4]
            . "</td><td>" . $row[6] . "</td><td>" . $row[7] . "</tr>";
        }
        echo "</table>";
      }

      OCICommit($db_conn);
    }

    // checks a pokemon's weaknesses
    function checkWeak()
    {
      global $db_conn;

      $cwid = $_POST['cwid'];
      if (isset($_POST['cwid'])) {
        $cwpoke = executePlainSQL("SELECT P.ID, P.Nickname, O.Type1, O.Type2 FROM Pokemon P, ofType O WHERE P.OwnedID='" . $cwid . "' AND P.ID=O.ID");
        if (($row = oci_fetch_row($cwpoke)) != false) {
          echo "Checking " . $row[1] . "'s weaknesses...<br>";
          // $check;
          if ($row[3] != NULL) {
            $check = executePlainSQL("SELECT * FROM WeakAgainst WHERE (Type1_TypeName='$row[2]' OR Type1_TypeName='$row[3]')");
          } else {
            $check = executePlainSQL("SELECT * FROM WeakAgainst WHERE Type1_TypeName='$row[2]'");
          }
          while (($row2 = oci_fetch_array($check)) != false) {
            echo $row2[0] . " weak against " . $row2[1] . "<br>";
          }
        }
      }

      OCICommit($db_conn);
    }

    function sortPokemonBy()
    {
      global $db_conn;

      if (isset($_POST['sortBy'])) {
        if (isset($_POST['order'])) {
          $order = $_POST['order'];
          if ($_POST['sortBy'] == 'spid') {
            $res = executePlainSQL("SELECT Pokemon.*, P_Stats.* FROM Pokemon LEFT JOIN P_Stats ON Pokemon.ID = P_Stats.ID ORDER BY Pokemon.ID $order");
            echo "<table style='border-collapse:separate;border-spacing:20px 0px;'><tr><th>Species ID</th><th>Nickname</th><th>Gender</th><th>Time Caught</th><th>Owned ID</th><th>HP</th><th>Attack</th><th>Defence</th><th>Sp. attack</th><th>Sp. defence</th><th>Speed</th></tr>";
            while (($row = oci_fetch_row($res)) != false) {
              echo "<tr>
                <td>" . $row[0] . "</td>
                <td>" . $row[1] . "</td>
                <td>" . $row[2] . "</td>
                <td>" . $row[3] . "</td>
                <td>" . $row[4] . "</td>
                <td>" . $row[6] . "</td>
                <td>" . $row[7] . "</td>
                <td>" . $row[8] . "</td>
                <td>" . $row[9] . "</td>
                <td>" . $row[10] . "</td>
                <td>" . $row[11] . "</td>
              </tr>";
            }
            echo "</table>";
          } else if ($_POST['sortBy'] == 'nickname') {
            $res = executePlainSQL("SELECT Pokemon.*, P_Stats.* FROM Pokemon LEFT JOIN P_Stats ON Pokemon.ID = P_Stats.ID ORDER BY Pokemon.Nickname $order");
            echo "<table style='border-collapse:separate;border-spacing:20px 0px;'><tr><th>Species ID</th><th>Nickname</th><th>Gender</th><th>Time Caught</th><th>Owned ID</th><th>HP</th><th>Attack</th><th>Defence</th><th>Sp. attack</th><th>Sp. defence</th><th>Speed</th></tr>";
            while (($row = oci_fetch_row($res)) != false) {
              echo "<tr>
                  <td>" . $row[0] . "</td>
                  <td>" . $row[1] . "</td>
                  <td>" . $row[2] . "</td>
                  <td>" . $row[3] . "</td>
                  <td>" . $row[4] . "</td>
                  <td>" . $row[6] . "</td>
                  <td>" . $row[7] . "</td>
                  <td>" . $row[8] . "</td>
                  <td>" . $row[9] . "</td>
                  <td>" . $row[10] . "</td>
                  <td>" . $row[11] . "</td>
                </tr>";
            }
            echo "</table>";
          } else if ($_POST['sortBy'] == 'date') {
            $res = executePlainSQL("SELECT Pokemon.*, P_Stats.* FROM Pokemon LEFT JOIN P_Stats ON Pokemon.ID = P_Stats.ID ORDER BY Pokemon.TimeCaught $order");
            echo "<table style='border-collapse:separate;border-spacing:20px 0px;'><tr><th>Species ID</th><th>Nickname</th><th>Gender</th><th>Time Caught</th><th>Owned ID</th><th>HP</th><th>Attack</th><th>Defence</th><th>Sp. attack</th><th>Sp. defence</th><th>Speed</th></tr>";
            while (($row = oci_fetch_row($res)) != false) {
              echo "<tr>
                <td>" . $row[0] . "</td>
                <td>" . $row[1] . "</td>
                <td>" . $row[2] . "</td>
                <td>" . $row[3] . "</td>
                <td>" . $row[4] . "</td>
                <td>" . $row[6] . "</td>
                <td>" . $row[7] . "</td>
                <td>" . $row[8] . "</td>
                <td>" . $row[9] . "</td>
                <td>" . $row[10] . "</td>
                <td>" . $row[11] . "</td>
              </tr>";
            }
            echo "</table>";
          } else if ($_POST['sortBy'] == 'hp') {
            $res = executePlainSQL("SELECT Pokemon.*, P_Stats.* FROM Pokemon LEFT JOIN P_Stats ON Pokemon.ID = P_Stats.ID ORDER BY P_Stats.HP $order");
            echo "<table style='border-collapse:separate;border-spacing:20px 0px;'><tr><th>Species ID</th><th>Nickname</th><th>Gender</th><th>Time Caught</th><th>Owned ID</th><th>HP</th><th>Attack</th><th>Defence</th><th>Sp. attack</th><th>Sp. defence</th><th>Speed</th></tr>";
            while (($row = oci_fetch_row($res)) != false) {
              echo "<tr>
                <td>" . $row[0] . "</td>
                <td>" . $row[1] . "</td>
                <td>" . $row[2] . "</td>
                <td>" . $row[3] . "</td>
                <td>" . $row[4] . "</td>
                <td>" . $row[6] . "</td>
                <td>" . $row[7] . "</td>
                <td>" . $row[8] . "</td>
                <td>" . $row[9] . "</td>
                <td>" . $row[10] . "</td>
                <td>" . $row[11] . "</td>
              </tr>";
            }
            echo "</table>";
          } else if ($_POST['sortBy'] == 'atk') {
            $res = executePlainSQL("SELECT Pokemon.*, P_Stats.* FROM Pokemon LEFT JOIN P_Stats ON Pokemon.ID = P_Stats.ID ORDER BY P_Stats.Atk $order");
            echo "<table style='border-collapse:separate;border-spacing:20px 0px;'><tr><th>Species ID</th><th>Nickname</th><th>Gender</th><th>Time Caught</th><th>Owned ID</th><th>HP</th><th>Attack</th><th>Defence</th><th>Sp. attack</th><th>Sp. defence</th><th>Speed</th></tr>";
            while (($row = oci_fetch_row($res)) != false) {
              echo "<tr>
                <td>" . $row[0] . "</td>
                <td>" . $row[1] . "</td>
                <td>" . $row[2] . "</td>
                <td>" . $row[3] . "</td>
                <td>" . $row[4] . "</td>
                <td>" . $row[6] . "</td>
                <td>" . $row[7] . "</td>
                <td>" . $row[8] . "</td>
                <td>" . $row[9] . "</td>
                <td>" . $row[10] . "</td>
                <td>" . $row[11] . "</td>
              </tr>";
            }
            echo "</table>";
          } else if ($_POST['sortBy'] == 'def') {
            $res = executePlainSQL("SELECT Pokemon.*, P_Stats.* FROM Pokemon LEFT JOIN P_Stats ON Pokemon.ID = P_Stats.ID ORDER BY P_Stats.Def $order");
            echo "<table style='border-collapse:separate;border-spacing:20px 0px;'><tr><th>Species ID</th><th>Nickname</th><th>Gender</th><th>Time Caught</th><th>Owned ID</th><th>HP</th><th>Attack</th><th>Defence</th><th>Sp. attack</th><th>Sp. defence</th><th>Speed</th></tr>";
            while (($row = oci_fetch_row($res)) != false) {
              echo "<tr>
                <td>" . $row[0] . "</td>
                <td>" . $row[1] . "</td>
                <td>" . $row[2] . "</td>
                <td>" . $row[3] . "</td>
                <td>" . $row[4] . "</td>
                <td>" . $row[6] . "</td>
                <td>" . $row[7] . "</td>
                <td>" . $row[8] . "</td>
                <td>" . $row[9] . "</td>
                <td>" . $row[10] . "</td>
                <td>" . $row[11] . "</td>
              </tr>";
            }
            echo "</table>";
          } else if ($_POST['sortBy'] == 'spatk') {
            $res = executePlainSQL("SELECT Pokemon.*, P_Stats.* FROM Pokemon LEFT JOIN P_Stats ON Pokemon.ID = P_Stats.ID ORDER BY P_Stats.Spatk $order");
            echo "<table style='border-collapse:separate;border-spacing:20px 0px;'><tr><th>Species ID</th><th>Nickname</th><th>Gender</th><th>Time Caught</th><th>Owned ID</th><th>HP</th><th>Attack</th><th>Defence</th><th>Sp. attack</th><th>Sp. defence</th><th>Speed</th></tr>";
            while (($row = oci_fetch_row($res)) != false) {
              echo "<tr>
                <td>" . $row[0] . "</td>
                <td>" . $row[1] . "</td>
                <td>" . $row[2] . "</td>
                <td>" . $row[3] . "</td>
                <td>" . $row[4] . "</td>
                <td>" . $row[6] . "</td>
                <td>" . $row[7] . "</td>
                <td>" . $row[8] . "</td>
                <td>" . $row[9] . "</td>
                <td>" . $row[10] . "</td>
                <td>" . $row[11] . "</td>
              </tr>";
            }
            echo "</table>";
          } else if ($_POST['sortBy'] == 'spdef') {
            $res = executePlainSQL("SELECT Pokemon.*, P_Stats.* FROM Pokemon LEFT JOIN P_Stats ON Pokemon.ID = P_Stats.ID ORDER BY P_Stats.Spdef $order");
            echo "<table style='border-collapse:separate;border-spacing:20px 0px;'><tr><th>Species ID</th><th>Nickname</th><th>Gender</th><th>Time Caught</th><th>Owned ID</th><th>HP</th><th>Attack</th><th>Defence</th><th>Sp. attack</th><th>Sp. defence</th><th>Speed</th></tr>";
            while (($row = oci_fetch_row($res)) != false) {
              echo "<tr>
                <td>" . $row[0] . "</td>
                <td>" . $row[1] . "</td>
                <td>" . $row[2] . "</td>
                <td>" . $row[3] . "</td>
                <td>" . $row[4] . "</td>
                <td>" . $row[6] . "</td>
                <td>" . $row[7] . "</td>
                <td>" . $row[8] . "</td>
                <td>" . $row[9] . "</td>
                <td>" . $row[10] . "</td>
                <td>" . $row[11] . "</td>
              </tr>";
            }
            echo "</table>";
          } else if ($_POST['sortBy'] == 'speed') {
            $res = executePlainSQL("SELECT Pokemon.*, P_Stats.* FROM Pokemon LEFT JOIN P_Stats ON Pokemon.ID = P_Stats.ID ORDER BY P_Stats.Speed $order");
            echo "<table style='border-collapse:separate;border-spacing:20px 0px;'><tr><th>Species ID</th><th>Nickname</th><th>Gender</th><th>Time Caught</th><th>Owned ID</th><th>HP</th><th>Attack</th><th>Defence</th><th>Sp. attack</th><th>Sp. defence</th><th>Speed</th></tr>";
            while (($row = oci_fetch_row($res)) != false) {
              echo "<tr>
                <td>" . $row[0] . "</td>
                <td>" . $row[1] . "</td>
                <td>" . $row[2] . "</td>
                <td>" . $row[3] . "</td>
                <td>" . $row[4] . "</td>
                <td>" . $row[6] . "</td>
                <td>" . $row[7] . "</td>
                <td>" . $row[8] . "</td>
                <td>" . $row[9] . "</td>
                <td>" . $row[10] . "</td>
                <td>" . $row[11] . "</td>
              </tr>";
            }
            echo "</table>";
          }
        }
      }

      OCICommit($db_conn);
    }

    function groupPokemonBy()
    {
      global $db_conn;

      if (isset($_POST['groupBy'])) {
        if (isset($_POST['having'])) {
          $having = $_POST['having'];
          if ($_POST['groupBy'] == 'spid') {
            $res = executePlainSQL("SELECT ID, COUNT(*) FROM Pokemon GROUP BY ID HAVING COUNT(*) >= $having");
            echo "<table style='border-collapse:separate;border-spacing:20px 0px;'><tr><th>Species ID</th><th>Pokemon</th></tr>";
            while (($row = oci_fetch_row($res)) != false) {
              echo "<tr>
                <td>" . $row[0] . "</td>
                <td>" . $row[1] . "</td>
              </tr>";
            }
            echo "</table>";
          } else if ($_POST['groupBy'] == 'gender') {
            $res = executePlainSQL("SELECT Gender, COUNT(*) FROM Pokemon GROUP BY Gender HAVING COUNT(*) >= $having");
            echo "<table style='border-collapse:separate;border-spacing:20px 0px;'><tr><th>Gender</th><th>Pokemon</th></tr>";
            while (($row = oci_fetch_row($res)) != false) {
              echo "<tr>
                  <td>" . $row[0] . "</td>
                  <td>" . $row[1] . "</td>
                </tr>";
            }
            echo "</table>";
          } else if ($_POST['groupBy'] == 'date') {
            $res = executePlainSQL("SELECT TimeCaught, COUNT(*) FROM Pokemon GROUP BY TimeCaught HAVING COUNT(*) >= $having");
            echo "<table style='border-collapse:separate;border-spacing:20px 0px;'><tr><th><th>Time Caught</th><th>Pokemon</th></tr>";
            while (($row = oci_fetch_row($res)) != false) {
              echo "<tr>
                <td>" . $row[0] . "</td>
                <td>" . $row[1] . "</td>
              </tr>";
            }
            echo "</table>";
          }
        } else {
          if ($_POST['groupBy'] == 'spid') {
            $res = executePlainSQL("SELECT ID, COUNT(*) FROM Pokemon GROUP BY ID");
            echo "<table style='border-collapse:separate;border-spacing:20px 0px;'><tr><th>Species ID</th><th>Pokemon</th></tr>";
            while (($row = oci_fetch_row($res)) != false) {
              echo "<tr>
                <td>" . $row[0] . "</td>
                <td>" . $row[1] . "</td>
              </tr>";
            }
            echo "</table>";
          } else if ($_POST['groupBy'] == 'gender') {
            $res = executePlainSQL("SELECT Gender, COUNT(*) FROM Pokemon GROUP BY Gender");
            echo "<table style='border-collapse:separate;border-spacing:20px 0px;'><tr><th>Gender</th><th>Pokemon</th></tr>";
            while (($row = oci_fetch_row($res)) != false) {
              echo "<tr>
                  <td>" . $row[0] . "</td>
                  <td>" . $row[1] . "</td>
                </tr>";
            }
            echo "</table>";
          } else if ($_POST['groupBy'] == 'date') {
            $res = executePlainSQL("SELECT TimeCaught, COUNT(*) FROM Pokemon GROUP BY TimeCaught");
            echo "<table style='border-collapse:separate;border-spacing:20px 0px;'><tr><th><th>Time Caught</th><th>Pokemon</th></tr>";
            while (($row = oci_fetch_row($res)) != false) {
              echo "<tr>
                <td>" . $row[0] . "</td>
                <td>" . $row[1] . "</td>
              </tr>";
            }
            echo "</table>";
          }
        }
      }

      OCICommit($db_conn);
    }

    function aggregateStats()
    {
      global $db_conn;

        $res = executePlainSQL("SELECT P.ID, MAX(G.GenderCount) FROM (SELECT SQP.ID, SQP.Gender, COUNT(*) AS GenderCount FROM Pokemon SQP GROUP BY SQP.ID, SQP.Gender) AS G GROUP BY G.ID");
        echo "<table><tr><th>ID</th><th>Gender</th></tr>";
        while (($row = oci_fetch_row($res)) != false) {
          echo "<tr>
            <td>" . $row[0] . "</td>
            <td>" . $row[1] . "</td>
          </tr>";
        }
        echo "</table>";

      OCICommit($db_conn);
    }


    // HANDLE ALL POST ROUTES
    // A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
    function handlePOSTRequest()
    {
      if (connectToDB()) {
        if (array_key_exists('resetTablesRequest', $_POST)) {
          handleResetRequest();
        } else if (array_key_exists('updateQueryRequest', $_POST)) {
          handleUpdateRequest();
        } else if (array_key_exists('insertQueryRequest', $_POST)) {
          handleInsertRequest();
        } else if (array_key_exists('releasePokemonRequest', $_POST)) {
          releasePokemon();
        } else if (array_key_exists('searchPokemonRequest', $_POST)) {
          searchPokemon();
        } else if (array_key_exists('searchIDRequest', $_POST)) {
          searchID();
        } else if (array_key_exists('checkWeaknessRequest', $_POST)) {
          checkWeak();
        } else if (array_key_exists('sortPokemonRequest', $_POST)) {
          sortPokemonBy();
        } else if (array_key_exists('groupPokemonRequest', $_POST)) {
          groupPokemonBy();
        }

        disconnectFromDB();
      }
    }

    // HANDLE ALL GET ROUTES
    // A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
    function handleGETRequest()
    {
      if (connectToDB()) {
        if (array_key_exists('countTuples', $_GET)) {
          handleCountRequest();
        } else if (array_key_exists('displayPokemon', $_GET)) {
          displayPokemon();
        } else if (array_key_exists('aggrPokemon', $_GET)) {
          aggregateStats();
        } else if (array_key_exists('getNormal', $_GET)) {
          getElem("Normal");
        } else if (array_key_exists('getGrass', $_GET)) {
          getElem("Grass");
        } else if (array_key_exists('getFire', $_GET)) {
          getElem("Fire");
        } else if (array_key_exists('getWater', $_GET)) {
          getElem("Water");
        } else if (array_key_exists('getGround', $_GET)) {
          getElem("Ground");
        } else if (array_key_exists('getFlying', $_GET)) {
          getElem("Flying");
        } else if (array_key_exists('getPoison', $_GET)) {
          getElem("Poison");
        } else if (array_key_exists('getFighting', $_GET)) {
          getElem("Fighting");
        } else if (array_key_exists('getBug', $_GET)) {
          getElem("Bug");
        } else if (array_key_exists('getElectric', $_GET)) {
          getElem("Electric");
        } else if (array_key_exists('getPsychic', $_GET)) {
          getElem("Psychic");
        } else if (array_key_exists('getFairy', $_GET)) {
          getElem("Fairy");
        }

        disconnectFromDB();
      }
    }

    if (isset($_POST['reset']) || isset($_POST['updateSubmit']) || isset($_POST['insertSubmit']) || isset($_POST['releaseSubmit']) || isset($_POST['searchSubmit']) || isset($_POST['searchIDSubmit']) || isset($_POST['checkWeakSubmit']) || isset($_POST['sortPokemon']) || isset($_POST['groupPokemon'])) {
      handlePOSTRequest();
    } else if (isset($_GET['countTupleRequest']) || isset($_GET['showTupleRequest']) || isset($_GET['displayPokemonRequest']) || isset($_GET['aggrPokemonRequest'])) {
      handleGETRequest();
    } else if (
      isset($_GET['getNormalPokemon']) || isset($_GET['getGrassPokemon']) || isset($_GET['getFirePokemon']) || isset($_GET['getWaterPokemon']) || isset($_GET['getGroundPokemon']) || isset($_GET['getFlyingPokemon']) ||
      isset($_GET['getPoisonPokemon']) || isset($_GET['getFightingPokemon']) || isset($_GET['getBugPokemon']) || isset($_GET['getElectricPokemon']) || isset($_GET['getPsychicPokemon']) || isset($_GET['getFairyPokemon'])
    ) {
      handleGETRequest();
    }
    ?>
  </div>
</body>
<footer>
  <div style="text-align:center;">Created by Derrick Sutanto, Shawn Pak, and Kristen Foong &#169; 2020</div>
</footer>

</html>
