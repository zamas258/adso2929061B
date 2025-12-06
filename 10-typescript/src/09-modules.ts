// 09 - Modules: organización de código con módulos

export class Book {
    constructor(public title: string, public author: string) {}
}

export function createBook(title: string, author: string): Book {
    return new Book(title, author);
}

const book = createBook("The Hobbit", "J.R.R. Tolkien");

const output09 = document.getElementById('output09');
if (output09) {
    output09.innerHTML = `
        <li><strong>Title:</strong> ${book.title}</li>
        <li><strong>Author:</strong> ${book.author}</li>
    `;
}