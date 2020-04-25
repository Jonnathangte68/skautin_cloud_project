// Global variables

var isTalentProfilePage = false;
var isRecruiterJobsInformationPage = false;
var isRecruiterJobCreationPage = false;
var isRecruiterConnectionPage = false;
var jobList = [];

// Functions

$('document').ready(() => {
    // Mocks 

    isTalentProfilePage = $('#is_preview_talent_profile_page') && $('#is_preview_talent_profile_page').val() == "true";
    isRecruiterJobsInformationPage = $('#is_recruiter_jobs_information_page') && $('#is_recruiter_jobs_information_page').val() == "true";
    isRecruiterJobCreationPage = $('#is_recruiter_job_creation_page') && $('#is_recruiter_job_creation_page').val() == "true";
    isRecruiterConnectionPage = $('#is_recruiter_connection_page') && $('#is_recruiter_connection_page').val() == "true";


    if (isTalentProfilePage) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/api/mock_retrieve_talent_complete_information',
            data: {
                talentId: 'bad62cf5-e61e-4987-9d9a-d29bd693c992',
            },
        })
            .done((response) => {
                if (response.status === "success") {
                    const { results } = response;
                    const { videos } = response.results;
                    addHeaderTalentProfile(results);
                    addMainTalentProfileVideoSource(videos);
                    addOtherVideosSection(videos);
                }
            });
    }
    else if (isRecruiterJobsInformationPage) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/api/mock_retrieve_own_jobs',
            data: {},
        })
            .done((response) => {
                if (response.status === "success") {
                    const { results } = response;
                    jobList = results;
                    for (const job of results) {
                        const htmlContent = apprendOwnJobRecruiter(job);
                        $('#listed_jobs').append(htmlContent);
                    }
                }
            });
    }
    else if (isRecruiterJobCreationPage) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/api/countries',
        })
            .done((response) => {
                if (response) {
                    response.forEach((country) => {
                        const htmlContent = apprendInnerCountry(country.label, country.value);
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
                    response.forEach((category) => {
                        const key = Object.keys(category)[0];
                        const value = Object.values(category)[0];
                        const htmlContent = apprendInnerCategory(key, value);
                        $('#category').append(htmlContent);
                    });
                }
            });
    }
    else if (isRecruiterConnectionPage) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/api/retrieve_connection_list_recruiter',
        })
            .done((response) => {
                if (response) {
                    const { results } = response;
                    if (!results || results.length === 0) {
                        // apprendTextNoResultsToShow();
                    } else {
                        for (const connection of results) {
                            const htmlContent = apprendRecruiterConnectionsSectionContent(
                                connection
                            );
                            $('#connections_list').append(htmlContent);
                        }
                        checkMoreResults();
                    }
                }
            });
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/api/retrieve_connection_suggestions',
        })
            .done((response) => {
                if (response) {
                    const { results } = response;
                    if (!results || results.length === 0) {
                        const htmlContent = apprendTextNoConnectionsSuggestionsToShow();
                        $($('.scrollbar-without-scroll')[1]).append(htmlContent);
                    } else {
                        for (const suggestion of results) {
                            const htmlContent = apprendRecruiterSuggestionSectionContent(
                                suggestion
                            );
                            $($('.scrollbar-without-scroll')[1]).append(htmlContent);
                        }
                    }
                }
            });
    }
    else {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/api/mock_retrieve_suggestions_prospects',
            data: {
                userId: 'email@gmail.com',
            },
        })
            .done((response) => {
                $('#replace_results_talents').text(response.videos.length);
                for (const video of response.videos) {
                    const { uri, userName, id } = video;
                    $('#main_video_list_content')
                        .append(
                            `<div class="col-md-4 no-padding-trail" onclick="updateVideoSource('${uri}', '${userName}', '${id}')">`
                            + '<a data-toggle="modal" data-target="#talentVideoPreviewModal">'
                            + '<video class="vid-container" autoplay loop muted src="api/stream/' + uri + '"></video>'
                            + '</a></div>'
                        );
                }
            });

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/api/mock_retrieve_meta_results',
            data: {
                userId: 'email@gmail.com',
            },
        })
            .done((response) => {
                const userList = response.users_list;
                const followingCount = userList.followers.length;
                const viewsCount = userList.following.length;
                const followersCount = userList.views.length;
                const favouritesCount = userList.favs.length;
                $('#following-count').text(followingCount);
                $('#views-count').text(viewsCount);
                $('#followers-count').text(followersCount);
                $('#favourites-count').text(favouritesCount);
                for (const follower of response.users_list.followers) {
                    const htmlContent = apprendFollowerSectionContent(follower.picture_uri, 'Follower profile image', follower.name, follower.recruiter_type, follower.category);
                    $('#followers-bar-content').append(htmlContent);
                }
                for (const following of response.users_list.following) {
                    const htmlContent = apprendFollowerSectionContent(following.picture_uri, 'Following profile image', following.name, following.recruiter_type, following.category);
                    $('#following-bar-content').append(htmlContent);
                }
                for (const viewer of response.users_list.views) {
                    const htmlContent = apprendFollowerSectionContent(viewer.picture_uri, 'Viewer profile image', viewer.name, viewer.recruiter_type, viewer.category);
                    $('#views-bar-content').append(htmlContent);
                }
                for (const fav of response.users_list.favs) {
                    const htmlContent = apprendFollowerSectionContent(fav.picture_uri, 'Favourites profile image', fav.name, fav.recruiter_type, fav.category);
                    $('#favourites-bar-content').append(htmlContent);
                }
                $('.rounded-profile-image')
                    .on("load", function () {
                        $(this).parent().find(".profile-image-loading-bar").hide();
                        $(this).parent().find(".rounded-profile-image").show();
                    });
            });
    }
});

stopVideoLoading = async () => {
    for (let i = 0; i < $('video').length; i++) {
        $('video')[i].pause();
    }
}

updateVideoSource = (videoUri, name, id) => {
    $('#bigPreviewTalentVideo').attr("src", '/api/stream/' + videoUri);
    $('#bigPreviewTalentTitleName').text(name);
    $('#bigPreviewTalentTitleName').attr('data-userId', id);
    setTimeout(function () {
        $('#bigPreviewTalentVideo').get(0).play();
    }, 300);
};

openTalentProfilePage = async () => {
    await stopVideoLoading();
    const userId = $('.full-video-modal h2').attr('data-userId');
    if (userId) {
        const newUrl = `/talent-preview/${userId}`;
        window.open(newUrl, "_self");
    }
};

addHeaderTalentProfile = (headerInfo) => {
    const htmlContent = apprendHeaderTalentProfile(headerInfo.picture_uri, headerInfo.meta_info);
    $('#headerTalentInfoSection').append(htmlContent);
}

addMainTalentProfileVideoSource = (videos) => {
    if (!videos) {
        const htmlContent = apprendNoOtherVideosFound();
        $('#mainVideoProfileTalent').hide();
        $('#videoPanel').append(htmlContent);
    }
    $('#mainVideoProfileTalent').attr("src", '/api/stream/' + videos[0]);
    $('#mainVideoProfileTalent')[0].play();
    setTimeout(function () {
        $('#mainVideoProfileTalent')[0].pause();
    }, 320);
}

addOtherVideosSection = (videos) => {
    if (!videos || videos.length > 1 === false) {
        const htmlContent = apprendNoOtherVideosFound();
        $('#right_box_other_videos').append(htmlContent);
        return;
    }
    const numberOfOtherVideos = videos.length - 1;
    const htmlContent = apprendOtherVideosToShowTalentProfileVideoSection(numberOfOtherVideos, videos);
    $('#right_box_other_videos').append(htmlContent);
}

validateNewJobCreation = (formData) => {
    let resultStatus = true;
    let htmlContent = '';
    if (!formData.title) {
        htmlContent = apprendEmptyErrorCreateJob('Title cannot be empty');
        $('#form_errors').append(htmlContent);
        resultStatus = false;
    }
    if (!formData.description) {
        htmlContent = apprendEmptyErrorCreateJob('Description cannot be empty');
        $('#form_errors').append(htmlContent);
        resultStatus = false;
    }
    if (!formData.category) {
        htmlContent = apprendEmptyErrorCreateJob('Job must be assigned to a particular category');
        $('#form_errors').append(htmlContent);
        resultStatus = false;
    }
    if (!formData.subcategory) {
        htmlContent = apprendEmptyErrorCreateJob('Job must be assigned to a particular sub-category');
        $('#form_errors').append(htmlContent);
        resultStatus = false;
    }
    if (!formData.country) {
        htmlContent = apprendEmptyErrorCreateJob('Job must be located in a country');
        $('#form_errors').append(htmlContent);
        resultStatus = false;
    }
    if (!formData.state) {
        htmlContent = apprendEmptyErrorCreateJob('Job must be located in a state');
        $('#form_errors').append(htmlContent);
        resultStatus = false;
    }
    if (!formData.city) {
        htmlContent = apprendEmptyErrorCreateJob('Job must be located in a city');
        $('#form_errors').append(htmlContent);
        resultStatus = false;
    }
    return resultStatus;
}

$('#submitNewJob').click(function () {
    const title = $('#title').val();
    const description = $('#description').val();
    const requirements = $('#requirements').val();
    const category = $('#category').val();
    const subcategory = $('#subcategory').val();
    const country = $('#country').val();
    const state = $('#state').val();
    const city = $('#city').val();
    const job_type = $('#job_type').val();
    const level = $('#level').val();
    const submitFormData = { title, description, requirements, category, subcategory, country, state, city, job_type, level }
    // Validate
    const validationResult = validateNewJobCreation(submitFormData);
    if (validationResult) {
        // Submit
        $.ajax({
            method: "POST",
            dataType: "json",
            url: "/api/mock_store_jobs",
            data: submitFormData
        })
            .done(function (result) {
                if (result.status === 'success') {
                    location.href = '/jobs';
                }
            });
    }
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
    if (isRecruiterJobCreationPage) {
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
    if (isRecruiterJobCreationPage) {
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
    if (isRecruiterJobCreationPage) {
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

function sortJobsArray(array, order = 'desc') {
    if (order === 'asc') {
        return array.sort(function (a, b) { return b.creation_timestamp - a.creation_timestamp });
    }
    return array.sort(function (a, b) { return a.creation_timestamp - b.creation_timestamp });
}

function cleanJobsPanel() {
    $('#listed_jobs').html('');
}

function checkMoreResults() {
    if ($($('.scrollbar-without-scroll > #connections_list')[0]).height() > $($('.scrollbar-without-scroll')[0]).parent().height()) {
        const htmlContent = apprendViewMoreListConnectionsRecruiter();
        $('#connections_list').append(htmlContent);
    }
}

function advanceConnectionList() {
    $('.scrollbar-without-scroll').animate({ scrollTop: 300 }, 700, 'swing', function () { });
}

$('.scrollbar-without-scroll').scroll(function () {
    console.log('scroll called');
    console.log('scroll top ', $(this).scrollTop());
    if (!$(this).scrollTop()) {
        $('#more_results_connections').show();
    } else {
        $('#more_results_connections').hide();
    }
});

$('#selectbasic').change(function () {
    if (isRecruiterJobsInformationPage) {
        const optionSelected = $(this).val();
        const copyOfTheJobListToSort = Array.from(jobList);
        if (optionSelected === '2') {
            const sortedJobs = sortJobsArray(copyOfTheJobListToSort, 'asc');
            cleanJobsPanel();
            for (const job of sortedJobs) {
                const htmlContent = apprendOwnJobRecruiter(job);
                $('#listed_jobs').append(htmlContent);
            }
        } else if (optionSelected === '3') {
            const sortedJobs = sortJobsArray(copyOfTheJobListToSort, 'desc');
            cleanJobsPanel();
            for (const job of sortedJobs) {
                const htmlContent = apprendOwnJobRecruiter(job);
                $('#listed_jobs').append(htmlContent);
            }
        } else {
            cleanJobsPanel();
            for (const job of jobList) {
                const htmlContent = apprendOwnJobRecruiter(job);
                $('#listed_jobs').append(htmlContent);
            }
        }
    }
});