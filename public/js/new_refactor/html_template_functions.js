function apprendFollowerSectionContent(picture_uri, picture_alt, name, recruiter_type, category) {
    return (
        `<div class="row">
            <div class="col-md-3">
                <img src="/api/assets/${picture_uri}" 
                    style="width: 100%;display:none;" 
                    class="rounded-profile-image" 
                    alt="${picture_alt}">
                <img src="/img/Rolling-1s-200px.gif" class="profile-image-loading-bar" style="width:100%" alt="progress loading">
            </div>
            <div class="col-md-9">
                <h4>${name}</h4>
                <p>${(recruiter_type) === null ? category : recruiter_type}</p>
            </div>
        </div>`
    );
}

function apprendHeaderTalentProfile(picture_uri, meta) {
    return (
        `<div class="col-md-1 profile-pic-col">
            <img src="/api/assets/${picture_uri}" 
                style="width: 100%;" 
                class="profile-talent-image" 
                alt="Profile picture of the talent">
        </div>
        <div class="col-md-2 talent-name-col">
            User Name
            <br>
            City, State, Country
            <br>
            ...
        </div>
        <div class="col-md-6 centered">
            <ul class="list-meta-info-hrz">
                <li>
                    <span>${meta.views}</span>
                    <br>
                    <p>Views</p>
                </li>
                <li>
                    <span>${meta.followers}</span>
                    <br>
                    <p>Followers</p>
                </li>
                <li>
                    <span>${meta.connections}</span>
                    <br>
                    <p>Connections</p>
                </li>
                <li>
                    <span>${meta.following}</span>
                    <br>
                    <p>Following</p>
                </li>
            </ul>
        </div>
        <div class="col-md-3 right-spaced">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-3">I1</div>
                <div class="col-md-3">I2</div>
                <div class="col-md-4 top-space-header">Follow</div>
            </div>
        </div>`
    );
}

function apprendNoOtherVideosFound() {
    return (
        `<p class='no-more-videos'>
            No other videos to show.
        </p>`
    );
}

function apprendHeaderProfileTalentVideoSection(other_videos_ctr) {
    return (
        `<h2 style="font-size:2.3rem;">
            Other videos from this talent (<span id="other_videos_ctr">${other_videos_ctr}</span>)
        </h2>`
    );
}

function apprendBottomActionSectionTalentOtherVideosSection() {
    return (
        `
        <ul style="padding-left: 0px !important;list-style: none;">
            <li style="display: inline-block; /* You can also add some margins here to make it look prettier */ zoom:1; *display:inline; /* this fix is needed for IE7- */">F</li>
            <li style="display: inline-block; /* You can also add some margins here to make it look prettier */ zoom:1; *display:inline; /* this fix is needed for IE7- */ margin-left: 9rem;">G</li>
        </ul>
        `
    );
}

function apprendOtherVideosRowsTalentOtherVideosSection(videos) {
    let generatedVideos = '';
    for (let i = 1; i < videos.length; i++) {
        generatedVideos += `
        <div class="col-md-6">
            <video class="other-talent-videos-preview" poster="https://cdn.mos.cms.futurecdn.net/CBLAP9KSfyz8QGf33WZMSP-1200-80.jpg"></video>
        </div>
        <div class="col-md-6" style="padding-top: 1%;padding-bottom: 1%;">
            <p style='margin-bottom:0px !important;white-space: nowrap;overflow: hidden;text-overflow: ellipsis; '>VIDEO NAME</p>
            <p style='margin-bottom:0px !important;white-space: nowrap;overflow: hidden;text-overflow: ellipsis; '>DESCRIPTION jkfsbadkfb;suadigisadgbsiuadgbuisadbgiuasdb</p>
            <p style='margin-bottom:0px !important;white-space: nowrap;overflow: hidden;text-overflow: ellipsis; '>VIEWS</p>
            ${apprendBottomActionSectionTalentOtherVideosSection()}
        </div>`;
    }
    return generatedVideos;
}

function apprendOtherVideosToShowTalentProfileVideoSection(other_videos_ctr, videos) {
    return (
        `${apprendHeaderProfileTalentVideoSection(other_videos_ctr)}
        <br>
        <div class="row">
            ${apprendOtherVideosRowsTalentOtherVideosSection(videos)}
        </div>
        `
    );
}

function apprendOwnJobRecruiter(job) {
    console.log('job ', job);
    return (
        `<div class="col-md-3 item-vacant">
            <h3>${job.title}</h3>
            <p style="word-break: break-all;">
                <span class="innerCountry">${job.country}</span>,
                <span class="innerState">${job.state}</span>,
                <span class="innerCity">${job.city}</span></p>
            <p style="text-align: justify;">${job.description}</p>
            <p style="text-align: right;" class="pega-derecha timeago-maketime" data-time_mark="${job.creation_timestamp}">${job.creation_time}</p>
        </div>`
    );
}

function apprendEmptyErrorCreateJob(title) {
    return (
        `
        <p style="color:red;">${title}<p>
        `
    );
}

function apprendInnerCountry(label, value) {
    return (
        `<option value='${value}'>${label}</option>`
    );
}

function apprendInnerCategory(key, value) {
    return (
        `<option value='${key}'>${value}</option>`
    );
}

function apprendOwnJobSubcategoriesRecruiter(subcategory) {
    return (
        `<option value='${subcategory._id}'>${subcategory.name}</option>`
    );
}

function apprendSelectableStateJobCreationRecruiter(state) {
    return (
        `<option value="${state.value}">${state.label}</option>`
    );
}

function apprendSelectableCityJobCreationRecruiter(city) {
    return (
        `<option value="${city.value}">${city.label}</option>`
    );
}

function apprendRecruiterConnectionsSectionContent(connection) {
    return (
        `<div class="row" style="padding:2%;">
            <div class="col-md-2">
                <img 
                    src="/api/assets/${connection.picture_uri}" 
                    style="width: 70%; height: 70%; border-radius: 50%; -webkit-border-radius:50%; -moz-border-radius: 50%;"
                >
            </div>
            <div class="col-md-6" style="padding-top: 1%;">
                ${connection.name}</br>
                ${(connection.recruiter_type ? connection.recruiter_type : connection.category + ', ' + connection.subcategory)}
            </div>
            <div class="col-md-2" style="text-align: center;">
                <img src="/img/comment.svg" style="width: 2.5rem;padding-top: 15%;">
            </div>
            <div class="col-md-2" style="padding-top: 1%;">
                <a>Remove</br>Connection</a>
            </div>
        </div>`
    )
}

function apprendRecruiterSuggestionSectionContent(suggestion) {
    return (
        `<div class="row" style="padding:2%;">
            <div class="col-md-3" style="padding-right:0px !important;">
                <img 
                    src="/api/assets/${suggestion.picture_uri}" 
                    style="width: 70%; height: 70%; border-radius: 50%; -webkit-border-radius:50%; -moz-border-radius: 50%;"
                >
            </div>
            <div class="col-md-9" style="padding-top: 1%;padding-left:0px !important;">
                ${suggestion.name}</br>
                ${(suggestion.recruiter_type ? suggestion.recruiter_type : suggestion.category + ', ' + suggestion.subcategory)}
            </div>
        </div>`
    )
}

function apprendViewMoreListConnectionsRecruiter() {
    return (
        `<span id="more_results_connections" style='position:absolute;bottom:15px;left:47%;color:white;background-color:#ccc;text-align:center;font-weight:bold;padding:1%;'>
            <p style='margin:0px;' onclick="advanceConnectionList()">Load more...</p>
        </span>`
    );
}

function apprendTextNoConnectionsSuggestionsToShow() {
    return (
        `</br><p style="text-align:center;">Nothing to show, please try adding another category/subcategory.</p>`
    )
}

function apprendConversationThread(thread) {
    const { thread_id, message, user } = thread;
    return (
        `<div class="row" style="cursor:pointer;" onclick="loadThread('${String(thread_id)}', '${String(user.name)}', '${String(user.picture_uri)}')">
            <div class="col-md-3">
                    <img 
                        src="/api/assets/${user.picture_uri}" 
                        style="width: 70%; height: 70%; border-radius: 50%; -webkit-border-radius:50%; -moz-border-radius: 50%; padding-top: 10%;"
                    >
            </div>
            <div class="col-md-9" style="padding-left:0px;">
                <p style="margin-bottom:0px !important;">
                    <b>
                        ${user.name}
                    </b>
                    / ${(user.recruiter_type) ? user.recruiter_type : user.category + ' ' + user.subcategory}
                </p>
                <p style="width: 70%;white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">${message}</p>
                <span style="position:absolute;right:0px;bottom:10px;">3 days ago</span>
            </div>
        </div><br>`);
}

function apprendThreadBarRecruiter(id, name, picture) {
    return (
        `<div class="row">
            <div class="col-md-2"><img src="/api/assets/${picture}" style="width: 70%; height: 70%; border-radius: 50%; -webkit-border-radius:50%; -moz-border-radius: 50%; padding-top: 10%;" /></div>
            <div class="col-md-7" style="padding-top:3%;font-size: 2.3rem;padding-left:0px;">${name}</div>
            <div class="col-md-3" style="padding-top:3%;font-size:2.4rem;">
                <table>
                    <tr style="text-align:right;">
                        <td onclick="conversationSearchMessage()" style="width: 40%;display:inline;font-size:2.4rem;padding-left:5%;padding-right:5%;"><i class="fa fa-search"></i></td>
                        <td onclick="conversationAttachFileMessage()" style="width: 40%;display:inline;font-size:2.4rem;padding-left:5%;padding-right:5%;"><img src="/img/attach.png" style="width: 22%;"></td>
                        <td onclick="conversationShowOptionsMessage()" style="width: 40%;display:inline;font-size:2.4rem;padding-left:5%;padding-right:5%;">
                            <i class="fa fa-ellipsis-v dropdown-toggle" aria-hidden="true"></i>
                        </td>
                    </tr>
                </table>
            </div>
        </div>`
    );
}