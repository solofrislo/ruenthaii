function showVideo(wrapperId, playerId) {
    var wrapper = document.getElementById(wrapperId);
    var player = document.getElementById(playerId);
    wrapper.style.display = 'none';
    player.style.display = 'block';
    var video = player.querySelector('video');
    if (video) {
        video.play();
    }
    var iframe = player.querySelector('iframe');
    if (iframe) {
        var src = iframe.getAttribute('src');
        if (src.indexOf('autoplay=1') === -1) {
            src += (src.indexOf('?') === -1 ? '?' : '&') + 'autoplay=1';
            iframe.setAttribute('src', src);
        }
    }
}