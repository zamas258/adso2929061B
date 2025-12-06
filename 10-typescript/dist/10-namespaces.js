"use strict";
// 10 - Namespaces: agrupación de código relacionado
var Library;
(function (Library) {
    class Book {
        constructor(title, year) {
            this.title = title;
            this.year = year;
        }
    }
    Library.Book = Book;
    function getBookInfo(book) {
        return `${book.title} (${book.year})`;
    }
    Library.getBookInfo = getBookInfo;
})(Library || (Library = {}));
const book = new Library.Book("1984", 1949);
const info = Library.getBookInfo(book);
const output10 = document.getElementById('output10');
if (output10) {
    output10.innerHTML = `
        <li><strong>Book:</strong> ${info}</li>
    `;
}
