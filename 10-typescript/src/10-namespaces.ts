// 10 - Namespaces: agrupación de código relacionado

namespace Library {
    export class Book {
        constructor(public title: string, public year: number) {}
    }
    
    export function getBookInfo(book: Book): string {
        return `${book.title} (${book.year})`;
    }
}

const book = new Library.Book("1984", 1949);
const info = Library.getBookInfo(book);

const output10 = document.getElementById('output10');
if (output10) {
    output10.innerHTML = `
        <li><strong>Book:</strong> ${info}</li>
    `;
}