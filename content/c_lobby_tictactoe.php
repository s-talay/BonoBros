<head>
   <style>
      table,
      th,
      td {
         border: 1px solid black;
         border-collapse: collapse;
      }

      td,
      th {
         padding: 10px;
      }
   </style>
</head>

<body>
   <style>
      #myLobby {
         margin-left: 10px;
      }

      td {
         position: relative;
      }

      button.fill-td {
         position: absolute;
         background-color: #44829f;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         z-index: 1;
      }
   </style>
   <div class="d-flex justify-content-center mb-2">
      <button id="createLobby" class="btn btn-secondary mb-2" onclick="createLobby()">Create Lobby</button>
      <button id="myLobby" class="btn btn-info mb-2" onclick="location.href='/php/lobby.php'">My Lobbies</button>
   </div>


   <div class="text-center table-responsive mx-auto col-lg-8 col-md-8 col-sm-10" id="container"></div>
   <script>
      var UserID;
      var UserName;
      var userIDAjax = new XMLHttpRequest();
      userIDAjax.open("GET", "/api/userid.php", false);
      userIDAjax.onreadystatechange = function () {
         var jsonRes = JSON.parse(userIDAjax.responseText);
         UserID = jsonRes.id;
         UserName = jsonRes.username;
      }
      userIDAjax.send();

      function createLobby() {

         var url = '/api/lobbyapi.php';
         var xhr = new XMLHttpRequest();
         xhr.open("POST", url, false);
         // Send the proper header information along with the request
         xhr.setRequestHeader('Content-Type', 'application/json');

         xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
               console.log(xhr.responseText);
            };
         };

         var data = JSON.stringify({
            gameid: 1
         });

         xhr.send(data);
         console.log(data);
         document.location.href = "/php/lobby.php";
      };

      function join_lobby(lobby_id) {
         var url = '/api/lobbyapi.php';
         var xhr = new XMLHttpRequest();
         xhr.open("PATCH", url, false);
         // Send the proper header information along with the request
         xhr.setRequestHeader('Content-Type', 'application/json');

         xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
               console.log(xhr.responseText);
            };
         };

         var data = JSON.stringify({
            lobbyid: lobby_id
         });

         xhr.send(data);
         document.location.href = "/php/lobby.php";
      }

      // Function to convert JSON data to HTML table
      function convert() {

         var jsonData = [];
         var xhr = new XMLHttpRequest();
         var url = '/api/lobbyapi.php?state=open';

         xhr.open('GET', url, true);
         xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
               console.log(xhr.responseText);
               var jsonResponse = JSON.parse(xhr.responseText);
               // Assuming the JSON response is an array
               jsonData = jsonResponse;

               // Now you can process this array as per your requirement
               // Get the container element where the table will be inserted
               let container = $("#container");

               // Create the table element
               let table = $("<table class='table' id='lobby'>");

               // Get the keys (column names) of the first object in the JSON data
               let cols = Object.keys(jsonData[0]);

               // Create the header element
               let thead = $("<thead>");
               let tr = $("<tr>");

               // Loop through the column names and create header cells
               $.each(cols, function (i, item) {
                  let th = $("<th>");
                  th.text(item); // Set the column name as the text of the header cell
                  tr.append(th); // Append the header cell to the header row
               });
               let th = $("<th>");
               th.text("Join"); // Set the column name as the text of the header cell
               tr.append(th); // Append the header cell to the header row

               thead.append(tr); // Append the header row to the header
               table.append(tr) // Append the header to the table

               // Loop through the JSON data and create table rows
               $.each(jsonData, function (i, item) {
                  let tr = $("<tr>");

                  // Get the values of the current object in the JSON data
                  let vals = Object.values(item);

                  // Loop through the values and create table cells
                  $.each(vals, (i, elem) => {
                     let td = $("<td>");
                     td.text(elem); // Set the value as the text of the table cell
                     tr.append(td); // Append the table cell to the table row
                  });
                  let td = $("<td>");
                  let btn_join = $("<button class='fill-td btn btn-primary btn_lobby_join'>Join</button>");
                  $(btn_join).on("click", (i) => {
                     join_lobby(vals[0])
                  })
                  $(btn_join).addClass("btn_lobby_join").appendTo($(td));
                  tr.append(td); // Append the table cell to the table row
                  table.append(tr); // Append the table row to the table
               });
               container.append(table) // Append the table to the container element

            }
         };
         xhr.send();
      }

      convert()
      var intervalId = window.setInterval(function () {
         var table = document.getElementById("lobby");
         if (table) table.parentNode.removeChild(table);
         convert();
      }, 10000);
   </script>
</body>