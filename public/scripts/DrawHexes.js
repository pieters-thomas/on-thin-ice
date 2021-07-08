function setup() {

    const HEX_SCALE = 70;
    const HEX_H = Math.ceil(Math.sin(30 * Math.PI / 180) * HEX_SCALE);
    const HEX_R = Math.ceil(Math.cos(30 * Math.PI / 180) * HEX_SCALE);
    const ROW_PARSE = HEX_H + HEX_SCALE;
    const COL_PARSE = HEX_R + HEX_R

    const MAX_ROW = 8;
    const MAX_COL_EVEN = 8;
    const MAX_COL_ODD = MAX_COL_EVEN - 1;

    const canvas = document.getElementById("board");
    canvas.style.width = (MAX_COL_EVEN * COL_PARSE).toString();
    canvas.style.height = (MAX_ROW * (HEX_SCALE + HEX_H) + HEX_H).toString();

    let tile_x = 0;
    let tile_y = 0;
    let tiles_in_row;

    for (let row = 0; row < MAX_ROW; row++) {
        if (row % 2 === 0) {
            tile_x = HEX_R;
            tiles_in_row = MAX_COL_EVEN
        } else {
            tile_x = COL_PARSE;
            tiles_in_row = MAX_COL_ODD
        }
        for (let j = 0; j < tiles_in_row; j++) {
            drawHex(tile_x, tile_y, HEX_SCALE, HEX_H, HEX_R);
            tile_x += COL_PARSE;
        }
        tile_y += ROW_PARSE;
    }

}
let counter = 0;
setup()


function drawHex(x, y, s, h, r) {

    let points = [
        {'x': x, 'y': y},
        {'x': x + r, 'y': y + h},
        {'x': x + r, 'y': y + h + s},
        {'x': x, 'y': y + h + h + s},
        {'x': x - r, 'y': y + h + s},
        {'x': x - r, 'y': y + h},
        {'x': x, 'y': y},
    ]

    let pointsArray = []

    for (let i = 0; i < points.length; i++) {
        pointsArray[i] = points[i]['x'] + " " + points[i]['y']
    }
    pointsArray = pointsArray.toString();
    let polygon = document.createElementNS("http://www.w3.org/2000/svg", "polygon");

    let id = document.getElementsByTagName('polygon').length
    let hex = `<g><polygon points="${pointsArray}" style="fill:snow;stroke:lightblue;stroke-width:4;" class="draggable" id="${id}" /><text>${counter}</text></g>`
    // hex += ``
    // hex += ``
    // hex += ``
    counter++;
    document.getElementById("board").innerHTML += hex;
    // document.getElementById("board").lastElementChild

    // let container = document.createElement('div');
    // document.getElementById("board").lastElementChild.appendChild(container)
    // `<div id="${id}" ondragenter="return dragEnter(event)" ondrop="return dragDrop(event)" ondragover="return dragOver(event)"></div>`;

}


function makeDraggable(evt) {
    let svg = evt.target;
    let selectedElement = false;

    svg.addEventListener('mousedown', startDrag);
    svg.addEventListener('mousemove', drag);
    svg.addEventListener('mouseup', endDrag);
    svg.addEventListener('mouseleave', endDrag);

    function startDrag(evt) {
        if (evt.target.classList.contains('draggable')) {
            selectedElement = evt.target;
        }
    }

    function drag(evt) {
        if (selectedElement) {
            evt.preventDefault();
            let coordinates = getMousePosition(evt);
            selectedElement.setAttributeNS(null, "cx", coordinates.x.toString());
            selectedElement.setAttributeNS(null, "cy", coordinates.y.toString());
        }
    }

    function endDrag(evt) {
        selectedElement = null;
    }

    function getMousePosition(evt) {
        let CTM = svg.getScreenCTM();
        return {
            x: (evt.clientX - CTM.e) / CTM.a,
            y: (evt.clientY - CTM.f) / CTM.d
        };
    }
}

// let token = document.createElementNS("http://www.w3.org/2000/svg", 'circle');
//
// token.setAttribute('id', 'token');
// token.setAttribute('cx', '50');
// token.setAttribute('cy', '50');
// token.setAttribute('r', '40');
// token.setAttribute('stroke', 'red');
// token.setAttribute('stroke-width', '5');
// token.setAttribute('fill', 'black');
// token.setAttribute('class', 'draggable');
//
// // let token = `<circle id="token" cx="50" cy="50" r="40" stroke="red" stroke-width="5" fill="black" class="draggable"/>`;
//
// document.getElementsByTagName('g')[0].appendChild(token)
//
// let holder;
// let placing = false;
// document.getElementById('token').addEventListener('click', (evt)=>{
//    holder = evt.target
//     console.log(holder)
// })

let max_penguins = 4;
let penguins_placed = 0;
let moving_from_tile = null;
let moving_penguin = false;
let valid_moves = [];

document.querySelectorAll('polygon').forEach((child) => {
    child.addEventListener('click', (evt) => {
        if (evt.target.style.fill === 'snow' && penguins_placed < max_penguins)
        {
            penguins_placed++
            evt.target.style.fill = 'red';
            return;
        }
        if (penguins_placed === max_penguins)
        {
            if (evt.target.style.fill === 'snow' && moving_penguin && valid_moves.includes(parseInt(evt.target.id)) ) {
                evt.target.style.fill = 'red';

                document.getElementById(moving_from_tile).remove();
                moving_penguin = false
                moving_from_tile = null;
                return
            }
            if (evt.target.style.fill === 'red' && !moving_penguin)
            {
                evt.target.style.fill = 'green';
                moving_penguin = true;
                moving_from_tile = evt.target.id
                valid_moves = calcValidMoves(evt.target.id)
                return;
            }
            if (evt.target.style.fill === 'green') {
                evt.target.style.fill = 'red';
                moving_penguin = false
                moving_from_tile = null
            }
        }

    })
})

function calcValidMoves(tile_id)
{
    let array = []
    for (let i = 0; i < 60; i++)
    {
        array[i] = i;
    }
    return array
}
