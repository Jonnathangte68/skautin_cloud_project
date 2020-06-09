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

function apprendJobForTalent(job) {
    return (
        `<div class="col-md-3 item-vacant">
            <h3>${job.title}</h3>
            <p style="text-align: justify;">${job.recruiter.name} / ${job.recruiter.type}</p>
            <p style="word-break: break-all;">
                <span class="innerCountry">${job.country}</span>,
                <span class="innerState">${job.state}</span>,
                <span class="innerCity">${job.city}</span></p>
            <table>
                <tr>
                    <td width="50%">${job.creation_time}</td>
                    <td width="50%"><button class="btn btn-primary" onclick="viewJob(${job.id})">Apply</button></td>
                <tr>
            </table>
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
                        <td id="open_dd_files" onclick="conversationShowOptionsMessage()" style="width: 40%;display:inline;font-size:2.4rem;padding-left:5%;padding-right:5%;">
                            <i class="fa fa-ellipsis-v dropdown-toggle" aria-hidden="true"></i>
                        </td>
                    </tr>
                </table>
            </div>
        </div>`
    );
}

function apprendMessageRecruiter(msg, style_class) {
    console.log('msg ', msg);
    if (style_class === "right") {
        return (
            `
                <tr>
                    <td style="width:50%;"></td>
                    <td style="width:50%;" class="message-content-container-sender">${msg.content}</td>
                <tr>
            `
        );
    } else {
        return (
            `
                <tr>
                    <td style="width:50%;" class="message-content-container-receiver">${msg.content}</td>
                    <td style="width:50%;"></td>
                <tr>
            `
        );
    }
}

function apprendSearchResultCard(data, type) {
    if (type !== 2) {
        return (
            `<div class="col-md-4 ${(type === 0) ? 'talent-card' : 'recruiter-card'}">
                    <div class="col-md-3" style="padding-right:0px !important;">
                        <img 
                            src="/api/assets/${data.picture_uri}" 
                            style="width: 70%; height: 70%; border-radius: 50%; -webkit-border-radius:50%; -moz-border-radius: 50%;"
                        >
                    </div>
                    <div class="col-md-9" style="padding-top: 1%;padding-left:0px !important;">
                        ${data.name}</br>
                        <p style="word-break: break-all;">
                        <span class="innerCountry">${data.country}</span>,
                        <span class="innerState">${data.state}</span>,
                        <span class="innerCity">${data.city}</span></p>
                        <p style="text-align: justify;">${(type === 0) ? data.category + '/' + data.subcategory : data.recruiter_type}</p>
                    </div>
                </div>`
        );
    } else {
        return (
            `
            <div class="col-md-4 job-card">
                <div class="col-md-3" style="padding-right:0px !important;">
                    <img 
                        src="/api/assets/${data.picture_uri}" 
                        style="width: 70%; height: 70%; border-radius: 50%; -webkit-border-radius:50%; -moz-border-radius: 50%;"
                    >
                </div>
                <div class="col-md-9" style="padding-top: 1%;padding-left:0px !important;">
                    ${data.title}</br>
                    <p style="word-break: break-all;">
                    <span class="innerCountry">${data.country}</span>,
                    <span class="innerState">${data.state}</span>,
                    <span class="innerCity">${data.city}</span></p>
                    <p style="text-align: justify;">${data.description}</p>
                    <p style="text-align: right;" class="pega-derecha timeago-maketime" data-time_mark="${data.creation_timestamp}">${data.creation_time}</p>
                </div>
            </div>
            `
        );
    }
}

function apprendJobDescriptionHeaderTalent(job) {
    console.log('apprendJobDescriptionHeaderTalent ', job);
    return (
        `<div class="row">
            <div class="col-md-2">
                <img src="/api/assets/${job.recruiter.picture_uri}" style="width: 100%; height: 100%; padding-top: 30%; border-radius: 50%; -webkit-border-radius:50%; -moz-border-radius: 50%;" />
            </div>
            <div class="col-md-3 item-vacant">
                <h3>${job.title}</h3>
                <p style="text-align: justify;">${job.recruiter.name} / ${job.recruiter.type}</p>
                <p style="word-break: break-all;">
                    <span class="innerCountry">${job.country}</span>,
                    <span class="innerState">${job.state}</span>,
                    <span class="innerCity">${job.city}</span></p>
                <p style="text-align: justify;">${job.creation_time}</p>
            </div>
            <div class="col-md-7" style="text-align:right;padding-top: 6%;">
                <button class="btn btn-primary" onclick="applyToJob(${job.id})">Apply</button>
                <a href="#" class="linklittlf" onclick="viewRecruiterProfile(${job.recruiter.id})"><img src="/img/goto.png" style="width: 38px;"></a>
        		<a href="#" class="linklittlf"><i class="fas fa-ellipsis-h"></i></a>
            </div>
        </div>`
    );
}

function apprendJobDescriptionContent(job) {
    console.log('job details ', job);
    return (
        `<div class="row">
            <div class="col-md-9">
                <div class="class-md-12"><h3 style="margin-left:35px;">Job Description</h3></div>
                <p id="description_content" style="text-align: justify; margin-left: 6%; margin-right: 6%;">
                    ${job.description}
                </p>
                <div class="class-md-12"><h3 style="margin-left:35px;">Requirements</h3></div>
                <p id="requirements_content" style="text-align: justify; margin-left: 6%; margin-right: 6%;">
                    ${job.requirements}
                </p>
            </div>
            <div class="col-md-3" style="padding: 0px !important;">
                <div class="row">
                    <div class="col-md-1" style="height: 25vh; border-left: 1px solid #ddd; margin-top: 10%; margin-bottom: 10%; padding-left: 5%;">
                        <span style="color:transparent;">.</span>
                    </div>
                    <div class="col-md-9" style="margin-top:3%;">
                        <p style="font-size: 1.6rem; font-weight: bold; margin-bottom: 20%;">${job.category}</p>
                        <p style="font-size: 1.6rem; margin-bottom: 20%">${job.subcategory}</p>
                        <p style="font-size: 1.6rem; margin-bottom: 20%;">${job.level}</p>
                        <p style="font-size: 1.6rem; margin-bottom: 20%">${job.job_type}</p>
                    </div>
                </div>
            </div>
        </div>`
    );
}

function apprendShortJobForTalent(job) {
    return (`<div class="row" style="padding:2%;">
        <div class="col-md-3" style="padding-right:0px !important;">
            <img 
                src="/api/assets/${job.recruiter.picture_uri}" 
                style="width: 70%; height: 70%; border-radius: 50%; -webkit-border-radius:50%; -moz-border-radius: 50%;"
            >
        </div>
        <div class="col-md-9" style="padding-top: 1%;padding-left:0px !important;">
        <h3 style="margin-top: 0px !important;">${job.title}</h3>
        <p style="text-align: justify;">${job.recruiter.name} / ${job.recruiter.type}</p>
        <p style="word-break: break-all;">
            <span class="innerCountry">${job.country}</span>,
            <span class="innerState">${job.state}</span>,
            <span class="innerCity">${job.city}</span></p>
        <p style="text-align: justify;">${job.creation_time}
            <button class="btn btn-primary">Apply</button></p>
        </div>
    </div>`);
}

function apprendRecruiterDescription(recruiter) {
    console.log('recruiter details ', recruiter);
    return (`
        <div class="row" style="padding-top: 2%; padding-left: 6% !important;">
            <div class="col-md-4">
                <img 
                    src="/api/assets/${recruiter.picture_uri}" 
                    style="width: 100%; height: 22rem;"
                >
            </div>
            <div class="col-md-4">
                <ul style="list-style-type: none;">
                    <li style="margin-bottom: 1rem;">Name: ${recruiter.name}</li>
                    <li style="margin-bottom: 1rem;">Type: ${recruiter.type}</li>
                    <li style="margin-bottom: 1rem;">City: ${recruiter.city}</li></ul>
            </div>
            <div class="col-md-4">
                <ul style="list-style-type: none; margin-top: 40%;">
                    <li style="display:inline;">
                        <button class="btn btn-primary">Connect</button>
                    </li>
                    <li style="display:inline;">
                        <button class="btn btn-primary">Follow</button>
                    </li>
                <ul>
            </div>
        </div>
        <div class="row" style="padding-top: 2%; padding-left: 6% !important;">
            <div class="col-md-8">
                <h2>About the recruiter</h2>
                <br>
                <p style='text-align:justify;'>${recruiter.sumary}</p>
            </div>
        </div>
    `);
}

function apprendShortJobRecruiterList(job) {
    return (`
        <div class="row" style="padding:2%;">
            <div class="col-md-2">
                <i class="fa fa-circle" aria-hidden="true" style="font-size: 0.6em;"></i>
            </div>
            <div class="col-md-10" style="padding-left:0px !important;">
                <h3 style="margin-top: 0px !important;">
                    ${job.title}
                </h3>
                <p style="word-break: break-all;">
                    <span class="innerCountry">${job.country}</span>,
                    <span class="innerState">${job.state}</span>,
                    <span class="innerCity">${job.city}</span>
                </p>
                <p style="text-align: justify;">${job.creation_time}
                    <button class="btn btn-primary">Apply</button>
                </p>
            </div>
        </div>
    `);
}