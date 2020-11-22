<!-- The script assumes you already have a server set up
  All OCI commands are commands to the Oracle libraries
  To get the file to work, you must place it somewhere where your
  Apache server can run it, and you must rename it to have a ".php"
  extension.  You must also change the username and password on the 
  OCILogon below to be your ORACLE username and password -->

<html>

<head>
    <title>Pokedex</title>
    <script>
        <?php

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
        { /* Sometimes the same statement will be executed several times with different values for the variables involved in the query.
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
            $db_conn = OCILogon("ora_dsutanto", "a30529168", "dbhost.students.cs.ubc.ca:1522/stu");

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

        function handleUpdateRequest()
        {
            global $db_conn;

            $old_name = $_POST['oldName'];
            $new_name = $_POST['newName'];

            echo $old_name;
            echo $new_name;
            // you need the wrap the old name and new name values with single quotations
            executePlainSQL("UPDATE pokemonTable SET nickname='" . $new_name . "' WHERE ownedId='" . $old_name . "'");
            OCICommit($db_conn);
        }

        function handleResetRequest()
        {
            global $db_conn;
            // Drop old tables
            executePlainSQL("DROP TABLE pokemonTable");
            executePlainSQL("DROP TABLE speciesTable");

            // Create new tables
            echo "<br> creating new table <br>";
            executePlainSQL("CREATE TABLE speciesTable (spid int, spName varchar(30), PRIMARY KEY (spid), UNIQUE (spName))");
            executePlainSQL("INSERT INTO speciesTable VALUES (1, 'Bulbasaur')");
            executePlainSQL("INSERT INTO speciesTable VALUES (2, 'Ivysaur')");
            executePlainSQL("INSERT INTO speciesTable VALUES (3, 'Venusaur')");
            executePlainSQL("INSERT INTO speciesTable VALUES (4, 'Charmander')");
            executePlainSQL("INSERT INTO speciesTable VALUES (5, 'Charmeleon')");
            executePlainSQL("INSERT INTO speciesTable VALUES (6, 'Charizard')");
            executePlainSQL("INSERT INTO speciesTable VALUES (7, 'Squirtle')");
            executePlainSQL("INSERT INTO speciesTable VALUES (8, 'Wartortle')");
            executePlainSQL("INSERT INTO speciesTable VALUES (9, 'Blastoise')");

            executePlainSQL("CREATE TABLE statTable (spid int, hp int, attack int, defence int, speed int PRIMARY KEY (spid), CONSTRAINT FK_speciesID FOREIGN KEY (spid) REFERENCES speciesTable(spid))");
            executePlainSQL("INSERT INTO speciesTable VALUES (1, 0, 1, 0, 0)");
            executePlainSQL("INSERT INTO speciesTable VALUES (2, 0, 1, 1, 0)");
            executePlainSQL("INSERT INTO speciesTable VALUES (3, 0, 2, 1, 0)");
            executePlainSQL("INSERT INTO speciesTable VALUES (4, 0, 0, 0, 1)");
            executePlainSQL("INSERT INTO speciesTable VALUES (5, 0, 1, 0, 1)");
            executePlainSQL("INSERT INTO speciesTable VALUES (6, 0, 3, 0, 0)");
            executePlainSQL("INSERT INTO speciesTable VALUES (7, 0, 0, 1, 0)");
            executePlainSQL("INSERT INTO speciesTable VALUES (8, 0, 0, 2, 0)");
            executePlainSQL("INSERT INTO speciesTable VALUES (9, 0, 0, 3, 0)");


            executePlainSQL("CREATE TABLE pokemonTable (ownedId int GENERATED BY DEFAULT ON NULL AS IDENTITY, spid int, nickname varchar(30), gender VARCHAR2(10) CHECK(gender IN ('male', 'female')), pokemonWeight decimal(3, 1), friendshipLevel decimal(3, 2), timeCaught timestamp, PRIMARY KEY (ownedId), CONSTRAINT FK_speciesID FOREIGN KEY (spid) REFERENCES speciesTable(spid))");
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

            $randomSpid = executePlainSQL("SELECT spid FROM (SELECT spid FROM speciesTable ORDER BY DBMS_RANDOM.RANDOM) WHERE rownum < 8");
            $randomSpidResult = OCI_Fetch_Array($randomSpid, OCI_BOTH);
            $randomSpname = executePlainSQL("SELECT spName FROM speciesTable WHERE spid = $randomSpidResult[0]");
            $randomSpnameResult = OCI_Fetch_Array($randomSpname, OCI_BOTH);
            executePlainSQL("INSERT INTO pokemonTable VALUES (NULL, $randomSpidResult[0], '$randomSpnameResult[0]', 'male', 30.3, 0.01, CURRENT_TIMESTAMP)");
            OCICommit($db_conn);
        }

        function handleCountRequest()
        {
            global $db_conn;

            $resultSp = executePlainSQL("SELECT Count(*) FROM speciesTable");
            if (($row = oci_fetch_row($resultSp)) != false) {
                echo "<br> The number of tuples in Species Table: " . $row[0] . "<br>";
            }

            $resultPm = executePlainSQL("SELECT Count(*) FROM pokemonTable");
            if (($row = oci_fetch_row($resultPm)) != false) {
                echo "<br> The number of tuples in Pokemon Table: " . $row[0] . "<br>";
            }
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
                } else if (array_key_exists('showTuples', $_GET)) {
                    showTuples();
                }

                disconnectFromDB();
            }
        }

        if (isset($_POST['reset']) || isset($_POST['updateSubmit']) || isset($_POST['insertSubmit'])) {
            handlePOSTRequest();
        } else if (isset($_GET['countTupleRequest']) || isset($_GET['showTupleRequest'])) {
            handleGETRequest();
        }
        ?>
    </script>
    <script>
        function editPokemon(pokemon) {
            console.log(pokemon.cells[2]);
            // document.getElementById('nn').concat(pokemon.cells[2]);
        }
    </script>
    <style>
        tr:hover {
            background-color: lightblue;
        }
    </style>
</head>

<body>
    <h2>Reset</h2>
    <p>If you wish to reset the table press on the reset button. If this is the first time you're running this page, you MUST use reset</p>

    <form method="POST" action="project.php">
        <!-- if you want another page to load after the button is clicked, you have to specify that page in the action parameter -->
        <input type="hidden" id="resetTablesRequest" name="resetTablesRequest">
        <p><input type="submit" value="Reset" name="reset"></p>
    </form>

    <hr />

    <h2>Generate new Pokemon</h2>
    <form method="POST" action="project.php">
        <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">

        <input type="submit" value="Generate" name="insertSubmit"></p>
    </form>

    <hr />

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody id="speciesBody">
            <?php
            connectToDB();
            $result = executePlainSQL("SELECT * FROM speciesTable");

            if (($row = oci_fetch_row($result)) != false) {
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row["SPID"] . "</td><td>" . $row["SPNAME"] . "</td></tr>";
                }
            }
            ?>
        </tbody>
    </table>

    <!-- <form method="GET" action="project.php">
        <input type="hidden" id="sortTableRequest" name="sortTableRequest">
        <select name="sort">
            <option value="">Sort by...</option>
            <option value="Species ID"></option>
            <option value="Nickname"></option>
            <option value="Weight"></option>
        </select>
        <input type="submit" name="sortTuples">
    </form> -->
    <table>
        <thead>
            <tr>
                <th>Pokemon ID</th>
                <th>Species ID</th>
                <th>Nickname</th>
                <th>Gender</th>
                <th>Weight</th>
                <th>Friendship level</th>
                <th>Time caught</th>
                <th>Stats</td>
            </tr>
        </thead>
        <tbody id="pokemonBody">
            <?php
            connectToDB();
            $result = executePlainSQL("SELECT * FROM pokemonTable ORDER BY ownedId");

            if (($row = oci_fetch_row($result)) != false) {
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr onclick='editPokemon(this)'><td>" . $row["OWNEDID"] . "</td><td>" . $row["SPID"] . "</td><td>" . $row["NICKNAME"] . "</td><td>" . $row["GENDER"] . "</td><td>" . $row["POKEMONWEIGHT"] . "</td><td>" . $row["FRIENDSHIPLEVEL"] . "</td><td>" . $row["TIMECAUGHT"] . "</td></td></tr>";
                }
            }
            ?>
        </tbody>
    </table>

    <div>
        <ul>
            <li id="nn">Nickname: </li>
            <li id="sp">Species: </li>
            <li id="st">Stats: </li>
        </ul>
    </div>
    <input type="submit" value="Update Pokemon" id="updateTables">
    <input type="submit" value="Delete Pokemon" id="updateTables">

</body>

</html>
