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

<button onclick="location.href='/php/lobby_tictactoe.php'">Back</button>
<p></p>
<div id="container"></div>
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

   function enter_Game() {

   }

   function close_lobby(lobby_id) {
      //alert(lobby_id);
      var url = '/api/lobbyapi.php';
      var xhr = new XMLHttpRequest();
      xhr.open("DELETE", url, false);
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

   function convert_lobby_open() {

      var jsonData = [];
      var xhr = new XMLHttpRequest();
      var url = '/api/lobbyapi.php?state=open&playerid=' + UserID;

      xhr.open('GET', url, true);
      xhr.onreadystatechange = function () {
         if (xhr.readyState == 4 && xhr.status == 200) {
            var jsonResponse = JSON.parse(xhr.responseText);
            // Assuming the JSON response is an array
            jsonData = jsonResponse;

            // Now you can process this array as per your requirement
            // Get the container element where the table will be inserted
            let container = $("#container");

            // Create the table element
            let table = $("<table id='lobby_open'>");

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
            th.text("Close Lobby"); // Set the column name as the text of the header cell
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
               let btn_join = $("<button class = 'btn_lobby_close'>Close Lobby</button>");
               $(btn_join).on("click", (i) => { close_lobby(vals[0]) })
               $(btn_join).addClass("btn_lobby_close").appendTo($(td));
               tr.append(td); // Append the table cell to the table row
               table.append(tr); // Append the table row to the table
            });
            container.append(table) // Append the table to the container element

         }
      };
      xhr.send();
   }

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

   function enter_Game() {

   }

   function convert_lobby_running() {

      var jsonData = [];
      var xhr = new XMLHttpRequest();
      var url = '/api/lobbyapi.php?state=running&playerid=' + UserID;

      xhr.open('GET', url, true);
      xhr.onreadystatechange = function () {
         if (xhr.readyState == 4 && xhr.status == 200) {
            var jsonResponse = JSON.parse(xhr.responseText);
            // Assuming the JSON response is an array
            jsonData = jsonResponse;

            // Now you can process this array as per your requirement
            // Get the container element where the table will be inserted
            let container = $("#container");

            // Create the table element
            let table = $("<table id='lobby_running'>");

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
            th.text("Enter Game"); // Set the column name as the text of the header cell
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
               let btn_join = $("<button class = 'btn_lobby_join'>Enter Game</button>");
               $(btn_join).on("click", (i) => { enter_Game(vals[0]) })
               $(btn_join).addClass("btn_lobby_join").appendTo($(td));
               tr.append(td); // Append the table cell to the table row
               table.append(tr); // Append the table row to the table
            });
            container.append(table) // Append the table to the container element

         }
      };
      xhr.send();
   }

   convert_lobby_open();
   convert_lobby_running();
   var intervalId = window.setInterval(function () {
      var table = document.getElementById("lobby_open");
      if (table) table.parentNode.removeChild(table);
      var table = document.getElementById("lobby_running");
      if (table) table.parentNode.removeChild(table);
      convert_lobby_open();
      convert_lobby_running();
   }, 10000);
</script>