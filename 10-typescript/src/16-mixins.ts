// 15 - Error Handling: manejo de errores con try/catch

function calculateDivision(a: number, b: number): number {
    if (b === 0) throw new Error("Division by zero is not allowed");
    return a / b;
}

let message: string;

try {
    const result = calculateDivision(10, 2);
    message = `Result: ${result}`;
} catch (error: any) {
    message = `Error: ${error.message}`;
}

// Display in browser
const output = document.getElementById('output');
if (output) {
    output.innerHTML = `<li>${message}</li>`;
}

// 16 - Mixins: combinación de múltiples clases

type Constructor = new (...args: any[]) => {};

function Timestamped<T extends Constructor>(Base: T) {
    return class extends Base {
        timestamp = new Date();
    };
}

function Tagged<T extends Constructor>(Base: T) {
    return class extends Base {
        tag = "Library Item";
    };
}

class Book {
    constructor(public title: string) {}
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