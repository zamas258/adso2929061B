"use strict";
// 13 - Async/Await: operaciones asíncronas
async function fetchBookData() {
    return new Promise((resolve) => {
        setTimeout(() => {
            resolve("Book data loaded");
        }, 1000);
    });
}
async function loadData() {
    const output13 = document.getElementById('output13');
    if (output13) {
        output13.innerHTML = `<li>Loading...</li>`;
        const data = await fetchBookData();
        output13.innerHTML = `
            <li><strong>Status:</strong> ${data}</li>
            <li><strong>Book:</strong> Harry Potter</li>
        `;
    }
}
loadData();
