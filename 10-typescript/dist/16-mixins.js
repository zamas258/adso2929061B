"use strict";
// 15 - Error Handling: manejo de errores con try/catch
function calculateDivision(a, b) {
    if (b === 0)
        throw new Error("Division by zero is not allowed");
    return a / b;
}
let message;
try {
    const result = calculateDivision(10, 2);
    message = `Result: ${result}`;
}
catch (error) {
    message = `Error: ${error.message}`;
}
// Display in browser
const output = document.getElementById('output');
if (output) {
    output.innerHTML = `<li>${message}</li>`;
}
function Timestamped(Base) {
    return class extends Base {
        constructor() {
            super(...arguments);
            this.timestamp = new Date();
        }
    };
}
function Tagged(Base) {
    return class extends Base {
        constructor() {
            super(...arguments);
            this.tag = "Library Item";
        }
    };
}
class Book {
    constructor(title) {
        this.title = title;
    }
}
const TaggedBook = Tagged(Timestamped(Book));
const book = new TaggedBook("1984");
const output16 = document.getElementById('output16');
if (output16) {
    output16.innerHTML = `
        <li><strong>Title:</strong> ${book.title}</li>
        <li><strong>Tag:</strong> ${book.tag}</li>
        <li><strong>Created:</strong> ${book.timestamp.toLocaleString()}</li>
    `;
}
