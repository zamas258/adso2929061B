// 09 - Modules: organización de código con módulos
export class Book {
    constructor(title, author) {
        this.title = title;
        this.author = author;
    }
}
export function createBook(title, author) {
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
