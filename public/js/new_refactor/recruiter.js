$('document').ready(() => {
    // Mocks 

    const isTalentProfilePage = $('#is_preview_talent_profile_page') && $('#is_preview_talent_profile_page').val() == "true";


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
                    console.log('values ', results);
                    console.log('values ', videos);
                    addHeaderTalentProfile(results);
                    addMainTalentProfileVideoSource(videos);
                    addOtherVideosSection(videos);
                }
            });
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
                console.log('response.users_list ', response.users_list);
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

updateVideoSource = (videoUri, name, id) => {
    $('#bigPreviewTalentVideo').attr("src", '/api/stream/' + videoUri);
    $('#bigPreviewTalentTitleName').text(name);
    $('#bigPreviewTalentTitleName').attr('data-userId', id);
    setTimeout(function () {
        $('#bigPreviewTalentVideo').get(0).play();
    }, 300);
};

openTalentProfilePage = () => {
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