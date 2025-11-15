"use strict";
var CardinalDirections;
(function (CardinalDirections) {
    CardinalDirections[CardinalDirections["North"] = 0] = "North";
    CardinalDirections[CardinalDirections["East"] = 1] = "East";
    CardinalDirections[CardinalDirections["South"] = 2] = "South";
    CardinalDirections[CardinalDirections["West"] = 3] = "West";
})(CardinalDirections || (CardinalDirections = {}));
class Numbers {
    constructor() {
        this.items = [];
    }
    addItem(item) {
        this.items.push(item);
    }
    getItems() {
        return this.items;
    }
}
const directionNumbers = new Numbers();
directionNumbers.addItem(CardinalDirections.North);
directionNumbers.addItem(CardinalDirections.East);
directionNumbers.addItem(CardinalDirections.South);
directionNumbers.addItem(CardinalDirections.West);
const output06 = document.getElementById('output06');
if (output06) {
    output06.innerHTML = `
        <li><strong>Directions collected</strong></li>
        <ul>${directionNumbers.getItems().map(item => `<li>${item}</li>`).join('')}</ul>`;
}
