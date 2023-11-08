function getLabResult() {
    var guid = $('#code').val();
    if (validateGuid(guid) == false)
        return;

    window.location.href = '/labresults/' + guid;
}

function validateGuid(guid) {
    var regex = new RegExp("^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$");
    if (regex.test(guid) == false) {
        alert('Invalid Code');
        return false;
    }
}