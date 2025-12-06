"use strict";
// 12 - Utility Types: tipos utilitarios de TypeScript
const book = {
    title: "The Great Gatsby",
    author: "F. Scott Fitzgerald",
    year: 1925,
    available: true
};
const preview = { title: book.title, author: book.author };
const output12 = document.getElementById('output12');
if (output12) {
    output12.innerHTML = `
        <li><strong>Title:</strong> ${preview.title}</li>
        <li><strong>Author:</strong> ${preview.author}</li>
    `;
}
