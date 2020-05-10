// Global variables

var isTalentProfilePage = false;
var isRecruiterJobsInformationPage = false;
var isRecruiterJobCreationPage = false;
var isRecruiterConnectionPage = false;
var isRecruiterConversationPage = false;
var isSettingsPage = false;
var jobList = [];

// Functions

$('document').ready(() => {
    // Mocks 

    isTalentProfilePage = $('#is_preview_talent_profile_page') && $('#is_preview_talent_profile_page').val() == "true";
    isRecruiterJobsInformationPage = $('#is_recruiter_jobs_information_page') && $('#is_recruiter_jobs_information_page').val() == "true";
    isRecruiterJobCreationPage = $('#is_recruiter_job_creation_page') && $('#is_recruiter_job_creation_page').val() == "true";
    isRecruiterConnectionPage = $('#is_recruiter_connection_page') && $('#is_recruiter_connection_page').val() == "true";
    isRecruiterConversationPage = $('#is_recruiter_conversations_page') && $('#is_recruiter_conversations_page').val() == "true";
    isSettingsPage = $('#is_settings_page') && $('#is_settings_page').val() == "true";


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
    } else if (isRecruiterConversationPage) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/api/retrieve_conversation_threads',
        })
            .done((response) => {
                if (response) {
                    const { results } = response;
                    for (const thread of results) {
                        const htmlContent = apprendConversationThread(thread);
                        $('#conversation-threads').append(htmlContent);
                        $($('#conversation-threads > .row')[0]).trigger('click');
                    }
                }
            });
    } else if (isSettingsPage) {
        $('.panel-hidden-notifications').hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajaxSetup({ cache: true }); // since I am using jquery as well in my app
        $.getScript('//connect.facebook.net/en_US/sdk.js', function () {
            // initialize facebook sdk
            FB.init({
                appId: '722008658215991', // replace this with your id
                status: true,
                cookie: true,
                version: 'v2.8'
            });

            // attach login click event handler
            $("#btn-login").click(function () {
                FB.login(processLoginClick, { scope: 'public_profile,email,user_friends,pages_messaging', return_scopes: true });
            });
        });

        // function to send uid and access_token back to server
        // actual permissions granted by user are also included just as an addition
        function processLoginClick(response) {
            var uid = response.authResponse.userID;
            var access_token = response.authResponse.accessToken;
            var permissions = response.authResponse.grantedScopes;
            var data = {
                uid: uid,
                access_token: access_token,
                _token: '{{ csrf_token() }}', // this is important for Laravel to receive the data
                permissions: permissions
            };
            postData("{{ url('/loginfb') }}", data, "post");
        }

        // function to post any data to server
        function postData(url, data, method) {
            method = method || "post";
            var form = document.createElement("form");
            form.setAttribute("method", method);
            form.setAttribute("action", url);
            for (var key in data) {
                if (data.hasOwnProperty(key)) {
                    var hiddenField = document.createElement("input");
                    hiddenField.setAttribute("type", "hidden");
                    hiddenField.setAttribute("name", key);
                    hiddenField.setAttribute("value", data[key]);
                    form.appendChild(hiddenField);
                }
            }
            document.body.appendChild(form);
            form.submit();
        }

        if (window.location.href.includes("global-settings")) {
            $('#settingslk').css({ 'height': '0px', 'display': 'block' });
            $('#settingslk').animate({ height: 'auto' }, "slow", function () { $('#settingslk').css({ 'height': 'auto' }); });
        } else if (window.location.href.includes("account-management")) {
            $('#accountlk').css({ 'height': '0px', 'display': 'block' });
            $('#accountlk').animate({ height: 'auto' }, "slow", function () { $('#accountlk').css({ 'height': 'auto' }); });
        } else if (window.location.href.includes("help")) {
            $('#helplk').css({ 'height': '0px', 'display': 'block' });
            $('#helplk').animate({ height: 'auto' }, "slow", function () { $('#helplk').css({ 'height': 'auto' }); });
        } else {
            setTimeout(() => {
                $('#fb_invites').trigger('click');
            }, 300);
        }
    } else {
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

function loadThread(id, name, picture) {
    const htmlContent = apprendThreadBarRecruiter(id, name, picture);
    $($('.scrollbar-without-scroll')[0]).append(htmlContent);
    loadMessages(id);
}

function loadMessages(id) {
    $.ajax({
        url: "/api/retrieve_thread_messages",
        dataType: "json",
        data: {
            thread_id: id,
        },
        type: "post",
        success: function (response) {
            const { results } = response;
            if (results) {
                results.forEach(msg => {
                    if (msg.sender === "X") {
                        const htmlContent = apprendMessageRecruiter(msg, 'left');
                        $('#container-for-messages').append(htmlContent);
                    } else {
                        const htmlContent = apprendMessageRecruiter(msg, 'right');
                        $('#container-for-messages').append(htmlContent);
                    }
                });
            }
        },
        error: function (xhr) {
            //console.log(xhr);
        }
    });
}

function conversationSearchMessage() {
    alert("One");
}

function conversationAttachFileMessage() {
    alert("Two");
}

function conversationShowOptionsMessage() {
    if ($('#chat-option-dropdown').css('display') === "none") {
        document.getElementById('chat-option-dropdown').style.display = "block";
    } else {
        document.getElementById('chat-option-dropdown').style.display = "none";
    }
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

$('#enlacesettingslk').click(function () {
    if ($('#settingslk').is(':visible')) {
        $('#settingslk').animate({ height: '0px' }, "slow", function () { $('#settingslk').hide(); });
    } else {
        $('#settingslk').css({ 'height': '0px', 'display': 'block' });
        $('#settingslk').animate({ height: 'auto' }, "slow", function () { $('#settingslk').css({ 'height': 'auto' }); });
        $('#accountlk').animate({ height: '0px' }, "slow", function () { $('#accountlk').hide(); });
        $('#helplk').animate({ height: '0px' }, "slow", function () { $('#helplk').hide(); });
    }
});
$('#enlaceaccountlk').click(function () {
    if ($('#accountlk').is(':visible')) {
        $('#accountlk').animate({ height: '0px' }, "slow", function () { $('#accountlk').hide(); });
    } else {
        $('#accountlk').css({ 'height': '0px', 'display': 'block' });
        $('#accountlk').animate({ height: 'auto' }, "slow", function () { $('#accountlk').css({ 'height': 'auto' }); });
        $('#settingslk').animate({ height: '0px' }, "slow", function () { $('#settingslk').hide(); });
        $('#helplk').animate({ height: '0px' }, "slow", function () { $('#helplk').hide(); });
    }
});
$('#enlacehelplk').click(function () {
    if ($('#helplk').is(':visible')) {
        $('#helplk').animate({ height: '0px' }, "slow", function () { $('#helplk').hide(); });
    } else {
        $('#helplk').css({ 'height': '0px', 'display': 'block' });
        $('#helplk').animate({ height: 'auto' }, "slow", function () { $('#helplk').css({ 'height': 'auto' }); });
        $('#settingslk').animate({ height: '0px' }, "slow", function () { $('#settingslk').hide(); });
        $('#accountlk').animate({ height: '0px' }, "slow", function () { $('#accountlk').hide(); });
    }
});

$('#btn-notificaciones').click(function () {
    $('.panel-hidden-notifications').toggle();
});

/*Retrieve facebook friends */
$("#fb_invites").click(function () {
    FB.ui({
        app_id: '722008658215991',
        method: 'send',
        display: "iframe",
        name: "sdfds jj jjjsdj j j ",
        link: 'https://apps.facebook.com/xxxxxxxaxsa',
        description: 'sasa d d dssd ds sd s s s '

    });
});

$('#del_account').click(function () {
    try {
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: "POST",
                    url: "/api/delete-user",
                    data: {}
                })
                    .done(function (msg) {
                        swal(
                            'Deleted!',
                            'Account has been deleted.',
                            'success'
                        )
                        location.replace("{!! route('logOut') !!}");
                    });
            } else {
                return true;
            }
        })
    } catch (err) {
        console.log("ERROR CODE: AW11");
        console.log(err);
    }
});

$('#private_acc').click(function () {
    try {
        swal({
            title: "Are you sure?",
            text: "If you become Private, will not appear on searches and couldn't be contact by people outside your connections!",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Privatize me!'
        })
            .then((willDelete) => {
                if (willDelete.value) {
                    $.ajax({
                        method: "POST",
                        url: "/change-privateaccount-status",
                        data: {}
                    })
                        .done(function (msg) {
                            if (msg) {
                                swal(
                                    'Change has been made!',
                                    'You\'re now a private user.',
                                    'success'
                                )
                            } else {
                                swal(
                                    'Something bad happen!',
                                    'Error processing the request.',
                                    'error'
                                )
                            }
                        });

                } else {
                    return true;
                }
            })
    } catch (err) {
        console.log("ERROR CODE: AW10");
        console.log(err);
    }
});