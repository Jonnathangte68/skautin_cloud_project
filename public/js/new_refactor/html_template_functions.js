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
            <p>${job.description}</p>
            <p style="text-align: right;" class="pega-derecha timeago-maketime">${job.creation_time}</p>
        </div>`
    );
} 