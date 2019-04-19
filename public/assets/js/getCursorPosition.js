document.addEventListener("DOMContentLoaded", init, false);
let counter = 0;
let rarity;

function init()
{
    $('#exampleModalCenter').modal('hide')
    let canvas = document.getElementById("canvas");
    canvas.addEventListener("mousedown", getPosition, false);

}

function getPosition(event) {
    let x = event.x;
    let y = event.y;
    let canvas = document.getElementById("canvas");

    x -= canvas.offsetLeft;
    y -= canvas.offsetTop;

    let playerPos = {x: x, y: y};

    console.log("x:" + x + " y:" + y);

    let objectPos = [
        {x1: 100, y1: 108, x2: 189, y2: 23, name: 'house1'},
        {x1: 434, y1: 114, x2: 527, y2: 18, name: 'house2'},
        {x1: 964, y1: 139, x2: 1147, y2: 19, name: 'house3'},
        {x1: 278, y1: 335, x2: 286, y2: 326, name: 'chest1'},
        {x1: 252, y1: 631, x2: 1186, y2: 228, name: 'forest1'},
        {x1: 343, y1: 740, x2: 569, y2: 627, name: 'forest2'},
        {x1: 346, y1: 830, x2: 427, y2: 749, name: 'forest3'},
        {x1: 554, y1: 911, x2: 562, y2: 842, name: 'river1'},
        {x1: 553, y1: 847, x2: 795, y2: 838, name: 'river2'},
        {x1: 791, y1: 844, x2: 799, y2: 789, name: 'river3'},
        {x1: 793, y1: 800, x2: 1078, y2: 789, name: 'river'},
        {x1: 1075, y1: 892, x2: 1090, y2: 789, name: 'river'},
        {x1: 1076, y1: 895, x2: 1217, y2: 885, name: 'river'},
        {x1: 1219, y1: 911, x2: 1232, y2: 885, name: 'river'},
        {x1: 1371, y1: 554, x2: 1701, y2: 269, name: 'house5'},
        {x1: 1351, y1: 849, x2: 11438, y2: 785, name: 'rock'},
        {x1: 1351, y1: 849, x2: 11438, y2: 785, name: 'house4'}
    ];

    fetch('http://easteregg.wildcodeschool.fr/api/eggs/random', {mode: 'cors'})
        .then(function (response) {
            return response.json();
        })
        .then(function (text) {
            console.log('Request successful', text);
            rarity = text['rarity'];
            $('#exampleModalCenterTitle').text(text['name']);
            $('#imgModal').attr("src", text['image']);
            $('#modalText').html(text['rarity']);
        })
        .catch(function (error) {
            console.log('Request failed', error)
        });


    isClicked(objectPos);

    function isClicked(pos) {
        if (playerPos.x >= 1351 && playerPos.x <= 11438 && playerPos.y <= 849 && playerPos.y >= 785) {
            $('#exampleModalCenter').modal('hide')
            counter -= 2;
        }

        pos.forEach((v) => {
            if (playerPos.x >= v.x1 && playerPos.x <= v.x2 && playerPos.y <= v.y1 && playerPos.y >= v.y2) {
                isEgg();
            }
        })
    }

    function isEgg() {
        switch (rarity) {
            case ('junk') :
                counter -= 2;
                break;
            case ('basic'):
                counter --;
                break;

            case ('fine'):
                counter++;
                break;

            case ('exotic'):
                counter++;
                break;

            case ('masterwork'):
                counter++;
                break;

            case ('rare'):
                counter += 2;
                break;

            case ('ascended'):
                counter += 3;
                break;

            case ('legendary'):
                counter += 3;
                break;
        }
        $('#exampleModalCenter').modal('show');
        document.getElementById('displayEgg').innerHTML = 'Eggs : ' + counter + '&nbsp&nbsp&nbsp&nbsp</div>';  //elementID changé pour marcher avec html div id. C'était 'count'
        if (counter < 0) {
          counter = 0;
          $('#exampleModalCenter').modal('hide');
          document.getElementById('frodo2').style.display = "block";
            var audio = new Audio('scary1.mp3');
            var audio1 = new Audio('scary2.mp3');
            audio.play();
            audio1.play();
          setTimeout(function () {
            window.location = "/Creepy/index";
            }, 10000);
       }
    }
}