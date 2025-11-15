"use strict";
//Generic inventory for any type
class Inventory {
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
const charmInventory = new Inventory();
charmInventory.addItem('Mothwing Cloak');
charmInventory.addItem('Crystal Heart');
const output05 = document.getElementById('output05');
if (output05) {
    output05.innerHTML = `
        <li><strong>Charms collected</strong></li>
        <ul>${charmInventory.getItems().map(item => `<li>${item}</li>`).join('')}</ul>`;
}
