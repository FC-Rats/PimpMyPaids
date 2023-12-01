var rowsPerPage = 3;
var pageToShow = 1;
var listRemittancesData = [
    "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"
];

$(document).ready(function () {
    $("#nbLineByPage").on("input", function () {
        console.log("Contenu de l'input nbLineByPage : " + $(this).val());
        rowsPerPage=$(this).val();
        PrintList();
    });
    $("#pageToShow").on("input", function () {
        console.log("Contenu de l'input pageToShow : " + $(this).val());
        pageToShow=$(this).val();
        PrintList();
    });
    PrintList();
});

function PrintList() {
    console.log("PRINTING");
    //$("#container-remise-list").empty();
    var start = rowsPerPage*(pageToShow-1);
    var itemsToShow = listRemittancesData.slice(start, start+rowsPerPage);

    $.map(itemsToShow, function (data, dataKey) {
        html = "";
        // html += "to Add";
        console.log(data);

        //$("#container-remise-list").append(html);
    });
}