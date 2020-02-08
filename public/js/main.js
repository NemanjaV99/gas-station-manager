function getPost(form)
{
    let params = [];

    for (i = form.elements.length - 1; i >= 0 ; i = i - 1) {

        params.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
    }

    params = params.join("&");
    
    ajax("POST", "index.php?page=employee&type=api", postResult, params);
}

function getData()
{
    ajax("GET", "index.php?page=employee&type=api", displayTable);
}

function ajax(method, url, success, data = null) 
{
    let xhttp = new XMLHttpRequest();

    xhttp.open(method, url, true);
        
    xhttp.onreadystatechange = function(){
        
        if(xhttp.readyState == 4 && xhttp.status == 200)
        {
            let response = JSON.parse(xhttp.responseText);
            success(response);
        }
    }
				
	if (data == null) {
        xhttp.send();
    } else {

        xhttp.setRequestHeader("X-Request-With", "XMLHttpRequest");
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttp.send(data);
    }
}

function postResult(result)
{
   if (result.success) {

       // remove the previous table to update result
       let oldTable = document.getElementsByClassName("display-data")[0];
       oldTable.style.opacity = "0";
       setTimeout(function(){oldTable.parentNode.removeChild(oldTable);}, 1000);

       ajax("GET", "index.php?page=employee&type=api", displayTable);

   } else {

       let container = document.getElementsByClassName("container")[0];
       let error = document.createElement("div");
       error.classList.add("error");
       error.innerText = result.error
       container.append(error);
   }
}

function displayTable(result)
{

    let table = document.createElement("table");
    table.classList.add("display-data");

    // create headers
    let headers = Object.keys(result[0]);
    let row = document.createElement("tr");

    for (i = 0; i < headers.length; i++) {
        let header = document.createElement("th");
        header.innerText = headers[i];
        row.append(header);
    }

    table.append(row);

    for (i = 0; i < result.length; i++) {

        let row = document.createElement("tr");

        for (data in result[i]) {

            let cell = document.createElement("td");
            cell.innerText = result[i][data]
            row.append(cell);
        }

        table.append(row);
    }

    document.getElementsByClassName("container")[0].prepend(table);
}

