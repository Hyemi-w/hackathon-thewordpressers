<script>
    var div = document.getElementById("clickme"),
            count = 0;
    div.onclick = function () {
            count += 1;
            //var audio = new Audio('assets/audio/scary1.mp3');
            //var audio1 = new Audio('assets/audio/scary2.mp3');
            //audio.play();
            //audio1.play();
            div.innerHTML = "Eggs : " + count;
        };
</script>
