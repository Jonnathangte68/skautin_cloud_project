// Global variables

var isTalentProfilePage = false;
var isJobDescriptionPage = false;
var isRecruiterProfile = false;
var subs = { "music": [{ "_id": 1, "name": "Rock" }, { "_id": 2, "name": "Soul" }, { "_id": 3, "name": "Pop" }, { "_id": 4, "name": "Grunge" }, { "_id": 5, "name": "Indian" }, { "_id": 6, "name": "Classic" }, { "_id": 7, "name": "Alternative" }, { "_id": 8, "name": "Heavy" }] };

// Functions

$('document').ready(() => {
    isTalentHomePage = $('#is_talent_home_page') && $('#is_talent_home_page').val() == "true";
    isJobDescriptionPage = $('#is_job_description') && $('#is_job_description').val() == "true";
    isRecruiterProfile = $('#is_recruiter_profile') && $('#is_recruiter_profile').val() == "true";

    if (isTalentHomePage) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/api/mock_retrieve_jobs_for_talent',
            data: {
                talentId: 'bad62cf5-e61e-4987-9d9a-d29bd693c992',
            },
        })
            .done((response) => {
                if (response.status === "success") {
                    const { results } = response;
                    for (const job of results) {
                        const htmlContent = apprendJobForTalent(job);
                        $('#listed_jobs').append(htmlContent);
                    }
                }
            });
    } else if (isJobDescriptionPage) {
        const uri = location.pathname;
        const jobId = uri.split("/")[uri.split("/").length - 1];
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/api/mock_retrieve_job',
            data: {
                jobId
            },
        })
            .done((response) => {
                if (response.status === "success") {
                    const job = response.results;
                    // Load Header
                    const headerJobDescription = apprendJobDescriptionHeaderTalent(job);
                    $('#job_description').append(headerJobDescription);
                    // Then load content
                    job.subcategory = getSubcategoryTitle(job.category, job.subcategory);
                    job.job_type = toUpper(job.job_type);
                    job.category = toUpper(job.category);
                    job.level = toUpper(job.level);
                    // job.sub_category = toUpper(job.sub_category);
                    const JobDescriptionContent = apprendJobDescriptionContent(job);
                    $('#job_description').append(JobDescriptionContent);
                }
            });
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/api/mock_retrieve_jobs_suggestions_for_talent',
            data: {
                talentId: 'bad62cf5-e61e-4987-9d9a-d29bd693c992',
            },
        })
            .done((response) => {
                console.log('response ', response);
                if (response.status === "success") {
                    const { results } = response;
                    for (const job of results) {
                        const htmlContent = apprendShortJobForTalent(job);
                        $('#suggestions_list').append(htmlContent);
                    }
                }
            });
    } else if (isRecruiterProfile) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/api/mock_retrieve_recruiter_details',
            data: {
                recruiterId: 'bad62cf5-e61e-4987-9d9a-d29bd693c992',
            },
        })
            .done((response) => {
                console.log('response ', response);
                if (response.status === "success") {
                    const { results } = response;
                    const htmlContent = apprendRecruiterDescription(results);
                    $('#recruiter_content').append(htmlContent);
                }
            });
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/api/mock_retrieve_recruiter_job_list',
            data: {
                recruiterId: 'bad62cf5-e61e-4987-9d9a-d29bd693c992',
            },
        })
            .done((response) => {
                console.log('response ', response);
                if (response.status === "success") {
                    const { results } = response;
                    for (const job of results) {
                        const htmlContent = apprendShortJobRecruiterList(job);
                        $('#suggestions_list').append(htmlContent);
                    }
                }
            });
    }
});

function viewJob(jobId) {
    location.href = `/job-description/${jobId}`;
}

function showSuccessAlert(alertMessage) {
    $('#success_body').text(alertMessage);
    $('#hidden_dv').show();
    $(".alert-danger").hide();
    $(".alert-success").fadeTo("slow", 1, function () {
        setTimeout(function () {
            $(".alert-success").hide();
        }, 4000);
    });
}

function showWarningAlert(alertMessage) {
    $('#warning_body').text(alertMessage);
    $('#hidden_dv').show();
    $(".alert-sucess").hide();
    $(".alert-warning").fadeTo("slow", 1, function () {
        setTimeout(function () {
            $(".alert-warning").hide();
        }, 4000);
    });
}

function removeDash(str) {
    return str.replace(/-/g, " ");
}

function toUpper(str) {
    str = removeDash(str);
    return str
        .toLowerCase()
        .split(' ')
        .map(function (word) {
            console.log("First capital letter: " + word[0]);
            console.log("remain letters: " + word.substr(1));
            return word[0].toUpperCase() + word.substr(1);
        })
        .join(' ');
}

function getSubcategoryTitle(category, id) {
    const subsInCategory = subs[category];
    if (subsInCategory) {
        const subcategoriesFromCategory = subsInCategory.find(sub => sub._id === id);
        return subcategoriesFromCategory.name;
    }
}

function viewRecruiterProfile(id) {
    location.href = `/recruiter-profile/${id}`;
}

function applyToJob(jobId) {
    showSuccessAlert('Your application the Job has been received.');
    // showWarningAlert('Your had already apply for this position.');
}