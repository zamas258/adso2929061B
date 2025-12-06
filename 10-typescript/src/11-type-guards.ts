// 11 - Type Guards: verificación de tipos en tiempo de ejecución

type Book = { type: "book"; title: string; pages: number };
type Magazine = { type: "magazine"; title: string; issue: number };
type Media = Book | Magazine;

function isBook(media: Media): media is Book {
    return media.type === "book";
}

function getMediaInfo(media: Media): string {
    if (isBook(media)) {
        return `Book: ${media.title} - ${media.pages} pages`;
    }
    return `Magazine: ${media.title} - Issue ${media.issue}`;
}

const item: Media = { type: "book", title: "Clean Code", pages: 464 };

const output11 = document.getElementById('output11');
if (output11) {
    output11.innerHTML = `
        <li><strong>Media:</strong> ${getMediaInfo(item)}</li>
    `;
}