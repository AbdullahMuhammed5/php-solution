$(document).ready(function() {
    const url = window.location.origin;
    const countryElem = $('#country-ddl')
    const stateElem = $('#state-ddl')

    async function handleFilterChange(e) {
        $.ajax({
            type: 'GET',
            url: `${url}/customers?country_code=${countryElem.val()}&phone_state=${stateElem.val()}`,
            success: (result) => {
                $('#example').dataTable().fnClearTable();
                $('#example').dataTable().fnAddData(result.data);
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
            error: (res) => console.log(res)
        })
    }

    function initialiseTable(){
        $('#example').DataTable( {
            "ajax": `${url}/customers`,
            "aoColumns": [
                { data: "country"},
                {
                    "mData": "phone_state",
                    "mRender": function (data, type, row) {
                        return data ?
                            "<i class=\"fa fa-check-circle fa-2x\" style=\"color: green\"></i>" :
                            "<i class=\"fa fa-times-circle fa-2x\" style=\"color: red\"></i>"
                    }
                },
                { data: "country_code"},
                { data: "phone"}
            ],
            pageLength: 5,
            lengthMenu: [5, 10, 20, 50, 100],
            order: []
        } );
    }

    renderCountryList()
    initialiseTable()

    countryElem.on('change', handleFilterChange)
    stateElem.on('change', handleFilterChange)

} );

