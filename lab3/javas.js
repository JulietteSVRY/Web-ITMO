const table = document.createElement("table");
let lineNumber=0;

function addTable() {
    if (document.getElementById('table') !=null){
        alert("Таблица уже создана!");
    }
    else {

        table.innerHTML = "<table>\n" +
            "<tr>\n" +
            "      <th>\n" +
            lineNumber+
            "      </td>\n" +
            "     </td>\n" +
            "      <td>\n" +
            "      </td>\n" +
            "</tr>"
        "              </table>";

        table.setAttribute('id','table')
        document.body.append(table);
        lineNumber++;
    }
}

function addLine(){
    let tab = table.insertRow();
    tab.insertCell().append(lineNumber);
    tab.insertCell().append("Smth interesting");
    lineNumber++;
}
function deleteLine(){
    if (document.getElementById('num').value=="") {
        alert("Сначала введите число");
        return null;
    }
    num = document.getElementById('num').value;
    try {
        table.deleteRow(num);
    }
    catch (DOMexcepion){
        alert("Строки с таким номером нет")
    }

}