// 14 - Promises: manejo de operaciones asíncronas con promesas

function getBook(): Promise<string> {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            resolve("Lord of the Rings");
        }, 500);
    });
}

getBook()
    .then((book) => {
        const output14 = document.getElementById('output14');
        if (output14) {
            output14.innerHTML = `
                <li><strong>Book:</strong> ${book}</li>
                <li><strong>Status:</strong> Promise resolved</li>
            `;
        }
    })
    .catch((error) => {
        console.error(error);
    });