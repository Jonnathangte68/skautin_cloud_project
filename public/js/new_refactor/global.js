const isSearchResult = $('#search_result_page').val() && $('#search_result_page').val() == "true";

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
    });

    if (isSearchResult) {
        let i = 0;
        // do {
        //     const isPersonNotAJob = (i == 0) ? true : false;
        //     const htmlContent = apprendSearchResultCard(isPersonNotAJob);
        //     $('#search_content').append(htmlContent);
        //     i++;
        // } while (i < 2);
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/api/mock_retrieve_search_results',
            data: {
                searchTerms: 'xxx',
            },
        })
            .done((response) => {
                if (response.status === "success") {
                    const { results } = response;
                    results.forEach(element => {
                        const htmlContent = apprendSearchResultCard(element);
                        $('.search_content').append(htmlContent);
                    });
                }
            });
    }
});