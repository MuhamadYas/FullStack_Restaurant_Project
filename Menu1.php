<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amatic+SC">
    <title>Menu</title>
    <style>
        body, html {height: 100%}
        body, h1, h2, h3, h4, h5, h6 {font-family: "Amatic SC", sans-serif}
        .menu {display: none}
    </style>
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "id20831592_muhamadyasin";
    $password = "Yl3a4ic400!";
    $dbname = "id20831592_yasorestaurant";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch types from the "type" table and store them in an array
    $types = array();
    $typesQuery = "SELECT * FROM Type";
    $typesResult = $conn->query($typesQuery);
    while ($type = $typesResult->fetch_assoc()) {
        $types[$type['id']] = $type['Name'];
    }

    // Fetch food items from the "food" table and store them in separate arrays based on their type
    $foodArrays = array();
    $foodQuery = "SELECT * FROM Catagory";
    $foodResult = $conn->query($foodQuery);
    while ($food = $foodResult->fetch_assoc()) {
        $typeId = $food['TypeId'];
        if (!isset($foodArrays[$typeId])) {
            $foodArrays[$typeId] = array();
        }
        $foodArrays[$typeId][] = $food;
    }
    ?>

    <div class="w3-top w3-hide-small">
        <div class="w3-bar w3-xlarge w3-black w3-opacity w3-hover-opacity-off" id="myNavbar">
          <a href="index.html" class="w3-bar-item w3-button">HOME</a>
          <a href="Menu1.php" class="w3-bar-item w3-button">MENU</a>
          <a href="About.html" class="w3-bar-item w3-button">ABOUT</a>
          <a href="ContactForm.html" class="w3-bar-item w3-button">CONTACT</a>
          <a href="#order" class="w3-bar-item w3-button">Order</a>
          <a href="#LogIn" class="w3-bar-item w3-button">Sign in/Up</a>
        </div>
    </div>

    <div class="w3-container w3-black w3-padding-64 w3-xxlarge" id="menu">
        <div class="w3-content">
            <h1 class="w3-center w3-jumbo" style="margin-bottom: 64px">THE MENU</h1>
            <div class="w3-row w3-center w3-border w3-border-dark-grey">
                <?php
                // Displaying types (categories) as tab links
                foreach ($types as $typeId => $typeName) {
                    echo '<a href="javascript:void(0)" onclick="openMenu(event, \'' . $typeName . '\');" id="tablink_' . $typeId . '">';
                    echo '<div class="w3-col s4 tablink w3-padding-large w3-hover-red">' . $typeName . '</div>';
                    echo '</a>';
                }
                ?>
            </div>

            <?php
            // Displaying food items under their respective types
            foreach ($types as $typeId => $typeName) {
                echo '<div id="' . $typeName . '" class="w3-container menu w3-padding-32 w3-white">';
                foreach ($foodArrays[$typeId] as $food) {
                    echo '<h1><b>' . $food['Name'] . '</b> <span class="w3-right w3-tag w3-dark-grey w3-round">$' . $food['Price'] . '</span></h1>';
                    echo '<p class="w3-text-grey">' . $food['Description'] . '</p>';
                    echo '<hr>';
                }
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <footer class="w3-center w3-black w3-padding-small w3-large">
        <p>Find us at some address at some place or call us at 05050515-122330</p>
        <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green">w3.css</a></p>
    </footer>

    <script>
  // Tabbed Menu
  function openMenu(evt, menuName) {
    var i, x, tablinks;
    x = document.getElementsByClassName("menu");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].classList.remove("w3-red");
    }
    document.getElementById(menuName).style.display = "block";
    evt.currentTarget.firstElementChild.classList.add("w3-red");
  }

  // Automatically open the first tab on page load
  document.getElementById("tablink_1").click();
</script>

</body>
</html>
