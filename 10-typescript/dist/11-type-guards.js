"use strict";
// 11 - Type Guards: verificación de tipos en tiempo de ejecución
function isBook(media) {
    return media.type === "book";
}
function getMediaInfo(media) {
    if (isBook(media)) {
        return `Book: ${media.title} - ${media.pages} pages`;
    }
    return `Magazine: ${media.title} - Issue ${media.issue}`;
}
const item = { type: "book", title: "Clean Code", pages: 464 };
const output11 = document.getElementById('output11');
if (output11) {
    output11.innerHTML = `
        <li><strong>Media:</strong> ${getMediaInfo(item)}</li>
    `;
}
