// Zuck stories and stories data

var timestamp = function() {
  var timeIndex = 0;
  var shifts = [35, 60, 60 * 3, 60 * 60 * 2, 60 * 60 * 25, 60 * 60 * 24 * 4, 60 * 60 * 24 * 10];

  var now = new Date();
  var shift = shifts[timeIndex++] || 0;
  var date = new Date(now - shift * 1000);

  return date.getTime() / 1000;
};


// Stories data

// Update your story below
function initZuckStories(storiesData) {
    new Zuck('stories', {
        backNative: true,
        skin: 'snapgram',
        autoFullScreen: false,
        avatars: true,
        list: false,
        cubeEffect: true,
        localStorage: true,
        stories: storiesData
    });
}
;
