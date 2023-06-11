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
   <p></p>
   <button onclick=json_export()>JSON-Export</button>
   <p></p>
   <div id="container"></div>
   <script>
      var UserID;
      var UserName;
      var userIDAjax = new XMLHttpRequest();
      userIDAjax.open("GET", "/api/userid.php", false);
      userIDAjax.onreadystatechange = function() {
         var jsonRes = JSON.parse(userIDAjax.responseText);
         UserID = jsonRes.id;
         UserName = jsonRes.username;
      }
      userIDAjax.send();

      function json_export(){
        window.open('./api/export.php','_blank');

      }


      function admin_no_admin(user_id, admin_var, enabled_var) {
        var url = '/api/adminverwaltung.php';
         var xhr = new XMLHttpRequest();
         xhr.open("PATCH", url, false);
         // Send the proper header information along with the request
         xhr.setRequestHeader('Content-Type', 'application/json');

         xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
               console.log(xhr.responseText);
            };
         };

         if (admin_var == '1') {
            admin_var = '0';
         }
         else{
            admin_var = '1';
         }

         var data = JSON.stringify({
            admin: admin_var,
            enabled: enabled_var,
            id: user_id
         });

         xhr.send(data);
         var table = document.getElementById("users");
         if (table) table.parentNode.removeChild(table);
         list_users();
      };

      function enable_disable_user(user_id, admin_var, enabled_var) {
         var url = '/api/adminverwaltung.php';
         var xhr = new XMLHttpRequest();
         xhr.open("PATCH", url, false);
         // Send the proper header information along with the request
         xhr.setRequestHeader('Content-Type', 'application/json');

         xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
               console.log(xhr.responseText);
            };
         };

         if (enabled_var == '1') {
            enabled_var = '0';
         }
         else{
            enabled_var = '1';
         }

         var data = JSON.stringify({
            admin: admin_var,
            enabled: enabled_var,
            id: user_id
         });

         xhr.send(data);
         var table = document.getElementById("users");
         if (table) table.parentNode.removeChild(table);
         list_users();
      }

      // Function to convert JSON data to HTML table
      function list_users() {

         var jsonData = [];
         var xhr = new XMLHttpRequest();
         var url = '/api/adminverwaltung.php';

         xhr.open('GET', url, true);
         xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
               var jsonResponse = JSON.parse(xhr.responseText);
               // Assuming the JSON response is an array
               jsonData = jsonResponse;

               // Now you can process this array as per your requirement
               // Get the container element where the table will be inserted
               let container = $("#container");

               // Create the table element
               let table = $("<table id='users'>");

               // Get the keys (column names) of the first object in the JSON data
               let cols = Object.keys(jsonData[0]);

               // Create the header element
               let thead = $("<thead>");
               let tr = $("<tr>");

               // Loop through the column names and create header cells
               $.each(cols, function(i, item) {
                  let th = $("<th>");
                  th.text(item); // Set the column name as the text of the header cell
                  tr.append(th); // Append the header cell to the header row
               });
               let th1 = $("<th>");
               th1.text("Set / Remove Admin"); // Set the column name as the text of the header cell
               tr.append(th1); // Append the header cell to the header row
               let th2 = $("<th>");
               th2.text("Enable / Disable User"); // Set the column name as the text of the header cell
               tr.append(th2); // Append the header cell to the header row

               thead.append(tr); // Append the header row to the header
               table.append(tr) // Append the header to the table

               // Loop through the JSON data and create table rows
               $.each(jsonData, function(i, item) {
                  let tr = $("<tr>");

                  // Get the values of the current object in the JSON data
                  let vals = Object.values(item);

                  // Loop through the values and create table cells
                  $.each(vals, (i, elem) => {
                     let td = $("<td>");
                     td.text(elem); // Set the value as the text of the table cell
                     tr.append(td); // Append the table cell to the table row
                  });

                  let td1 = $("<td>");
                  let btn_admin = $("<button class = 'btn_admin'>Make Admin</button>");
                  if (vals[4] == '1') {
                    btn_admin = $("<button class = 'btn_disable'>Remove Admin</button>");
                  }
                  $(btn_admin).on("click", (i) => {
                    admin_no_admin(vals[0], vals[4], vals[5]);
                  })
                  $(btn_admin).addClass("btn_lobby_join").appendTo($(td1));
                  tr.append(td1); // Append the table cell to the table row

                  let td2 = $("<td>");
                  let btn_disable = $("<button class = 'btn_disable'>Disable Account</button>");
                  if (vals[5] == '0') {
                    btn_disable = $("<button class = 'btn_disable'>Enable Account</button>");
                  }

                  $(btn_disable).on("click", (i) => {
                     enable_disable_user(vals[0], vals[4], vals[5]);
                  })
                  $(btn_disable).addClass("btn_lobby_join").appendTo($(td2));
                  tr.append(td2); // Append the table cell to the table row

                  table.append(tr); // Append the table row to the table
               });
               container.append(table) // Append the table to the container element

            }
         };
         xhr.send();
      }

    list_users();
   </script>
</body>