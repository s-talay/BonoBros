<button onclick="location.href='/php/lobby_tictactoe.php'">Back</button>

<script>
    function convert() {


    var jsonData = [];
    var xhr = new XMLHttpRequest();
    var url = '/api/lobbyapi.php?player1id='+$S;

    xhr.open('GET', url, true);
    xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
        var jsonResponse = JSON.parse(xhr.responseText);
        // Assuming the JSON response is an array
        jsonData = jsonResponse;
        console.log(jsonData);
        // Now you can process this array as per your requirement
        // Get the container element where the table will be inserted
        let container = $("#container");

        // Create the table element
        let table = $("<table id='lobby'>");

        // Get the keys (column names) of the first object in the JSON data
        let cols = Object.keys(jsonData[0]);

        // Create the header element
        let thead = $("<thead>");
        let tr = $("<tr>");

        // Loop through the column names and create header cells
        $.each(cols, function(i, item){
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
        $.each(jsonData, function(i, item){
        let tr = $("<tr>");
        
        // Get the values of the current object in the JSON data
        let vals = Object.values(item);
        
        // Loop through the values and create table cells
        $.each(vals, (i, elem) => {
            let td = $("<td>");
            td.text(elem); // Set the value as the text of the table cell
            tr.append(td); // Append the table cell to the table row
        });
        });
        container.append(table) // Append the table to the container element

        }
    };
    xhr.send();
    }
</script>