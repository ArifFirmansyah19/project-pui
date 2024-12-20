    $(document).ready(function() {
        $('.summernote').summernote({
            height: 250, // Set editor height
            minHeight: null, // Set minimum height of editor
            maxHeight: null, // Set maximum height of editor
            focus: true, // Set focus to editable area after initializing summernote
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['style', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'youtube']],
                ['view', ['codeview', 'help']],
            ],
            buttons: {
                youtube: function() {
                    var ui = $.summernote.ui;
                    var button = ui.button({
                        contents: '<i class="fa fa-video"/>',
                        tooltip: 'Insert YouTube video',
                        click: function() {
                            var url = prompt('Enter YouTube video URL:');
                            if (url) {
                                var videoId = url.split('v=')[1];
                                if (videoId) {
                                    var ampersandPosition = videoId.indexOf('&');
                                    if (ampersandPosition != -1) {
                                        videoId = videoId.substring(0,
                                            ampersandPosition);
                                    }
                                    var thumbnailUrl = 'https://img.youtube.com/vi/' +
                                        videoId + '/0.jpg';
                                    var embedUrl = 'https://www.youtube.com/watch?v=' +
                                        videoId;
                                    var thumbnailLink =
                                        '<div class="youtube-video-wrapper"><a href="' +
                                        embedUrl + '" target="_blank"><img src="' +
                                        thumbnailUrl +
                                        '" alt="YouTube video" style="max-width:100%;"/></a></div>';
                                    $('#summernote').summernote('pasteHTML',
                                        thumbnailLink);
                                }
                            }
                        }
                    });
                    return button.render();
                }
            },
            styleTags: ['p', 'blockquote', 'pre', 'h1', 'h2', 'h3', 'h4', 'h5',
                'h6'
            ],
            video: {
                urlInputPlaceholder: 'paste your video link'
            } // Include all heading tags

        });
    });