"use strict";
// 07 - Advanced Types: uso de unión e intersección de tipos
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
const item = { title: "1984", author: "George Orwell", copies: 5 };
const availability = "New";
// Display in browser
const output07 = document.getElementById('output07');
if (output07) {
    output07.innerHTML = `
        <li><strong>Title:</strong> ${item.title}</li>
        <li><strong>Author:</strong> ${item.author}</li>
        <li><strong>Copies:</strong> ${item.copies}</li>
        <li><strong>Condition:</strong> ${availability}</li>
    `;
}
// 08 - Decorators: decoradores de clase y método
function Logger(constructor) {
    console.log('Class created:', constructor.name);
}
function ReadOnly(target, key) {
    Object.defineProperty(target, key, { writable: false });
}
let Library = class Library {
    constructor(books) {
        this.books = books;
        this.name = "City Library";
    }
    info() {
        return `${this.name} has ${this.books} books`;
    }
};
__decorate([
    ReadOnly
], Library.prototype, "name", void 0);
Library = __decorate([
    Logger
], Library);
const library = new Library(500);
const output08 = document.getElementById('output08');
if (output08) {
    output08.innerHTML = `
        <li><strong>Library:</strong> ${library.info()}</li>
        <li><strong>Name:</strong> ${library.name}</li>
        <li><strong>Books:</strong> ${library.books}</li>
    `;
}
