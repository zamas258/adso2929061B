"use strict";
// 15 - Error Handling: manejo de errores con try/catch
class BookNotFoundError extends Error {
    constructor(message) {
        super(message);
        this.name = "BookNotFoundError";
    }
}
function findBook(id) {
    if (id < 0) {
        throw new BookNotFoundError("Invalid book ID");
    }
    return "Harry Potter";
}
let result = "";
let errorMsg = "";
try {
    result = findBook(5);
}
catch (error) {
    if (error instanceof BookNotFoundError) {
        errorMsg = error.message;
    }
}
const output15 = document.getElementById('output15');
if (output15) {
    output15.innerHTML = `
        <li><strong>Book found:</strong> ${result}</li>
        <li><strong>Status:</strong> Success</li>
    `;
}
