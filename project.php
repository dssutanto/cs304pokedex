<?php
function debugAlertMessage($message)
{
  global $show_debug_alert_messages;

  if ($show_debug_alert_messages) {
    echo "<script type='text/javascript'>alert('" . $message . "');</script>";
  }
}

function connectToDB()
{
  $db_host = "localhost";
  $db_user = "root";
  $db_pass = "";
  $db_name = "cs304_pokedex";

  $db_conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
  if ($db_conn->connect_error) {
    die("Failed to connect: Error " . $db_conn->connect_errno . ": " . $db_conn->connect_error);
  }

  return $db_conn;
}

function disconnectFromDB(mysqli $db)
{
  $db->close();
}

function handleInsertRequest(mysqli $db)
{
  $rgen = 'agender';
  $rnum = rand(0, 10) % 2;
  if ($rnum == 0) {
    $rgen = 'male';
  } else {
    $rgen = 'female';
  }
  $randomSpid = $db->query("SELECT ID FROM Species ORDER BY RAND() LIMIT 1");
  $randomSpidResult = $randomSpid->fetch_assoc();
  if ($randomSpidResult["ID"] >= 29 && $randomSpidResult["ID"] < 32) {
    $rgen = 'female';
  } else if ($randomSpidResult["ID"] >= 32 && $randomSpidResult["ID"] < 35) {
    $rgen = 'male';
  }
  $randomSpname = $db->query("SELECT SpName FROM Species WHERE id = $randomSpidResult[ID]");
  $randomSpnameResult = $randomSpname->fetch_assoc();

  $resultSp = $db->query("SELECT OwnedID FROM Pokemon ORDER BY ownedID DESC LIMIT 1");
  $row = $resultSp->fetch_assoc();
  $newRow = $row["OwnedID"] + 1;

  $newPokemon = "INSERT INTO Pokemon VALUES ($randomSpidResult[ID],'$randomSpnameResult[SpName]' , '$rgen', CURRENT_DATE, $newRow)";

  if (mysqli_query($db, $newPokemon)) {
    echo "You caught a " . $randomSpnameResult["SpName"] . "!";
  } else {
    die("Error generating new Pokemon");
  }

  mysqli_commit($db);
}

function handleUpdateRequest(mysqli $db, $nid, $new_name)
{
  // $nid = mysqli_real_escape_string($db, $NID);
  // $new_name = mysqli_real_escape_string($db, $newName);
  if (isset($nid) && is_numeric($nid) && isset($new_name)) {
    $npoke = "UPDATE Pokemon SET Nickname='" . $new_name . "' WHERE OwnedID='" . $nid . "'";
    if (mysqli_query($db, $npoke)) {
      echo "Pokemon " . $nid . "'s nickname was updated to " . $new_name . ".";
    } else {
      die("Error changing nickname: " . $db->error);
    }
  } else {
    echo "Invalid OwnedID or no nickname entered, no changes were made.";
  }

  mysqli_commit($db);
}

// general function for filtering through Pokedex
function getElem(mysqli $db, $elem)
{
  echo "<table style='border-spacing: 0px;'><tr><th>Species ID</th><th>Species</th><th>Type 1</th><th>Type 2</th></tr>";
  $res = $db->query("SELECT S.ID, S.SpName, O.Type1, O.Type2 FROM Species S, ofType O WHERE S.ID=O.ID AND (O.Type1='$elem' OR O.Type2='$elem')");
  while (($row = $res->fetch_assoc()) != false) {
    echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["SpName"] . "</td><td>" . $row["Type1"] . "</td>";
    if ($row["Type2"] != NULL) {
      echo "<td>" . $row["Type2"] . "</td></tr>";
    } else {
      echo "<td></td></tr>";
    }
  }
  echo "</table>";
  mysqli_commit($db);
}

// displays all caught Pokemon
function displayPokemon(mysqli $db)
{
  // $resultCount = $db->query("SELECT Count(*) FROM Pokemon");
  $resultDisp = $db->query("SELECT * FROM Pokemon ORDER BY OwnedID ASC");

  // if(isset($resultCount) && is_numeric($resultCount)) {
  if ($resultDisp->num_rows > 0) {
    // echo "<br> The number of records in Your Pokemon Table: " . $resultCount . "<br>";
    echo "<table style='border-spacing: 0px;'><tr><th>Species ID</th><th>Nickname</th><th>Gender</th><th>Time Caught</th><th>Owned ID</th></tr>";
    while ($row = $resultDisp->fetch_assoc()) {
      echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["Nickname"] . "</td><td>" . $row["Gender"] . "</td><td>" . $row["TimeCaught"] . "</td><td>" . $row["OwnedID"] . "</td></tr>";
    }
    echo "</table>";
  } else {
    echo "Table is empty";
  }
  // } else {
  //     echo "Could not find table";
  // }

  mysqli_commit($db);
}

// displays Pokemon stats
function showStats(mysqli $db)
{
  $res = $db->query("SELECT * FROM P_Stats INNER JOIN Pokemon ON P_Stats.ID=Pokemon.ID");
  echo "<table style='border-spacing: 0px;'><tr><th>Nickname</tb><th>Species ID</th><th>HP</th><th>Atk</th><th>Def</th><th>SpAtk</th><th>SpDef</th><th>Speed</th></tr>";
  while (($row = $res->fetch_assoc()) != false) {
    echo "<tr><td>" . $row["Nickname"]
      . "</td><td>" . $row["ID"]
      . "</td><td>" . $row["HP"]
      . "</td><td> " . $row["Atk"]
      . "</td><td>" . $row["Def"]
      . ".</td><td>" . $row["Spatk"]
      . "</td><td>" . $row["Spdef"]
      . "</td><td>" . $row["Speed"]
      . "</tr>";
  }
  echo "</table>";
  mysqli_commit($db);
}

// deletes a pokemon from the Pokemon table given a valid OwnedID is provided
function releasePokemon(mysqli $db, $rid)
{
  if (isset($rid) && is_numeric($rid)) {
    $rpoke = $db->query("SELECT Nickname, OwnedID FROM Pokemon WHERE OwnedID='" . $rid . "'");
    if (($row = $rpoke->fetch_assoc()) != false) {
      if ($db->query("DELETE FROM Pokemon WHERE OwnedID=$row[OwnedID]") === true) {
        echo $row["Nickname"] . " was released.";
      } else {
        die("Error deleting record: " . $db->error);
      }
    } else {
      echo "Could not find Pokemon with OwnedID";
    }
  } else {
    echo "No OwnedID was selected or improper input. No pokemon was released.";
  }

  mysqli_commit($db);
}

// seach pokemon by name
function searchPokemon(mysqli $db, $pname)
{
  if (isset($pname)) {
    $psearch = $db->query("SELECT * FROM Species S, ofType O WHERE S.ID=O.ID AND S.SpName='" . $pname . "' ");
    echo "<table style='border-spacing: 0px;'><tr><th>Species ID</th><th>Species</th><th>Ability 1</th><th>Ability 2</th><th>Hidden Ability</th><th>Type 1</th><th>Type 2</th></tr>";
    while (($row = $psearch->fetch_assoc()) != false) {
      echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["SpName"] . "</td><td>" . $row["Ability1"] . "</td><td>" . $row["Ability2"] . "</td><td>" . $row["HiddenAbility"] . "</td><td>" . $row["Type1"] . "</td><td>" . $row["Type2"] . "</tr>";
    }
    echo "</table>";
  }

  mysqli_commit($db);
}

// search pokemon by id
function searchID(mysqli $db, $pid)
{
  if (isset($_POST['pid'])) {
    $psearch = $db->query("SELECT * FROM Species S INNER JOIN ofType O ON S.ID=O.ID WHERE S.ID='" . $pid . "' ");
    echo "<table style='border-spacing: 0px;'><tr><th>Species ID</th><th>Species</th><th>Ability 1</th><th>Ability 2</th><th>Hidden Ability</th><th>Type 1</th><th>Type 2</th></tr>";
    while (($row = $psearch->fetch_assoc()) != false) {
      echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["SpName"] . "</td><td>" . $row["Ability1"] . "</td><td>" . $row["Ability2"] . "</td><td>" . $row["HiddenAbility"] . "</td><td>" . $row["Type1"] . "</td><td>" . $row["Type2"] . "</tr>";
    }
    echo "</table>";
  }

  mysqli_commit($db);
}

// checks a pokemon's weaknesses
function checkWeak(mysqli $db, $cwid)
{
  if (isset($_POST['cwid'])) {
    $cwpoke = $db->query("SELECT P.ID, P.Nickname, O.Type1, O.Type2 FROM Pokemon P, ofType O WHERE P.OwnedID='" . $cwid . "' AND P.ID=O.ID");
    if (($row = $cwpoke->fetch_assoc()) != false) {
      echo "Checking " . $row["Nickname"] . "'s weaknesses...<br>";
      $check = NULL;
      if ($row["Type2"] != NULL) {
        $check = $db->query("SELECT * FROM WeakAgainst WHERE (Type1_TypeName='$row[Type1]' OR Type1_TypeName='$row[Type2]')");
      } else {
        $check = $db->query("SELECT * FROM WeakAgainst WHERE Type1_TypeName='$row[Type1]'");
      }
      while (($row2 = $check->fetch_assoc()) != false) {
        echo $row2["Type1_TypeName"] . " weak against " . $row2["Type2_TypeName"] . "<br>";
      }
    }
  }

  mysqli_commit($db);
}

// show specific pokemon details
function showThisPokemon(mysqli $db, $ownedID)
{
  // echo $ownedID;
  if (isset($ownedID) && is_numeric($ownedID)) {
    $thisPokemon = $db->query("SELECT * FROM Pokemon WHERE OwnedID='" . $ownedID . "'");
    if (($row = $thisPokemon->fetch_assoc()) != false) {
      echo "<table style='border-spacing: 0px;'><tr><th>Species ID</th><th>Nickname</th><th>Gender</th><th>Time Caught</th><th>Owned ID</th></tr>";
      echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["Nickname"] . "</td><td>" . $row["Gender"] . "</td><td>" . $row["TimeCaught"] . "</td><td>" . $row["OwnedID"] . "</td></tr>";
      echo "</table>";
    } else {
      echo "Invalid input, try again.";
    }
  }
  mysqli_commit($db);
}

function sortPokemonBy(mysqli $db, $sortBy, $order)
{
  if (isset($sortBy)) {
    if (isset($order)) {
      if ($sortBy == 'spid') {
        $sql = "SELECT Pokemon.*, P_Stats.* FROM Pokemon LEFT JOIN P_Stats ON Pokemon.ID = P_Stats.ID ORDER BY Pokemon.ID $order";
      } else if ($sortBy == 'nickname') {
        $sql = "SELECT Pokemon.*, P_Stats.* FROM Pokemon LEFT JOIN P_Stats ON Pokemon.ID = P_Stats.ID ORDER BY Pokemon.Nickname $order";
      } else if ($sortBy == 'date') {
        $sql = "SELECT Pokemon.*, P_Stats.* FROM Pokemon LEFT JOIN P_Stats ON Pokemon.ID = P_Stats.ID ORDER BY Pokemon.TimeCaught $order";
      } else if ($sortBy == 'hp') {
        $sql = "SELECT Pokemon.*, P_Stats.* FROM Pokemon LEFT JOIN P_Stats ON Pokemon.ID = P_Stats.ID ORDER BY P_Stats.HP $order";
      } else if ($sortBy == 'atk') {
        $sql = "SELECT Pokemon.*, P_Stats.* FROM Pokemon LEFT JOIN P_Stats ON Pokemon.ID = P_Stats.ID ORDER BY P_Stats.Atk $order";
      } else if ($sortBy == 'def') {
        $sql = "SELECT Pokemon.*, P_Stats.* FROM Pokemon LEFT JOIN P_Stats ON Pokemon.ID = P_Stats.ID ORDER BY P_Stats.Def $order";
      } else if ($sortBy == 'spatk') {
        $sql = "SELECT Pokemon.*, P_Stats.* FROM Pokemon LEFT JOIN P_Stats ON Pokemon.ID = P_Stats.ID ORDER BY P_Stats.Spatk $order";
      } else if ($sortBy == 'spdef') {
        $sql = "SELECT Pokemon.*, P_Stats.* FROM Pokemon LEFT JOIN P_Stats ON Pokemon.ID = P_Stats.ID ORDER BY P_Stats.Spdef $order";
      } else if ($sortBy == 'speed') {
        $sql = "SELECT Pokemon.*, P_Stats.* FROM Pokemon LEFT JOIN P_Stats ON Pokemon.ID = P_Stats.ID ORDER BY P_Stats.Speed $order";
      } else {
        die("Invalid sorting criteria.");
      }
      $res = $db->query($sql);
      echo "<table style='border-spacing: 0px;'><tr><th>Species ID</th><th>Nickname</th><th>Gender</th><th>Time Caught</th><th>Owned ID</th><th>HP</th><th>Attack</th><th>Defence</th><th>Sp. attack</th><th>Sp. defence</th><th>Speed</th></tr>";
      while (($row = $res->fetch_assoc()) != false) {
        echo "<tr>
                        <td>" . $row["ID"] . "</td>
                        <td>" . $row["Nickname"] . "</td>
                        <td>" . $row["Gender"] . "</td>
                        <td>" . $row["TimeCaught"] . "</td>
                        <td>" . $row["OwnedID"] . "</td>
                        <td>" . $row["HP"] . "</td>
                        <td>" . $row["Atk"] . "</td>
                        <td>" . $row["Def"] . "</td>
                        <td>" . $row["Spatk"] . "</td>
                        <td>" . $row["Spdef"] . "</td>
                        <td>" . $row["Speed"] . "</td>
                        </tr>";
      }
      echo "</table>";
    } else {
      die("Invalid request.");
    }
  }
  mysqli_commit($db);
}

function groupPokemonBy(mysqli $db, $groupBy, $having)
{
  if (isset($groupBy)) {
    if (isset($having)) {
      if ($groupBy == 'spid') {
        $res = $db->query("SELECT ID, COUNT(*) FROM Pokemon GROUP BY ID HAVING COUNT(*) >= $having");
        echo "<table style='border-spacing: 0px;'><tr><th>Species ID</th><th>Pokemon</th></tr>";
        while (($row = $res->fetch_assoc()) != false) {
          echo "<tr>
                            <td>" . $row["ID"] . "</td>
                            <td>" . $row["COUNT(*)"] . "</td>
                            </tr>";
        }
        echo "</table>";
      } else if ($groupBy == 'gender') {
        $res = $db->query("SELECT Gender, COUNT(*) FROM Pokemon GROUP BY Gender HAVING COUNT(*) >= $having");
        echo "<table style='border-spacing: 0px;'><tr><th>Gender</th><th>Pokemon</th></tr>";
        while (($row = $res->fetch_assoc()) != false) {
          echo "<tr>
                            <td>" . $row["Gender"] . "</td>
                            <td>" . $row["COUNT(*)"] . "</td>
                            </tr>";
        }
        echo "</table>";
      } else if ($groupBy == 'date') {
        $res = $db->query("SELECT TimeCaught, COUNT(*) FROM Pokemon GROUP BY TimeCaught HAVING COUNT(*) >= $having");
        echo "<table style='border-spacing: 0px;'><tr><th>Time Caught</th><th>Pokemon</th></tr>";
        while (($row = $res->fetch_assoc()) != false) {
          echo "<tr>
                            <td>" . $row["TimeCaught"] . "</td>
                            <td>" . $row["COUNT(*)"] . "</td>
                            </tr>";
        }
        echo "</table>";
      } else if ($groupBy == 'spid') {
        $res = $db->query("SELECT ID, COUNT(*) FROM Pokemon GROUP BY ID");
        echo "<table style='border-spacing: 0px;'><tr><th>Species ID</th><th>Pokemon</th></tr>";
        while (($row = $res->fetch_assoc()) != false) {
          echo "<tr>
                            <td>" . $row["ID"] . "</td>
                            <td>" . $row["COUNT(*)"] . "</td>
                            </tr>";
        }
        echo "</table>";
      } else if ($groupBy == 'gender') {
        $res = $db->query("SELECT Gender, COUNT(*) FROM Pokemon GROUP BY Gender");
        echo "<table style='border-spacing: 0px;'><tr><th>Gender</th><th>Pokemon</th></tr>";
        while (($row = $res->fetch_assoc()) != false) {
          echo "<tr>
                            <td>" . $row["Gender"] . "</td>
                            <td>" . $row["COUNT(*)"] . "</td>
                            </tr>";
        }
        echo "</table>";
      } else if ($groupBy == 'date') {
        $res = $db->query("SELECT TimeCaught, COUNT(*) FROM Pokemon GROUP BY TimeCaught");
        echo "<table style='border-spacing: 0px;'><tr><th><th>Time Caught</th><th>Pokemon</th></tr>";
        while (($row = $res->fetch_assoc()) != false) {
          echo "<tr>
                            <td>" . $row["TimeCaught"] . "</td>
                            <td>" . $row["COUNT(*)"] . "</td>
                            </tr>";
        }
        echo "</table>";
      }
    }
  }

  mysqli_commit($db);
}

function displayMegaEvolutions(mysqli $db)
{
  $res = $db->query("SELECT S.SpName, H.MeName FROM Species S, has_a H WHERE S.ID = H.ID");
  echo "<table style='border-spacing: 0px;'><tr><th>Pokemon</th><th>Mega Evolution</th></tr>";
  while (($row = $res->fetch_assoc()) != false) {
    echo "<tr>
                <td>" . $row["SpName"] . "</td>
                <td> " . $row["MeName"] . "</td>
                </tr>";
  }
  echo "</table>";
  mysqli_commit($db);
}

function displayEvolutions(mysqli $db)
{
  $res = $db->query("SELECT S1.SpName, S2.SpName FROM Species S1, Species S2, EvolvesInto EI WHERE S1.ID = EI.SpID1 AND S2.ID = EI.SpID2");
  echo "<table style='border-spacing: 0px;'><tr><th>Pokemon</th><th>Evolves Into</th></tr>";

  while (($row = $res->fetch_array()) != false) {
    echo "<tr>
            <td>" . $row[0] . "</td>
            <td> " . $row[1] . "</td>
            </tr>";
  }
  echo "</table>";
  mysqli_commit($db);
}

function showPokemonNotWeakAgainst(mysqli $db, $numTypes)
{
  $res = $db->query("SELECT S.SpName FROM Species S WHERE NOT EXISTS (SELECT OT.ID FROM WeakAgainst WA, ofType OT WHERE S.ID = OT.ID AND (OT.Type1 = WA.Type1_TypeName OR OT.Type2 = WA.Type1_TypeName) AND WA.Type2_TypeName = '" . $numTypes . "') ");
  echo "<table style='border-spacing: 0px;'><tr><th>All Pokemon not weak to " . $numTypes . "</th></tr>";
  while (($row = $res->fetch_assoc()) != false) {
    echo "<tr>
                <td>" . $row["SpName"] . "</td>
                </tr>";
  }
  echo "</table>";
  mysqli_commit($db);
}

function aggregateStats(mysqli $db)
{
  $res = $db->query("SELECT G.ID, G.Gender FROM (SELECT SQP.ID, SQP.Gender, COUNT(*) AS GenderCount FROM Pokemon SQP GROUP BY SQP.ID, SQP.Gender) G JOIN (SELECT G.ID, MAX(G.GenderCount) AS maxGenderCount
              FROM (SELECT SQP.ID, SQP.Gender, COUNT(*) AS GenderCount FROM Pokemon SQP GROUP BY SQP.ID, SQP.Gender) G GROUP BY G.ID) GC ON G.ID = GC.ID AND G.GenderCount = GC.MaxGenderCount");
  echo "<table><tr><th>ID</th><th>Gender</th></tr>";
  while (($row = $res->fetch_assoc()) != false) {
    echo "<tr>
                <td>" . $row["ID"] . "</td>
                <td>" . $row["Gender"] . "</td>
                </tr>";
  }
  echo "</table>";

  mysqli_commit($db);
}
