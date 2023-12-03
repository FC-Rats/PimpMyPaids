var listAccountData = "";
var siren = "";
var companyName = "";
var date = "";

$(function () {
    siren = $('#siren').val();
    companyName = $('#companyName').val();
    date = $('#date').val();
    listAccounts(siren, companyName, date, $("#sortAccount").val());

    $("#sortAccount").on("change", function () {
        siren = $('#siren').val();
        companyName = $('#companyName').val();
        date = $('#date').val();
        listAccounts(
            siren,
            companyName,
            date,
            $("#sortAccount").val()
        );
    });

    $("#searchAccountsButton").on("click", function () {
        siren = $('#siren').val();
        companyName = $('#companyName').val();
        date = $('#date').val();
        listAccounts(siren, companyName, date, $("#sortAccount").val());
    });

    // export
    $("#export_type").on("change", function () {
        console.log('changing export type');
        var formData = [];
        siren = $('#siren').val();
        companyName = $('#companyName').val();
        date = $('#date').val();
        context = $('#context').val();
        export_type = $('#export_type').val();
        formData.push({ name: 'siren', value: siren });
        formData.push({ name: 'companyName', value: companyName });
        formData.push({ name: 'date', value: date });
        formData.push({ name: 'context', value: context });
        formData.push({ name: 'export_type', value: export_type });
        $.ajax({
            url: "../../export/export_data.php",
            type: "POST",
            dataType: "JSON",
            data: { "siren": siren, "companyName": companyName, "date": date, "context": context, "export_type": export_type },
            success: function (data) {
                if (data.Test) {
                    console.log(data.Test);
                }
            },
            error: function (data) {
                console.log(data);
            },
        });
    });
});

function listAccounts(
    siren,
    companyName,
    date,
    sort
) {
    var formData = [];
    formData.push({ name: 'siren', value: siren });
    formData.push({ name: 'companyName', value: companyName });
    formData.push({ name: 'date', value: date });
    formData.push({ name: 'sortAccount', value: sort });
    $.ajax({
        url: "../../includes/getAccounts.php",
        type: "POST",
        dataType: "JSON",
        data: { formData },
        success: function (data) {
            listAccountData = data.ListAccounts;
        },
        error: function (data) {
            console.log(data);
        },
    });

    $("#accordionListAcounts").empty();
    $.map(listAccountData, function (data, dataKey) {
        html = "";
        // html += "to Add";

        $("#accordionListAcounts").append(html);
    });
}