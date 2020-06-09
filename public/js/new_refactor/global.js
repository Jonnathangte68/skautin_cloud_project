const isSearchResult = $('#search_result_page').val() && $('#search_result_page').val() == "true";
const isAdvancedSearchPage = $('#advanced_search').val() && $('#advanced_search').val() == "true";

function updateSelections() {
    let selectedFilter = 0;
    for (let i = 0; i < $('.selectors span').length; i++) {
        if ($($('.selectors span')[i]).hasClass('selected')) {
            selectedFilter = i;
        }
    }
    jQuery.each($('#search_content > .col-md-4'), function (k, item) {
        if (selectedFilter === 0 && !$(item).hasClass('talent-card')) {
            console.log('false');
            $(this).hide();
        } else if (selectedFilter === 1 && !$(item).hasClass('recruiter-card')) {
            console.log('false');
            $(this).hide();
        } else if (selectedFilter === 2 && !$(item).hasClass('job-card')) {
            console.log('false');
            $(this).hide();
        } else {
            console.log('true');
            $(this).show();
        }
    });
}

$(document).ready(function () {
    $('#search_action').click(function () {
        alert('Test 1.');
    });

    $('#prependedtext').keydown(function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            const textToSearch = $(this).val();
            location.href = `/search?terms=${textToSearch}`;
        }
    });

    $('.selectors span').click(function () {
        $('.selectors span').removeClass('selected');
        $(this).addClass('selected');
        updateSelections();
    });

    if (isSearchResult) {
        let i = 0;
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/api/mock_retrieve_search_results',
            data: {
                searchTerms: 'xxx',
            },
        })
            .done((response) => {
                console.log('response done');
                if (response.status === "success") {
                    const { results } = response;
                    console.log('results ', results);
                    results.forEach(element => {
                        console.log('looping ', element);
                        let cardType = 0;
                        if (element.hasOwnProperty('description') && element.description !== "") {
                            cardType = 2;
                        }
                        if (element.hasOwnProperty('recruiter_type') && element.recruiter_type !== "") {
                            cardType = 1;
                        }
                        const htmlContent = apprendSearchResultCard(element, cardType);
                        console.log('htmlContent ', htmlContent);
                        $('#search_content').append(htmlContent);
                    });
                    updateSelections();
                }
            });
    } else if (isAdvancedSearchPage) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/api/countries',
        })
            .done((response) => {
                if (response) {
                    response.forEach(c => {
                        const htmlContent = apprendInnerCountry(c.label, c.value);
                        $('#country').append(htmlContent);
                    });
                }
            });
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/api/categories',
        })
            .done((response) => {
                if (response) {
                    response.forEach(c => {
                        const htmlContent = apprendInnerCategory(Object.keys(c)[0], Object.values(c)[0]);
                        $('#category').append(htmlContent);
                    })
                }
            });
    }
    $('.dropdown-menu').click(function (e) {
        $(".dropdown-toggle").dropdown('toggle');// this doesn't
    });
});

cleanSubcategoryList = () => {
    $('#subcategory').empty();
    $('#subcategory').append(`<option>-- Select one of the categories --</option>`);
}

cleanStateList = () => {
    $('#state').empty();
    $('#state').append(`<option>Please select a country.</option>`);
}

cleanCitiesList = () => {
    $('#city').empty();
    $('#city').append(`<option>Please select a state.</option>`);
}

$('#category').change(function () {
    if (isAdvancedSearchPage) {
        cleanSubcategoryList();
        const selectedCategory = $('#category').val();
        if (selectedCategory) {
            $.ajax({
                url: "/api/getcategsxsubcategs" + "?category=" + selectedCategory,
                dataType: "json",
                type: "get",
                success: function (response) {
                    if (response) {
                        response.forEach((sub) => {
                            const htmlContent = apprendOwnJobSubcategoriesRecruiter(sub);
                            $('#subcategory').append(htmlContent);
                        });
                    }
                },
                error: function (xhr) {
                    //console.log(xhr);
                }
            });
        }
    }
});

$('#country').change(function () {
    if (isAdvancedSearchPage) {
        cleanStateList();
        $.ajax({
            url: "/api/states",
            dataType: "json",
            data: { q: '', country: $("#country").val() },
            success: function (data) {
                for (const state of Object.values(data)) {
                    const htmlContent = apprendSelectableStateJobCreationRecruiter(state);
                    $('#state').append(htmlContent);
                };
            }
        });
    }
});

$('#state').change(function () {
    if (isAdvancedSearchPage) {
        cleanCitiesList();
        $.ajax({
            url: "/api/cities",
            dataType: "json",
            data: { q: '', state: $("#state").val() },
            success: function (data) {
                for (const city of Object.values(data)) {
                    const htmlContent = apprendSelectableCityJobCreationRecruiter(city);
                    $('#city').append(htmlContent);
                };
            }
        });
    }
});

$('#user_type').change(function () {
    if ($('#user_type').val() === '1' || $('#user_type').val() === '3') {
        if ($('#user_type').val() === '1') {
            $('#age-range-select').show();
        } else {
            $('#age-range-select').hide();
        }
        $('#experience-select-container').show();
    } else {
        $('#experience-select-container').hide();
        $('#age-range-select').hide();
    }
});

function resetFields() {
    $('#user_type').val("1");
    $('#category').val("1");
    $('#category').change();
    $('#ages').val("1");
    $('#level').val("1");
    $('#country').val("1");
    $('#country').change();
    $('#state').val("1");
    $('#state').change();
    $('#city').val("1");
    $('#age-range-select').show();
    $('#experience-select-container').show();
}

$('.btnadvsearch').click(function () {
    const basePath = '/search?terms=';
    const searchRequest = `${JSON.stringify($('#user_type').val())}+${JSON.stringify($('#category').val())}+${JSON.stringify($('#subcategory').val())}+${JSON.stringify($('#ages').val())}+${JSON.stringify($('#level').val())}+${JSON.stringify($('#country').val())}+${JSON.stringify($('#state').val())}+${JSON.stringify($('#city').val())}`;
    location.href = basePath + searchRequest;
});

$('.popover-notifications').click(function () {
    $('#dsgsd').toggle();
});