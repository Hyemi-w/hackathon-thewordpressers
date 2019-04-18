<script type="text/javascript">
            //var audio = new Audio('assets/audio/scary1.mp3');
            //var audio1 = new Audio('assets/audio/scary2.mp3');
            //audio.play();
            //audio1.play();
    var div = document.getElementById("displayEgg");

    var close = document.getElementById('btn');
    close.onclick = function () {
        div.innerHTML = 'Eggs : {{ eggCount }}';
        window.location.reload()

    }

    var close1 = document.getElementById('btn1');
    close1.onclick = function () {
            div.innerHTML = 'Eggs : {{ eggCount }}';
            window.location.reload()
        }

</script>

