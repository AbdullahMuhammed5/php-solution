$(document).ready(function() {
    const url = window.location.origin;
    const countryElem = $('#country-ddl')
    const stateElem = $('#state-ddl')

    const handleCountryChange = (e) => {
        $.ajax({
            type: 'GET',
            url: `${url}?q=${e.target.value}`,
            success: (res) => {
                $('#example').dataTable().fnClearTable();
                $('#example').dataTable().fnAddData(res.data);
            },
            error: (res) => console.log('Error')
        })
    }

    const handleStateChange = (e) => {
        $.ajax({
            type: 'GET',
            url: `${url}?q=${e.target.value}`,
            success: (res) => {
                $('#example').dataTable().fnClearTable();
                $('#example').dataTable().fnAddData(res.data);
            },
            error: (res) => console.log('Error')
        })
    }

    const renderCountryListOption = (data) => {
        for (let country of data) {
            countryElem.append(`<option value='${country.code}'>${country.name}</option>`)
        }
    }

    const renderCountryList = (e) => {
        $.ajax({
            type: 'GET',
            url: `${url}/countries`,
            success: (res) => {
                renderCountryListOption(res)
            },
            error: (res) => console.log('Error')
        })
    }

    renderCountryList()

    countryElem.on('change', handleCountryChange)
    countryElem.on('change', handleStateChange)

    // to be seperated in initialize function
    $('#example').DataTable( {
        "ajax": url,
        columns: [
            { data: "country" },
            { data: "phone_state" },
            { data: "country_code"},
            { data: "phone"},
        ],
        pageLength: 5,
        lengthMenu: [5, 10, 20, 50, 100],
    } );
} );

