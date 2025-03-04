function searchVideo() {
    const searchQuery = document.getElementById('search_video').value.trim();
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "User/Video/SelectVideo.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        document.getElementById('Show_Video_menu').innerHTML = xhr.responseText;
      }
    };
    xhr.send("search=" + encodeURIComponent(searchQuery));
  }


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